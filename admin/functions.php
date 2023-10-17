<?php

function insertCategories()
{
    global $connection;

    if (isset($_POST['submit'])) {
        $cat_title = $_POST['cat_title'];

        if ($cat_title == "" || empty($cat_title)) {
            echo "This field should not be empty!";
        } else {
            if (!$connection) {
                die("Sorry, we're experiencing technical difficulties.");
            }

            $query = "INSERT INTO categories(cat_title) VALUES (?)";
            $stmt = mysqli_prepare($connection, $query);

            if (!$stmt) {
                error_log("Statement preparation failed: " . mysqli_error($connection));
                die("Sorry, we're experiencing technical difficulties.");
            }

            mysqli_stmt_bind_param($stmt, 's', $cat_title);
            $result = mysqli_stmt_execute($stmt);

            if (mysqli_stmt_errno($stmt)) {
                error_log("Statement execution failed: " . mysqli_stmt_error($stmt));
                die("Sorry, we're experiencing technical difficulties.");
            }

            if (!$result) {
                error_log('QUERY FAILED: ' . mysqli_error($connection));
                die("Sorry, we're experiencing technical difficulties.");
            }

            mysqli_stmt_close($stmt);
        }
    }
}

function findAllCategories()
{
    global $connection;

    if (!$connection) {
        die("Sorry, we're experiencing technical difficulties.");
    }

    $query = "SELECT * FROM categories";
    $stmt = mysqli_prepare($connection, $query);

    if (!$stmt) {
        error_log("Statement preparation failed: " . mysqli_error($connection));
        die("Sorry, we're experiencing technical difficulties.");
    }

    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_errno($stmt)) {
        error_log("Statement execution failed: " . mysqli_stmt_error($stmt));
        die("Sorry, we're experiencing technical difficulties.");
    }

    $result = mysqli_stmt_get_result($stmt);

    if (!$result) {
        error_log('QUERY FAILED: ' . mysqli_error($connection));
        die("Sorry, we're experiencing technical difficulties.");
    }

    while ($row = mysqli_fetch_assoc($result)) {
        $cat_id = htmlspecialchars($row['cat_id']);
        $cat_title = htmlspecialchars($row['cat_title']);

        echo "<tr>";
        echo "<td>{$cat_id}</td>";
        echo "<td>{$cat_title}</td>";
        echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
        echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
        echo "</tr>";
    }

    mysqli_stmt_close($stmt);
}

function deleteCategories()
{
    if (isset($_GET['delete'])) {
        global $connection;

        $delete_cat_id = $_GET['delete'];
        $query = "DELETE FROM categories WHERE cat_id = ?";
        $stmt = mysqli_prepare($connection, $query);

        mysqli_stmt_bind_param($stmt, 'i', $delete_cat_id);
        $result = mysqli_stmt_execute($stmt);

        if (mysqli_stmt_errno($stmt)) {
            error_log("Statement execution failed: " . mysqli_stmt_error($stmt));
            die("Sorry, we're experiencing technical difficulties.");
        }

        if (!$result) {
            error_log('QUERY FAILED: ' . mysqli_error($connection));
            die("Sorry, we're experiencing technical difficulties.");
        }

        mysqli_stmt_close($stmt);
        header("Location: categories.php");
    }
}

?>
