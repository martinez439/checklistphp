<?php

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "newapp";

// Create connection
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "connectionneeenn" . "<br>";
    
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

//Function to retrieve to-do list items
function getTodoItems($conn)
{
    $stmt = $conn->prepare("SELECT * FROM task");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
//var_dump(getTodoItems($conn));
//print_r(getTodoItems($conn));

// // Retrieve and display to-do list items
$todoItems = getTodoItems($conn);


// // Function to add a new to-do item
function addTodoItem($conn, $task)
{
    $stmt = $conn->prepare("INSERT INTO task (name) VALUES (:name)");
    $stmt->bindParam(':name', $task);
    $stmt->execute();
    header("Refresh: 0");
}

// // Function to edit a to-do item
function editTodoItem($conn, $id, $task)
{
    $stmt = $conn->prepare("UPDATE task SET name = :name WHERE id = :id");
    $stmt->bindParam(':name', $task);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    header("Refresh: 0");

}

// // Function to delete a to-do item
function deleteTodoItem($conn, $id)
{
    $stmt = $conn->prepare("DELETE FROM task WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    header("Refresh: 0");
}

// // Handle form submissions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["add"])) {
        $task = $_POST["task"];
        addTodoItem($conn, $task);
    } elseif (isset($_POST["edit"])) {
        $id = $_POST["edit_id"];
        $task = $_POST["edited_task"];
        editTodoItem($conn, $id, $task);
    } elseif (isset($_POST["delete"])) {
        $id = $_POST["delete_id"];
        deleteTodoItem($conn, $id);
    }
}


