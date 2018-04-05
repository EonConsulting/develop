    <div class="container-fluid">

        <div class="content-page shadow">
            <h3 style="margin: 0px;"><?php echo $content->title; ?></h3>
            <hr>
            <div>
                <?php echo $content->body; ?>
            </div>
        
        </div>
        <div style="margin: 15px;">
            <span>Tags: </span>
            <?php foreach($content->tags as $tag => $count): ?>
            <span class="label label-default"><?php echo $tag ?></span>
            <?php endforeach; ?>
        </div>
       
    </div>

