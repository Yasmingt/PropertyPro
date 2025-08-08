<?php
$servername = "localhost";  //servidor
$username = "root";    // Usuario DB
$password = ""; // Contraseña DB
$dbname = "propertypro_bd"; // Nombre DB

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);}
 else {
   // echo "Conexion Exitosa a la DB"; // SMS Prueba de Conexion
 }
