<?php
namespace Models;
use Models\ClassCalendario;
use Classes\ClassEvents;

class ClassAtivRot extends ClassCrud{

    #Realizar a inserção no banco de dados das atividades de rotina
    public function inserAtiRot($arrAtivRot,$local,$setor,$cargo)
    {
        $data=date("Y-m-d");
        $dataCreate=date("Y-m-d H:i:s");

        if($arrAtivRot['responsavel'] == 'Responsavel...'){
            $arrAtivRot['responsavel'] = "";
        }

        $this->insertDB(
            "atividadesrot",
            "?,?,?,?,?,?,?,?,?,?,?,?",
            array(
                0,
                $arrAtivRot['atividades'],
                $arrAtivRot['horario'],
                $arrAtivRot['responsavel'],
                "",
                $arrAtivRot['obs'],
                $data,
                $dataCreate,
                $arrAtivRot['dia'],
                $local,
                $setor,
                $cargo
            )
        );
    }

    #Retorna os dados da atividade
    public function getAtvRot($CD,$dia,$setor)
    {
        $dados=[];
        if($dia == null){
            $b=$this->selectDB(
                "*",
                "atividadesrot",
                "WHERE local=? and setor=?",
                array(
                    $CD,
                    $setor
                )
            );
        }else{
            $b=$this->selectDB(
                "*",
                "atividadesrot",
                "WHERE local=? and dia=? and setor=?",
                array(
                    $CD,
                    $dia,
                    $setor
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

    #Editar atividades de rotina
    public function editeAtiRot($arrAtivRot){
        $b=$this->updateDB(
            "atividadesrot",
            "atividade=?, prazo=?, responsavel=?, obs=? , dia=?",
            "id=?",
            array(
                $arrAtivRot['atividades'],
                $arrAtivRot['horario'],
                $arrAtivRot['responsavel'],
                $arrAtivRot['obs'],
                $arrAtivRot['dia'],
                $arrAtivRot['id']
            )
        );
    }

    #deletar Atividade de rotina
    public function deleteAtivRot($arrAtivRot){
        $b=$this->deleteDB(
            "atividadesrot",
            "id=?",
            array(
                $arrAtivRot['id']
            )
        );        
    }

    #Selecionar atividades de rotina e adc no dia
    public function inserAtiRotina($arrDados,$setor,$cargo)
    {   

        $dados=[];
    
        $b=$this->selectDB(
            "*",
            "atividadesrot",
            "WHERE dia=? and local=? and setor=?" ,
            array(
                $arrDados["nDia"],
                $arrDados["local"],
                $setor
            )
        );
        $r=0;
        while($f=$b->fetch(\PDO::FETCH_ASSOC)){
            $this->insertDB(
                "atividade",
                "?,?,?,?,?,?,?,?,?,?,?,?,?,?,?",
                array(
                    0,
                    $f['atividade'],
                    $f['prazo'],
                    $f['responsavel'],
                    $f['status'],
                    $f['obs'],
                    $arrDados["local"],
                    $arrDados["dataReq"],
                    $arrDados["dataCreate"],
                    0,
                    "",
                    "",
                    "",
                    $setor,
                    $cargo
                )
            );
            $dados[$r]=$f;
            $r++;
        }
        $this->inserAtvCale($arrDados["local"],$arrDados["prontuario"],$setor,$id=null);
        $this->requisicao_diaria($arrDados);
        return $dados;
    }
    
        #inserir dados das requisicao_diaria no bd
        public function requisicao_diaria($arrDados){
            $this->insertDB(
                "requisicao_diaria",
                "?,?,?,?,?",
                array(
                    0,
                    $arrDados['dataReq'],
                    $arrDados['local'],
                    $arrDados['setor'],
                    $arrDados['dataReq']
                )
            );
        }

        #Validar se a requisição ja foi feita no dia
        public function verifyRequiDia($arrDados){
            $b=$this->selectDB(
                "*",
                "requisicao_diaria",
                "WHERE data_requisicao=? and local=? and setor=?",
                array(
                    $arrDados['dataReq'],
                    $arrDados['local'],
                    $arrDados['setor']
                )
            );
            return $r=$b->rowCount();
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
    
}