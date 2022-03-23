<?php
include './dbconn.php';
$quotequery=mysqli_query($conn, "SELECT *, authors.id AS aut_id FROM `authors` LEFT JOIN `quotes` ON authors.id=quotes.author_id ORDER BY RAND() LIMIT 1 ");
$authorquery=mysqli_query($conn, "SELECT *, authors.id AS aut_id FROM `authors` LEFT JOIN `quotes` ON authors.id=quotes.author_id ORDER BY RAND() LIMIT 1 ");
?>

<html lang="en">
<head>
  <link rel="stylesheet" href="./css/myquiz.css">
    <meta charset="UTF-8" >
    <title>Binary mode quiz</title>
</head>
<body>
    <div class="binaryglobal">
        <a href="./binarymode.php">
            <div class="leftwireframe divs">
                <img src="./images/singlepage.webp" alt="binarymodeimg">
            </div>
        </a>
        <a href="">
            <div class="rightwireframe divs">
                <img src="./images/multiplepages.webp" alt="multimodeimg">
            </div>
        </a>
        <h3>Who said it?</h3>
        <div class="binaryquote" >
            <?php
            while($row=mysqli_fetch_assoc($quotequery)){
                echo $row['quote'];
                $resultquote[]=$row['author_id'];
                $resultquote[]=$row['name'];
                $resultquote[]=$row['quote'];
            }
            ?>
        </div>
        <div class="binaryauthor">
            <?php
            while($row=mysqli_fetch_assoc($authorquery)){
                echo '<h3>'.$row['name'].'</h3>';
                $resultauthor[]=$row['aut_id'];
                $resultauthor[]=$row['name'];
                $resultauthor[]=$row['quote'];
            }
            ?>
        </div>

            <button id="BtnYes" class="button yesbutton">Yes!</button>
            <button id="BtnNo" class="button nobutton">No!</button>
    </div>

   <?php
        echo '<pre>' . print_r($resultquote, true) . '</pre>';
        echo '<pre>' . print_r($resultauthor, true) . '</pre>';
    ?>

</body>
</html>




