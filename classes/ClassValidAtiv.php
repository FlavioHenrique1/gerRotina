<?php
namespace Classes;

use Models\Atividade;
use Models\ClassAtividade;

class ClassValidAtiv extends ClassValidate{

    private $mAtividade;

    public function __construct()
    {
        $this->mAtividade=new ClassAtividade();
    }
    //Validar campos prara adc atividades
    public function validCampos($atividade,$data){
        if($atividade == "" ){
            $this->setErro("Preencha os campos obrigatórios!");
            return false;
        }else{
            if($data == ""){
                $this->setErro("Preencha os campos obrigatórios!");
            }else{
                return true;
            }
        }
    }
    // Verificar se a data é valida
    public function validarDataAtv($data){
        if (strtotime($data) !== false) {
            return true;
        } else {
            $this->setErro("Data inválida!");
            return false;
        }

    }
    //Validação final da edição
    public function ValidateFinalEdit($arrAtiv){
        if(count($this->getErro()) >0){
            $arrResponse=[
                "retorno"=>"erro",
                "erros"=>$this->getErro()
            ];
        }else{
            $arrResponse=[
                "retorno"=>"success",
                "page"=>'atividades'
            ];
            $this->mAtividade->inserEdit($arrAtiv);
        }
        return $arrResponse;
    }
    //Validação final da edição
    public function ValidateEditTab($dados){

        $ret=$this->mAtividade->inserEditTab($dados['id'],$dados['coluna'],$dados['infor']);
        return $ret;
    }
    #Validação final para adc atividade
    public function ValidateFinalAtv($arrAtiv){
        if(count($this->getErro()) >0){
            $arrResponse=[
                "retorno"=>"erro",
                "erros"=>$this->getErro()
            ];
        }else{
            $arrResponse=[
                "retorno"=>"success",
                "page"=>'atividades'
            ];
            $this->mAtividade->inserAti($arrAtiv);
        }
        return $arrResponse;
    }
    #Get de atividades
    public function GetAtividade($data){
        $atvs=$this->mAtividade->getAtv($data);
        return $atvs;
    }

    #Deletar atividades
    public function deleteAtiv($id){
        $atvs=$this->mAtividade->deleteAtividade($id);

    }

    #Validar e inserir tarefas de rotinas
    public function ValidateTarRot($nDia){
        $atvs=$this->mAtividade->inserAtiRot($nDia);
        return $atvs;
    }

        #Validar e inserir tarefas de rotinas
        public function ValidateTarRota($nDia,$data){
            $atvs=$this->mAtividade->inserAtiRota($nDia,$data);
            return $atvs;
        }
    
}