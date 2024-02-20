<?php \Classes\ClassLayout::setHeader('Redefinição de Senha','Redefina sua senha');?>
    
    <div class="topFaixa float w100 center">
        Cadastro de Clientes
    </div>
    <div class="retornoSen"></div>
    
    <form  name="formRedSenha" id="formRedSenha" action="<?php echo DIRPAGE.'controllers/controllerConfirmacaoSenha';?>" method="post">
        <div class="cadastro float center">
            <input class="float w100 h40 inputform" type="email" id="email" name="email" placeholder="Email:" required autofocus>
            <input class="float w100 h40 inputform" type="nunber" id="prontuario" name="prontuario" placeholder="Prontuário:" required>
            <input class="float w100 h40 inputform" type="text" id="dataNascimento" name="dataNascimento" placeholder="Data de Nascimento:" required>
            <input class="float w100 h40 inputform" type="password" id="senha" name="senha" placeholder="Senha:" required>
            <input class="float w100 h40 inputform" type="password" id="senhaConf" name="senhaConf" placeholder="Confirmação de Senha:" required>
            <input class="inlineBlock h40 inputSubmit" type="submit" value="Cadastrar Nova Senha">
        </div>
    </form>

<?php \Classes\ClassLayout::setFooter();?>