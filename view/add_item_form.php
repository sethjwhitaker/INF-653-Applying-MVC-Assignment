<section class="add add-items">
    <h2>Add Item</h2>
    <form action="." method="POST">
        <input type="hidden" name="action" value="create-item">
        <input type="text" name="title" id="title" placeholder="Title" maxlength="20" autocomplete="off" required>
        <br>
        <input type="text" name="description" id="description" placeholder="Description" maxlength="50" autocomplete="off" required>
        <br>
        <select name="category_id" id="add-item-category">
            <?php
                if(!empty($categories)) {
                    foreach($categories as $category) {
                        $cid = $category["categoryID"];
                        $cname = $category["categoryName"];
            ?>
                <option value="<?= $cid ?>"><?= $cname ?></option>
            <?php
                    }
                }
            ?>
        </select>
        <a href=".?action=read-categories">Edit Categories</a>
        <button type="submit">Add</button>
    </form>
    
</section>