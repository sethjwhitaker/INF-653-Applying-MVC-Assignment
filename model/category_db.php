<?php
    function category_create($name) {
        global $db;

        $count = 0;
        $query = "INSERT INTO categories (categoryname)
                    VALUES (:name)";

        $statement = $db->prepare($query);
        $statement->bindvalue(":name", $name);
        if ($statement->execute()) {
            $count = $statement->rowCount();
        };
        $statement->closeCursor();
        return $count;
    }

    function category_read() {
        global $db;

        $query = "SELECT * FROM categories ORDER BY categoryid";

        $statement = $db->prepare($query);
        $statement->execute();
        $results = $statement->fetchAll();
        $statement->closeCursor();

        return $results;
    }

    function category_update($id, $name) {
        global $db;

        $count = 0;
        $query = "UPDATE categories SET categoryname = :name
                    WHERE categoryid = :id";

        $statement = $db->prepare($query);
        $statement->bindValue(':id', $id);
        $statement->bindvalue(":name", $name);
        if ($statement->execute()) {
            $count = $statement->rowCount();
        };
        $statement->closeCursor();
        return $count;
    }

    function category_delete($id) {
        global $db;

        $count = 0;
        $query = "DELETE FROM categories WHERE categoryid = :id";

        $statement = $db->prepare($query);
        $statement->bindValue(':id', $id);
        if ($statement->execute()) {
            $count = $statement->rowCount();
        };
        $statement->closeCursor();
        return $count;
    }