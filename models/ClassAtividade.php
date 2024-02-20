<?php
namespace Models;

use Classes\ClassEvents;

class ClassAtividade extends ClassCrud{

    private $events;
    #Realizar a inserção no banco de dados
    public function inserAti($arrAtiv)
    {
        
        @session_start();
        $iniciar="";
        $finalizar="";
        $dataO=date("Y-m-d H:i:s");
        if($arrAtiv['status'] == "iniciar"){
            $status="Em Andamento";
            $iniciar=$dataO;
        }elseif ($arrAtiv['status'] == "finalizar") {
            $status="Concluído";
            $finalizar = $dataO;
        }else{
            $status="";
        }

        $local=$_SESSION['local'];
        $pront=$_SESSION['prontuario'];
        $setor=$_SESSION['setor'];
        $cargo=$_SESSION['cargo'];
        if(!$arrAtiv['status']){
            $arrAtiv['status']="";
        }

        $this->insertDB(
            "atividade",
            "?,?,?,?,?,?,?,?,?,?,?,?,?,?,?",
            array(
                0,
                $arrAtiv['atividade'],
                $arrAtiv['horario'],
                $arrAtiv['responsavel'],
                $status,
                $arrAtiv['observacao'],
                $local,
                $arrAtiv['dataAtv'],
                $arrAtiv['dataCreate'],
                $pront,
                $dataO,
                $iniciar,
                $finalizar,
                $setor,
                $cargo
            )
        );
    }
    
    #Realizar a edição dos dados
    public function inserEdit($arrDadosE){
        @session_start();
        $pront=$_SESSION['prontuario'];
        $dataEdite=date("Y-m-d H:i:s");
        
        if($arrDadosE['status'] == "iniciar"){
            $status="Em Andamento";
            $par="atividade=?, prazo=?, responsavel=?, status=?, obs=?, data=?, userEdit=?, inicioAtv=?";
        }elseif ($arrDadosE['status'] == "finalizar") {
            $status="Concluído";
            $par="atividade=?, prazo=?, responsavel=?, status=?, obs=?, data=?, userEdit=?, fimAtv=?";
        }elseif($arrDadosE['status'] == "pendente"){
            $status="Pendente";
            $par="atividade=?, prazo=?, responsavel=?, status=?, obs=?, data=?, userEdit=?, dataEdit=?";
        }else{
            $status="";
            $par="atividade=?, prazo=?, responsavel=?, status=?, obs=?, data=?, userEdit=?, dataEdit=?";
        }
        
        $b=$this->updateDB(
            "atividade",
            $par,
            "id=?",
            array(
                $arrDadosE['atividade'],
                $arrDadosE['horario'],
                $arrDadosE['responsavel'],
                $status,
                $arrDadosE['observacao'],
                $arrDadosE['dataAtv'],
                $pront,
                $dataEdite,
                $arrDadosE['id']
            )
        );
    }

    #Realizar a edição dos dados tabela
    public function inserEditTab($id,$coluna,$info){
        @session_start();
        $pront=$_SESSION['prontuario'];
        $dataEdite=date("Y-m-d H:i:s");
        $dataEditeTab=date("Y-m-d");
        $campo="";
        switch ($coluna) {
            case 1:
                $campo="atividade";
                # code...
                break;
            case 2:
                $campo="inicioAtv";
                $info=$dataEditeTab." ".$info;
                # code...
                break;
            case 3:
                $campo="fimAtv";
                $info=$dataEditeTab." ".$info;
                # code...
                break;
            case 4:
                $campo="prazo";
                # code...
                break;
            case 5:
                $campo="responsavel";
                # code...
                break;
            case 6:
                $campo="status";
                if($info == 'Iniciar'){
                    $info="Em Andamento";
                }
                # code...
                break;
            case 7:
                $campo="obs";
                # code...
                break;
        }
        $b=$this->updateDB(
            "atividade",
            $campo."=?, userEdit=?, dataEdit=?",
            "id=?",
            array(
                $info,
                $pront,
                $dataEdite,
                $id
            )
        );
        return "Realizado com sucesso!";
    }


