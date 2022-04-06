<?php
include './dbconn.php';
// store all db queries in a variable
$quotesQuery=mysqli_query($conn, "SELECT * FROM `quotes`");
$authorsQuery=mysqli_query($conn, "SELECT * FROM `authors`");

//loop each row of Quotes query variable and store its data into multidimensional array
while($row=mysqli_fetch_assoc($quotesQuery)){
    $quotesArray[]=$row;
}
shuffle($quotesArray);


//loop each row of Authors query variable and store its data into multidimensional array
while($row=mysqli_fetch_assoc($authorsQuery)){
    $authorsArray[]=$row;
}
//echo '<pre>' . print_r($quotesArray, true) . '</pre>';

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
        <?php
        foreach($quotesArray as $key=>$quote){
            //get the random author position from the array
            $posAuthor=rand(0,sizeof($authorsArray)-1);
        echo "<div class='hidden'>";
        echo "<div class=\"binaryquote\">".$quote['quote']."</div>";
        echo "<div class=\"binaryauthor\"><h3>".$authorsArray[$posAuthor]['name']."</h3></div>";
        echo "<button class=\"button yesbutton\" onclick=\"myFunctionYes()\">Yes!</button>";
        echo "<button class=\"button nobutton\" onclick=\"myFunctionNo()\">No!</button>";
        echo "</div>";
        }
        ?>
    </div>
    <script>
        //create 2 js variables to store php results for additional comparison
      /*  let quotesResultID = <?php echo(json_encode($quotesArray[$posQuote]['author_id'])); ?>;
        let authorsResultID = <?php echo(json_encode($authorsArray[$posAuthor]['id'])); ?>;
        //a variable which extracts Author-Name and show it in the alert box after
        let authorResultName = <?php echo(json_encode($authorsArray[$posAuthor]['name'])); ?>;
        //function for comparison the YES result*/
        function myFunctionYes() {
            if(quotesResultID===authorsResultID){
                alert('Correct! The right answer is: '+authorResultName);
            }
            else{
                alert('Sorry, you are wrong! The right answer is: '+authorResultName);
            }
        }
        //function for comparison the NO result
        function myFunctionNo() {
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




