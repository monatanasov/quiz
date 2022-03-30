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

//echo '<pre>'. print_r($quotesArray, true) .'</pre>';

$authorsCount = count($authorsArray);



//echo '<pre>'. print_r($authorsArray[$randomAuthorKey], true) .'</pre>';
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
            foreach ($quotesArray as $key => $quote) {
                $quoteText = $quote['quote'];
                $randomAuthorKey = rand(0, $authorsCount - 1);
                $randomAuthorName = $authorsArray[$randomAuthorKey]['name'];

                $check = 0;

                // check if this is the author
                if ($quote['author_id'] === $authorsArray[$randomAuthorKey]['id']) {
                    $check = 1;
                }

                if ($key === 0) {
                    $classes = '';
                } else {
                    $classes = 'hidden';
                }

                echo "
                    <div class='$classes' id='$key'>
                        <div class=\"binaryquote\">$quoteText</div>
                        <div class=\"binaryauthor\"><h3>$randomAuthorName</h3></div>
                        <button class=\"button yesbutton\" onclick=\"buttonClicked(1, $check, $key)\">Yes!</button>
                        <button class=\"button nobutton\" onclick=\"buttonClicked(0, $check, $key)\">No!</button>
                    </div>
                ";
            }
        ?>
    </div>
    <div>
        <p class="answer" id="correct-answer">The answer is correct</p>
        <p class="answer" id="incorrect-answer">The answer is NOT correct</p>
<!--        <p class="answer" id="what-is-the-answer">The answer is NOT correct</p>-->
    </div>
</body>

<script>
    function buttonClicked(value, check, key) {
        // show div

        if (check === value) {
            document.getElementById("correct-answer").style.display = "block";
        } else {
            document.getElementById("incorrect-answer").style.display = "block";
        }

        setTimeout(() => {
            let answers = document.getElementsByClassName('answer');
            for(i = 0; i < answers.length; i++) {
                answers[i].style.display = 'none';
            }

            document.getElementById(key).style.display = "none";
            document.getElementById(key + 1).style.display = "block";
        }, 1000);
    }
</script>

</html>
