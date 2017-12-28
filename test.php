<?php


$event = array();

$event[] = array(
"Date" => "10/12/17",
"Title" => "Kingston Christmas Carols",
"Price" => "Free",
"Kid Friendly" => TRUE,
"Tickets Available" => TRUE,
);

$event[] = array(
"Date" => "10/12/17",
"Title" => "Santa Trains",
"Price" => [
"Kids single" => 7,
"Adults single" => 12,
"Kids return" => 10,
"Adults return" => 20,     
],
"Kid Friendly" => TRUE,
"Tickets Available" => TRUE,
);

$event[] = array(
"Date" => "23/12/17",
"Title" => "Mornington Christmas Carols on the Park",
"Price" => "Free",
"Kid Friendly" => TRUE,
"Tickets Available" => TRUE,
);

$event[] = array(
"Date" => "23/12/17",
"Title" => "Under the Southern Stars Concert",
"Price" => 110,
"Kid Friendly" => TRUE,
"Tickets Available" => TRUE,
);

//1.Function to create a new array from the values in a multi-dimensional array for a specific key and sort
//alphabetically
//2. For each loop to echo the value of each item

$title = array_column($event, 'Title');
asort($title);
print_r($title);

foreach($title as $key => $item) {
echo $item . "\n"; 
}
























    












