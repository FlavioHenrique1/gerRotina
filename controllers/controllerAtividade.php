<?php 

$ativ=new Classes\ClassValidAtiv();
$ativ->validCampos($atividade,$dataAtv);
$ret =$ativ->ValidateFinalAtv($arrAtiv);
echo json_encode($ret);