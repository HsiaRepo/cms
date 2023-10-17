<!-- Header -->
<?php include "includes/admin_header.php" ?>

<div id="wrapper">

    <!-- Navigation -->
    <?php include "includes/admin_navigation.php" ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome to Admin
                        <small>Logan's CMS</small>
                    </h1>

                    <div class="col-xs-6">

                        <!-- Insert categories function -->
                        <?php insertCategories(); ?>

                        <!-- Add Category -->
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="cat-title">Category Title</label>
                                <input type="text" class="form-control" name="cat_title">
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                            </div>
                        </form>

                        <?php

                        // Update Category
                        if (isset($_GET['edit'])) {
                            $cat_id = $_GET['edit'];
                            include "includes/update_categories.php";
                        }

                        ?>

                    </div><!-- Category Forms -->

                    <div class="col-xs-6">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Category Title</th>
                                <th>Delete</th>
                                <th>Edit</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <!-- find categories function -->
                                <?php findAllCategories(); ?>
                                <!-- delete categories function -->
                                <?php deleteCategories(); ?>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->

    <!-- Footer -->
    <?php include "includes/admin_footer.php" ?>
