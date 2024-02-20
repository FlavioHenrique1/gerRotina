<?php 
$dados = json_decode(file_get_contents('php://input'), true);
$data=$dados['data'];
$timestamp = strtotime($data);
$nDia= date("N",$timestamp);

$ativ=new Classes\ClassValidAtiv();

$dados=$ativ->ValidateTarRota($nDia,$data);

// echo json_encode($dados);