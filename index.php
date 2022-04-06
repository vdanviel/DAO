<?php
require_once("config.php");

#login user
$user = new User;

$login = $user->login("Daniel","vintao122");

echo json_encode($login);

/* 
#procurar user
$users = new User;

$procurar = $users->searchUsers("a");

echo json_encode($procurar); 
*/

/*
#listar usuários (classe User)
$users = new User;

$list = $users->getList();

echo json_encode($list);
*/

/*
#select da classe User:

$user = new User;

$user->loadUser(1);

echo $user; 
*/

/* 
#select do DBconnect:

$conn = new DBconnect("localhost", "dbhcodephp","root","");

$clientes = $conn->select("SELECT * FROM tb_cliente");

echo json_encode($clientes); 
*/


?>