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
<a href="./index.php">Authors</a><br>

<?php
// set blank name on input text field when submitting the form / $_POST
$editableAuthorName = '';

if ($_GET) {
    $intGetAuthorId = (int) $_GET['id'];
    $authorNameSql = "SELECT * FROM `authors` WHERE `id` = $intGetAuthorId";
    $authorNameQuery = mysqli_query($conn, $authorNameSql);

    while ($row = mysqli_fetch_assoc($authorNameQuery)) {
        $author = $row;
    }
}
?>

<?php
    $authorId = $author['id'];
    echo "<a href='./editAuthor.php?id=$authorId'>Edit</a><br>";
    echo '<form action="deleteAuthor.php" method="POST">
            <div id="deleteAuthorDiv">
                <input name="id" value="'. $authorId .'" hidden>
                <input type="submit" onclick="return confirm(\'Are you sure? This action cannot be undone!\')" class="deleteAuthor" value="Delete">
            </div>
        </form>';
?>


<h2>Author</h2>
<div>
    <?php
        $authorName = $author['name'];
        echo "<p>Name: $authorName</p>";
    ?>
</div>

</body>
</html>
