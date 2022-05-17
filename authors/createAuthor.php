<?php
    include '../dbconn.php';
    mb_internal_encoding("UTF-8");
?>
<html lang="en">
    <head>
        <meta charset="UTF-8" >
        <link rel="stylesheet" href="./css/myquiz.css">
        <title>Create Author</title>
    </head>
    <body>
        <a href="./index.php">Authors</a><br>

        <?php
            // That variable will be used to set the Value of the text field where AuthorNames are filled.
            // Using this outside of POST puts blank name inside our input TEXT field for AuthorName
            $wrongAuthor = '';

            if ($_POST) {
                // remove white spaces before and after filled AuthorName
                $authorName = trim($_POST['authorName']);
                // check if our Author exists in DB.
                // If there's a match mysqli_num_rows becomes 1 because our Authors are Unique
                // mysqli_num_rows returns 0 if there's no match.
                $authorCheckQuery = "SELECT * FROM `authors` WHERE `name` = '$authorName'";
                $authorCheckResult = mysqli_query($conn,$authorCheckQuery);
                // mb_strlen require the string length showing number of characters instead of
                // strlen which showing number of bytes
                $authorNameLength = mb_strlen ($authorName);
                // this var will be used to check for Errors right before Inserting into DB
                $errors = [];

                if (!$authorNameLength >= 1 && !$authorNameLength <=255) {
                    $errors[] = 'Author name must be between 1 and 255 characters long!' . '<br>';
                }

                // return the text below as message to the user if he submits Author that already exists in DB
                if (mysqli_num_rows($authorCheckResult) >= 1) {
                    $errors[] = 'This Author already exists!' . '<br>';
                }

                // if there are no errors - INSERT the new Author INTO DB
                // mysqli_real_escape_string prevents SQL injection
                if (empty($errors)) {
                    $insertAuthorSql = 'INSERT INTO `authors`(`name`) VALUES ("'.
                        mysqli_real_escape_string($conn,$authorName).'")';
                    $insertAuthorQuery = mysqli_query($conn,$insertAuthorSql);
                    echo 'Author ' . "<b>" . $authorName . "</b>" . ' was successfully added!' . '<br>';

                    // check if there are errors on INSERT query
                    if (mysqli_error($conn)) {
                        echo 'No database connection in createAuthor page' . '<br>';
                        exit;
                    }
                } else {
                    $wrongAuthor = $authorName;
                    foreach ($errors as $error) {
                        echo $error;
                    }
                }
            }
        ?>
        <form action="createAuthor.php" method="POST">
            <h2>Create Author</h2>
            <div id="createAuthorDiv">
                <b><label for="createAuthorName">Author name</label></b>
                <?php echo '<input type="text" class="createAuthorName" id="createAuthorName" name="authorName" value="'. $wrongAuthor .'">'?>
                <input type="submit" class="submitAuthor" value="Create">
            </div>
        </form>
    </body>
</html>
