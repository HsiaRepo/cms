<!-- Database -->
<?php include "includes/db.php"; ?>

<!-- Header -->
<?php include "includes/header.php" ?>

<!-- Navigation -->
<?php include "includes/navigation.php" ?>

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
            if (isset($_POST['submit'])) {

                if (!$connection) {
                    error_log("Connection failed: " . mysqli_connect_error());
                    die("Sorry, we're experiencing technical difficulties.");
                }

                $search = $_POST['search'];

                // Select posts like post_tags or post_title query
                $query = "SELECT * FROM posts WHERE post_tags LIKE CONCAT('%', ?, '%') OR post_title LIKE CONCAT('%', ?, '%')";
                $stmt = mysqli_prepare($connection, $query);
                if (!$stmt) {
                    error_log("Statement preparation failed: " . mysqli_error($connection));
                    die("Sorry, we're experiencing technical difficulties.");
                }

                mysqli_stmt_bind_param($stmt, 'ss', $search, $search);
                if (!mysqli_stmt_execute($stmt)) {
                    error_log("Statement execution failed: " . mysqli_stmt_error($stmt));
                    die("Sorry, we're experiencing technical difficulties.");
                }

                $search_query = mysqli_stmt_get_result($stmt);
                $count = mysqli_num_rows($search_query);
                if ($count == 0) {
                    echo "<h1> NO RESULT </h1>";
                } else {
                    while ($row = mysqli_fetch_assoc($search_query)) {

                        // Using htmlspecialchars for output escaping
                        $post_title = htmlspecialchars($row['post_title']);
                        $post_author = htmlspecialchars($row['post_author']);
                        $post_date = htmlspecialchars($row['post_date']);
                        $post_image = htmlspecialchars($row['post_image']);
                        $post_content = htmlspecialchars($row['post_content']);
                        ?>

                        <!-- First Blog Post -->
                        <h2>
                            <a href="#"><?php echo $post_title; ?></a>
                        </h2>
                        <p class="lead">
                            by <a href="index.php"><?php echo $post_author; ?></a>
                        </p>
                        <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?></p>
                        <hr>
                        <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                        <hr>
                        <p><?php echo $post_content; ?></p>
                        <a class="btn btn-primary" href="#">Read More <span
                                    class="glyphicon glyphicon-chevron-right"></span></a>

                        <hr>

                        <?php
                    }
                }
                mysqli_stmt_close($stmt);
            }
            ?>

            <!-- TODO Pager -->
            <?php
            /*
                include "includes/pager.php"
            */
            ?>

        </div>

        <?php include "includes/sidebar.php"; ?>

    </div>
    <!-- /.row -->

    <hr>

    <!-- Footer -->
    <?php include "includes/footer.php"; ?>
