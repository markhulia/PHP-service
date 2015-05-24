<?php

//load and connect to MySQL database stuff
require("config.inc.php");
$query_params = null;

$resetQuery = "UPDATE `items` SET `picked`= 0";
 try {
        $stmt   = $db->prepare($resetQuery);
        $result = $stmt->execute($query_params);
    }
    catch (PDOException $ex) {
    $response["success"] = 0;
    $response["message"] = "PHP Database Error!";
    die(json_encode($response));
}
    $response["success"] = 1;
    $response["message"] = "PHP database reset complete";
    echo json_encode($response);
?> 
