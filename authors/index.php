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
        <link rel="stylesheet" href="./css/myquiz.css">
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
                echo $_SESSION['message'];
                $showAllAuthorsTable = mysqli_query($conn, "SELECT * FROM `authors`");
                while ($row = mysqli_fetch_assoc($showAllAuthorsTable)) {
                    echo '<tr>
                             <td><a href="./show.php?id='.$row['id'].'">'.$row['id'].'</a></td>
                             <td><a href="./show.php?id='.$row['id'].'">'.$row['name'].'</a></td>';
                    echo '<td><input type="submit" class="deleteAuthor" value="delete"></td>';
                    echo '</tr>';
                }
            echo '<pre>' . print_r($_SESSION['message'], true) . '</pre>';
            ?>
        </table>
    </body>
</html>
