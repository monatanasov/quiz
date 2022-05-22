<?php
    session_start();
    include '../dbconn.php';
    mb_internal_encoding("UTF-8");

    if ($_POST) {
        $authorName = trim($_POST['authorName']);
        $authorNameLength = mb_strlen($authorName);
        $authorId = $_POST['authorId'];
        $authorCheckQuery = "SELECT * FROM `authors` WHERE `name` = '$authorName'";
        $authorCheckResult = mysqli_query($conn,$authorCheckQuery);

        if (!$authorNameLength >= 1 && !$authorNameLength <=255) {
            $_SESSION['message'] = 'Author name must be between 1 and 255 characters long!' . '<br>';
        }

        if (mysqli_num_rows($authorCheckResult) >= 1) {
            $_SESSION['message'] = 'This Author already exists!' . '<br>';
        }

        if (empty($_SESSION['message'])) {
            $updateAuthorSql = "UPDATE `authors` SET `name`='$authorName' WHERE `id` = $authorId";
            mysqli_query($conn,$updateAuthorSql);
            $_SESSION['message'] = 'Your Author was successfully edited!';
            header("location: ./index.php");
        } else {
            //$editableAuthorName = $authorName;
            $_SESSION['post'] = $_POST;
            header("location: ./show.php");
        }
    }
?>