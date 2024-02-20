<?php \Classes\ClassLayout::setHeader('Cadastro','Realize seu cadastro em nosso sistema');?>
    
    <div class="topFaixa float w100 center">
        Cadastro de Usuário
    </div>
    <div class="retornoCad"></div>
    <form  name="formCadastro" id="formCadastro" action="<?php echo DIRPAGE.'controllers/controllerCadastro';?>" method="post">
        <div class="cadastro float center">
            <input class="float w100 h40 formc inputform" type="text" id="nome" name="nome" placeholder="Nome:" required>
            <input class="float w100 h40 formc inputform" type="email" id="email" name="email" placeholder="Email:" required>
            <input class="float w100 h40 formc inputform" type="text" id="prontuario" name="prontuario" placeholder="Prontuário:" required>
            <input class="float w100 h40 formc inputform" type="text" id="dataNascimento" name="dataNascimento" placeholder="Data de Nascimento:" required>
            <select name="local" id="local" class="form-select  w100 h40 formc inputform" required>
                <option disabled selected>Local...</option>
                <option value='CDPE'>CDPE</option>
                <option value='BELEM'>BELÉM</option>
                <option value='CURITIBA'>CURITIBA</option>
                <option value='SALVADOR'>SALVADOR</option>
                <option value='CONTAGEM'>CONTAGEM</option>
                <option value='REVERSA'>REVERSA</option>
                <option value='ITAPEVI'>ITAPEVI</option>
                <option value='CDSP'>CDSP</option>
                <option value='UBERLÂNDIA'>UBERLÂNDIA</option>
                <option value='GRAVATAI'>GRAVATAÍ</option>
                <option value='CDRJ'>CDRJ</option>
                <option value='SEROPÉDICA'>SEROPÉDICA</option>
                <option value='CDMG'>CDMG</option>
            </select>
            <select name="setor" id="setor" class="form-select  w100 h40 formc inputform" required>
                <option disabled selected>Setor...</option>
            </select>
            <select name='cargo' id='cargo' class='form-select w100 h40 formc inputform' required>
                <option disabled selected>Cargo...</option>
            </select>
            <input class="w100 h40 inputform" type="password" id="senha" name="senha" placeholder="Senha:" required>
            <input class="float w100 h40 formc inputform" type="password" id="senhaConf" name="senhaConf" placeholder="Confirmação de Senha:" required>
            <button class="inlineBlock h40 inputCancelar" onclick="cancelar()">Cancelar</button>
            <input class="inlineBlock h40 inputSubmit" type="submit" value="Cadastrar">
        </div>
    </form>

<?php \Classes\ClassLayout::setFooter();?>