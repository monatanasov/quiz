<?php
include './dbconn.php';
mb_internal_encoding("UTF-8");
//validation
//normalization
//author already exist? IFs
//insert into DB

?>



<html lang="en">
<head>
    <meta charset="UTF-8" >
    <link rel="stylesheet" href="./css/myquiz.css">
    <title>Add Author</title>
</head>
<body>

<?php

    if ($_POST) {
        $trimmedAuthor = trim($_POST['authorName']);

        echo '<pre>' . print_r($trimmedAuthor, true) . '</pre>';

    }
?>


    <a href="./index.php">Main page</a><br>
    <a href="./binarymode.php">Binarymode quiz</a>
    <form action="addAuthor.php" method="POST">
            <h2>Add new author</h2>
        <div id="addAuthorDiv">
            <b><label for="">Author name</label></b>
            <input type="text" class="addAuthorName" name="authorName">
            <input type="submit" class="submitAuthor">
        </div>
    </form>
</body>
</html>
