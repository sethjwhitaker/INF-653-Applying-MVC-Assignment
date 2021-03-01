<section class="results category-results">
    <?php
        if(!empty($categories)) {
            foreach($categories as $category) {
                $cid = $category["categoryID"];
                $cname = $category["categoryName"];
    ?>
        <div class="card category-card">
            <form class="delete-category" action="." method="POST">
                <input type="hidden" name="action" value="delete-category">
                <input type="hidden" name="category_id" value="<?= $cid ?>">
                <button type="submit" class="delete-button">Delete</button>
            </form>
            <h3>
                <a href=".?action=category&category_id=<?=$cid?>"><?= $cname ?></a>
            </h3>
        </div>
    <?php }} else { ?>
        <h3 class="empty-results">No categories exist yet.</h3>
    <?php } ?>
</section>