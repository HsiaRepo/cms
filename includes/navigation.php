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
            <a class="navbar-brand" href="#">Page Navigation</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <?php

                // Connection check
                if (!$connection) {
                    die("Sorry, we're experiencing technical difficulties.");
                }

                // All categories query
                $query = "SELECT * FROM categories";

                // Prepare statement
                $stmt = mysqli_prepare($connection, $query);

                if (!$stmt) {
                    error_log('Statement preparation failed: ' . mysqli_error($connection));  // Log error for debugging
                    die("Sorry, we're experiencing technical difficulties.");
                }

                // Execute statement
                mysqli_stmt_execute($stmt);

                if (mysqli_stmt_errno($stmt)) {
                    error_log('Statement execution failed: ' . mysqli_stmt_error($stmt));  // Log error for debugging
                    die("Sorry, we're experiencing technical difficulties.");
                }

                // Get result
                $result = mysqli_stmt_get_result($stmt);

                if (!$result) {
                    error_log('Query failed: ' . mysqli_error($connection));  // Log error for debugging
                    die("Sorry, we're experiencing technical difficulties.");
                }

                // Loop for displaying navigation options from categories
                while ($row = mysqli_fetch_assoc($result)) {
                    $cat_title = htmlspecialchars($row['cat_title']);
                    echo "<li><a href='#'>{$cat_title}</a></li>";
                }

                // Close statement
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
