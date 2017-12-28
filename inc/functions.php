<?php

//Custom function 
function get_item_html($id, $item) {
$output = 
"<li><a href='details.php?id=" . $id ."'><img src= 
'" . $item['img'] . "' . alt='"
. $item["title"] . "'/>" 
. "<p>View Details</p>" 
."</a></li>";

return $output;
}


//Custom Function - Designed to filter items for a specific category. Creates a new array

function array_category($catalog,$category){

$output = array();
//Loop through all the nested array items
//Sort by key "title" in all the nested array items

foreach($catalog as $id => $item) { 
if ($category == null OR strtolower($category) == strtolower($item["category"])) {
$sort = $item['title'];
$sort = ltrim($sort, "The ");
$sort = ltrim($sort, "A ");
$sort = ltrim($sort, "And ");
    $output[$id] = $sort;
    }
}

asort($output);
return array_keys($output);

return $output;

}


?>