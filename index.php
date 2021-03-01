<?php
    require('model/database.php');
    require("model/item_db.php");
    require("model/category_db.php");

    $action = filter_input(INPUT_POST, "action",  FILTER_SANITIZE_STRING);
    if(!$action) {
        $action = filter_input(INPUT_GET, "action",  FILTER_SANITIZE_STRING);
        if(!$action) {
            $action = "read-items";
        }
    }

    switch ($action) {
        case "create-item":
            $title = filter_input(INPUT_POST, "title", FILTER_SANITIZE_STRING);
            $description = filter_input(INPUT_POST, "description", FILTER_SANITIZE_STRING);
            $category_id = filter_input(INPUT_POST, "category_id", FILTER_SANITIZE_STRING);
            if($title && $description && $category_id) {
                item_create($title, $description, $category_id);
                header("Location: .");
            } else {
                $error_message = "Invalid form data. Check all fields and resubmit.";
                require("view/error.php");
            }
            break;
        case "read-items":
            $results = item_read();
            $categories = category_read();
            require("view/items.php");
            break;
        case "delete-item":
            $id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);
            if($id) {
                item_delete($id);
                header("Location: .");
            } else {
                $error_message = "Invalid item id. Please try again.";
                require("view/error.php");
            }
            break;
        case "create-category":
            $category_name = filter_input(INPUT_POST, "category_name", FILTER_SANITIZE_STRING);
            if($category_name) {
                category_create($category_name);
                header("Location: .?action=read-categories");
            } else {
                $error_message = "Invalid category name. Check field and resubmit.";
                require("view/error.php");
            }
            break;
        case "read-categories":
            $categories = category_read();
            require("view/categories.php");
            break;
        case "category":
            $category_id = filter_input(INPUT_GET, "category_id", FILTER_VALIDATE_INT);
            if($category_id) {
                $results = item_read_by_category($category_id);
                require("view/category.php");
            } else {    
                $error_message = "Invalid Category ID. Please Try again.";
                require("view/error.php");
            }
            break;
        case "update-category":
            $category_name = filter_input(INPUT_POST, "category_name", FILTER_SANITIZE_STRING);
            $category_id = filter_input(INPUT_POST, "category_id", FILTER_VALIDATE_INT);
            if($category_id && $category_name) {
                category_update($category_id, $category_name);
            } else {
                $error_message = "Invalid category name. Check field and resubmit.";
                require("view/error.php");
            }
            break;
        case "delete-category":
            $category_id = filter_input(INPUT_POST, "category_id", FILTER_VALIDATE_INT);
            if($category_id) {
                category_delete($category_id);
                header("Location: .?action=read-categories");
            } else {
                $error_message = "Error deleting category. Please try again.";
                require("view/error.php");
            }
            break;

    }


