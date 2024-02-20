<?php \Classes\ClassLayout::setHeader('Esqueci minha senha','Recupere sua senha.');?>
    
    <div class="topFaixa float w100 center">
        Esqueci minha senha
    </div>
    <div class="retornoSen float w100 center"></div>
    <form  name="formSenha" id="formSenha" action="<?php echo DIRPAGE.'controllers/controllerSenha';?>" method="post">
        <div class="cadastro float center">
            <input class="float w100 h40" type="email" id="email" name="email" placeholder="Email:" required>
            <input class="float w100 h40" type="nunber" id="prontuario" name="prontuario" placeholder="Prontuário:" required>
            <input class="float w100 h40" type="text" id="dataNascimento" name="dataNascimento" placeholder="Data de Nascimento:" required>
            <input class="float w100 h40" type="password" id="senha" name="senha" placeholder="Senha:" required>
            <input class="float w100 h40" type="password" id="senhaConf" name="senhaConf" placeholder="Confirmação de Senha:" required>
            <input class="inlineBlock h40" type="submit" value="Solicitar">
        </div>
    </form>

<?php \Classes\ClassLayout::setFooter();?>