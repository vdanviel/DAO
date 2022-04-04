<?php
require_once("config.php");

$conn = new DBconnect("localhost", "dbhcodephp","root","");

$clientes = $conn->select("SELECT * FROM tb_cliente");

echo json_encode($clientes);


?>