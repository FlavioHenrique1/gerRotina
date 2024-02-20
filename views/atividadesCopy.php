<?php \Classes\ClassLayout::setHeadRestrito("user");?>
<?php \Classes\ClassLayout::setHeader('Atividades','Atividades do dia');?>
<?php \Classes\ClassLayout::setNav();
@session_start();
$cd= $_SESSION['local'];
?>

<main class="container-fluid">
    <div class="bg-light p-5 rounded center"style="margin-top:80px;">
        <h1>Lista de Atividades -  <?= $cd ?></h1>
        <div class="form">
            <div  class="input-group mb-3">
            <div class="testeeee">
                <input type="date" name="dataPesquisa" id="dataPesquisa" class="form-control">
                </div>
                <button type="button" class="btn btn-secondary" id="pesquisarData">Pesquisar</button>
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">Adicionar</button>
            </div>
        </div>
        <div class="tabelaAtividade">
            <table class="table table-striped table-hover" id="myTable">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Atividade</th>
                        <th scope="col">Início</th>
                        <th scope="col">Fim</th>
                        <th scope="col">Prazo</th>
                        <th scope="col">Responsavel</th>
                        <th scope="col">Status</th>
                        <th scope="col">Observações</th>
                        <th scope="col">Editar</th>
                        <th scope="col">Deletar</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider" id="tabelaBody" style="width: 100%;">
                </tbody>
            </table>
        </div>
  </div>
</main>
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Adicionar Atividade</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" onclick="ngOnDestroy()"  aria-label="Close"></button>
            </div>
            <form method="post" id="formAddAtiv" action="<?= DIRCONT.'controllerAtividade'?>">
                <div class="modal-body">
                    <div id="retorno"></div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Atividade:</label>
                        <input type="text" name="atividade" class="form-control" id="atividade">
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Data:</label>
                        <input type="date" name="dataAtv" class="form-control" id="dataAtv">
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Prazo:</label>
                        <input type="text" name="horario" class="form-control" id="horario">
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Responsavel:</label>
                        <select name="responsavel" class="form-select" id="seleResp" id="status">
                            <option selected disabled>Responsavel...</option>
                        </select>
                        <!-- <input type="text" name="responsavel" class="form-control" id="responsavel"> -->
                    </div>
                    <div class="mb-3">
                        <!-- <label for="recipient-name" class="col-form-label">Status:</label> -->
                        <select name="status" class="form-select" id="inputGroupSelect01" id="status">
                            <option selected disabled>Status...</option>
                            <option value="iniciar">Iniciar</option>
                            <option value="finalizar">Finalizar</option>
                            <option value="pendente">Pendente</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Observações:</label>
                        <textarea name="observacao" class="form-control" id="obs"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="ngOnDestroy()">Cancelar</button>
                    <button type="submit" class="btn btn-success" id="btnSalvar" >Salvar</button>
                </div>
            </form>
        </div>
  </div>
</div>
<!-- Fim Modal -->
<!-- Modal IMG Calendário Mensal -->
<div class="modal fade modal-xl" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Calendário</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                <div class="modal-body center">
                    <img src="<?php echo DIRIMG.'calendario.jpg'?>" alt="" srcset="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="ngOnDestroy()">Cancelar</button>
                </div>
        </div>
  </div>
</div>
<!-- Modal IMG Calendário Diario -->
<div class="modal fade modal-xl" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Calendário do dia</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                <div class="modal-body center">
                    <img src="<?php echo DIRIMG.'calendario1.jpg'?>" style="width: 100%;">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="ngOnDestroy()">Cancelar</button>
                </div>
        </div>
  </div>
</div>

<script src="<?= DIRJS.'jquery-3.6.4.min.js'?>"></script>
<link rel="stylesheet" type="text/css" href="<?= DIRJS.'DataTables\datatables.min.css' ?>">
<script type="text/javascript" src="<?= DIRJS.'DataTables\datatables.min.js' ?>"></script>
<script src="<?= DIRJS.'atividade_copy.js' ?>"></script>
<?php \Classes\ClassLayout::setFooter();?>