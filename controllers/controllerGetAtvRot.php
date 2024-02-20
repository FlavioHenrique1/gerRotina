<?php 
$ativRot=new Classes\ClassValidRot();
$dados = json_decode(file_get_contents('php://input'), true);
//inclusão no BD
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ativRot->validateCapos($dados);
    $ret =$ativRot->validateFinalAddRot($dados);
    echo json_encode($ret);
    //selecionar as atividades de rotina
}elseif($_SERVER['REQUEST_METHOD'] === 'GET') {
    isset($_GET['dia']) ? $atvidades=$ativRot->GetAtividadeRotina($_GET['dia']) : $atvidades=$ativRot->GetAtividadeRotina();
    //$atvidades=$ativRot->GetAtividadeRotina();
    echo json_encode($atvidades); 
    //Deletar as atividades de rotina
}elseif($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $atvidades=$ativRot->DeleteAtividadeRotina($dados);
    echo json_encode($atvidades); 
}elseif($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $atvidades=$ativRot->validateFinalEditeRot($dados);
    echo json_encode($atvidades); 
}
