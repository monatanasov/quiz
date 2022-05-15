<?php
    include './dbconn.php';
    // Set internal character encoding to UTF-8
    mb_internal_encoding("UTF-8");
    // get all rows from Authors Table
    $dbAuthorNamesQuery = mysqli_query($conn,"SELECT * FROM `authors`");
    // put all records from Authors Table inside Array for later use
    while ($row = mysqli_fetch_assoc($dbAuthorNamesQuery)) {
        $allAuthors[] = $row;
    }
?>
<html lang="en">
<head>
    <meta charset="UTF-8" >
    <link rel="stylesheet" href="./css/myquiz.css">
    <title>Add Quote</title>
</head>
<body>
    <?php
          if ($_POST) {
            $quoteTxt = trim($_POST['quoteTxt']);
            $selectedAuthorId = (int) trim($_POST['selectedAuthorName']);
            $quoteCheckQuery = "SELECT * FROM `quotes` WHERE `quote` = '$quoteTxt'";
            $quoteCheckResult = mysqli_query($conn,$quoteCheckQuery);
            $errors = [];
            // mb_strlen require the string length showing number of characters instead of
            // strlen which showing number of bytes
            $quoteLength = mb_strlen ($quoteTxt);

            if (!$quoteLength >= 1 && !$quoteLength <= 500) {
                $errors[] = 'Quote length must be between 1 and 500 characters long!<br>';
            }

            if (mysqli_num_rows($quoteCheckResult) >= 1) {
                $errors[] = 'This quote already exists<br>';
            }

            if (empty($errors)) {
                $insertQuoteSql = 'INSERT INTO `quotes`(`author_id`,`quote`) VALUES('.
                    mysqli_real_escape_string($conn,$selectedAuthorId).',"'.
                    mysqli_real_escape_string($conn,$quoteTxt).'")';
                $insertQuoteQuery = mysqli_query($conn,$insertQuoteSql);
                echo 'success';
            } else {
                foreach ($errors as $error) {
                    echo $error;
                }
            }
        }
    ?>
    <a href="./index.php">Main page</a><br>
    <a href="./binarymode.php">Binarymode quiz</a><br>
    <a href="./addAuthor.php">Add Author</a>
    <form action="addQuote.php" method="POST">
        <h2>Add new quote</h2>
        <div id="addQuoteDiv">
            <b><label for="addQuoteTxt">Add your Quote here</label></b><br>
            <textarea class="addQuoteTxt" id="addQuoteTxt" name="quoteTxt" cols="40" rows="5"></textarea><br>
            <b><label for="authorNameDropDown">Choose author name</label></b>
            <?php
                // display all Author Names inside dropdown select tag
                echo '<select id="authorNameDropDown" name="selectedAuthorName">';
                foreach ($allAuthors as $key => $author) {
                    echo '<option value="' . $author['id'] . '">' . $author['name'] . '</option>'.'<br>';
                }
                echo '</select><br>';
            ?>
            <input type="submit" class="submitQuote">
        </div>
    </form>
    <table border="1px solid black">
        <tr>
            <th>Author</th>
            <th>Quote</th>
        </tr>
        <?php
            // get all Quotes from DB
            $query = mysqli_query(
                $conn,
                "SELECT * FROM `quotes` LEFT JOIN `authors` ON quotes.author_id = authors.id ORDER BY name ASC"
            );
            // show all Quotes using HTML Table for better view
            while ($row = mysqli_fetch_assoc($query)){
                echo '<tr><td>' . $row['name'] . '</td>
                     <td>' . $row['quote'] . '</td> 
                      <tr>';
            }
        ?>
    </table>
</body>
</html>
