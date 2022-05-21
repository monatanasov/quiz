<?php
echo '<pre>' . print_r($_POST, true) . '</pre>';
    if ($_POST) {
        $errors = [];
        $postAuthorName = trim($_POST['updateAuthor']);
        $authorNameLength = mb_strlen($postAuthorName);
        $authorId = $_SESSION['editableAuthorId'];     // TODO: PASS ID

        $authorCheckQuery = "SELECT * FROM `authors` WHERE `name` = '$postAuthorName'";
        $authorCheckResult = mysqli_query($conn,$authorCheckQuery);

        if (!$authorNameLength >= 1 && !$authorNameLength <=255) {
            $errors[] =  'Author name must be between 1 and 255 characters long!' . '<br>';
        }

        if (mysqli_num_rows($authorCheckResult) >= 1) {
            $errors[] = 'This Author already exists!' . '<br>';
        }

        if (empty($errors)) {
            $updateAuthorSql = "UPDATE `authors` SET `name`='$postAuthorName' WHERE `id` = $authorId";
            mysqli_query($conn,$updateAuthorSql);
            echo 'Your Author was successfully edited!';

            if (mysqli_error($conn)) {
                echo 'No database connection in editAuthor page';
                exit;
            }
        } else {
            $editableAuthorName = $postAuthorName;
            foreach ($errors as $error) {
                echo $error;
            }
        }
    }
?>
