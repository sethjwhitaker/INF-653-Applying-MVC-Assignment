<section class="results item-results">
    <?php
        $cat = "";
        if(!empty($results)) {
            foreach($results as $result) {
                $rid = $result["itemnum"];
                $rtitle = $result["title"];
                $rdesc = $result["description"];
                $rcatid = $result["categoryid"];
                $rcat = $result["category"];

                if($cat != $rcat) {
                    $cat = $rcat;
    ?>
        <div class="category">
            
            <h2><a href=".?action=category&category_id=<?=$rcatid?>"><?=$cat?></a></h2>
        </div>
    <?php       } ?>
 
        <div class="card item-card">
            <form class="complete" action="." method="POST">
                <input type="hidden" name="action" value="delete-item">
                <input type="hidden" name="id" value="<?= $rid ?>">
                <button type="submit" class="complete-button"></button>
            </form>
            <h3>
                <?= $rtitle ?>
            </h3>
            <p>
                <?= $rdesc ?>
            </p>
        </div>
    <?php 
        }} else { 
    ?>
        <h3 class="empty-results">No to do list items exist yet.</h3>
    <?php } ?>
</section>