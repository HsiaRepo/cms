<!-- Update Category -->
<form action="" method="post">
    <div class="form-group">
        <label for="cat-title">Edit Category</label>

        <?php

        // Query for displaying category to edit
        if (isset($_GET['edit'])) {

            $cat_id = $_GET['edit'];
            $query = "SELECT * FROM categories WHERE cat_id = ?";

            // Proper SQL injection prevention
            $stmt = mysqli_prepare($connection, $query);
            mysqli_stmt_bind_param($stmt, 'i', $cat_id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            while ($row = mysqli_fetch_assoc($result)) {

                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];

                ?>

                <input value="<?php echo $cat_title; ?>" type="text" class="form-control" name="cat_title">

                <?php
            }
        }

        ?>

        <?php

        // Update Query
        if (isset($_POST['update_category'])) {

            $update_cat_id = $_GET['edit'];
            $cat_title_to_update = $_POST['cat_title'];

            $query = "UPDATE categories SET cat_title = ? WHERE cat_id = ?";

            $stmt = mysqli_prepare($connection, $query);
            mysqli_stmt_bind_param($stmt, 'si', $cat_title_to_update, $update_cat_id);
            mysqli_stmt_execute($stmt);

            header("Location: categories.php");
        }

        ?>

    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update_category" value="Update Category">
    </div>
</form>
