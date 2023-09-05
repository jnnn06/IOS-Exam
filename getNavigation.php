<?php
require_once("database.php");

$data = [];
$newData = [];
$firstLevelParentId = 0; // identify the first level parent id

// get all navigation data
$navigations = "SELECT *
FROM navigation
";
$navigationResult = $mysqli->query($navigations);

while ($navigation = $navigationResult->fetch_assoc()) {
    $data[] = $navigation;
}

// build multidimensional array for navigation structure
foreach ($data as $index => $d){
    $newData[$d['id']] = $d;
    $newData[$d['id']]['subs'] = [];
}
foreach ($newData as $index => &$nd) {
    $parent = $newData[$index]['parent_id'];
    if (isset($newData[$parent])) {
        $newData[$parent]['subs'][] = &$newData[$index];
    }
}

// filter out first level data that does not have 0 as parent_id
foreach ($newData as $index => $nd) {
    if ($firstLevelParentId !== intval($nd['parent_id'])) {
        unset($newData[$index]);
    }
}

echo json_encode($newData);
?>