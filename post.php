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

            <?php include "comments.php"; ?>

        </div>

        <?php include "includes/sidebar.php"; ?>

    </div>
    <!-- /.row -->

    <hr>

    <!-- Footer -->
    <?php include "includes/footer.php"; ?>
