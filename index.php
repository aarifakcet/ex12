<?php

$xmlFile = 'books.xml';

if (!file_exists($xmlFile)) {
    die("XML file not found.");
}

$xml = simplexml_load_file($xmlFile);

if ($xml === false) {
    die("Failed to read XML file.");
}

$totalBooks = count($xml->book);
$totalPrice = 0;

foreach ($xml->book as $book) {
    $totalPrice += (float)$book->price;
}

$avgPrice = $totalBooks > 0 ? $totalPrice / $totalBooks : 0;

?>

<!DOCTYPE html>
<html>

<head>

    <title>Bookstore Inventory</title>

</head>

<body>

    <h1>Bookstore Inventory</h1>

    <p>Total Books: <?php echo $totalBooks; ?></p>

    <p>Average Price: $<?php echo number_format($avgPrice, 2); ?></p>

    <table border="1">

        <tr>
            <th>Title</th>
            <th>Author</th>
            <th>Genre</th>
            <th>Year</th>
            <th>Price</th>
        </tr>

        <?php foreach ($xml->book as $book): ?>

        <tr>

            <td><?php echo htmlspecialchars($book->title); ?></td>

            <td><?php echo htmlspecialchars($book->author); ?></td>

            <td><?php echo htmlspecialchars($book->genre); ?></td>

            <td><?php echo htmlspecialchars($book->year); ?></td>

            <td>$<?php echo number_format((float)$book->price, 2); ?></td>

        </tr>

        <?php endforeach; ?>

    </table>

</body>

</html>