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

            if ($_POST) {
                //this variable will be used when buttons are clicked to check the correct/wrong answer
                //check becomes TRUE on match.
                $postQuoteId = $_POST['current_quote_id'];
                $postAuthorId = $_POST['current_author_id'];

                // OPTION 1
                // mysql query to check if the author of quote with id $postQuoteId equals $postAuthorId
                $query = mysqli_query($conn, "SELECT * FROM `quotes` WHERE `id` = 1");

                while($row = mysqli_fetch_assoc($query)){
                    $postQuote = $row;
                }
                echo '<pre>' . print_r($postQuote, true) . '</pre>';
                $check = false;
                if ($postQuote['author_id'] == $postAuthorId) {
                    $check = true;
                }

//                // OPTION 2
//                // mysql query to check if the author of quote with id $postQuoteId equals $postAuthorId
//                $query = mysqli_query($conn, "SELECT * FROM `quotes` WHERE `id` = $postQuoteId AND `author_id` = $postAuthorId");
//
//                $postQuote = [];
//                while($row = mysqli_fetch_assoc($query)){
//                    $postQuote = $row;
//                }
//                echo '<pre>' . print_r($postQuote, true) . '</pre>';
//                $check = false;
//                if ($postQuote) {
//                    $check = true;
//                }


                echo '<div id="display_answer_div">';
                    //$_POST returns 1 or 0 as string that's why the sign is ==
                    //Paragraph classes added for later use
                    if($check === (bool) $_POST['answer']){
                        echo '<p>CORRECT</p>';
                        $_SESSION['correct_Answers_Count'] = $_SESSION['correct_Answers_Count'] + 1;
                    } else{
                        echo '<p>INcorrect</p>';
                    }
                echo '</div>';
            }

            //on page reload if there's no SESSION key set these variables
            //key and SESSION['key'] will be used to change the Quotes div below
            //SESSION CAC will hold all correct user answers later
            if(!isset($_SESSION['key'])){
                $key=0;
                $_SESSION['key']=0;
                $_SESSION['correct_Answers_Count']=0;
            } else{
                //if there's SESSION add +1. Key variable assigns its value.
                //CORRECT ORDER IS A MUST
                $_SESSION['key']=$_SESSION['key'] + 1;
                $key=$_SESSION['key'];
            }

            echo '<pre>' . print_r($_SESSION['correct_Answers_Count'], true) . '</pre>';

            //destroy the session at start quiz again on btn click/form submit.
            //isset is a MUST
            if(isset($_POST['start_over_btn'])){
                session_destroy();
                header('Location: binarymode.php');
            }

            if(key_exists($key,$quotesArray)){
                $quote=$quotesArray[$key];
                $currentQuoteId = $quote['id'];
                //get the random author position from the Authors array
                $posAuthor=rand(0,sizeof($authorsArray)-1);
                $currentAuthorId=$authorsArray[$posAuthor]['id'];
                if(isset($key)){
                    echo "<div class='notHidden' id='$key'>";
                    echo "<div class=\"binaryquote\">" . $quote['quote'] . "</div>";
                    echo "<div class=\"binaryauthor\"><h3>" . $authorsArray[$posAuthor]['name'] . "</h3></div>";
                echo "<form action='binarymode.php' method=\"post\">";
                echo "<input class=\"Hidden\" name=\"current_quote_id\" value=\"$currentQuoteId\">";
                echo "<input class=\"Hidden\" name=\"current_author_id\" value=\"$currentAuthorId\">";
                echo "<button type=\"submit\" class=\"button yesbutton\" name=\"answer\" value=1>Yes!</button>";
                echo "<button type=\"submit\" class=\"button nobutton\" name=\"answer\" value=0>No!</button>";
                echo "</div>";
                echo "</form>";
                }
            } else{
                $correctAnswersCount=$_SESSION['correct_Answers_Count'];
                echo "<form action='binarymode.php' method=\"post\">";
                    echo "<div class=\"notHidden\" id=\"endOfQuizResult\">";
                    echo "<label for=\"inputAnswersCount\">Correct Answers:</label>";
                    echo "<input type=\"text\" id=\"inputAnswersCount\" name=\"inputAnswersCount\" value=\"$correctAnswersCount\" readonly>";
                    echo "<button name=\"start_over_btn\">Start over</button>";
                    echo "</div>";
                echo "</form>";
            }
        ?>
    </div>
</body>
<script type="text/javascript">
    window.onload = function () {
        // let displayAnswerDiv = document.getElementById('display_answer_div');
        //
        // if (displayAnswerDiv) {
        //     // wait for 3 sec and hide
        //     setTimeout(() => {
        //         // hide the element
        //         displayAnswerDiv.style.display = 'none';
        //     }, 1000);
        // }
    };
</script>
</html>
