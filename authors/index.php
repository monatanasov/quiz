<?php
    // index author
    // create author
    // store author
    // show author
    // edit author
    // update - endpoint
    // destroy - endpoint
    session_start();
    include '../dbconn.php';
    mb_internal_encoding("UTF-8");
?>

<html lang="en">
    <head>
        <meta charset="UTF-8" >
        <link rel="stylesheet" href="../css/myquiz.css">
        <title>CRUD Authors</title>
    </head>
    <body>
        <a href="create.php">Create Author</a><br>
        <table border = "1px solid black">
            <tr>
                <th>Author ID</th>
                <th>Author Name</th>
            </tr>
            <?php
                if (isset($_SESSION['message'])) {
                    $sessionMessage[] = $_SESSION['message'];
                    session_destroy();
                    foreach ($sessionMessage as $message) {
                        echo $message;
                    }
                }
                $allAuthorsTable = mysqli_query($conn, "SELECT * FROM `authors`");
                if (mysqli_num_rows($allAuthorsTable) > 0) {
                    while ($row = mysqli_fetch_assoc($allAuthorsTable)) {
                        echo '<tr>';
                        echo '<td><a href="./show.php?id='.$row['id'].'">'.$row['id'].'</a></td>';
                        echo '<td><a href="./show.php?id='.$row['id'].'">'.$row['name'].'</a></td>';
                        echo '<form action="delete.php" method="POST">';
                            echo '<td><input type="text" name="authorId" value="'.$row['id'].'" readonly hidden></td>';
                            echo '<td><input type="submit" class="deleteAuthor" value="delete"></td>';
                        echo '</form>';
                        echo '<form action="show.php" method="POST">';
                            echo '<td><input type="text" name="authorId" value="'.$row['id'].'" readonly hidden></td>';
                            echo '<td><input type="text" name="authorName" value="'.$row['name'].'" readonly hidden></td>';
                            echo '<td><input type="submit" class="deleteAuthor" value="edit"></td>';
                        echo '</form>';
                        echo '</tr>';
                    }
                }
            ?>
        </table>
    </body>
</html>
