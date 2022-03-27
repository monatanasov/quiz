<?php
include './dbconn.php';
//store all db tables in a variable
$quotesQuery=mysqli_query($conn, "SELECT * FROM `quotes` ");
$authorsQuery=mysqli_query($conn, "SELECT * FROM `authors` ");

//loop each row of Quotes querry variable and store its data into multidimensional array
while($row=mysqli_fetch_assoc($quotesQuery)){
    $quotesArray[]=$row;
}
//get the random quote position from the array
$posQuery=rand(0,sizeof($quotesArray)-1);

//loop each row of Authors querry variable and store its data into multidimensional array
while($row=mysqli_fetch_assoc($authorsQuery)){
    $authorsArray[]=$row;
}
//get the random author position from the array
$posAuthor=rand(0,sizeof($authorsArray)-1);

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
                //print the random generated Quote
                echo $quotesArray[$posQuery]['quote'];
            ?>
        </div>
        <div class="binaryauthor">
            <?php
                //print the random generated Author
                echo '<h3>'.$authorsArray[$posAuthor]['name'].'</h3>';
            ?>
        </div>

            <button id="BtnYes" class="button yesbutton">Yes!</button>
            <button id="BtnNo" class="button nobutton">No!</button>
    </div>

    <?php

        if($quotesArray[$posQuery]['author_id']===$authorsArray[$posAuthor]['id']){
            echo '<p>Correct</p>';
        }else{
            echo '<p>Try again!</p>';
        }


    echo '<pre>' . print_r($quotesArray[$posQuery], true) . '</pre>';
    echo  '<pre>' . print_r($authorsArray[$posAuthor], true) . '</pre>';
    ?>

</body>
</html>




