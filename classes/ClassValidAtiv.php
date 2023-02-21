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

    public function ValidateFinalAtv($arrAtiv){
        $this->mAtividade->inserAti($arrAtiv);
    }

    public function GetAtividade(){
        $atvs=$this->mAtividade->getAtv();
        return $atvs;
    }

}