<!-- Update Category -->
<form action="" method="post">
    <div class="form-group">
        <label for="cat-title">Edit Category</label>

        <?php

        // Query for displaying category to edit
        if (isset($_GET['edit'])) {

            // Connection check
            if (!$connection) {
                die("Connection failed: " . mysqli_connect_error());
            }

            // Category id query
            $cat_id = intval($_GET['edit']); // Ensuring integer value
            $query = "SELECT * FROM categories WHERE cat_id = ?";

            // Prepare statement
            $stmt = mysqli_prepare($connection, $query);

            // Preparation check
            if (!$stmt) {
                die("Statement preparation failed: " . mysqli_error($connection));
            }

            // Bind parameters
            mysqli_stmt_bind_param($stmt, 'i', $cat_id);

            // Execute statement
            mysqli_stmt_execute($stmt);

            // Execution check
            if (mysqli_stmt_errno($stmt)) {
                die("Statement execution failed: " . mysqli_stmt_error($stmt));
            }

            // Access result
            $result = mysqli_stmt_get_result($stmt);

            // Result check
            if (!$result) {
                die('QUERY FAILED' . mysqli_error($connection));
            }

            // Loop to show "update form" input
            while ($row = mysqli_fetch_assoc($result)) {

                $cat_id = intval($row['cat_id']);
                $cat_title = htmlspecialchars($row['cat_title']); // Protect against XSS

                ?>

                <input value="<?php echo $cat_title; ?>" type="text" class="form-control" name="cat_title">

                <?php
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }

        ?>

        <?php

        if (isset($_POST['update_category'])) {

            // Connection check
            if (!$connection) {
                die("Connection failed: " . mysqli_connect_error());
            }

            $update_cat_id = intval($_GET['edit']); // Ensuring integer value
            $cat_title_to_update = $_POST['cat_title'];

            // Category update query
            $query = "UPDATE categories SET cat_title = ? WHERE cat_id = ?";

            // Prepare statement
            $stmt = mysqli_prepare($connection, $query);

            // Preparation check
            if (!$stmt) {
                die("Statement preparation failed: " . mysqli_error($connection));
            }

            // Bind parameters
            mysqli_stmt_bind_param($stmt, 'si', $cat_title_to_update, $update_cat_id);

            // Execute statement
            mysqli_stmt_execute($stmt);

            // Execution check
            if (mysqli_stmt_errno($stmt)) {
                die("Statement execution failed: " . mysqli_stmt_error($stmt));
            }

            // No need for get_result() since it's an UPDATE operation and not a SELECT

            // Close statement
            mysqli_stmt_close($stmt);

            // GO-TO categories
            header("Location: categories.php");
        }

        ?>

    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update_category" value="Update Category">
    </div>
</form>