    #Retorna os dados da atividade
    public function getAtv($data)
    {
        $dados=[];
        @session_start();

        if($_SESSION['setor'] == 14){
            $b=$this->selectDB(
                "*",
                "atividade",
                "WHERE data=? and local=? and setor=?",
                array(
                    $data,
                    $_SESSION['local'],
                    $_SESSION['setor']
                )
            );
        }else{
            
            // $b=$this->selectDB(
            //     "*",
            //     "atividade",
            //     "WHERE data=? and local=? and setor=? and cargo=?",
            //     array(
            //         $data,
            //         $_SESSION['local'],
            //         $_SESSION['setor'],
            //         $_SESSION['cargo']
            //     )
            // );
            $b=$this->selectDB(
                "*",
                "atividade",
                "WHERE data=? and local=? and setor=?",
                array(
                    $data,
                    $_SESSION['local'],
                    $_SESSION['setor']
                )
            );
        }

        $r=0;
        while($f=$b->fetch(\PDO::FETCH_ASSOC)){
            $dados[$r]=$f;
            $r++;
        }
        return $dados;
    }

    
    #Retorna os dados da atividade
    public function getAtvRot($CD)
    {
        $dados=[];
        @session_start();

        $b=$this->selectDB(
            "*",
            "atividadesrot",
            "WHERE local=?",
            array(
                $CD,
            )
        );
        $r=0;
        while($f=$b->fetch(\PDO::FETCH_ASSOC)){
            $dados[$r]=$f;
            $r++;
        }
        return $dados;
    }


    #deletar Atividade
    public function deleteAtividade($id){
        $b=$this->deleteDB(
            "atividade",
            "id=?",
            array(
                $id
            )
        );        
    }

    #Selecionar atividades de rotina e adc no dia
    public function inserAtiRot($nDia)
    {   
        @session_start();
        $local=$_SESSION['local'];
        $pront=$_SESSION['prontuario'];
        $dataCreate=date("Y-m-d H:i:s");
        $data=date("Y-m-d");
        $dados=[];
        $cargo=$_SESSION["cargo"];
        $setor=$_SESSION["setor"];
        $b=$this->selectDB(
            "*",
            "atividadesrot",
            "WHERE dia=? and local=? and setor=?",
            array(
                $nDia,
                $local,
                $setor
            )
        );
        $r=0;
        while($f=$b->fetch(\PDO::FETCH_ASSOC)){
            $this->insertDB(
                "atividade",
                "?,?,?,?,?,?,?,?,?,?,?,?,?,?",
                array(
                    0,
                    $f['atividade'],
                    $f['prazo'],
                    $f['responsavel'],
                    $f['status'],
                    $f['obs'],
                    $local,
                    $data,
                    $dataCreate,
                    $pront,
                    0,
                    0,
                    0,
                    $setor
                )
            );
            $dados[$r]=$f;
            $r++;
        }

        $this->inserAtvCale($local,$pront,$setor,$id=null);
        return $dados;
    }

    //Pegar as atividades do calendario e inserir no dia
    public function InserAtvCale($cd,$pront,$setor,$id){
        $evt= new ClassEvents();
        $dataCreate=date("Y-m-d H:i:s");
        $data=date("Y-m-d");
        $eventos=$evt->getEvents($cd,$pront,$setor,$id);
        foreach ($eventos as $key => $value) {
            if($data == date("Y-m-d",strtotime($value['start']))){
                $this->insertDB(
                    "atividade",
                    "?,?,?,?,?,?,?,?,?,?,?,?,?,?,?",
                    array(
                        0,
                        $value['title'],
                        "",
                        "",
                        "",
                        $value['description'],
                        $value['cd'],
                        $data,
                        $dataCreate,
                        $pront,
                        0,
                        0,
                        0,
                        $setor,
                        0
                    )
                );
            }

        }

    }


    #inserir dados das requisicao_diaria no bd
    public function requisicao_diaria($dados){
        $this->insertDB(
            "requisicao_diaria",
            "?,?,?,?,?",
            array(
                0,
                $dados['data'],
                $dados['local'],
                $dados['data'],
                $dados['data']
            )
        );
    }

    #Selecionar atividades de rotina e adc no dia
    public function inserAtiRota($nDia,$data)
    {   
        @session_start();
        $local=$_SESSION['local'];
        $pront=$_SESSION['prontuario'];
        $dataCreate=date("Y-m-d H:i:s");
        $setor=$_SESSION["setor"];
        $dados=[];
        $b=$this->selectDB(
            "*",
            "atividadesrot",
            "WHERE dia=? and local=? and setor=?" ,
            array(
                $nDia,
                $local,
                $setor
            )
        );
        $this->events= new ClassEvents();

        $r=0;
        while($f=$b->fetch(\PDO::FETCH_ASSOC)){
            $this->insertDB(
                "atividade",
                "?,?,?,?,?,?,?,?,?,?,?",
                array(
                    0,
                    $f['atividade'],
                    $f['prazo'],
                    $f['responsavel'],
                    $f['status'],
                    $f['obs'],
                    $local,
                    $data,
                    $dataCreate,
                    $pront,
                    0
                )
            );
            $dados[$r]=$f;
            $r++;
        }
        return $dados;
    }
    
}