<?php
require_once("database.php");

$data = [];

// select clients' projects query
$clientProjects = "SELECT clients.name AS client_name, projects.name AS project_name
FROM clients
INNER JOIN client_projects ON clients.id = client_projects.client_id
INNER JOIN projects ON projects.id = client_projects.project_id
";
$clientProjectResult = $mysqli->query($clientProjects);

// loop the result to assign to data array variable
while ($clientProject = $clientProjectResult->fetch_assoc()) {
    $data[$clientProject['client_name']]['projects'][] = ['name' => $clientProject['project_name']];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clients' Projects</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Clients' Projects</h1>

    <ul>
        <?php foreach ($data as $client => $projects) : ?>
            <li><?= $client ?></li>
            <ul>
                <?php foreach ($projects['projects'] as $project) : ?>
                    <li><?= $project['name']?></li>
                <?php endforeach; ?>
            </ul>
        <?php endforeach; ?>
    </ul>
</body>
</html>
