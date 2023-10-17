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

    // Connection check
    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // All posts query
    $query = "SELECT * FROM posts";

    // Prepare statement
    $stmt = mysqli_prepare($connection, $query);

    //Preparation check
    if (!$stmt) {
        die("Statement preparation failed: " . mysqli_error($connection));
    }

    // Execute statement
    mysqli_stmt_execute($stmt);

    // Execution check
    if (mysqli_stmt_errno($stmt)) {
        die("Statement execution failed: " . mysqli_stmt_error($stmt));
    }

    // Get result
    $result = mysqli_stmt_get_result($stmt);

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
        echo "<td>{$post_comment_count_title}</td>";
        echo "<td>{$post_date}</td>";
        echo "</tr>";

    }

    // Close statement
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
