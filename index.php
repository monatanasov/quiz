<?php
include 'dbconn.php';
$query = mysqli_query($conn, "SELECT * FROM `quotes` LEFT JOIN `authors` ON quotes.author_id=authors.id");
?>
<a href="./binarymode.php">Binarymode quiz</a><br>
<a href="./addAuthor.php">Add Author</a><br>
<a href="./addQuote.php">Add Quote</a><br>
<a href="./authors/index.php">CRUD Author</a>
<table border="1px solid black">
    <tr>
        <th>Author</th>
        <th>Quote</th>
    </tr>
            <?php
                while ($row = mysqli_fetch_assoc($query)){
                    echo '<tr><td>' . $row['name'] . '</td>
                              <td>' . $row['quote'] . '</td>
                </tr>';
                }
            ?>
</table>
