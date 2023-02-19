<?php //\Classes\ClassLayout::setHeadRestrito("user");?>
<?php \Classes\ClassLayout::setHeader('Área Restrita','Exclusivos para membros');?>

<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Fixed navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav me-auto mb-2 mb-md-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled">Disabled</a>
        </li>
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>

<main class="container">
  <div class="bg-light p-5 rounded center"style="margin-top:80px;">
    <h1>Lista de Atividades</h1>
    <div class="form">
        <div  class="input-group mb-3">
            <input type="date" name="dataPesquisa" id="dataPesquisa" class="form-control">
            <button type="button" class="btn btn-secondary ">Pesquisar</button>
            <button type="button" class="btn btn-success">Adcionar</button>
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
            <tbody class="table-group-divider center" style="width: 100%;">
                <tr>
                <th scope="row">1</th>
                <td>Enviar acompanhamento de Quadro</td>
                <td>Até as 15h</td>
                <td>Jose Roberto</td>
                <td>@mdo</td>
                <td>com observações / sem obsercações </td>
                <td class="tabelaEdit" id="edit"><img class="imgTabela" src="<?php echo DIRIMG.'edit.svg' ?>"></td>
                <td class="tabelaEdit" id="delete"><img class="imgTabela" src="<?php echo DIRIMG.'delete.svg' ?>"></td>
                </tr>
                <tr>
                <th scope="row">1</th>
                <td>Enviar acompanhamento</td>
                <td>Até </td>
                <td>Experdito</td>
                <td>@mdo</td>
                <td>com observações </td>
                <td class="tabelaEdit" id="edit"><img class="imgTabela" src="<?php echo DIRIMG.'edit.svg' ?>"></td>
                <td class="tabelaEdit" id="delete"><img class="imgTabela" src="<?php echo DIRIMG.'delete.svg' ?>"></td>
                </tr>
            </tbody>
        </table>
    </div>
  </div>
</main>

<a href="<?php echo DIRPAGE.'controllers/controllerLogout'; ?>">Sair</a>
<script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>
<script>
    $(document).ready( function () {
    $('#myTable').DataTable({
        keys: true,
        language: {
            "lengthMenu":"Mostrando _MENU_ registros por página",
            "zeroRecords": "Nada encontrado",
            "info":"Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty":"Nenhum registro disponível",
            "infoFiltered":"(filtrando de _MAX_ registros no total)",
            "search":"Pesquisar"
        },

    });

} );
</script>
<?php \Classes\ClassLayout::setFooter();?>