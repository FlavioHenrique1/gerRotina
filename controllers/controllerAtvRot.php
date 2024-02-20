<?php 

$nDia= date("N");

$ativ=new Classes\ClassValidAtiv();
$dados=$ativ->ValidateTarRot($nDia);

echo json_encode($dados);