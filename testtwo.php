<?php
$aflteams = array();

$aflteams[] = array(
'Team' => 'Essendon',
'C6DB' => 2,
'Road Trips' => 6,
'HvIS' => 8,
);

$aflteams[] = array(
'Team' => 'Carlton',
'C6DB' => 4,
'Road Trips' => 9,
'HvIS' => 6,
);

$aflteams[] = array(
'Team' => 'Geelong',
'C6DB' => 1,
'Road Trips' => 6,
'HvIS' => 7,
);

echo "The order of teams with the fewest road trips is:" . "\n";
$output = array_column($aflteams, 'Road Trips', 'Team');
asort($output);
foreach($output as $key => $value) {
echo $key . " " . $value . "\n";
}

echo "The order of teams with the fewest consecutive 6 day breaks is:" . "\n";
$output = array_column($aflteams, 'C6DB', 'Team');
asort($output);
foreach($output as $key => $value) {
echo $key . " " . $value . "\n";   
}





























