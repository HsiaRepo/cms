<!-- Navigation Bar -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation 1</span>
                <span class="icon-bar">Toggle navigation 2</span>
                <span class="icon-bar">Toggle navigation 3</span>
                <span class="icon-bar">Toggle navigation 4</span>
            </button>
            <a class="navbar-brand" href="index.php">CMS Home</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <?php

                confirmConnection($connection);

                // Select all categories query
                $query = "SELECT * FROM categories";
                $stmt = mysqli_prepare($connection, $query);
                confirmPreparation($stmt);
                mysqli_stmt_execute($stmt);
                confirmExecution($stmt);
                $result = mysqli_stmt_get_result($stmt);
                confirmResult($result);

                // Loop for displaying navigation options from categories
                while ($row = mysqli_fetch_assoc($result)) {
                    $cat_title = htmlspecialchars($row['cat_title']);
                    echo "<li><a href='#'>{$cat_title}</a></li>";
                }

                mysqli_stmt_close($stmt);

                ?>
                <li>
                    <a href="admin">Admin</a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>
