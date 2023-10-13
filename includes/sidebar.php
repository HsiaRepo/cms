<!-- Blog Sidebar Widgets Column -->
<div class="col-md-4">
    <?php

//    TODO explore open/elasticsearch (used in Shopware 6)

//    TODO: Quick Submission Check
//    check if we have a search submission
    if(isset($_POST['submit'])){

        $search = $_POST['search'];

//        TODO: Debug/Log echo
//        echo $search;

//        TODO PCP: datasources configured/defined in db.php
        $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%' OR post_title LIKE '%$search%'";
        $search_query = mysqli_query($connection, $query);

//        Query Error Checking and Handling
        if(!$search_query) {
            die("QUERY FAILED" . mysqli_error($connection));
        }

//        Count results and TODO: loop through
        $count = mysqli_num_rows($search_query);

//        TODO: Implement logic on database calls
        if($count == 0) {
            echo "<h1> NO RESULT </h1>"; // TODO: Debug/Log echo
        } else {
            echo "<h1> $count RESULT(S) </h1>"; // TODO: Debug/Log echo
        }
    }

    ?>

    <!-- Blog Search Well -->
    <div class="well">
        <h4>Blog Search</h4>
        <form action="" method ="post">
        <div class="input-group">
            <!-- TODO PCP: PHP associate label to input -->
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
            <div class="col-lg-6">
                <ul class="list-unstyled">
                    <li><a href="#">Category Name</a>
                    </li>
                    <li><a href="#">Category Name</a>
                    </li>
                    <li><a href="#">Category Name</a>
                    </li>
                    <li><a href="#">Category Name</a>
                    </li>
                </ul>
            </div>
            <!-- /.col-lg-6 -->
            <div class="col-lg-6">
                <ul class="list-unstyled">
                    <li><a href="#">Category Name</a>
                    </li>
                    <li><a href="#">Category Name</a>
                    </li>
                    <li><a href="#">Category Name</a>
                    </li>
                    <li><a href="#">Category Name</a>
                    </li>
                </ul>
            </div>
            <!-- /.col-lg-6 -->
        </div>
        <!-- /.row -->
    </div>

    <!-- Side Widget Well -->
    <div class="well">
        <h4>Side Widget Well</h4>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
    </div>

</div>