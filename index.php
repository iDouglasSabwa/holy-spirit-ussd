<?php

//Echo response back to the API
header('Content-type: text/plain');

//Read POST variables from the API
$sesssionid = $_POST['sessionid'];
$serviceCode = $_POST['serviceCode'];
$phoneNumber = ($_POST['phoneNumber']);
$text = $_POST['text'];

//Display default menu
if ($text == "") {
    // code...
    $response = "CON Holy Spirit Attributes:\n";
    $response .= "1. Fruits\n";
    $response .= "2. Gifts";

} else {
    
// Step 2: Connect to the database
try {
    include 'config.php';
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Step 2: Prepare the SQL statement
    $sql = "SELECT id, attribute FROM attributes WHERE category = :category";
    $stmt = $pdo->prepare($sql);

    // Step 3: Match category based on input
    if ($text == "1") {
        // code...
        $choice = 'fruit';
    } elseif ($text == "2") {
        // code...
        $choice = 'gift';
    } else {
        $response ="END Invalid input\n";
    }

    // Step 4: Bind parameters    
    $category = $choice;
    $stmt->bindParam(':category', $category, PDO::PARAM_STR);

    // Step 4: Execute the statement
    $stmt->execute();

    // Default menu on second layer
    $response ="CON Here we go:\n";

   // Set default number value for the menu
    $number = 1;

    // Step 5: Fetch the results
    foreach ($stmt as $key => $value) {

        $attribute = $value['attribute'];   
        
        //Display responses from db       
        $response .= $number++ . ". $attribute\n";
    } 

}
    catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        $response = "END Error occurred";
    }
}

// Close the connection
$pdo = null;

echo $response;

?>
