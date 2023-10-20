<?php

confirmConnection($connection);

$get_post_id = isset($_GET['post_id']) ? htmlspecialchars($_GET['post_id']) : null; // Initialize outside if block

// Fetch all categories for the dropdown
$query = "SELECT * FROM categories";
$all_categories = mysqli_query($connection, $query);
confirmResult($all_categories);

if (isset($_POST['update_post'])) {
    $post_title = htmlspecialchars($_POST['title']);
    $post_author = htmlspecialchars($_POST['author']);
    $post_category_id = htmlspecialchars($_POST['post_category_id']);
    $post_status = htmlspecialchars($_POST['post_status']);

    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];

    $post_tags = htmlspecialchars($_POST['post_tags']);
    $post_content = htmlspecialchars($_POST['post_content']);

    if (!empty($post_image)) {
        move_uploaded_file($post_image_temp, "../images/$post_image");
    } else {
        // Retrieve existing image if not being updated
        $img_query = "SELECT post_image FROM posts WHERE post_id={$get_post_id}";
        $img_result = mysqli_query($connection, $img_query);
        $row = mysqli_fetch_assoc($img_result);
        $post_image = $row['post_image'];
    }

    $query = "UPDATE posts SET 
        post_category_id = ?, 
        post_title = ?, 
        post_author = ?, 
        post_image = ?,  
        post_content = ?, 
        post_tags = ?, 
        post_status = ? 
        WHERE post_id = ?";

    $stmt = mysqli_prepare($connection, $query);
    confirmPreparation($stmt);
    mysqli_stmt_bind_param($stmt, "issssssi",
        $post_category_id, $post_title, $post_author,
        $post_image, $post_content, $post_tags,
        $post_status, $get_post_id);
    mysqli_stmt_execute($stmt);
    confirmExecution($stmt);
    mysqli_stmt_close($stmt);
}

if (isset($_GET['post_id'])) {
    $query = "SELECT * FROM posts WHERE post_id={$get_post_id}";
    $stmt = mysqli_prepare($connection, $query);
    confirmPreparation($stmt);
    mysqli_stmt_execute($stmt);
    confirmExecution($stmt);
    $result = mysqli_stmt_get_result($stmt);
    confirmResult($result);

    while ($row = mysqli_fetch_assoc($result)) {
        $post_title = htmlspecialchars($row['post_title']);
        $post_author = htmlspecialchars($row['post_author']);
        $post_category_id = htmlspecialchars($row['post_category_id']);
        $post_status = htmlspecialchars($row['post_status']);
        $post_image = htmlspecialchars($row['post_image']);
        $post_tags = htmlspecialchars($row['post_tags']);
        $post_content = htmlspecialchars($row['post_content']);
        ?>

        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Post Title</label>
                <input type="text" value="<?php echo $post_title ?>" class="form-control" name="title">
            </div>

            <div class="form-group">
                <label for="post_category">Post Category</label>
                <select name="post_category_id" id="post_category" class="form-control">
                    <?php
                    while ($cat_row = mysqli_fetch_assoc($all_categories)) {
                        $current_cat_id = intval($cat_row['cat_id']);
                        $current_cat_title = htmlspecialchars($cat_row['cat_title']);

                        if ($current_cat_id == $post_category_id) {
                            echo "<option value='{$current_cat_id}' selected>{$current_cat_title}</option>";
                        } else {
                            echo "<option value='{$current_cat_id}'>{$current_cat_title}</option>";
                        }
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="post_author">Post Author</label>
                <input type="text" value="<?php echo $post_author ?>" class="form-control" name="author">
            </div>
            <div class="form-group">
                <label for="post_status">Post Status</label>
                <input type="text" value="<?php echo $post_status ?>" class="form-control" name="post_status">
            </div>
            <div class="form-group">
                <label for="post_image">Post Image</label>
                <input type="file" name="image">
                <img src="../images/<?php echo $post_image ?>" width="100" alt="Post Image">
            </div>
            <div class="form-group">
                <label for="post_tags">Post Tags</label>
                <input type="text" value="<?php echo $post_tags ?>" class="form-control" name="post_tags">
            </div>
            <div class="form-group">
                <label for="post_content">Post Content</label>
                <textarea class="form-control" name="post_content" id="" cols="30"
                          rows="10"><?php echo $post_content ?></textarea>
            </div>
            <div>
                <input class="btn btn-primary" type="submit" name="update_post" value="Update Post">
            </div>
        </form>

        <?php
    }
}
?>
