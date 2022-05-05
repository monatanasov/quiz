<?php
include 'dbconn.php';
$query=mysqli_query($conn, "SELECT * FROM `authors` LEFT JOIN `quotes` ON authors.id=quotes.author_id");
?>
<a href="http://dev.quiz/binarymode.php">Binary mode</a>
<a href="http://dev.quiz/add-author.php">Add author</a>
<a href="http://dev.quiz/add-quote.php">Add quote</a>
<table border="1px solid black">
    <tr>
        <th>Author</th>
        <th>Quote</th>
    </tr>
            <?php
                while($row=mysqli_fetch_assoc($query)){
                    echo '<tr><td>'.$row['name'].'</td>
                              <td>'.$row['quote'].'</td>
                </tr>';
                }
            ?>
</table>
