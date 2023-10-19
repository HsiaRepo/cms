<!-- Update Category -->
<form action="" method="post">
    <div class="form-group">
        <label for="cat-title">Edit Category</label>

        <?php

        // Query for displaying category to edit
        if (isset($_GET['edit'])) {

            confirmConnection($connection);
            $cat_id = intval($_GET['edit']); // Ensuring integer value

            // Category id query
            $query = "SELECT * FROM categories WHERE cat_id = ?";

            $stmt = mysqli_prepare($connection, $query);
            confirmPreparation($stmt);

            mysqli_stmt_bind_param($stmt, 'i', $cat_id);

            mysqli_stmt_execute($stmt);
            confirmExecution($stmt);

            $result = mysqli_stmt_get_result($stmt);
            confirmResult($result);

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

            confirmConnection($connection);

            $update_cat_id = intval($_GET['edit']); // Ensuring integer value
            $cat_title_to_update = $_POST['cat_title'];

            // Category update query
            $query = "UPDATE categories SET cat_title = ? WHERE cat_id = ?";
            $stmt = mysqli_prepare($connection, $query);
            confirmPreparation($stmt);

            mysqli_stmt_bind_param($stmt, 'si', $cat_title_to_update, $update_cat_id);
            mysqli_stmt_execute($stmt);
            confirmExecution($stmt);

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
