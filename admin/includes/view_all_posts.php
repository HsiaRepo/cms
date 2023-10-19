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
        <th>Content</th>
        <th>Comments</th>
        <th>Date</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
    </thead>
    <tbody>

    <?php

    if (isset($_GET['delete'])) {

        confirmConnection($connection);

        $post_id = htmlspecialchars($_GET['delete']);

        // Delete by post_id query
        $query = "DELETE FROM posts WHERE post_id = ? ";
        $stmt = mysqli_prepare($connection, $query);
        confirmPreparation($stmt);

        mysqli_stmt_bind_param($stmt, 'i', $post_id);

        mysqli_stmt_execute($stmt);
        confirmExecution($stmt);

        // DELETE does not require a $result check

        mysqli_stmt_close($stmt);

    }

    ?>

    <?php

    confirmConnection($connection);

    // Select all posts query
    $query = "SELECT * FROM posts";

    $stmt = mysqli_prepare($connection, $query);
    confirmPreparation($stmt);

    mysqli_stmt_execute($stmt);
    confirmExecution($stmt);

    $result = mysqli_stmt_get_result($stmt);
    confirmResult($result);

    // Loop to show all post info in table
    while ($row = mysqli_fetch_assoc($result)) {

        // Post info with XSS protection using htmlspecialchars
        $post_id = htmlspecialchars($row['post_id']);
        $post_title = htmlspecialchars($row['post_title']);
        $post_author = htmlspecialchars($row['post_author']);
        $post_category_id = htmlspecialchars($row['post_category_id']);
        $post_status = htmlspecialchars($row['post_status']);
        $post_image = htmlspecialchars($row['post_image']);
        $post_tags = htmlspecialchars($row['post_tags']);
        $post_content = htmlspecialchars($row['post_content']);
        $post_comment_count_title = htmlspecialchars($row['post_comment_count']);
        $post_date = htmlspecialchars($row['post_date']);

        // Table formatting
        echo "<tr>";
        echo "<td>{$post_id}</td>";
        echo "<td>{$post_title}</td>";
        echo "<td>{$post_author}</td>";
        echo "<td>{$post_category_id}</td>";
        echo "<td>{$post_status}</td>";
        echo "<td><img class='img-responsive' src='../images/{$post_image}' alt='image'></td>";
        echo "<td>{$post_tags}</td>";
        echo "<td>{$post_content}</td>";
        echo "<td>{$post_comment_count_title}</td>";
        echo "<td>{$post_date}</td>";
        echo "<td><a href='posts.php?source=edit_post&post_id={$post_id}'>Edit</a></td>";
        echo "<td><a href='posts.php?delete={$post_id}'>Delete</a></td>";
        echo "</tr>";

    }

    mysqli_stmt_close($stmt);

    ?>

    <!-- Filler Entry -->
    <!--
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
    -->

</table>
