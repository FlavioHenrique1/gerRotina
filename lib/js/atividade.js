// // Função para formatar data 
// function formatarData(data) {
//     let diasDaSemana = ['Domingo', 'Segunda-feira', 'Terça-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira', 'Sábado'];
//     let diaDaSemana = diasDaSemana[data.getDay()];
//     let dia = String(data.getDate()).padStart(2, '0');
//     let mes = String(data.getMonth() + 1).padStart(2, '0');
//     let ano = data.getFullYear();
//     return diaDaSemana + ' ' + dia + '/' + mes + '/' + ano;
// }
  
//   let today = new Date();
//   let formattedDate = formatarData(today);
  
//   let dateInput = document.getElementById('dataPesquisa');
//   dateInput.type = 'text';
//   dateInput.value = formattedDate;

// dateInput.addEventListener('focus', function() {
//     dateInput.type = 'date';
// });
// dateInput.addEventListener('change', function() {
//     let selectedDate = new Date(dateInput.value);
//     selectedDate.setMinutes(selectedDate.getMinutes() + selectedDate.getTimezoneOffset()); // ajusta para o fuso horário UTC
//     dateInput.type = 'text';
//     dateInput.value = formatarData(selectedDate);
// });
let pegarData=()=>{

    let today = new Date();
    let year = today.getFullYear();
    let month = (today.getMonth() + 1).toString().padStart(2, '0');
    let day = today.getDate().toString().padStart(2, '0');
    let date = `${year}-${month}-${day}`;
    return date
}
function getRoot()
{
    var root="http://"+document.location.hostname+":8080/Qualidade/";
    return root;
}

// Pegar as informações na API
let url= getRoot()+'controllers/controllerGetAtiv'
let img=getRoot()+'img'

// Função para carregar os dados das atividades
const iniciarTabela=(dataI=null)=>{

    let dados={
        data:dataI,
    }
    url= getRoot()+'controllers/controllerGetAtiv'
    fetch(url, {
        method: 'POST',
        body: JSON.stringify(dados)
    })
    .then(res=>res.json())
    .then(res=>{
        iniTabela(res)
    })
}
const tblIn=()=>{
    let dateInput = document.getElementById('dataPesquisa')
    let dataDia=pegarData()
    dateInput.value=dataDia
    iniciarTabela(dataDia)
}
tblIn()
const pesquisarData=document.querySelector("#pesquisarData")
pesquisarData.addEventListener("click",(evt)=>{
    let dateInput = document.getElementById('dataPesquisa');
    console.log(dateInput.value)
    iniciarTabela(dateInput.value)
})

// iniciarTabela()
const tabelaBody=document.querySelector("#tabelaBody")
// Carregar a tabela com as informações
let iniTabela=(dadosT)=>{
    var data=[]
     dadosT.map((el)=>{
        data.push([
                el.id,
                el.atividade,
                el.prazo,
                el.responsavel,
                "<div class='status"+el.status+"'>"+ el.status+"</div>",
                el.obs,
                "<img src='img/edit.svg' alt='' class='imgTabela' id=edit>",
                "<img src='img/delete.svg' alt='' class='imgTabela' id='delete'>",
         ])
     })
    table = new DataTable('#myTable', {
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
    funcTab()
}

let editarDados=(tr)=>{
// selecionar todos os elementos <td> filhos do <tr>
let tds = tr.querySelectorAll('td');
const atv=document.querySelector("#atividade")
const dataAtv=document.querySelector("#dataAtv")
const horario=document.querySelector("#horario")
const responsavel=document.querySelector("#responsavel")
const obs=document.querySelector("#obs")
const dataPesquisa=document.querySelector("#dataPesquisa")
const status=document.querySelector("#status")

atv.value=tds[1].innerHTML
dataAtv.value=dataPesquisa.value
horario.value=tds[2].innerHTML
responsavel.value=tds[3].innerHTML
status.value=tds[4].firstElementChild.innerHTML
obs.value=tds[5].innerHTML

}


// Função para obter os dados da tabela e ditar e apagar
let funcTab=()=>{

    const editTabela=[...document.querySelectorAll(".imgTabela")]
    const Tabela=document.querySelector("tbody")
    const dataPesquisa=document.querySelector("#dataPesquisa")
    editTabela.map((el)=>{
        el.addEventListener("click",(evt)=>{ 
            let tr=el.parentNode.parentNode.firstElementChild
            if(el.id=="edit"){
                var myModal = new bootstrap.Modal(document.getElementById('exampleModal'), {

                });
                const formAddAtiv=document.querySelector("#formAddAtiv")
                const novoInp=document.createElement("input")
                novoInp.setAttribute("type","hidden")
                novoInp.setAttribute("name","id")
                novoInp.value= tr.innerHTML 
                formAddAtiv.appendChild(novoInp)
                // nome.value = tr.innerHTML
                myModal.show()
                let trI=el.parentNode.parentNode
                editarDados(trI)
                console.log("editar dados id= "+ tr.innerHTML)
            }else if(el.id=="delete"){
                Tabela.removeChild(evt.target.parentNode.parentNode)
                id=tr.innerHTML
                console.log(id)
                apagarAtiv(id)
            }
        })
    })
}

let apagarAtiv=(id)=>{
    url= getRoot()+'controllers/controllerDelAtiv'
    let dados={
        id:id,
    }
    fetch(url, {
        method: 'POST',
        body: JSON.stringify(dados)
    })
    .then(res=>res.json())
    .then(res=>{
        console.log(res)
    })
}

//Salvar nova atividade para o banco de dados
const form=document.querySelector("#formAddAtiv")
form.addEventListener('submit',(event)=>{
    event.preventDefault();
    const formData = new FormData(document.getElementById('formAddAtiv'))
    const botaoEnvio = form.querySelector('button[type="submit"]')
    const divRetorno=document.querySelector("#retorno")
    divRetorno.setAttribute("role","alert")
    // Desabilita o botão de envio ao ser clicado
    botaoEnvio.disabled = true
    // Mostra uma mensagem de "aguarde"
    botaoEnvio.textContent = 'Salvando...'
    
    url= getRoot()+'controllers/controllerAtividade'
    fetch(url, {
        method: 'POST',
      body: formData
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
    const formul=document.querySelector("#formAddAtiv")
    formul.reset()
    // Reabilita o botão de envio após 3 segundos
    setTimeout(() => {
        botaoEnvio.disabled = false;
        botaoEnvio.textContent = 'Salvar';
    }, 1000);
})