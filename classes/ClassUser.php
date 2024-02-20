<?php
namespace Classes;

/** pendente concluir  */
use Classes\ClassValidate;
use DateTime;
use Models\ClassUserCad;
use Classes\ClassPassword;


class ClassUser extends ClassValidate{
    
    private $user;
    private $email;
    private $classUser;
    private $nome;
    private $cd;
    private $setor;
    private $pront;
    private $objPasss;

    public function __construct()
    {
        @session_start();
        $emailt=$_SESSION['email'];
        $nomet=$_SESSION['name'];
        $prontt=$_SESSION['prontuario'];
        $this->cd=$_SESSION['local'];
        $this->setor=$_SESSION['setor'];
        $this->email=$emailt;
        $this->nome=$nomet;
        $this->pront=$prontt;

        $this->objPasss=new ClassPassword();
        $this->classUser=new ClassUserCad();
    }
    
    /**
     * Get the value of user
     */ 
    public function getUser()
    {
        $dados=$this->classUser->getUserDados($this->email);
        $dados['data']['nome']=$this->nome;
        return $dados;
    }

    /**
     * Set the value of user
     *
     * @return  self
     */ 
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get the value of user
    */ 
    public function getNome()
    {
        $dados=$this->classUser->getUserName($this->cd,$this->setor);
        return $dados;
    }

    //Validação final da edição do usuário 
    public function ValidateFinEditUser($arrAtiv){
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
            $senhaHash=$this->objPasss->passwordHash($arrAtiv['senha']);
            $this->classUser->AtualizarDadosBD($arrAtiv,$this->email,$senhaHash);
        }
        return json_encode($arrResponse);
    }

    //Validar imagem
    public function validarImg($imagem){
        $nomeArquivo = rand(0,10000)."_".date("Y-m-d")."_".$this->pront.$imagem["name"];
        $caminhoTemporario = $imagem["tmp_name"];
        $caminho=DIRREQ.'img/imgUser/';
        $destino = $caminho.$nomeArquivo;
    
        if (move_uploaded_file($caminhoTemporario, $destino)) {
            $this->classUser->salvarImgBD($nomeArquivo,$this->email);
            $_SESSION["img"]=$nomeArquivo;
            echo "
            <script>
            alert('A imagem foi enviada com sucesso!');
            window.location.href='".DIRPAGE."editarUsuario';
            </script>
        ";
        } else {
            echo "
            <script>
            alert('Erro ao enviar a imagem.');
            window.location.href='".DIRPAGE."editarUsuario';
            </script>
        ";
        }

    }

}
