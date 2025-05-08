<?php
require 'vendor/autoload.php'; // Composer autoload

$client = new MongoDB\Client("mongodb+srv://ananthakrishnans0608:CUUx3fXeWYDcJGNf@lms1.zefizq5.mongodb.net/?retryWrites=true&w=majority&appName=LMS1");
$collection = $client->User1->users;
?>
