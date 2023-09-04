<?php
require_once("database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["task"])) {
    $task = $_POST["task"];
    $sql = "INSERT INTO clients (name) VALUES ('test')";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("s", $task);
    $stmt->execute();
    $stmt->close();
}

$sql = "SELECT * FROM clients";
$result = $mysqli->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple To-Do List</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Simple To-Do List</h1>
    
    <form method="POST">
        <input type="text" name="task" placeholder="Add a task" required>
        <button type="submit">Add</button>
    </form>

    <ul>
        <?php while ($row = $result->fetch_assoc()) : ?>
            <li><?= $row["name"] ?></li>
        <?php endwhile; ?>
    </ul>
</body>
</html>
