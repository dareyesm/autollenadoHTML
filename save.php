<?php

//llamar la conexion a la base de datos
require 'class/database.php';
$objData = new Database();

$sth = $objData->prepare('insert into clientes VALUES (:idCLiente, :idUsers, :names, :correo, :pais, :ciudad)');
$idCliente = 0;

$sth->bindParam(':idCLiente', $idCliente);
$sth->bindParam(':idUsers', $_POST['userN']);
$sth->bindParam(':names', $_POST['names']);
$sth->bindParam(':correo', $_POST['email']);
$sth->bindParam(':pais', $_POST['country']);
$sth->bindParam(':ciudad', $_POST['city']);

$sth->execute();

header('location: index.php');


