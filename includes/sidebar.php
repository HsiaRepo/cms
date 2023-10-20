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

                    confirmConnection($connection);

                    // Select limit 12 all categories query
                    $query = "SELECT * FROM categories LIMIT 12";

                    $stmt = mysqli_prepare($connection, $query);
                    confirmPreparation($stmt);

                    mysqli_stmt_execute($stmt);
                    confirmExecution($stmt);

                    $result = mysqli_stmt_get_result($stmt);
                    confirmResult($result);

                    // Loop category titles for sidebar
                    while ($row = mysqli_fetch_assoc($result)) {
                        $cat_id = htmlspecialchars($row['cat_id']);
                        $cat_title = htmlspecialchars($row['cat_title']);
                        echo "<li><a href='category.php?category={$cat_id}'>{$cat_title}</a></li>";
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