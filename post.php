<!-- Database -->
<?php include "includes/db.php"; ?>

<!-- Header -->
<?php include "includes/header.php"; ?>

<!-- Navigation -->
<?php include "includes/navigation.php"; ?>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <?php

            confirmConnection($connection);

            if(isset($_POST['submit_comment'])) {
                // Extract POST data
                $comment_author = mysqli_real_escape_string($connection, $_POST['comment_author']);
                $comment_email = mysqli_real_escape_string($connection, $_POST['comment_email']);
                $comment_content = mysqli_real_escape_string($connection, $_POST['comment_content']);
                $comment_post_id = (int)$_POST['post_id'];

                // Insert comment into the database
                $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) VALUES (?, ?, ?, ?, 'unapproved', NOW())";
                $stmt = mysqli_prepare($connection, $query);
                mysqli_stmt_bind_param($stmt, 'isss', $comment_post_id, $comment_author, $comment_email, $comment_content);
                mysqli_stmt_execute($stmt);
            }

            if (isset($_GET['post_id'])) {

                $post_id = $_GET['post_id'];

            }

            // Select post by id query
            $query = "SELECT * FROM posts WHERE post_id=?";
            $stmt = mysqli_prepare($connection, $query);
            confirmPreparation($stmt);
            mysqli_stmt_bind_param($stmt, 'i', $post_id);
            mysqli_stmt_execute($stmt);
            confirmExecution($stmt);
            $result = mysqli_stmt_get_result($stmt);
            confirmResult($result);

            // Loop to show all posts' info
            while ($row = mysqli_fetch_assoc($result)) {
                $post_id = htmlspecialchars($row['post_id']);
                $post_title = htmlspecialchars($row['post_title']);
                $post_author = htmlspecialchars($row['post_author']);
                $post_date = htmlspecialchars($row['post_date']);
                $post_image = htmlspecialchars($row['post_image']);
                $post_content = htmlspecialchars($row['post_content']);
                ?>

                <!-- Exit PHP tags to fill in HTML (still in while loop) -->

                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?post_id=<?php echo $post_id; ?>"><?php echo $post_title ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image ?>" alt="">
                <hr>
                <p><?php echo $post_content ?></p>
                <a class="btn btn-primary" href="#">Read More <span
                            class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>

            <?php } ?>

            <!-- TODO Pager -->
            <?php /* include "includes/pager.php"; */ ?>

            <!-- Comment Form -->
            <div class="well">
                <h4>Leave a Comment:</h4>
                <form action="" method="post">
                    <div class="form-group">
                        <label for="comment_author">Name:</label>
                        <input type="text" class="form-control" name="comment_author">
                    </div>
                    <div class="form-group">
                        <label for="comment_email">Email:</label>
                        <input type="email" class="form-control" name="comment_email">
                    </div>
                    <div class="form-group">
                        <label for="comment_content">Your Comment:</label>
                        <textarea class="form-control" name="comment_content" rows="3"></textarea>
                    </div>
                    <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
                    <button type="submit" name="submit_comment" class="btn btn-primary">Submit Comment</button>
                </form>

            </div>

            <?php include "includes/comments.php"; ?>

        </div>

        <?php include "includes/sidebar.php"; ?>

    </div>
    <!-- /.row -->

    <hr>

    <!-- Footer -->
    <?php include "includes/footer.php"; ?>
