<?php
require 'db.php';

$data = json_decode(file_get_contents("php://input"), true);

if ($data) {
    $existingUser = $collection->findOne(['email' => $data['email']]);

    if ($existingUser) {
        echo json_encode(['status' => 'error', 'message' => 'Email already exists']);
    } else {
        $hashedPassword = password_hash($data['password'], PASSWORD_BCRYPT);
        $collection->insertOne([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $hashedPassword
        ]);
        echo json_encode(['status' => 'success', 'message' => 'Registered successfully']);
    }
}
?>
