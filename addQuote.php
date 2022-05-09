<?php
include './dbconn.php';
mb_internal_encoding("UTF-8");
?>

<html lang="en">
<head>
    <meta charset="UTF-8" >
    <link rel="stylesheet" href="./css/myquiz.css">
    <title>Add Quote</title>
</head>
<body>
    <a href="./index.php">Main page</a><br>
    <a href="./binarymode.php">Binarymode quiz</a><br>
    <a href="./addAuthor.php">Add Author</a>

    <form action="addQuote.php" method="POST">
        <h2>Add new quote</h2>
        <div id="addQuoteDiv">
            <!--     LABEL FOR ?????? what should I put there      -->
            <b><label for="">Add your Quote here</label> </b><br>
            <?php echo '<textarea class="addQuoteTxt" name="quoteTxt" cols="40" rows="5"></textarea>'?><br>
            <input type="submit" class="submitQuote">
        </div>
    </form>

</body>
</html>
