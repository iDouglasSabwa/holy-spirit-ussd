<?php
// Step 1: Connect to the database
include 'config.php';

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Step 2: Prepare the SQL statement
    $sql = "SELECT student_id, student_name FROM class WHERE class_name = :class_name";
    $stmt = $pdo->prepare($sql);

    // Step 3: Bind parameters
    $class_name = 'Math';
    $stmt->bindParam(':class_name', $class_name, PDO::PARAM_STR);

    // Step 4: Execute the statement
    $stmt->execute();

    // Step 5: Fetch the results
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "Student ID: " . $row['student_id'] . " - Name: " . $row['student_name'] . "\n";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// Close the connection
$pdo = null;
?>
