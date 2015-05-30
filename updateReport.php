<?php

//load and connect to MySQL database stuff
require("config.inc.php");

	//initial query
	$query = "INSERT INTO comments ( username, title, message ) VALUES ( :user, :title, :message ) ";

    //Update query
    $query_params = array(
        ':user' => $_POST['username'],
        ':title' => $_POST['title'],
		':message' => $_POST['message']
    );
  
	//execute query
    try {
        $stmt   = $db->prepare($query);
        $result = $stmt->execute($query_params);
    }
    catch (PDOException $ex) {
        // For testing, a die and message. 
        //die("Failed to run query: " . $ex->getMessage());
        
        //or just use this use this one:
        $response["success"] = 0;
        $response["message"] = "PHP Database Error. Couldn't add post!";
        die(json_encode($response));
    }

    $response["success"] = 1;
    $response["message"] = "PHP Post Successfully Added!";
    echo json_encode($response);
   


?> 
