<?php
require_once("database.php");

$data = [];

// query for getting the projects and it purchase/clients count
$projectsCount = "SELECT projects.name, IFNULL(projects_count, 0) AS count
FROM projects
LEFT JOIN (
    SELECT project_id, COUNT(*) AS projects_count
    FROM client_projects
    GROUP BY project_id
) AS project_counts
ON projects.id = project_counts.project_id;
";
$projectsCountResult = $mysqli->query($projectsCount);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projects Count</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Projects Count</h1>

    <ul>
    <?php while ($project = $projectsCountResult->fetch_assoc()) : ?>
            <li><?= $project["name"] . ' - ' . $project['count'] ?> clients</li>
        <?php endwhile; ?>
    </ul>
</body>
</html>
