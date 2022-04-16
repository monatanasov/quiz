<?php
// Start the session
session_start();

include './dbconn.php';
// store all db queries in a variable
$quotesQuery=mysqli_query($conn, "SELECT * FROM `quotes`");
$authorsQuery=mysqli_query($conn, "SELECT * FROM `authors`");
//loop each row of Quotes query variable and store its data into multidimensional array
while($row=mysqli_fetch_assoc($quotesQuery)){
    $quotesArray[]=$row;
}

// if reset form is submitted - destroy the session and reload
if (isset($_GET['reset'])) {
    session_destroy();
    header('Location: binarymode.php');
}

// if answer form is submitted - check what is the answer
if (isset($_GET['answer'])) {
    // if the answer is YES - check if the quote author and current random author matches;
    // else - check if the quote author and current random author do not match
    if ($_GET['answer'] === "YES") {
        // check if quote_author_id === current_author_id
        if ($_GET['quote_author_id'] === $_GET['current_author_id']) {
            $check = true;
        } else {
            $check = false;
        }
    } else {
        // check if quote_author_id is different than the current_author_id
        if ($_GET['quote_author_id'] !== $_GET['current_author_id']) {
            $check = true;
        } else {
            $check = false;
        }
    }
}

// if there is NOT currentQuoteKey key in the session - set session default variables
// else - increase the current quote key
if (! isset($_SESSION["currentQuoteKey"])) {
    $_SESSION["currentQuoteKey"] = 0;
    $_SESSION["correctAnswersCount"] = 0;
} else {
    $_SESSION["currentQuoteKey"] = $_SESSION["currentQuoteKey"] + 1;
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

        <?php
            // if there is answer form passed - display if the answer was correct or not
            if (isset($_GET['answer'])) {
                echo "<h2>You have answered</h2>";
                echo "<p>Your answers was: </p>";
                if ($check) {
                    $_SESSION["correctAnswersCount"] = $_SESSION["correctAnswersCount"] + 1;
                    echo "CORRECT";
                } else {
                    echo "INCORRECT";
                }
            }

            echo "<h3>Who said it?</h3>";

            $key = $_SESSION["currentQuoteKey"];

            // if the given key exists in the quotes array - display the quote
            // else - display the results
            if (key_exists($key, $quotesArray)) {
                $quote = $quotesArray[$key];
                $quoteAuthorId = $quote['author_id'];
                //get the random author position from the Authors array
                $posAuthor=rand(0,sizeof($authorsArray)-1);
                $currentAuthorId = $authorsArray[$posAuthor]['id'];

                echo "<div class='notHidden' id='$key'>";
                echo "<div class=\"binaryquote\">".$quote['quote']."</div>";
                echo "<div class=\"binaryauthor\"><h3>".$authorsArray[$posAuthor]['name']."</h3></div>";
                echo "</div>";

                echo "<form action='binarymode.php' method='GET'>";
                    echo "<input name=\"quote_author_id\" value=\"$quoteAuthorId\"/>";
                    echo "<input name=\"current_author_id\" value=\"$currentAuthorId\"/>";
                    echo "<input type=\"submit\" name=\"answer\" value=\"YES\" />";
                    echo "<input type=\"submit\" name=\"answer\" value=\"NO\" />";
                echo " </form>";
            } else {
                $correctAnswersCount = $_SESSION["correctAnswersCount"];
                echo "<div id=\"endOfQuizResult\">";
                echo "<label for=\"inputAnswersCount\">Correct Answers:</label>";
                echo "<input type=\"text\" id=\"inputAnswersCount\" name=\"inputAnswersCount\" readonly value=\"$correctAnswersCount\">";
                echo "<form action='binarymode.php' method='GET'>";
                    echo "<input type=\"submit\" name=\"reset\" value=\"Start over\" />";
                echo " </form>";
                echo "</div>";
            }
        ?>
    </div>
</body>
</html>
