<?php
$objEvents= new \Classes\ClassEvents();
$data = json_decode(file_get_contents('php://input'), true);

if(isset($data['data'])){
    $starts=new \DateTime($data['data'].' '.$data['time'], new \DateTimeZone('America/Sao_Paulo'));
    $dados=[
        "id"=>$data['id'],
        "title"=>$data['title'],
        "start"=>$starts->format("Y-m-d H:i:s"),
        "end"=>$starts->format("Y-m-d H:i:s"),
        "description"=>$data['description']
    ];
}else{

    // $dados=[
    //     "id"=>$data['id'],
    // ];
}

// Verificar o método HTTP da requisição
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Consultar todos os eventos
    $events=$objEvents->validateFinCalend();
    echo json_encode($events);
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Inserir um novo evento
    $objEvents->validateCampos($dados);
    echo $ret = $objEvents->validateFinInsert($dados);
} elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    // Editar um evento existente
    $objEvents->validateCampos($dados);
    echo $ret = $objEvents->validateFinEdit($dados);
} elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // Deletar um evento existente
    echo $events = $objEvents->deleteEvents($dados);
}
