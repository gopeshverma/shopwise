<?php
session_start();

$host = 'localhost';
$user = 'root';
$pass = '';          // XAMPP default
$db   = 'shopwise';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) { die('DB connection failed: ' . $conn->connect_error); }

function h($s){ return htmlspecialchars($s, ENT_QUOTES, 'UTF-8'); }

if(!isset($_SESSION['cart'])){ $_SESSION['cart'] = []; } // cart: [productId => qty]
