<?php
session_start();
include './dbconn.php';
// store all db queries in a variable
$quotesQuery=mysqli_query($conn, "SELECT * FROM `quotes`");
$authorsQuery=mysqli_query($conn, "SELECT * FROM `authors`");
//loop each row of Quotes query variable and store its data into multidimensional array
while($row=mysqli_fetch_assoc($quotesQuery)){
    $quotesArray[]=$row;
}
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
            //this variable will be used when buttons are clicked to check the correct/wrong answer
            //check becomes TRUE on match.
            $check=0;
            if($_POST['current_quote_author_id']===$_POST['current_author_id']){
                $check = 1;
            }
            //$_POST returns 1 or 0 as string that's why the sign is ==

            if(!isset($_SESSION['key'])){
                $key=0;
                $_SESSION['key']=0;
                $_SESSION['correct-Answers']=0;
            } else{
                $_SESSION['key']=$_SESSION['key'] + 1;
                $key=$_SESSION['key'];
            }

            if($check==$_POST['answer']){
                echo '<p>CORRECT</p>';
                $_SESSION['correct-Answers'] = $_SESSION['correct-Answers'] + 1;
            } else{
                echo '<p>INcorrect</p>';
            }

            echo '<pre>' . print_r($_SESSION['correct-Answers'], true) . '</pre>';

            if(key_exists($key,$quotesArray)){
                $quote=$quotesArray[$key];
                $currentQuoteAuthorId=$quote['author_id'];
                //get the random author position from the Authors array
                $posAuthor=rand(0,sizeof($authorsArray)-1);
                $currentAuthorId=$authorsArray[$posAuthor]['id'];
                if(isset($key)){
                    echo "<div class='notHidden' id='$key'>";
                    echo "<div class=\"binaryquote\">" . $quote['quote'] . "</div>";
                    echo "<div class=\"binaryauthor\"><h3>" . $authorsArray[$posAuthor]['name'] . "</h3></div>";
                echo "<form action='binarymode.php' method=\"post\">";
                echo "<input class=\"Hidden\" name=\"current_quote_author_id\" value=\"$currentQuoteAuthorId\">";
                echo "<input class=\"Hidden\" name=\"current_author_id\" value=\"$currentAuthorId\">";
                echo "<button type=\"submit\" class=\"button yesbutton\" name=\"answer\" value=1>Yes!</button>";
                echo "<button type=\"submit\" class=\"button nobutton\" name=\"answer\" value=0>No!</button>";
                echo "</div>";
                echo "</form>";
                }
            } else{
                echo "<form action='binarymode.php' method=\"post\">";
                    echo "<div class=\"notHidden\" id=\"endOfQuizResult\">";
                    echo "<label for=\"inputAnswersCount\">Correct Answers:</label>";
                    echo "<input type=\"text\" id=\"inputAnswersCount\" name=\inputAnswersCount\" readonly>";
                    echo "<button name=\"start_over_btn\">Start over</button>";
                    echo "</div>";
                echo "</form>";
            }
        ?>

    </div>
<!--    <script>
        //variable for counting all correct answers
        let currentAnswersCount = 0;
        function answerFunction(value,check,key) {
            if(value===check){
                alert('Correct! The right answer is: ');
                currentAnswersCount = currentAnswersCount + 1;
            }else{
                alert('Sorry, you are wrong! The right answer is: ');
            }
            setTimeout(() => {
                document.getElementById(key).style.display = 'none';
                if(document.getElementById(key + 1) != null){
                document.getElementById(key + 1).style.display = 'block';
                }else{
                    alert('You have answered all questions. Click "OK" to check your result.');
                    // et the value of an html input field with already counted number of correct answers
                    document.getElementById("inputAnswersCount").value = currentAnswersCount;
                    //show the div with result
                    document.getElementById("endOfQuizResult").style.display = 'block';
                }
            },100)
        }
    </script>-->
</body>
</html>
