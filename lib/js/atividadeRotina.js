const pesquisarDia=document.querySelector("#pesquisarDia");
const dia=document.querySelector("#dia");

function getRoot1()
{
    var root="http://"+document.location.hostname+":8080/DiarioDeBordo/";
    return root;
}

// Função para carregar os dados das atividades


const iniciarTabel=()=>{

    url =dia.value == "Dia..." ? url= getRoot1()+'controllers/controllerGetAtvRot': url= getRoot1()+'controllers/controllerGetAtvRot?dia='+dia.value; 
    //url= getRoot1()+'controllers/controllerGetAtvRot'
    fetch(url)
    .then(res=>res.json()) 
    .then(res=>{
        iniTabel(res)
    })
}

pesquisarDia.addEventListener("click",(evt)=>{
    iniciarTabel();
});

// const iniciarTabel=()=>{
//     fetch(url)
//     .then(res=>res.json())
//     .then(res=>{
//         iniTabel(res)
//     })
// }

// Carregar a tabela com as informações
let iniTabel=(dadosT)=>{
    var data=[]
    let diaA="dia na"
     dadosT.map((el)=>{
        switch (el.dia) {
            case "1":
                diaA="Segunda"
                break;
             case "2":
                diaA="Terça"
                break;
             case "3":
                diaA="Quarta"
                break;
            case "4":
                diaA="Quinta"
                break;
            case "5":
                diaA="Sexta"
                break;
        }
        data.push([
                el.id,
                el.atividade,
                el.prazo,
                el.responsavel,
                diaA,
                el.local,
                el.obs,
                "<img src='"+img+"/edit.svg' alt='' class='imgTabela' id=edit>",
                "<img src='"+img+"/delete.svg' alt='' class='imgTabela' id='delete'>",
         ])
     })
     let table = new DataTable('#myTableRot', {
        keys: true,
        destroy: true,
        data:data,
        language: {
            "lengthMenu":"Mostrando _MENU_ registros por página",
            "sZeroRecords": "Nenhum registro encontrado",
            "info":"Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty":"Nenhum registro disponível",
            "infoFiltered":"(filtrando de _MAX_ registros no total)",
            "sSearch": "Pesquisar",
            "sLoadingRecords": "Carregando...",
            "sProcessing": "Processando...",
            "oPaginate": {
                "sNext": "Próximo",
                "sPrevious": "Anterior",
                "sFirst": "Primeiro",
                "sLast": "Último"
            },
        }
    });
    funcTabRot()
}

iniciarTabel()


// Função para obter os dados da tabela e ditar e apagar
let funcTabRot=()=>{
    const editTabela=[...document.querySelectorAll(".imgTabela")]
    const Tabela=document.querySelector("tbody")
    const dataPesquisa=document.querySelector("#dataPesquisa")
    editTabela.map((el)=>{
        el.addEventListener("click",(evt)=>{ 
            let tr=el.parentNode.parentNode.firstElementChild
            if(el.id=="edit"){
                var myModal = new bootstrap.Modal(document.getElementById('exampleModal'), {

                });
                let idForm=document.querySelector("#idRot")
                //Verificar se o id existe se não cria um novo
                if(idForm == null){
                    const formAtivRot=document.querySelector("#formAtivRot")
                    const novoInp=document.createElement("input")
                    novoInp.setAttribute("type","hidden")
                    novoInp.setAttribute("name","id")
                    novoInp.setAttribute("id","idRot")
                    novoInp.value= tr.innerHTML 
                    formAtivRot.appendChild(novoInp)
                }
                // nome.value = tr.innerHTML
                let id=tr.innerHTML
                myModal.show()
                let trI=el.parentNode.parentNode
                editarDadosRot(trI)
            }else if(el.id=="delete"){
                let id=tr.innerHTML
                apagarAtivRot(id,Tabela,evt)
                // Tabela.removeChild(evt.target.parentNode.parentNode)
            }
        })
    })
}

//Apagar atividades
let apagarAtivRot=(id,Tabela,evt)=>{
    url= getRoot1()+'controllers/controllerGetAtvRot'
    console.log(getRoot1())
    let dados={
        id:id,
    }
    fetch(url, {
        method: 'DELETE',
        body: JSON.stringify(dados)
    })
    .then(res=>res.json()) 
    .then(res=>{
        if(res.retorno == 'success'){
            Tabela.removeChild(evt.target.parentNode.parentNode)
            iniciarTabel()
        }else{
            alert(res.erros)
        }
    })
}

