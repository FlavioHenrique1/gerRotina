<?php 
$dados = json_decode(file_get_contents('php://input'), true);
$id=$dados['id'];
@session_start();
$ativ=new Classes\ClassValidAtiv();
if($_SESSION['permition'] == 'manager'){
    $ativ->deleteAtiv($id);
    $retorno=[
        'msg'=>'registro deletado!',
        'retorno'=>true
    ];
    echo  json_encode($retorno);
}else{
    //Caso for ADM não pode apagar
    $ativ->deleteAtiv($id);
    $retorno=[
        'msg'=>'registro deletado!',
        'retorno'=>true
    ];
    // $retorno=[
    //     'msg'=>'"Somente ADM pode apagar registros!',
    //     'retorno'=>false
    // ];
    echo  json_encode($retorno);
}