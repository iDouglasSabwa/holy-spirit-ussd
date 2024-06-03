<?php

//Echo response back to the API
header('Content-type: text/plain');

//Read POST variables from the API
$sessionId = $_POST['sessionId'];
$networkCode = $_POST['networkCode'];
$serviceCode = $_POST['serviceCode'];
$phoneNumber = ltrim($_POST['phoneNumber']);
$text = $_POST['text'];

// Step 1: Connect to the database
include 'config.php';

$response = "CON Holy Spirit:\n";
$response .= "1. Fruits \n";
$response .= "2. Gifts \n";

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Step 2: Prepare the SQL statement
    $sql = "SELECT id, attribute FROM holy_spirit WHERE category = :category";
    $stmt = $pdo->prepare($sql);

    // Step 3: Bind parameters
    $category = $text;
    $stmt->bindParam(':category', $category, PDO::PARAM_STR);

    // Step 4: Execute the statement
    $stmt->execute();

    // Step 5: Fetch the results
    foreach ($stmt as $key => $value) {
        // code...
        $id = $value['id'];
        $attribute = $value['attribute'];
        //Set default number value
        $number = 1;

        //Display responses from db
       $response .= $number++ . ". $attribute\n";
    } 
}
catch (PDOException $e) {
echo "Error: " . $e->getMessage();
}

// Close the connection
$pdo = null;
?>
