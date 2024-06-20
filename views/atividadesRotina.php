<?php \Classes\ClassLayout::setHeadRestrito("manager"); ?>
<?php \Classes\ClassLayout::setHeader('Rotinas', 'Atividades de Rotina'); ?>
<?php \Classes\ClassLayout::setNav();
@session_start();
$cd = $_SESSION['local'];
?>

<main class="container-fluid">
    <div class="bg-light p-5 rounded center" style="margin-top:80px;">
        <h1>Lista Atividades de Rotina - <?= $cd ?></h1>
        <div class="form">
            <div class="input-group mb-3">
                <div class="testeeee">
                    <select name='dia' id='dia' class='form-select'>
                        <option disabled selected>Dia...</option>
                        <option value='1'>Segunda</option>
                        <option value='2'>Terça</option>
                        <option value='3'>Quarta</option>
                        <option value='4'>Quinta</option>
                        <option value='5'>Sexta</option>
                    </select>
                </div>
                <button type="button" class="btn btn-secondary" id="pesquisarDia">Pesquisar</button>
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">Adicionar</button>
            </div>
        </div>
        <div class="tabelaAtividade">
            <table class="table table-striped table-hover" id="myTableRot">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Atividade</th>
                        <th scope="col">Horário</th>
                        <th scope="col">Responsavel</th>
                        <th scope="col">Dia</th>
                        <th scope="col">CD</th>
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
                <button type="button" class="btn-close" onclick="ngOnDestroy()" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="formAtivRot" action="<?= DIRCONT . 'controllerGetAtvRot' ?>">
                <div class="modal-body">
                    <div id="retorno"></div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Atividade:</label>
                        <input type="text" name="atividade" class="form-control" id="atividade" required>
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Dia:</label>
                        <select name='dia' id='diaAtv' class='form-select'>
                            <option disabled selected>Dia...</option>
                            <option value='1'>Segunda</option>
                            <option value='2'>Terça</option>
                            <option value='3'>Quarta</option>
                            <option value='4'>Quinta</option>
                            <option value='5'>Sexta</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Horário:</label>
                        <input type="text" name="horario" class="form-control" id="horarioRot">
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Responsavel:</label>
                        <select name="responsavel" class="form-select" id="seleResp">
                            <option selected disabled>Responsavel...</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Observações:</label>
                        <textarea name="observacao" class="form-control" id="obsRot"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="ngOnDestroy()">Cancelar</button>
                    <button type="submit" class="btn btn-success" id="btnSalvarRot">Salvar</button>
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
                <img src="<?php echo DIRIMG . 'calendario.jpg' ?>" alt="" srcset="">
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
                <img src="<?php echo DIRIMG . 'calendario1.jpg' ?>" style="width: 100%;">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="ngOnDestroy()">Cancelar</button>
            </div>
        </div>
    </div>
</div>

<script src="<?= DIRJS . 'jquery-3.6.4.min.js' ?>"></script>
<link rel="stylesheet" type="text/css" href="<?= DIRJS . 'DataTables\datatables.min.css' ?>">
<script type="text/javascript" src="<?= DIRJS . 'DataTables\datatables.min.js' ?>"></script>
<script src="<?= DIRJS . 'atividade.js' ?>"></script>
<?php \Classes\ClassLayout::setFooter('atividadeRotina.js'); ?>