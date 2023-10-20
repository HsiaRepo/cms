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

            <h1 class="page-header">
                Page Heading
                <small>Page Subheading</small>
            </h1>

            <?php

            confirmConnection($connection);

            // Select all posts query
            $query = "SELECT * FROM posts";
            $result = mysqli_query($connection, $query);
            confirmResult($result);

            // Loop to show all posts' info
            while ($row = mysqli_fetch_assoc($result)) {
                $post_id = htmlspecialchars($row['post_id']);
                $post_title = htmlspecialchars($row['post_title']);
                $post_author = htmlspecialchars($row['post_author']);
                $post_date = htmlspecialchars($row['post_date']);
                $post_image = htmlspecialchars($row['post_image']);
                $post_content = substr(htmlspecialchars($row['post_content']),0,50);
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

        </div>

        <?php include "includes/sidebar.php"; ?>

    </div>
    <!-- /.row -->

    <hr>

    <!-- Footer -->
    <?php include "includes/footer.php"; ?>
