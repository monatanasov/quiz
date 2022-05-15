<?php
// create author
// store author
// show author
// edit author
// update - endpoint
// destroy - endpoint


include '../dbconn.php';
?>
<html lang="en">
<head>
    <meta charset="UTF-8" >
    <link rel="stylesheet" href="../css/myquiz.css">
    <title>Add Author</title>
</head>
<body>
<a href="./create.php">Create author</a><br>

<table border = "1px solid black">
    <tr>
        <th>Author ID</th>
        <th>Author Name</th>
    </tr>
    <?php
    //get all Authors from DB
    $showAllAuthorsTable = mysqli_query($conn,"SELECT * FROM `authors`");
    //show all Authors using HTML Table for better view
    while ($row = mysqli_fetch_assoc($showAllAuthorsTable)) {
        $authorId = $row['id'];

        echo '<tr class="pointer">
                     <td><a href="./show.php?id='. $authorId .'">'.$authorId.'</a></td>
                     <td><a href="./show.php?id='. $authorId .'">'.$row['name'].'</a></td>
                  </tr>';
    }
    ?>
</table>
</body>
