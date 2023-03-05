<?php 

$ativ=new Classes\ClassValidAtiv();
$ativ->validCampos($atividade,$dataAtv);
$ativ->validarDataAtv($dataAtv);
if(isset($_POST['id'])){
    $ret=$ativ->ValidateFinalEdit($arrAtiv);
}else{
    $ret =$ativ->ValidateFinalAtv($arrAtiv);
}
echo json_encode($ret);