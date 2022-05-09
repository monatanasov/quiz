<?php
include './dbconn.php';
//missing documentation
mb_internal_encoding("UTF-8");
//get all rows from Authors Table
$DbAuthorNamesQuery = mysqli_query($conn,"SELECT * FROM `authors`");
//put all records from Authors Table inside Array for later use
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
            <!--     LABEL FOR ?????? what should I put there      -->
            <b><label for="">Choose author name</label> </b>
            <?php
                //display all Author Names inside dropdown select tag
                echo '<select>';
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
            //get all Quotes from DB
            $query = mysqli_query(
                $conn,
                "SELECT * FROM `authors` LEFT JOIN `quotes` ON authors.id=quotes.author_id"
            );
            //show all Quotes using HTML Table for better view
            while ($row = mysqli_fetch_assoc($query)){
                echo '<tr><td>' . $row['name'] . '</td>
                     <td>' . $row['quote'] . '</td> 
                      <tr>';
            }
        ?>
    </table>

</body>
</html>
