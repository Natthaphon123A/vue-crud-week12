<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$conn = new mysqli("localhost", "root", "", "vue_crud");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        $result = $conn->query("SELECT * FROM customers");
        $customers = [];
        while ($row = $result->fetch_assoc()) {
            $customers[] = $row;
        }
        echo json_encode($customers);
        break;

    case 'POST':
        $data = json_decode(file_get_contents("php://input"), true);
        $first_name = $data['first_name'];
        $last_name = $data['last_name'];
        $phone_number = $data['phone_number'];
        $username = $data['username'];
        $password = $data['password'];
        $conn->query("INSERT INTO customers (first_name, last_name, phone_number, username, password) VALUES ('$first_name', '$last_name', '$phone_number', '$username', '$password')");
        echo json_encode(["message" => "Customer added"]);
        break;

    case 'PUT':
        $data = json_decode(file_get_contents("php://input"), true);
        $id = $data['id'];
        $first_name = $data['first_name'];
        $last_name = $data['last_name'];
        $phone_number = $data['phone_number'];
        $username = $data['username'];
        $conn->query("UPDATE customers SET first_name='$first_name', last_name='$last_name', phone_number='$phone_number', username='$username' WHERE id=$id");
        echo json_encode(["message" => "Customer updated"]);
        break;

    case 'DELETE':
        $id = $_GET['id'];
        $conn->query("DELETE FROM customers WHERE id=$id");
        echo json_encode(["message" => "Customer deleted"]);
        break;
}

$conn->close();
