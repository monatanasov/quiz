<?php
    session_start();
    include '../dbconn.php';
    mb_internal_encoding("UTF-8");

    if ($_POST) {
        $authorId = $_POST['id'];
        $exists = false;
        // TODO: check if exists

        if ($exists) {
            $_SESSION['message'] = 'Unexisting id';
            header("Location: ./index.php");
        }

        $deleteAuthorSql = "DELETE FROM `authors` WHERE `id` = $authorId";
        mysqli_query($conn, $deleteAuthorSql);

        if (mysqli_error($conn)) {
            echo 'No database connection in deleteAuthor page';
            exit;
        }

        $_SESSION['message'] = 'Author deleted successfully';
    }

    header("Location: ./index.php");
?>
