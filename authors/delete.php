<?php
    session_start();
    include '../dbconn.php';
    mb_internal_encoding("UTF-8");

    if (mysqli_error($conn)) {
        echo 'No database connection in deleteAuthor page';
        exit;
    }

    if ($_POST) {
        $AuthorId = (int) $_POST['authorId'];
        $authorIdQuery = "SELECT * FROM `authors` WHERE `id` = $AuthorId";
        $authorIdExists = mysqli_query($conn,$authorIdQuery);

        if (mysqli_num_rows($authorIdExists) === 1) {
            $deleteAuthorSql = "DELETE FROM `authors` WHERE `id` = $AuthorId";
            mysqli_query($conn,$deleteAuthorSql);
            $_SESSION['message'] = 'Your Author was successfully deleted!';
            header("location: ./index.php");
        } else {
            $_SESSION['message'] = 'Unexisting Author ID';
            header("Location ./index.php");
        }
    }
?>