// Função para editar dados da tabela
let editarDadosRot=(tr)=>{
// selecionar todos os elementos <td> filhos do <tr>
    let tds = tr.querySelectorAll('td');
    const atv=document.querySelector("#atividade")
    var dataAtv = document.getElementById("diaAtv")
    const horario=document.querySelector("#horarioRot")
    const responsavel=document.querySelector("#seleResp")
    const obs=document.querySelector("#obsRot")
    const dataPesquisa=document.querySelector("#dia")
    const status=document.querySelector("#status")

    atv.value=tds[1].innerHTML
    var valorSelecionado = tds[4].innerHTML;
    // percorra todas as opções do elemento select
    for (var i = 0; i < dataAtv.options.length; i++) {
        // verifique se o valor da opção é igual ao valor selecionado
        if (dataAtv.options[i].innerHTML == valorSelecionado) {
        // selecione a opção
        dataAtv.selectedIndex = i;
        break;
        }
    }

    var valorSelecionadoNome = tds[3].innerHTML;
    // percorra todas as opções do elemento select
    for (var x = 0; x < responsavel.options.length; x++) {
        // verifique se o valor da opção é igual ao valor selecionado
        if (responsavel.options[x].innerHTML == valorSelecionadoNome) {
        // selecione a opção
        responsavel.selectedIndex = x;
        break;
        }
    }

    horario.value=tds[2].innerHTML
    obs.value=tds[6].innerHTML
}


$('#myTableRot').DataTable().on('draw', () => {
    funcTabRot()
});

function buscDados() {
    let atividade=document.querySelector("#atividade")
    let diaAtv=document.querySelector("#diaAtv")
    let horarioRot=document.querySelector("#horarioRot")
    let responsavelRot=document.querySelector("#seleResp")
    let obsRot=document.querySelector("#obsRot")
    let idRot=document.querySelector("#idRot")
    if(idRot !== null){
        idDados=idRot.value
    }else{
        idDados=null
    }
    let dados={
        id:idDados,
        atividades:atividade.value,
        dia:diaAtv.value,
        horario:horarioRot.value,
        responsavel:responsavelRot.value,
        obs:obsRot.value
    }
    return dados
}

//Salvar nova atividade para o banco de dados
const formRot=document.querySelector("#formAtivRot")
formRot.addEventListener('submit',(event)=>{
    event.preventDefault();
    const botaoEnvio = formRot.querySelector('button[type="submit"]')
    const divRetorno=document.querySelector("#retorno")
    divRetorno.setAttribute("role","alert")
    const id=document.querySelector("#idRot")

    dados=buscDados()
    // Desabilita o botão de envio ao ser clicado
    botaoEnvio.disabled = true
    // Mostra uma mensagem de "aguarde"
    botaoEnvio.textContent = 'Salvando...'
    console.log(dados)
    url= getRoot1()+'controllers/controllerGetAtvRot'
    let methodEnv=""
    if(id == null){
         methodEnv="POST"
    }else{
         methodEnv="PUT"
    }
    fetch(url, {
        method: methodEnv,
        body: JSON.stringify(dados),
    })
    .then(res=>res.json())
    .then(res=>{
        if(res.retorno == "erro"){
            divRetorno.setAttribute("class","alert alert-danger")
            divRetorno.innerHTML=res.erros
        }else{
            divRetorno.setAttribute("class","alert alert-success")
            divRetorno.innerHTML="Atividade salva com sucesso!" 
        }
    })
    formRot.reset()
    // Reabilita o botão de envio após 1 segundo
    setTimeout(() => {
        iniciarTabel()
        botaoEnvio.disabled = false;
        botaoEnvio.textContent = 'Salvar';
        }, 1000);
})


function carregarNomes() {
    const seleEdit =  document.querySelector("#seleResp");
    url= getRoot()+'controllers/controllerNameSele'
    fetch(url)
    .then(res=>res.json()) 
    .then(res=>{
        res.map(el=>{
            let opt=document.createElement("option");
            opt.value = removerAcentos(el.nome);
            opt.innerHTML = removerAcentos(el.nome);
            seleEdit.appendChild(opt);
        });
    })
}
carregarNomes();

function ngOnDestroy(){
    var elemento = document.getElementById("idRot");
    const divRetorno=document.querySelector("#retorno")
    divRetorno.removeAttribute("class")
    divRetorno.innerHTML=""
    if(elemento !== null){
        elemento.parentNode.removeChild(elemento);
    }
    const formul=document.querySelector("#formAtivRot")
    formul.reset()
    $("body>.modal-backdrop").remove()
}
