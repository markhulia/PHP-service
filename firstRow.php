<?php

//load and connect to MySQL database stuff
require("config.inc.php");
$nextItemQuery="SELECT * FROM `items` WHERE picked = 0 Limit 1";
// $nextItemQuery = "SELECT * FROM `items`  WHERE picked = 0 Limit 1";
// $query_params = {
//     ':rowNr' => $_POST['rowNr']
// };
$query_params=null;

try {
    $stmt   = $db->prepare($nextItemQuery);
    $result = $stmt->execute($query_params);
}
catch (PDOException $ex) {
    $response["success"] = 0;
    $response["message"] = "PHP Database Error!";
    die(json_encode($response));
}
$rows = $stmt->fetchAll();


if ($rows) {
    $response["success"] = 1;
    $response["message"] = "PHP Post Available!";
    $response["items_report"]   = array();

    
    foreach ($rows as $row) {
        $post             = array();
        $post["rowNr"] = $row["rowNr"];
        $post["item_info"] = $row["item_info"];
        $post["item_name"]    = $row["item_name"];
        $post["item_quantity"]  = $row["item_quantity"];
        $post["item_location"]  = $row["item_location"];
        $post["comment"]  = $row["comment"];
        

        //update our repsonse JSON data
        array_push($response["items_report"], $post);
    }
    
    // echoing JSON response
    echo json_encode($response);
    
    
} else {
    $response["success"] = 0;
    $response["message"] = "PHP No Post Available!";
    die(json_encode($response));

}
?> 
