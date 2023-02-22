<?php //\Classes\ClassLayout::setHeadRestrito("user");?>
<?php \Classes\ClassLayout::setHeader('Área Restrita','Exclusivos para membros');?>
<?php \Classes\ClassLayout::setNav();?>

<main class="container-fluid">
  <div class="bg-light p-5 rounded center"style="margin-top:80px;">
    <h1>Lista de Atividades</h1>
    <div class="form">
        <div  class="input-group mb-3">
          <div class="testeeee">
            <input type="date" name="dataPesquisa" id="dataPesquisa" class="form-control">
            </div>
            <button type="button" class="btn btn-secondary ">Pesquisar</button>
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">Adcionar</button>
        </div>
    </div>
  
    <div class="tabelaAtividade">
        <table class="table table-striped table-hover" id="myTable">
            <thead class="table-dark">
                <tr>
                <th scope="col">#</th>
                <th scope="col">Atividade</th>
                <th scope="col">Horário</th>
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
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="formAddAtiv" action="<?= DIRCONT.'controllerAtividade'?>">
                <div class="modal-body">
                    <div id="retorno"></div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Atividade:</label>
                        <input type="text" name="atividade" class="form-control" id="recipient-name">
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Data:</label>
                        <input type="date" name="dataAtv" class="form-control" id="recipient-name">
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Horário:</label>
                        <input type="text" name="horario" class="form-control" id="recipient-name">
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Responsavel:</label>
                        <input type="text" name="responsavel" class="form-control" id="recipient-name">
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Observações:</label>
                        <textarea name="observacao" class="form-control" id="recipient-name"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success" id="btnSalvar" >Salvar</button>
                </div>
            </form>
        </div>
  </div>
</div>
<!-- Fim Modal -->

<a href="<?= DIRPAGE.'controllers/controllerLogout'; ?>">Sair</a>
<script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>
<script src="<?= DIRJS.'atividade.js' ?>"></script>
<?php \Classes\ClassLayout::setFooter();?>