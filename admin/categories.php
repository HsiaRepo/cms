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

                        <?php

                        if (isset($_POST['submit'])) {

                            // TODO Checking if user submits
                            // echo "<h1>Hello!</h1>";

                            $cat_title = $_POST['cat_title'];

                            if ($cat_title == "" || empty($cat_title)) {

                                echo "This field should not be empty!";

                            } else {

                                // TODO Add Logic
                                $query = "INSERT INTO categories(cat_title) VALUES (?)";
                                $stmt = mysqli_prepare($connection, $query);

                                // Bind the parameter
                                mysqli_stmt_bind_param($stmt, 's', $cat_title);

                                // Execute the statement
                                $result = mysqli_stmt_execute($stmt);

                                if (!$result) {
                                    die('QUERY FAILED' . mysqli_error($connection));
                                }

                            }
                        }

                        ?>

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
                                <?php

                                // Query all categories
                                $query = "SELECT * FROM categories";
                                $stmt = mysqli_prepare($connection, $query);

                                // Execute the statement
                                mysqli_stmt_execute($stmt);

                                // Get result
                                $result = mysqli_stmt_get_result($stmt);

                                while ($row = mysqli_fetch_assoc($result)) {

                                    // Get and Print category id and title
                                    $cat_id = $row['cat_id'];
                                    $cat_title = $row['cat_title'];

                                    echo "<tr>";
                                    echo "<td>{$cat_id}</td>";
                                    echo "<td>{$cat_title}</td>";
                                    echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
                                    echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
                                    echo "</tr>";

                                }

                                ?>

                                <?php

                                // Delete Query
                                if (isset($_GET['delete'])) {

                                    $delete_cat_id = $_GET['delete'];
                                    $query = "DELETE FROM categories WHERE cat_id = ? ";

                                    $stmt = mysqli_prepare($connection, $query);

                                    // Bind the parameter
                                    mysqli_stmt_bind_param($stmt, 'i', $delete_cat_id);

                                    // Execute the statement
                                    $result = mysqli_stmt_execute($stmt);

                                    if (!$result) {

                                        die('QUERY FAILED' . mysqli_error($connection));

                                    }

                                    header("Location: categories.php");

                                }

                                ?>
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
