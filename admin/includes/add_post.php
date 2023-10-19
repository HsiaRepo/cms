<?php

confirmConnection($connection);

if (isset($_POST['create_post'])) {
    $post_title = htmlspecialchars($_POST['title']);
    $post_author = htmlspecialchars($_POST['author']);
    $post_category_id = htmlspecialchars($_POST['post_category_id']);
    $post_status = htmlspecialchars($_POST['post_status']);
    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];
    $post_tags = htmlspecialchars($_POST['post_tags']);
    $post_content = htmlspecialchars($_POST['post_content']);
    $post_date = date('d-m-y');
    $post_comment_count = 0;

    // move file
    move_uploaded_file($post_image_temp, "../images/$post_image");

    // Insert post query
    $query = "INSERT INTO posts(
            post_title, post_category_id, post_author, 
            post_date, post_image, post_content, 
            post_tags, post_comment_count, post_status
         ) VALUES (?, ?, ?, NOW(), ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($connection, $query);
    confirmPreparation($stmt);
    mysqli_stmt_bind_param($stmt, "sissssis",
        $post_title, $post_category_id, $post_author,
        $post_image, $post_content, $post_tags,
        $post_comment_count, $post_status
    );

    mysqli_stmt_execute($stmt);
    confirmExecution($stmt);
    mysqli_stmt_close($stmt);
}

// Fetch all categories for the dropdown
$query = "SELECT * FROM categories";
$all_categories = mysqli_query($connection, $query);
confirmResult($all_categories);

?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="title">
    </div>

    <!-- Category Dropdown -->
    <div class="form-group">
        <label for="post_category_id">Post Category</label>
        <select name="post_category_id" id="post_category_id" class="form-control">
            <?php
            while ($cat_row = mysqli_fetch_assoc($all_categories)) {
                $cat_id = intval($cat_row['cat_id']);
                $cat_title = htmlspecialchars($cat_row['cat_title']);
                echo "<option value='{$cat_id}'>{$cat_title}</option>";
            }
            ?>
        </select>
    </div>

    <div class="form-group">
        <label for="author">Post Author</label>
        <input type="text" class="form-control" name="author">
    </div>
    <div class="form-group">
        <label for="post_status">Post Status</label>
        <input type="text" class="form-control" name="post_status">
    </div>
    <div class="form-group">
        <label for="image">Post Image</label>
        <input type="file" name="image">
    </div>
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags">
    </div>
    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" id="" cols="30" rows="10"></textarea>
    </div>
    <div>
        <input class="btn btn-primary" type="submit" name="create_post" value="Publish Post">
    </div>
</form>
