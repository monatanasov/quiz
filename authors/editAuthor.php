<?php
    include '../dbconn.php';
    mb_internal_encoding("UTF-8");
?>
<html lang="en">
    <head>
        <meta charset="UTF-8" >
        <link rel="stylesheet" href="./css/myquiz.css">
        <title>Edit Author</title>
    </head>
    <body>
        <?php
        $intGetAuthorId = (int) $_GET['id'];
        $authorNameSql = "SELECT * FROM `authors` WHERE `id` = $intGetAuthorId";
        $authorNameQuery = mysqli_query($conn, $authorNameSql);

        while ($row = mysqli_fetch_assoc($authorNameQuery)) {
            $selectedAuthorName = $row;
        }

        echo '<pre>' . print_r($selectedAuthorName, true) . '</pre>';
        ?>
    </body>
</html>
