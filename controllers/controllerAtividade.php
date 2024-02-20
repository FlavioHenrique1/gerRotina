<?php 
$dados = json_decode(file_get_contents('php://input'), true);
$ativ=new Classes\ClassValidAtiv();
$ativ->validCampos($atividade,$dataAtv);
$ativ->validarDataAtv($dataAtv);
if(isset($dados['id'])){
    $ret=$ativ->ValidateEditTab($dados);
    //echo json_encode($ret);
}else{
    if(isset($_POST['id'])){
        $ret=$ativ->ValidateFinalEdit($arrAtiv);
    }else{
        $ret =$ativ->ValidateFinalAtv($arrAtiv);
    }
}
echo json_encode($ret);