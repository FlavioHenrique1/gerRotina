<?php 
$dados = json_decode(file_get_contents('php://input'), true);
$data=$dados['data'];

$ativ=new Classes\ClassValidAtiv();
$atvidades=$ativ->GetAtividade($data);


echo json_encode($atvidades);