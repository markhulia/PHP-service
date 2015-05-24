<?
require("config.inc.php");
$query_picked = "UPDATE `items` SET picked = :bool_Value, user = :username WHERE item_id = :item_ID"


 //Update query
    $query_params = array(
        ':item_id' => $_POST['item_id'],
        ':item_name' => $_POST['item_name'],
		':item_quantity' => $_POST['item_quantity']
		':item_location' => $_POST['item_location']
		':item_info' => $_POST['item_info']
		':comment' => $_POST['comment']
    );

try {
        $stmt   = $db->prepare($query);
        $result = $stmt->execute($query_params);
    }
    catch (PDOException $ex) {
        // For testing, a die and message. 
        //die("Failed to run query: " . $ex->getMessage());
        
        //or just use this use this one:
        $response["success"] = 0;
        $response["message"] = "PHP Database Error. Notifier is dead";
        die(json_encode($response));
    } 
    $response["success"] = 1;
    $response["message"] = "Notifier Works!";
    echo json_encode($response);

//TODO initialize :item_ID
//TODO initialize :bool_Value

?>