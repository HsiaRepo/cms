<?php

function insertCategories() {

    global $connection;

    if (isset($_POST['submit'])) {

        // TODO Checking if user submits
        // echo "<h1>Hello!</h1>";

        $cat_title = $_POST['cat_title'];

        if ($cat_title == "" || empty($cat_title)) {

            echo "This field should not be empty!";

        } else {

            // TODO Add Logic
            $query = "INSERT INTO categories(cat_title) VALUES (?)";
            $stmt = mysqli_prepare($connection, $query);

            // Bind the parameter
            mysqli_stmt_bind_param($stmt, 's', $cat_title);

            // Execute the statement
            $result = mysqli_stmt_execute($stmt);

            if (!$result) {
                die('QUERY FAILED' . mysqli_error($connection));
            }

        }
    }
}

function findAllCategories() {
    global $connection;

    // Query all categories
    $query = "SELECT * FROM categories";
    $stmt = mysqli_prepare($connection, $query);

    // Execute the statement
    mysqli_stmt_execute($stmt);

    // Get result
    $result = mysqli_stmt_get_result($stmt);

    while ($row = mysqli_fetch_assoc($result)) {

        // Get and Print category id and title
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];

        echo "<tr>";
        echo "<td>{$cat_id}</td>";
        echo "<td>{$cat_title}</td>";
        echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
        echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
        echo "</tr>";

    }

}

function deleteCategories() {

    // Delete Query
    if (isset($_GET['delete'])) {

        global $connection;

        $delete_cat_id = $_GET['delete'];
        $query = "DELETE FROM categories WHERE cat_id = ? ";

        $stmt = mysqli_prepare($connection, $query);

        // Bind the parameter
        mysqli_stmt_bind_param($stmt, 'i', $delete_cat_id);

        // Execute the statement
        $result = mysqli_stmt_execute($stmt);

        if (!$result) {

            die('QUERY FAILED' . mysqli_error($connection));

        }

        header("Location: categories.php");

    }
}

?>