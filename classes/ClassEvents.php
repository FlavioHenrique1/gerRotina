<?php
namespace Classes;
use Models\ClassCalendario;
@session_start();

class ClassEvents extends ClassCalendario{

    private $cd;
    private $setor;
    private $pront;
    private $tipo;
    private $erro=[];

    public function __construct()
    {
        $this->cd=$_SESSION['local'];
        $this->pront=$_SESSION['prontuario'];

        if($_SESSION['permition'] == "user"){
            $this->tipo="user";
        }else{
            $this->tipo="CD";
        }
    }

    public function getErro()
    {
        return $this->erro;
    }

    public function setErro($erro)
    {
        array_push($this->erro,$erro);
    }

    #Validar se os campos desejados foram preenchidos
    public function validateCampos($par)
    {
        if($par['title'] == "" or $par['start'] == ""){
            $this->setErro("Preencha todos os campos obrigatórios!");
        }
    }


    #validação final da consulta do calendario
    public function validateFinCalend($id=null){
        $b=$this->getEvents($this->cd,$this->pront,"");
        return $b;
    }

    #validação finaldo do insert calendario
    public function validateFinInsert($arrEvents){
        $dataCreate=date("Y-m-d H:i:s");

        if(count($this->getErro()) >0){
            $arrResponse=[
                "retorno"=>"erro",
                "erros"=>$this->getErro()
            ];
        }else{
            $b=$this->insertCale($arrEvents,$this->cd,$this->pront,$dataCreate,$this->tipo);
            $arrResponse=[
                "retorno"=>"success",
                "page"=>'atividades'
            ];

        }
        return json_encode($arrResponse);

    }

    #validação finaldo do insert calendario
    public function validateFinEdit($arrEvents){
        if(count($this->getErro()) >0){
            $arrResponse=[
                "retorno"=>"erro",
                "erros"=>$this->getErro()
            ];
        }else{
            $b=$this->editCale($arrEvents);
            $arrResponse=[
                "retorno"=>"success",
                "page"=>'atividades'
            ];

        }
        return json_encode($arrResponse);
    }

    #Deletar eventos
    public function deleteEvents($arrEvents){

        $res=$b=$this->getEvents("","","",$arrEvents['id']);

        if($res[0]['prontuario'] == $this->pront or $this->tipo == "CD"){
            $arrResponse=[
                "retorno"=>"success",
                "page"=>'atividades'
            ];
            $b=$this->deleteCal($arrEvents['id']);
            return json_encode($arrResponse);
        }else{
            $arrResponse=[
                "retorno"=>"erro",
                "erros"=>'Apenas administradores autorizados podem apagar atividades corporativas'
            ];
            return json_encode($arrResponse);
        }

    }
    
}