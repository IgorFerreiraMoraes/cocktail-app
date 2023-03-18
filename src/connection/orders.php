<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php
    $connection = mysqli_connect("localhost", "root", "", "cocktail") or die("Failed");

    $sql_query = "SELECT drink FROM `orders`";
    $result = $connection->query($sql_query);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<span>" . $row["drink"] . "</span>";
        }
    }

    mysqli_close($connection);
    ?>

    <script src="script.js"></script>
</body>

</html>