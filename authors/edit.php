<?php
    session_start();
    include '../dbconn.php';
    mb_internal_encoding("UTF-8");

    echo '<pre>' . print_r($_POST, true) . '</pre>';

    if ($_POST) {
        $authorName = trim($_POST['updateAuthor']);
        $authorNameLength = mb_strlen($authorName);
        $authorId = $_POST['authorId'];
        $authorCheckQuery = "SELECT * FROM `authors` WHERE `id` = '$authorName'";
        $authorCheckResult = mysqli_query($conn,$authorCheckQuery);

        if (!$authorNameLength >= 1 && !$authorNameLength <=255) {
            $_SESSION['message'] =  'Author name must be between 1 and 255 characters long!' . '<br>';
        }

        if (mysqli_num_rows($authorCheckResult) >= 1) {
            $_SESSION['message'] = 'This Author already exists!' . '<br>';
        }

        if (empty($_SESSION['message'])) {
            $updateAuthorSql = "UPDATE `authors` SET `name`='$authorName' WHERE `id` = $authorId";
            mysqli_query($conn,$updateAuthorSql);
            $_SESSION['message'] = 'Your Author was successfully edited!';
            header("Location ./index.php");
        } else {
            //$editableAuthorName = $authorName;
            foreach ($_SESSION['message'] as $error) {
                echo $error;
            }
            header("location: ./show.php");
        }
    }
?>
