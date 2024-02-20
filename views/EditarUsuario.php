<?php \Classes\ClassLayout::setHeadRestrito("user");?>
<?php \Classes\ClassLayout::setHeader('Editar','Editar usuário');?>
<?php \Classes\ClassLayout::setNav(); 
@session_start();
$nome=$_SESSION['name'];
?>

<div class="container" style="align-items: center;">
    <div class="prinEditUser">
        <div class="row" style="margin-top: 10%;">
            <div class="ret" id="ret"></div>
            <div class="col-8">
                <form class="row g-3" action="<?php echo DIRPAGE.'controllers/controllerUser';?>" method="post" id='formEditUser'>
                    <div class="col-md-6">
                        <label for="inputEmail4" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="nome" name="nome" required placeholder="Nome do Usuário">
                    </div>
                    <div class="col-md-6">
                        <label for="inputPassword4" class="form-label">Prontuário</label>
                        <input type="text" class="form-control" id="prontuario" name="prontuario" required placeholder="Prontuário do Usuário" >
                    </div>
                    <div class="col-md-6">
                        <label for="inputState" class="form-label">CD</label>
                        <select name="local" id="local"class="form-select" required>
                            <option disabled selected>CD...</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="inputState" class="form-label">Cargo</label>
                        <select name='cargo' id='cargo' class="form-select" required>
                            <option disabled selected>Cargo...</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="inputState" class="form-label">Setor</label>
                        <select name="setor" id="setor" class="form-select" required>
                            <option disabled selected>Setor...</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="inputCity" class="form-label">Data de Nascimento</label>
                        <input class="form-control"  type="text" id="dataNascimento" name="dataNascimento" placeholder="Data de Nascimento:" required>
                    </div>
                    <div class="col-md-6">
                        <label for="inputCity" class="form-label">Senha</label>
                        <input type="password" class="form-control" id="senha" name="senha" placeholder="Senha:" required>
                    </div>
                    <div class="col-md-6">
                        <label for="inputCity" class="form-label">Confirmação de Senha</label>
                        <input type="password" class="form-control" id="senhaConf" name="senhaConf" placeholder="Confirmação de Senha:" required>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-success">Salvar</button>
                        <button class="btn btn-primary" id="btnCanEdit">Cancelar</button>
                    </div>
                </form>
            </div>
            <div class="col-4">
                <div class="center">
                    <form action="<?php echo DIRPAGE.'controllers/controllerUser';?>" method="post" enctype="multipart/form-data" >
                        <div class="imgEdit rounded-circle user_img">
                            <img class='rounded-circle user_img' id="imagem-preview" src="<?= DIRIMG.'profile.png' ?>" alt="">
                        </div>
                        <div class="input-group mb-3" >
                            <input type="file" class="form-control" name="imagem" accept="image/png, image/jpeg, image/jpg, image/gif" onchange="exibirImagem(this)" required>
                        </div>
                        <button type="submit" class="btn btn-secondary">Salvar Foto</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?= DIRJS.'userEdit.js' ?>"></script>
<?php \Classes\ClassLayout::setFooter();?>