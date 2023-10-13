<!-- Database -->
<?php include "includes/db.php"; ?>

<!-- Header -->
<?php include "includes/header.php"?>

    <!-- Navigation -->
    <?php include "includes/navigation.php"?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <h1 class="page-header">
                    <!-- TODO: Filler -->
                    Page Heading
                    <!-- TODO: Filler -->
                    <small>Page Subheading</small>
                </h1>

                <?php

//                    TODO explore open/elasticsearch (used in Shopware 6)

//                    TODO: Quick Submission Check
//              check if we have a search submission
                if (isset($_POST['submit'])) {

                    $search = $_POST['search'];

//                    TODO: Debug/Log echo
//                  echo $search;

//                    TODO PCP: datasources configured/defined in db.php
                    $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%' OR post_title LIKE '%$search%'";
                    $search_query = mysqli_query($connection, $query);

//        Query Error Checking and Handling
                    if (!$search_query) {
                        die("QUERY FAILED" . mysqli_error($connection));
                    }

//        Count results and TODO: loop through
                    $count = mysqli_num_rows($search_query);

//        TODO: Implement logic on database calls
                    if ($count == 0) {
                        echo "<h1> NO RESULT </h1>"; // TODO: Debug/Log echo
                    } else {
//                Show all relevant posts with while loop
                while ($row = mysqli_fetch_assoc($search_query)) {
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = $row['post_content'];

                    ?>

                    <!-- Exit PHP tags to fill in HTML (still in while loop) -->

                    <!-- First Blog Post -->
                    <h2>
                        <a href="#"><?php echo $post_title?></a>
                    </h2>
                    <p class="lead">
                        by <a href="index.php"><?php echo $post_author?></a>
                    </p>
                    <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date?></p>
                    <hr>
                    <img class="img-responsive" src="images/<?php echo $post_image?>" alt="">
                    <hr>
                    <p><?php echo $post_content?></p>
                    <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                    <hr>

                    <?php
                }
                    }
                }
                ?>



            <!-- TODO Pager -->
            <?php
            /*
                include "includes/pager.php"
            */
            ?>

            </div>

            <?php include "includes/sidebar.php" ?>

        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
    <?php include "includes/footer.php" ?>
