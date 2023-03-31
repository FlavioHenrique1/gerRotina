<?php 
$nDia= date("N");
$nDia= 5;

$ativ=new Classes\ClassValidAtiv();
$dados=$ativ->ValidateTarRot($nDia);

echo json_encode($dados);