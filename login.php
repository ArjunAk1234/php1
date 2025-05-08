<?php
require 'db.php';

$data = json_decode(file_get_contents("php://input"), true);

if ($data) {
    $user = $collection->findOne(['email' => $data['email']]);

    if ($user && password_verify($data['password'], $user['password'])) {
        echo json_encode(['status' => 'success', 'message' => 'Login successful', 'user' => ['name' => $user['name'], 'email' => $user['email']]]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid credentials']);
    }
}
?>
