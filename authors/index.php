<?php
    // index author
    // create author
    // store author
    // show author
    // edit author
    // update - endpoint
    // destroy - endpoint

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
        <a href="./createAuthor.php">Create Author</a><br>

        <table border = "1px solid black">
            <tr>
                <th>Author ID</th>
                <th>Author Name</th>
            </tr>
        <?php
            $showAllAuthorsTable = mysqli_query($conn, "SELECT * FROM `authors`");
            while ($row = mysqli_fetch_assoc($showAllAuthorsTable)) {
                echo '<tr>
                         <td>'.$row['id'].'</td>
                         <td>'.$row['name'].'</td>
                      </tr>';
            }
        ?>
        </table>

    </body>
</html>
