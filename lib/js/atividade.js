// Função para formatar data 
function formatarData(data) {
    let diasDaSemana = ['Domingo', 'Segunda-feira', 'Terça-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira', 'Sábado'];
    let diaDaSemana = diasDaSemana[data.getDay()];
    let dia = String(data.getDate()).padStart(2, '0');
    let mes = String(data.getMonth() + 1).padStart(2, '0');
    let ano = data.getFullYear();
    return diaDaSemana + ' ' + dia + '/' + mes + '/' + ano;
  }
  
  let today = new Date();
  let formattedDate = formatarData(today);
  
  let dateInput = document.getElementById('dataPesquisa');
  dateInput.type = 'text';
  dateInput.value = formattedDate;

  dateInput.addEventListener('focus', function() {
    dateInput.type = 'date';
  });
  dateInput.addEventListener('change', function() {
    let selectedDate = new Date(dateInput.value);
    selectedDate.setMinutes(selectedDate.getMinutes() + selectedDate.getTimezoneOffset()); // ajusta para o fuso horário UTC
    dateInput.type = 'text';
    dateInput.value = formatarData(selectedDate);
  });

function getRoot()
{
    var root="http://"+document.location.hostname+":8080/Qualidade/";
    return root;
}

// Pegar as informações na API
let url= getRoot()+'controllers/controllerGetAtiv'
let img=getRoot()+'img'

fetch(url)
.then(res=>res.json())
.then(res=>{
    tabela(res)
})
const tabelaBody=document.querySelector("#tabelaBody")
// Carregar a tabela com as informações
const tabela=(dadosT)=>{
    dadosT.map((el)=>{
        const novoTh=document.createElement("th")
        novoTh.setAttribute("scope","row")
        const novoTr=document.createElement("tr")
        novoTh.innerHTML=el.id
        novoTr.appendChild(novoTh)
        let adcTd=(innerTab)=>{
            let novoTd=document.createElement("td")
            novoTd.innerHTML=innerTab
            novoTr.appendChild(novoTd)
        }
        adcTd(el.atividade)
        adcTd(el.prazo)
        adcTd(el.responsavel)
        adcTd(el.status)
        adcTd(el.obs)
        let adcImg=(tipo)=>{
            novoTd=document.createElement("td")
            novoImg=document.createElement("img")
            novoTd.setAttribute("class","tabelaEdit")
            novoTd.setAttribute("id",tipo)
            novoImg.setAttribute("class","imgTabela")
            novoImg.setAttribute("src",img+"/"+tipo+".svg")
            novoTd.appendChild(novoImg)
            novoTr.appendChild(novoTd)
        }
        adcImg("edit")
        adcImg("delete")
        tabelaBody.appendChild(novoTr)
    })
    iniTabela()
    
funcTab()
}
let iniTabela=()=>{
    $('#myTable').DataTable({
        keys: true,
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
}
// Função para obter os dados da tabela e ditar e apagar
let funcTab=()=>{

    const editTabela=[...document.querySelectorAll(".tabelaEdit")]
    const Tabela=document.querySelector("tbody")
    const dataPesquisa=document.querySelector("#dataPesquisa")
    editTabela.map((el)=>{
        el.addEventListener("click",(evt)=>{ 
            let tr=el.parentNode.firstElementChild
            if(el.id=="edit"){
                console.log("editar dados id= "+ tr.innerHTML)
            }else if(el.id=="delete"){
                Tabela.removeChild(evt.target.parentNode.parentNode)
                id=tr.innerHTML
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
    
    // Reabilita o botão de envio após 3 segundos
    setTimeout(() => {
        botaoEnvio.disabled = false;
        botaoEnvio.textContent = 'Salvar';
    }, 3000);
})