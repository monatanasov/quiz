<?php
    include './dbconn.php';
    //missing documentation
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
    //That variable will be used to set the Value of the text field where AuthorNames are filled.
    //Using this outside of POST puts blank name inside our input TEXT field for AuthorName
    $wrongAuthor = '';
    if ($_POST) {
    //remove white spaces before and after filled AuthorName
    $authorName = trim($_POST['authorName']);
    //check if our Author exists in DB.
    //If there's a match mysqli_num_rows becomes 1 because our Authors are Unique
    //mysqli_num_rows returns 0 if there's no match.
    $authorCheckQuery = "SELECT * FROM `authors` WHERE `name` = '$authorName'";
    $authorCheckResult = mysqli_query($conn,$authorCheckQuery);
    //this var will be used to check for Errors right before Inserting into DB
    $errors = false;
        if (
            //missing documentation for mb_strlen
            !mb_strlen($authorName) >= 1
            && !mb_strlen($authorName) <=255
        ) {
            echo 'Author name must be between 1 and 255 characters long!';
            $errors = true;
        }
        //return the text below as message to the user if he submits Author that already exists in DB
        if (mysqli_num_rows($authorCheckResult) >= 1){
            echo 'This Author already exists!' . '<br>';
            $errors = true;
        }
        //if there are no errors - INSERT the new Author INTO DB
        if (!$errors) {
            $insertAuthorSql = "INSERT INTO `authors`(`id`, `name`) VALUES (NULL,'$authorName')";
            $insertAuthorQuery = mysqli_query($conn,$insertAuthorSql);
            echo 'Author ' . "<b>" . $authorName . "</b>" . ' was successfully added!' . '<br>';
        } else {
            $wrongAuthor = $authorName;
        }
    }
?>
    <a href="./index.php">Main page</a><br>
    <a href="./binarymode.php">Binarymode quiz</a><br>
    <a href="./addQuote.php">Add Quote</a>
    <form action="addAuthor.php" method="POST">
        <h2>Add new author</h2>
        <div id="addAuthorDiv">
            <!--     LABEL FOR ?????? what should I put there      -->
            <b><label for="">Author name</label></b>
            <?php echo '<input type="text" class="addAuthorName" name="authorName" value="'. $wrongAuthor .'">'?>
            <input type="submit" class="submitAuthor">
        </div>
    </form>
    <table border = "1px solid black">
        <tr>
            <th>Author ID</th>
            <th>Author Name</th>
        </tr>
        <?php
        //get all Authors from DB
        $showAllAuthorsTable = mysqli_query($conn,"SELECT * FROM `authors`");
        //show all Authors using HTML Table for better view
        while ($row=mysqli_fetch_assoc($showAllAuthorsTable)) {
            echo '<tr>
                     <td>'.$row['id'].'</td>
                     <td>'.$row['name'].'</td>
                  </tr>';
        }
        ?>
    </table>
</body>
</html>
