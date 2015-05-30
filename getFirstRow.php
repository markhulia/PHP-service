<?php

//load and connect to MySQL database stuff
require("config.inc.php");
$query_params = null;

$firstItem = "SELECT * FROM `items` LIMIT 1";


 try {
        $stmt   = $db->prepare($firstItem);
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
        $post["item_id"]  = $row["item_id"];
        
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
