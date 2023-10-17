<?php

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
    $post_comment_count = 4; //TODO Hardcoded

    move_uploaded_file($post_image_temp, "../images/$post_image");

    // Connection check
    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Insert post query
    $query = "INSERT INTO posts(
            post_category_id, post_title, post_author, 
            post_date, post_image, post_content, 
            post_tags, post_comment_count, post_status
         ) VALUES (?, ?, ?, NOW(), ?, ?, ?, ?, ?)";

    // Prepare statement
    $stmt = mysqli_prepare($connection, $query);

    // Preparation check
    if (!$stmt) {
        die("Statement preparation failed: " . mysqli_error($connection));
    }

    // Bind parameters
    mysqli_stmt_bind_param($stmt, "issssssis",
        $post_category_id, $post_title, $post_author,
        $post_image, $post_content, $post_tags,
        $post_comment_count, $post_status
    );

    // Execute statement
    mysqli_stmt_execute($stmt);

    // Execution check
    if (mysqli_stmt_errno($stmt)) {
        die("Statement execution failed: " . mysqli_stmt_error($stmt));
    }

    // Close statement
    mysqli_stmt_close($stmt);
}

?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="title">
    </div>
    <div class="form-group">
        <label for="post_category">Post Category</label>
        <input type="text" class="form-control" name="post_category_id">
    </div>
    <div class="form-group">
        <label for="post_author">Post Author</label>
        <input type="text" class="form-control" name="author">
    </div>
    <div class="form-group">
        <label for="post_status">Post Status</label>
        <input type="text" class="form-control" name="post_status">
    </div>
    <div class="form-group">
        <label for="post_image">Post Image</label>
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
