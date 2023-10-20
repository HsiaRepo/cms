<!-- View All Comments -->
<table class="table table-bordered table-hover">
    <thead>
    <tr>
        <th>Id</th>
        <th>Author</th>
        <th>Email</th>
        <th>Comment</th>
        <th>Status</th>
        <th>In Response to</th>
        <th>Date</th>
        <th>Approve</th>
        <th>Unapprove</th>
        <th>Delete</th>
    </tr>
    </thead>
    <tbody>

    <?php
    if (isset($_GET['approve'])) {
        $comment_id_to_approve = htmlspecialchars($_GET['approve']);
        $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = ?";

        $stmt = mysqli_prepare($connection, $query);
        confirmPreparation($stmt);

        mysqli_stmt_bind_param($stmt, 'i', $comment_id_to_approve);
        mysqli_stmt_execute($stmt);
        confirmExecution($stmt);

        mysqli_stmt_close($stmt);

        header("Location: comments.php");
    }

    if (isset($_GET['unapprove'])) {
        $comment_id_to_unapprove = htmlspecialchars($_GET['unapprove']);
        $query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = ?";

        $stmt = mysqli_prepare($connection, $query);
        confirmPreparation($stmt);

        mysqli_stmt_bind_param($stmt, 'i', $comment_id_to_unapprove);
        mysqli_stmt_execute($stmt);
        confirmExecution($stmt);

        mysqli_stmt_close($stmt);

        header("Location: comments.php");
    }

    if (isset($_GET['delete'])) {
        confirmConnection($connection);
        $comment_id = htmlspecialchars($_GET['delete']);

        // Delete by comment_id query
        $query = "DELETE FROM comments WHERE comment_id = ? ";

        $stmt = mysqli_prepare($connection, $query);
        confirmPreparation($stmt);

        mysqli_stmt_bind_param($stmt, 'i', $comment_id);
        mysqli_stmt_execute($stmt);
        confirmExecution($stmt);

        mysqli_stmt_close($stmt);
    }

    ?>

    <?php
    confirmConnection($connection);

    // Select all comments query
    $query = "SELECT * FROM comments ORDER BY comment_date DESC";
    $stmt = mysqli_prepare($connection, $query);
    confirmPreparation($stmt);
    mysqli_stmt_execute($stmt);
    confirmExecution($stmt);
    $result = mysqli_stmt_get_result($stmt);
    confirmResult($result);

    // Loop to show all comment info in table
    while ($row = mysqli_fetch_assoc($result)) {
        $comment_id = htmlspecialchars($row['comment_id']);
        $comment_post_id = htmlspecialchars($row['comment_post_id']);
        $comment_author = htmlspecialchars($row['comment_author']);
        $comment_email = htmlspecialchars($row['comment_email']);
        $comment_content = htmlspecialchars($row['comment_content']);
        $comment_status = htmlspecialchars($row['comment_status']);
        $comment_date = htmlspecialchars($row['comment_date']);

        echo "<tr>";
        echo "<td>{$comment_id}</td>";
        echo "<td>{$comment_author}</td>";
        echo "<td>{$comment_email}</td>";
        echo "<td>{$comment_content}</td>";
        echo "<td>{$comment_status}</td>";
        echo "<td><a href='../post.php?post_id={$comment_post_id}'>View Post</a></td>"; // Link to the related post
        echo "<td>{$comment_date}</td>";
        // TODO: placeholders
        echo "<td><a href='comments.php?approve={$comment_id}'>Approve</a></td>";
        echo "<td><a href='comments.php?unapprove={$comment_id}'>Unapprove</a></td>";
        echo "<td><a href='comments.php?delete={$comment_id}'>Delete</a></td>";
        echo "</tr>";
    }

    mysqli_stmt_close($stmt);
    ?>

    </tbody>
</table>
