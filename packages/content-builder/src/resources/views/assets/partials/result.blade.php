<div class="results-entry shadow">
    <div class="results-entry-icon">
        <i class="fa fa-image"></i>
    </div>
    <div class="results-entry-title">
        <?php echo $item['title']; ?>
    </div>
    <div class="results-entry-actions">
        <a href="#" class="deleteEntry" data-asset-id="<?php echo $item['id']; ?>"><i class="fa fa-trash-o"></i></a>
        <a href="#" class="editEntry" data-asset-id="<?php echo $item['id']; ?>"><i class="fa fa-pencil-square-o"></i></a>
        <a href="#" class="previewEntry" data-asset-id="<?php echo $item['id']; ?>"><i class="fa fa-eye"></i></a>
    </div>
</div>