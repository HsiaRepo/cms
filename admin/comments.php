<!-- Header -->
<?php include "includes/admin_header.php"; ?>

<div id="wrapper">

    <!-- Navigation -->
    <?php include "includes/admin_navigation.php"; ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Comments
                        <small>Admin View</small>
                    </h1>

                    <?php

                    // Switching admin display based on the 'source' parameter
                    if (isset($_GET['source'])) {
                        $source = $_GET['source'];
                    } else {
                        $source = '';
                    }

                    switch ($source) {

                        case 'approve_comment';
                            // TODO Code or inclusion for approving a comment can go here
                            break;

                        case 'unapprove_comment';
                            // TODO Code or inclusion for unapproving a comment can go here
                            break;

                        case 'edit_comment';
                            include "includes/edit_comment.php"; // TODO
                            break;

                        default:
                            include "includes/view_all_comments.php";
                            break;
                    }
                    ?>

                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

    <!-- Footer -->
    <?php include "includes/admin_footer.php"; ?>
