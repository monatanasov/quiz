<?php
include './dbconn.php';

$quotesQuery = mysqli_query(
    $conn,
    "SELECT * FROM `quotes`"
);
$authorsQuery = mysqli_query(
    $conn,
    "SELECT * FROM `authors`"
);

// create new empty array
$quotesArray = [];

while ($quote = mysqli_fetch_assoc($quotesQuery)) {
    // store the row as new key in the array
    $quotesArray[] = $quote;
}

// create new empty array
$authorsArray = [];

while ($author = mysqli_fetch_assoc($authorsQuery)) {
    // store the row as new key in the array
    $authorsArray[] = $author;
}

echo '<pre>'. print_r($quotesArray[0], true) .'</pre>';

$authorsCount = count($authorsArray);

$randomAuthorKey = rand(0, $authorsCount - 1);

echo '<pre>'. print_r($authorsArray[$randomAuthorKey], true) .'</pre>';
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
            echo $quotesArray[0]['quote'];
            ?>
        </div>
        <div class="binaryauthor">
            <?php
                echo '<h3>'.$authorsArray[$randomAuthorKey]['name'].'</h3>';
            ?>
        </div>
            <?php
                $check = 0;

                // check if this is the author
                if ($quotesArray[0]['author_id'] === $authorsArray[$randomAuthorKey]['id']) {
                    $check = 1;
                }

                echo '<button id="BtnYes" class="button yesbutton" onclick="buttonClicked(1, '. $check .')" >Yes!</button>';
                echo '<button id="BtnYes" class="button nobutton" onclick="buttonClicked(0, '. $check .')">No!</button>';
            ?>
    </div>
    <div>
<!--        <p class="answer" id="correct-answer">The answer is correct</p>-->
<!--        <p class="answer" id="incorrect-answer">The answer is NOT correct</p>-->
        <p class="answer" id="what-is-the-answer">The answer is NOT correct</p>
    </div>
</body>

<script>
    function buttonClicked(value, check) {
        // show div

        let answers = document.getElementsByClassName('answer');
        for(i = 0; i < answers.length; i++) {
            answers[i].style.display = 'none';
        }

        if (check === value) {
            document.getElementById("correct-answer").style.display = "block";
        } else {
            document.getElementById("incorrect-answer").style.display = "block";
        }
    }
</script>

</html>
