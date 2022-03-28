<?php
include './dbconn.php';
// store all db queries in a variable
$quotesQuery=mysqli_query($conn, "SELECT * FROM `quotes`");
$authorsQuery=mysqli_query($conn, "SELECT * FROM `authors`");

//loop each row of Quotes query variable and store its data into multidimensional array
while($row=mysqli_fetch_assoc($quotesQuery)){
    $quotesArray[]=$row;
}
//get the random quote position from the array
$posQuote=rand(0,sizeof($quotesArray)-1);

//loop each row of Authors query variable and store its data into multidimensional array
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
                echo $quotesArray[$posQuote]['quote'];
            ?>
        </div>
        <div class="binaryauthor">
            <?php
                //print the random generated Author
                echo '<h3>'.$authorsArray[$posAuthor]['name'].'</h3>';
            ?>
        </div>

            <button id="BtnYes" class="button yesbutton" onclick="myFunction()">Yes!</button>
            <button id="BtnNo" class="button nobutton" onclick="myFunction2()">No!</button>
    </div>

    <?php
    echo '<pre>' . print_r($quotesArray[$posQuote], true) . '</pre>';
    echo  '<pre>' . print_r($authorsArray[$posAuthor], true) . '</pre>';
    ?>

    <script>
        //create 2 js variables to store php results for additional comparison
        let quotesResultID = <?php echo(json_encode($quotesArray[$posQuote]['author_id'])); ?>;
        let authorsResultID = <?php echo(json_encode($authorsArray[$posAuthor]['id'])); ?>;
        //a variable which extracts Author-Name and show it in the alert box after
        let authorResultName = <?php echo(json_encode($authorsArray[$posAuthor]['name'])); ?>;
        //function for comparison the YES result
        function myFunction() {
            if(quotesResultID===authorsResultID){
                alert('Correct! The right answer is: '+authorResultName);
            }
            else{
                alert('Sorry, you are wrong! The right answer is: '+authorResultName);
            }
        }
        //function for comparison the NO result
        function myFunction2() {
            if(quotesResultID!==authorsResultID){
                alert('Correct! The right answer is:' +authorResultName);
            }
            else{
                alert('Sorry, you are wrong! The right answer is:' +authorResultName);
            }
        }
    </script>
</body>
</html>




