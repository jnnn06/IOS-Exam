<?php
require_once("database.php");

$data = [];

// unpurchased products query
$unpurchasedProjects = "SELECT *
FROM projects
WHERE id NOT IN (
    SELECT DISTINCT project_id
    FROM client_projects
);
";
$unpurchasedProjectsResult = $mysqli->query($unpurchasedProjects);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unpurchased Projects</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Unpurchased Projects</h1>

    <ul>
        <?php while ($project = $unpurchasedProjectsResult->fetch_assoc()) : ?>
            <li><?= $project["name"] ?></li>
        <?php endwhile; ?>
    </ul>
</body>
</html>
