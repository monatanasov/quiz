<?php
include './dbconn.php';
mb_internal_encoding("UTF-8");



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
    $trimmedAuthorName = trim($_POST['authorName']);
    $authorCheckQuery = "SELECT * FROM `authors` WHERE `name` = '$trimmedAuthorName'";
    $authorCheckResult = mysqli_query($conn,$authorCheckQuery);
        if (
            !mb_strlen($trimmedAuthorName) >= 1
            && !mb_strlen($trimmedAuthorName) <=255
        ) {
            echo 'Author name must be between 1 and 255 characters long!';
        }
        if (mysqli_num_rows($authorCheckResult) >= 1){
            echo 'This Author already exists!';
        } else {
            $insertAuthorSql = "INSERT INTO `authors`(`id`, `name`) VALUES (NULL,'$trimmedAuthorName')";
            $insertAuthorQuery = mysqli_query($conn,$insertAuthorSql);
            echo 'Author ' . $trimmedAuthorName . ' was successfully added';
        }
        echo '<pre>' . print_r($trimmedAuthorName, true) . '</pre>';
    }
?>
    <a href="./index.php">Main page</a><br>
    <a href="./binarymode.php">Binarymode quiz</a>
    <form action="addAuthor.php" method="POST">
            <h2>Add new author</h2>
        <div id="addAuthorDiv">
            <b><label for="">Author name</label></b>
            <input type="text" class="addAuthorName" name="authorName" value="">
            <input type="submit" class="submitAuthor">
        </div>
    </form>
</body>
</html>
