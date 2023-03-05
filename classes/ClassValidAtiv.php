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

    public function GetAtividade($data){
        $atvs=$this->mAtividade->getAtv($data);
        return $atvs;
    }
    public function deleteAtiv($id){
        $atvs=$this->mAtividade->deleteAtividade($id);

    }
    
}