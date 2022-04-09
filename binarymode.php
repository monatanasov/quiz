<?php
include './dbconn.php';
// store all db queries in a variable
$quotesQuery=mysqli_query($conn, "SELECT * FROM `quotes`");
$authorsQuery=mysqli_query($conn, "SELECT * FROM `authors`");
//loop each row of Quotes query variable and store its data into multidimensional array
while($row=mysqli_fetch_assoc($quotesQuery)){
    $quotesArray[]=$row;
}
//shuffle all quotes in the array for later random quote use.
shuffle($quotesArray);
//loop each row of Authors query variable and store its data into multidimensional array
while($row=mysqli_fetch_assoc($authorsQuery)){
    $authorsArray[]=$row;
}
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
        //get the current Author_ID from the first element of the QuotesArray
        $currentQuoteAuthorId=$quotesArray[0]['author_id'];
        //Iterate over whole table to get the Author Name using Author_ID from previous row
        //Is there another way to do that? Too complicated and slow way.
        foreach ($authorsArray as $author){
            if($currentQuoteAuthorId==$author['id']){
                $currentQuoteAuthorName=$author['name'];
            }
        }
        foreach($quotesArray as $key=>$quote){
            //get the random author position from the Authors array
            $posAuthor=rand(0,sizeof($authorsArray)-1);
            //this variable will be used when buttons are clicked to check the correct/wrong answer
            $check=0;
            //check becomes TRUE on match.
            if($quote['author_id']===$authorsArray[$posAuthor]['id']){
                $check=1;
            }
            if($key===0){
                echo "<div class='notHidden' id='$key'>";
            }else{
                echo "<div class='hidden' id='$key'>>";
            }
        echo "<div class=\"binaryquote\">".$quote['quote']."</div>";
        echo "<div class=\"binaryauthor\"><h3>".$authorsArray[$posAuthor]['name']."</h3></div>";
        echo "<button class=\"button yesbutton\" onclick=\"answerFunction(1,$check,$key)\">Yes!</button>";
        echo "<button class=\"button nobutton\" onclick=\"answerFunction(0,$check,$key)\">No!</button>";
        echo "</div>";
        }
        ?>
    </div>
    <script>
        //using json to get the author name from the complicated and slow iterations above
        let currentQuoteAuthorName = <?php echo(json_encode($currentQuoteAuthorName)); ?>;
        function answerFunction(value,check,key) {
            if(value===check){
                alert('Correct! The right answer is: ' + currentQuoteAuthorName);
            }else{
                alert('Sorry, you are wrong! The right answer is: ' + currentQuoteAuthorName);
            }
            setTimeout(() => {
                document.getElementById(key).style.display = 'none';
                document.getElementById(key + 1).style.display = 'block';
            },100)
        }
    </script>
</body>
</html>




