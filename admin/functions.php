<?php

// Insert new categories into the database
function insertCategories()
{
    global $connection;

    // Submit check
    if (isset($_POST['submit'])) {
        $cat_title = $_POST['cat_title'];

        // Validation check
        if ($cat_title == "" || empty($cat_title)) {
            echo "This field should not be empty!";
            return;
        }

        if (!$connection) {
            error_log("Connection failed: " . mysqli_connect_error());
            die("Sorry, we're experiencing technical difficulties.");
        }

        // Insert by cat_title query
        $query = "INSERT INTO categories(cat_title) VALUES (?)";
        $stmt = mysqli_prepare($connection, $query);
        if (!$stmt) {
            error_log("Statement preparation failed: " . mysqli_error($connection));
            die("Sorry, we're experiencing technical difficulties.");
        }

        mysqli_stmt_bind_param($stmt, 's', $cat_title);
        // TODO: INSERT -> never uses $result
        $result = mysqli_stmt_execute($stmt);
        if (mysqli_stmt_errno($stmt)) {
            error_log("Statement execution failed: " . mysqli_stmt_error($stmt));
            die("Sorry, we're experiencing technical difficulties.");
        }

        mysqli_stmt_close($stmt);
    }
}

// Fetch all categories from the database
function findAllCategories()
{
    global $connection;
    if (!$connection) {
        error_log("Connection failed: " . mysqli_connect_error());
        die("Sorry, we're experiencing technical difficulties.");
    }

    // Select all categories query
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

// Delete a category based on its ID
function deleteCategories()
{
    global $connection;

    if (isset($_GET['delete'])) {

        if (!$connection) {
            error_log("Connection failed: " . mysqli_connect_error());
            die("Sorry, we're experiencing technical difficulties.");
        }

        $delete_cat_id = intval($_GET['delete']); // Ensuring it's an integer

        // Delete category by cat_id query
        $query = "DELETE FROM categories WHERE cat_id = ?";
        $stmt = mysqli_prepare($connection, $query);
        if (!$stmt) {
            error_log("Statement preparation failed: " . mysqli_error($connection));
            die("Sorry, we're experiencing technical difficulties.");
        }

        mysqli_stmt_bind_param($stmt, 'i', $delete_cat_id);
        $result = mysqli_stmt_execute($stmt);
        if (mysqli_stmt_errno($stmt)) {
            error_log("Statement execution failed: " . mysqli_stmt_error($stmt));
            die("Sorry, we're experiencing technical difficulties.");
        }

        mysqli_stmt_close($stmt);

        // Redirect to categories page
        header("Location: categories.php");

    }
}

?>



