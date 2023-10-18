<!-- Update Category -->
<form action="" method="post">
    <div class="form-group">
        <label for="cat-title">Edit Category</label>

        <?php

        // Query for displaying category to edit
        if (isset($_GET['edit'])) {

            if (!$connection) {
                error_log("Connection failed: " . mysqli_connect_error());
                die("Sorry, we're experiencing technical difficulties.");
            }

            $cat_id = intval($_GET['edit']); // Ensuring integer value

            // Category id query
            $query = "SELECT * FROM categories WHERE cat_id = ?";
            $stmt = mysqli_prepare($connection, $query);
            if (!$stmt) {
                error_log("Statement preparation failed: " . mysqli_error($connection));
                die("Sorry, we're experiencing technical difficulties.");
            }

            mysqli_stmt_bind_param($stmt, 'i', $cat_id);
            mysqli_stmt_execute($stmt);
            if (mysqli_stmt_errno($stmt)) {
                error_log("Statement execution failed: " . mysqli_stmt_error($stmt));
                die("Sorry, we're experiencing technical difficulties.");
            }

            $result = mysqli_stmt_get_result($stmt);
            if (!$result) {
                error_log('QUERY FAILED' . mysqli_error($connection));
                die("Sorry, we're experiencing technical difficulties.");
            }

            while ($row = mysqli_fetch_assoc($result)) {
                $cat_id = intval($row['cat_id']);
                $cat_title = htmlspecialchars($row['cat_title']); // Protect against XSS

                ?>

                <input value="<?php echo $cat_title; ?>" type="text" class="form-control" name="cat_title">

                <?php

            }

            mysqli_stmt_close($stmt);
        }

        ?>

        <?php

        if (isset($_POST['update_category'])) {

            if (!$connection) {
                error_log("Connection failed: " . mysqli_connect_error());
                die("Sorry, we're experiencing technical difficulties.");
            }

            $update_cat_id = intval($_GET['edit']); // Ensuring integer value
            $cat_title_to_update = $_POST['cat_title'];

            // Category update query
            $query = "UPDATE categories SET cat_title = ? WHERE cat_id = ?";
            $stmt = mysqli_prepare($connection, $query);
            if (!$stmt) {
                error_log("Statement preparation failed: " . mysqli_error($connection));
                die("Sorry, we're experiencing technical difficulties.");
            }

            mysqli_stmt_bind_param($stmt, 'si', $cat_title_to_update, $update_cat_id);
            mysqli_stmt_execute($stmt);
            if (mysqli_stmt_errno($stmt)) {
                error_log("Statement execution failed: " . mysqli_stmt_error($stmt));
                die("Sorry, we're experiencing technical difficulties.");
            }

            // No need for get_result() since it's an UPDATE operation and not a SELECT

            mysqli_stmt_close($stmt);

            // Redirect to categories.php
            header("Location: categories.php");

        }

        ?>

    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update_category" value="Update Category">
    </div>
</form>
