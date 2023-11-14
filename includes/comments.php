<!-- Posted Comments -->

<?php

// Ensure you have $post_id available (from post.php)
if (isset($post_id)) {

    $query = "SELECT * FROM comments WHERE comment_post_id = ? AND comment_status = 'approved' ORDER BY comment_date DESC";
    $stmt = mysqli_prepare($connection, $query);
    if (!$stmt) {
        die("Query failed: " . mysqli_error($connection));
    }
    mysqli_stmt_bind_param($stmt, 'i', $post_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if (!$result) {
        die("Query failed: " . mysqli_error($connection));
    }
}

while ($row = mysqli_fetch_assoc($result)) {
    $comment_author = htmlspecialchars($row['comment_author']);
    $comment_date = htmlspecialchars($row['comment_date']);
    $comment_content = htmlspecialchars($row['comment_content']);
    $comment_image = "http://placehold.it/64x64"; // Placeholder; change if you have avatars in your database.
    ?>

    <!-- Comment -->
    <div class="media">
        <a class="pull-left" href="#">
            <img class="media-object" src="<?php echo $comment_image; ?>" alt="">
        </a>
        <div class="media-body">
            <h4 class="media-heading"><?php echo $comment_author; ?>
                <small><?php echo $comment_date; ?></small>
            </h4>
            <?php echo $comment_content; ?>
        </div>
    </div>

    <?php
} // End while loop
?>

