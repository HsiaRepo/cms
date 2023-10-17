<!-- View All Posts -->
<table class="table table-bordered table-hover">
    <thead>
    <tr>
        <th>Id</th>
        <th>Title</th>
        <th>Author</th>
        <th>Category</th>
        <th>Status</th>
        <th>Image</th>
        <th>Tags</th>
        <th>Comments</th>
        <th>Date</th>

    </tr>
    </thead>
    <tbody>

    <?php

    // Query all categories
    $query = "SELECT * FROM posts";
    $stmt = mysqli_prepare($connection, $query);

    // Execute the statement
    mysqli_stmt_execute($stmt);

    // Get result
    $result = mysqli_stmt_get_result($stmt);

    while ($row = mysqli_fetch_assoc($result)) {

        // Get and Print category id and title
        $post_id = $row['post_id'];
        $post_title = $row['post_title'];
        $post_author = $row['post_author'];
        $post_category_id = $row['post_category_id'];
        $post_status = $row['post_status'];
        $post_image = $row['post_image'];
        $post_tags = $row['post_tags'];
        $post_comment_count_title = $row['post_comment_count'];
        $post_date = $row['post_date'];

        echo "<tr>";
        echo "<td>{$post_id}</td>";
        echo "<td>{$post_title}</td>";
        echo "<td>{$post_author}</td>";
        echo "<td>{$post_category_id}</td>";
        echo "<td>{$post_status}</td>";
        echo "<td><img class='img-responsive' src='../images/$post_image' alt='image'></td>";
        echo "<td>{$post_tags}</td>";
        echo "<td>{$post_comment_count_title}</td>";
        echo "<td>{$post_date}</td>";
        echo "</tr>";

    }

    ?>

    <td>10</td>
    <td>Love Bootstrap</td>
    <td>Logan</td>
    <td>Date</td>
    <td>Bootstrap</td>
    <td>Status</td>
    <td>Image</td>
    <td>Tags</td>
    <td>Comments</td>
    </tbody>
</table>