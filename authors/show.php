<?php
include '../dbconn.php';

if (isset($_GET['id'])) {
    $authorId = $_GET['id'];

    $authorCheckQuery = "SELECT * FROM `authors` WHERE `id` = $authorId";
    $authorCheckResult = mysqli_query($conn,$authorCheckQuery);

    $errors = [];
    if (mysqli_num_rows($authorCheckResult) === 0) {
        $errors[] = 'Your selected Author doesnt exist<br>';
    }

    $author = [];
    if (empty($errors)) {
        while ($row = mysqli_fetch_assoc($authorCheckResult)) {
            $author = $row;
        }
    }

} else {
    // TODO show error
}

// TODO if errors - print errors
?>

LINK EDIT HERE
LINK DELETE HERE

Author id: id
Author name: name
