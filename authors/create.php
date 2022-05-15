<?php
include '../dbconn.php';

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
    $errors = [];

    // TODO: change errors logic like Dodo suggested
    if (
        // TODO: missing documentation for mb_strlen
        !mb_strlen ($authorName) >= 1
        && !mb_strlen ($authorName) <=255
    ) {
        $errors[] = 'Author name must be between 1 and 255 characters long!<br>';
    }

    // return the text below as message to the user if he submits Author that already exists in DB
    if (mysqli_num_rows($authorCheckResult) >= 1) {
        $errors[] = 'This Author already exists!<br>';
    }

    // if there are no errors - INSERT the new Author INTO DB
    // mysqli_real_escape_string prevents SQL injection
    if (empty($errors)) {
        $insertAuthorSql = 'INSERT INTO `authors`(`name`) VALUES ("'.mysqli_real_escape_string($conn,$authorName).'")';
        $insertAuthorQuery = mysqli_query($conn,$insertAuthorSql);
        echo 'Author ' . "<b>" . $authorName . "</b>" . ' was successfully added!' . '<br>';

        //check if there are errors on INSERT query
        if (mysqli_error($conn)) {
            echo 'Error on adding Author Name in DB';
            exit;
        }
    } else {
        $wrongAuthor = $authorName;

        if (is_array($errors)) {
            foreach ($errors as $error) {
                echo $error;
            }
        }
    }
}
?>

<a href="./index.php">Go to authors</a><br>

<form action="create.php" method="POST">
    <h2>Add new author</h2>
    <div id="addAuthorDiv">
        <b><label for="addAuthorName">Author name</label></b>
        <?php echo '<input type="text" class="addAuthorName" id="addAuthorName" name="authorName" value="'. $wrongAuthor .'">'?>
        <input type="submit" class="submitAuthor">
    </div>
</form>
