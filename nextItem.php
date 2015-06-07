2<?php

//load and connect to MySQL database stuff
require("config.inc.php");

 //$nextItemQuery = "SELECT * FROM `items` WHERE item_id = :item_id";
//$nextItemQuery = "UPDATE `items` SET picked = 1 WHERE rowNr = :rowNr";
// if(!empty($_POST)){
$nextItemQuery = "SELECT * FROM `items` where rowNr = :rowNr";

$query_params = array(
		':rowNr' => $_POST['rowNr']
    );

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
		$post["item_id"]  = $row["item_id"];
        $post["item_info"] = $row["item_info"];
        $post["item_name"]    = $row["item_name"];
        $post["item_quantity"]  = $row["item_quantity"];
        $post["item_location"]  = $row["item_location"];
        $post["comment"]  = $row["comment"];
        $post["rowNr"] = $row["rowNr"];

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
