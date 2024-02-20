<?php
namespace Classes;

@session_start();
use Models\ClassAtivRot;

class ClassValidRot extends ClassValidate{

    private $aRot;
    private $local;
    private $permition;
    private $setor;
    private $cargo;
    private $pront;


    public function __construct()
    {
        $this->aRot=new ClassAtivRot();
        $this->local=$_SESSION['local'];
        $this->permition=$_SESSION['permition'];
        $this->setor=$_SESSION['setor'];
        $this->cargo=$_SESSION['cargo'];
        $this->pront=$_SESSION['prontuario'];
    }
    
    #validação final da edição da atividades de rotina
    public function validateFinalAddRot($dados){
        echo $this->cargo;
        $ativRot=$this->aRot->inserAtiRot($dados,$this->local,$this->setor,$this->cargo);
        $retorno=[
            "retorno"=>"success",
            "erros"=>null
        ];
        return $retorno;
    }

    #Validar se o perfil é correspondente ao solicitado
    public function validarPerfil(){
        if($this->permition == 'user'){
            $this->setErro("Somente ADM pode apagar registros!");
            return false;
        }
    }

    #validação final da edição da atividades de rotina
    public function validateFinalEditeRot($dados){
        $ativRot=$this->aRot->editeAtiRot($dados,$this->local);
        $retorno=[
            "retorno"=>"success",
            "erros"=>null
        ];
        return $retorno;
    }

    #Get de atividades
    public function GetAtividadeRotina($dia=null){
        $atvs=$this->aRot->getAtvRot($this->local,$dia,$this->setor);
        return $atvs;
    }

    #validação de deletar atividades de rotina
    public function DeleteAtividadeRotina($dados){

        if(count($this->getErro())>0){
            $retorno=[
                "retorno"=>"erro",
                "erros"=>$this->getErro()
            ];
        }else{
            $atvs=$this->aRot->deleteAtivRot($dados);
            $retorno=[
                "retorno"=>"success",
                "erros"=>null
            ];
        }
        return $retorno;
    }

    #Inserir atividades de rotina
    public function validateRequisicaoDiaria(){
        
        $nDia= date("N");
        $dataCreate=date("Y-m-d H:i:s");
        $data=date("Y-m-d");
        $setor=$this->setor;
        $status="concluído";
        $arrDados=[
            "nDia"=>$nDia,
            "dataReq"=>$data,
            "local"=>$this->local,
            "setor"=>$setor,
            "prontuario"=>$this->pront,
            "dataCreate"=>$dataCreate,
            "status"=>$status,
        ];

        $this->validateExistRotina($arrDados);
        if(count($this->getErro())>0){
            $retorno=[
                "retorno"=>"erro",
                "erros"=>$this->getErro()
            ];
        }else{
            $this->aRot->inserAtiRotina($arrDados,$this->setor,$this->cargo);
            $retorno=[
                "retorno"=>"success",
                "erros"=>null
            ];
        }
        return $retorno;
    }
    
    #Validar atividades inseridas no dia
    public function validateExistRotina($arrDados){
        $atvs=$this->aRot->verifyRequiDia($arrDados);
        if($atvs > 0){
            $this->setErro("Atividades ja foram inseridas");
            return false;
        }else{
            return true;
        }
    }

    #Validação dos campos preenchido
    public function validateCapos($par){
        if($par['atividades'] == null){
            $this->setErro("Preencha todos os dados!");
            return false;
        }else if($par['dia'] == "Dia..."){
            $this->setErro("Preencha todos os dados!");
            return false;
        }else{
            return true;
        }
    }


}