<?php
    function item_create($title, $description, $category_id) {
        global $db;

        $count = 0;
        $query = "INSERT INTO todoitems (title, description, categoryid)
                    VALUES (:title, :description,
                        (SELECT categoryid FROM categories 
                        WHERE categoryid = :category_id)
                    )";

        $statement = $db->prepare($query);
        $statement->bindvalue(":title", $title);
        $statement->bindvalue(":description", $description);
        $statement->bindvalue(":category_id", $category_id);
        if ($statement->execute()) {
            $count = $statement->rowCount();
        };
        $statement->closeCursor();
        return $count;
    }

    function item_read() {
        global $db;

        $query = "SELECT itemnum, title, description, t.categoryid, categoryname category
                    FROM todoitems t, categories c
                    WHERE t.categoryid = c.categoryid 
                    ORDER BY t.categoryid, itemnum";

        $statement = $db->prepare($query);
        $statement->execute();
        $results = $statement->fetchAll();
        $statement->closeCursor();

        return $results;
    }

    function item_read_by_category($category_id) {
        global $db;

        $query = "SELECT itemnum, title, description, t.categoryid, categoryname category
                    FROM todoitems t, categories c
                    WHERE t.categoryid = c.categoryid AND t.categoryid = :category_id
                    ORDER BY itemnum";

        $statement = $db->prepare($query);
        $statement->bindvalue(":category_id", $category_id);
        $statement->execute();
        $results = $statement->fetchAll();
        $statement->closeCursor();

        return $results;
    }

    function item_delete($id) {
        global $db;

        $count = 0;
        $query = "DELETE FROM todoitems WHERE itemnum = :id";

        $statement = $db->prepare($query);
        $statement->bindValue(':id', $id);
        if ($statement->execute()) {
            $count = $statement->rowCount();
        };
        $statement->closeCursor();
        return $count;
    }