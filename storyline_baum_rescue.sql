DROP PROCEDURE IF EXISTS tree_recover;

DELIMITER //

CREATE PROCEDURE tree_recover ()
MODIFIES SQL DATA
BEGIN

    DECLARE currentId, currentParentId  CHAR(36);
    DECLARE currentLeft                 INT;
    DECLARE startId                     INT DEFAULT 1;

    # Determines the max size for MEMORY tables.
    SET max_heap_table_size = 1024 * 1024 * 512;

    START TRANSACTION;

    # Temporary MEMORY table to do all the heavy lifting in,
    # otherwise performance is simply abysmal.
    CREATE TABLE `tmp_tree` (
        `id`        char(36) NOT NULL DEFAULT '',
        `parent_id` char(36)          DEFAULT NULL,
        `_lft`       int(11)  unsigned DEFAULT NULL,
        `_rgt`      int(11)  unsigned DEFAULT NULL,
        PRIMARY KEY      (`id`),
        INDEX USING HASH (`parent_id`),
        INDEX USING HASH (`_lft`),
        INDEX USING HASH (`_rgt`)
    ) ENGINE = MEMORY
    SELECT `id`,
           `parent_id`,
           `_lft`,
           `_rgt`
    FROM   `storyline_items` where storyline_id=84;

    # Leveling the playing field.
    UPDATE  `tmp_tree`
    SET     `_lft`  = NULL,
            `_rgt` = NULL;

    # Establishing starting numbers for all root elements.
    WHILE EXISTS (SELECT * FROM `tmp_tree` WHERE `parent_id` IS NULL AND `_lft` IS NULL AND `_rgt` IS NULL LIMIT 1) DO

        UPDATE `tmp_tree`
        SET    `_lft`  = startId,
               `_rgt` = startId + 1
        WHERE  `parent_id` IS NULL
          AND  `_lft`       IS NULL
          AND  `_rgt`      IS NULL
        LIMIT  1;

        SET startId = startId + 2;

    END WHILE;

    # Switching the indexes for the lft/rght columns to B-Trees to speed up the next section, which uses range queries.
    DROP INDEX `_lft`  ON `tmp_tree`;
    DROP INDEX `_rgt` ON `tmp_tree`;
    CREATE INDEX `_lft`  USING BTREE ON `tmp_tree` (`_lft`);
    CREATE INDEX `_rgt` USING BTREE ON `tmp_tree` (`_rgt`);

    # Numbering all child elements
    WHILE EXISTS (SELECT * FROM `tmp_tree` WHERE `_lft` IS NULL LIMIT 1) DO

        # Picking an unprocessed element which has a processed parent.
        SELECT     `tmp_tree`.`id`
          INTO     currentId
        FROM       `tmp_tree`
        INNER JOIN `tmp_tree` AS `parents`
                ON `tmp_tree`.`parent_id` = `parents`.`id`
        WHERE      `tmp_tree`.`_lft` IS NULL
          AND      `parents`.`_lft`  IS NOT NULL
        LIMIT      1;

        # Finding the element's parent.
        SELECT  `parent_id`
          INTO  currentParentId
        FROM    `tmp_tree`
        WHERE   `id` = currentId;

        # Finding the parent's lft value.
        SELECT  `_lft`
          INTO  currentLeft
        FROM    `tmp_tree`
        WHERE   `id` = currentParentId;

        # Shifting all elements to the right of the current element 2 to the right.
        UPDATE `tmp_tree`
        SET    `_rgt` = `_rgt` + 2
        WHERE  `_rgt` > currentLeft;

        UPDATE `tmp_tree`
        SET    `_lft` = `_lft` + 2
        WHERE  `_lft` > currentLeft;

        # Setting lft and rght values for current element.
        UPDATE `tmp_tree`
        SET    `_lft`  = currentLeft + 1,
               `_rgt` = currentLeft + 2
        WHERE  `id`   = currentId;

    END WHILE;

    # Writing calculated values back to physical table.
    UPDATE `storyline_items`, `tmp_tree`
    SET    `storyline_items`.`_lft`  = `tmp_tree`.`_lft`,
           `storyline_items`.`_rgt` = `tmp_tree`.`_rgt`
    WHERE  `storyline_items`.`id`   = `tmp_tree`.`id`;

    COMMIT;

    DROP TABLE `tmp_tree`;

END//

DELIMITER ;