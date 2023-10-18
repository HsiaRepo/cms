<!-- Blog Sidebar Widgets Column -->
<div class="col-md-4">

    <!-- Blog Search Well -->
    <div class="well">
        <h4>Blog Search</h4>
        <form action="search.php" method="post">
            <div class="input-group">
                <input name="search" type="text" class="form-control">
                <span class="input-group-btn">
                    <button name="submit" class="btn btn-default" type="submit">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </span>
            </div><!-- /.input-group -->
        </form><!-- /.search form -->
    </div>

    <!-- Blog Categories Well -->
    <div class="well">
        <h4>Blog Categories</h4>
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-unstyled">
                    <?php

                    if (!$connection) {
                        error_log("Connection failed: " . mysqli_connect_error());
                        die("Sorry, we're experiencing technical difficulties.");
                    }

                    // Select limit 12 all categories query
                    $query = "SELECT * FROM categories LIMIT 12";
                    $stmt = mysqli_prepare($connection, $query);
                    if (!$stmt) {
                        error_log('Statement preparation failed: ' . mysqli_error($connection));  // Log error for debugging
                        die("Sorry, we're experiencing technical difficulties.");
                    }

                    mysqli_stmt_execute($stmt);
                    if (mysqli_stmt_errno($stmt)) {
                        error_log('Statement execution failed: ' . mysqli_stmt_error($stmt));  // Log error for debugging
                        die("Sorry, we're experiencing technical difficulties.");
                    }

                    $result = mysqli_stmt_get_result($stmt);
                    if (!$result) {
                        error_log('Query failed: ' . mysqli_error($connection));  // Log error for debugging
                        die("Sorry, we're experiencing technical difficulties.");
                    }

                    // Loop category titles for sidebar
                    while ($row = mysqli_fetch_assoc($result)) {
                        $cat_title = htmlspecialchars($row['cat_title']);
                        echo "<li><a href='#'>{$cat_title}</a></li>";
                    }
                    ?>

                </ul>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>

    <!-- Side Widget Well -->
    <?php include "widget.php" ?>

</div>