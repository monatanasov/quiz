<?php
include './dbconn.php';
mb_internal_encoding("UTF-8");
$DbAuthorNamesQuery = mysqli_query($conn,"SELECT * FROM `authors`");
while ($row = mysqli_fetch_assoc($DbAuthorNamesQuery)) {
    $allAuthorNames[] = $row['name'];
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8" >
    <link rel="stylesheet" href="./css/myquiz.css">
    <title>Add Quote</title>
</head>
<body>
    <a href="./index.php">Main page</a><br>
    <a href="./binarymode.php">Binarymode quiz</a><br>
    <a href="./addAuthor.php">Add Author</a>

    <form action="addQuote.php" method="POST">
        <h2>Add new quote</h2>
        <div id="addQuoteDiv">
            <!--     LABEL FOR ?????? what should I put there      -->
            <b><label for="">Add your Quote here</label> </b><br>
            <?php echo '<textarea class="addQuoteTxt" name="quoteTxt" cols="40" rows="5"></textarea><br>';?>
            <b><label for="">Choose author name</label> </b>
            <?php echo '<select>';
            foreach($allAuthorNames as $key=>$authorNames){
                echo '<option value="'.$key.'">'.$authorNames.'</option>'.'<br>';
            }
            echo '</select><br>';
            ?>
            <input type="submit" class="submitQuote">
        </div>
    </form>
    <table border="1px solid black">
        <tr>
            <th>Author</th>
            <th>Quote</th>
        </tr>
        <?php
            $query = mysqli_query(
                $conn,
                "SELECT * FROM `authors` LEFT JOIN `quotes` ON authors.id=quotes.author_id"
            );
            while ($row = mysqli_fetch_assoc($query)){
                echo '<tr><td>' . $row['name'] . '</td>
                     <td>' . $row['quote'] . '</td> 
                      <tr>';
            }
        ?>
    </table>

</body>
</html>
