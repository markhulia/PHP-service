<?php

/*
Our "config.inc.php" file connects to database every time we include or require
it within a php script.  Since we want this script to add a new user to our db,
we will be talking with our database, and therefore,
let's require the connection to happen:
*/
require("config.inc.php");

//initial query
$query = "Select * FROM items";
$query_params = null;
//execute query
try {
    $stmt   = $db->prepare($query);
    $result = $stmt->execute($query_params);
}
catch (PDOException $ex) {
    $response["success"] = 0;
    $response["message"] = "PHP Database Error!";
    die(json_encode($response));
}

// Finally, we can retrieve all of the found rows into an array using fetchAll 
$rows = $stmt->fetchAll();


if ($rows) {
    $response["success"] = 1;
    $response["message"] = "PHP Post Available!";
    $response["items_report"]   = array();
    
    foreach ($rows as $row) {
        $post             = array();
		$post["item_id"]  = $row["item_id"];
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
