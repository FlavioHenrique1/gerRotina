"use strict"

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
    var root="http://"+document.location.hostname+":8080/DiarioDeBordo/";
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
    let dateInput = document.getElementById('dataPesquisa')
    iniciarTabela(dateInput.value)
})

const tabelaBody=document.querySelector("#tabelaBody")
// Carregar a tabela com as informações
let iniTabela=(dadosT)=>{
    var data=[]
    

     dadosT.map((el)=>{
        let iHora="00";
        let iMinutos="00";
        let iHoraM="--:--";
        let fHora="00";
        let fMinutos="00";
        let fHoraM="--:--";

        if(el.inicioAtv != "0000-00-00 00:00:00"){
            const dataHora = el.inicioAtv;
            const dataObj = new Date(dataHora);
            iHora = dataObj.getHours();
            iMinutos = dataObj.getMinutes();
            if(iHora < 10){
                iHora="0"+iHora;
            }else if(iMinutos < 10){
                iMinutos="0"+iMinutos;
            }
            iHoraM =  iHora + ':' + iMinutos.toString().padStart(2,'0');
        }
        if(el.fimAtv != "0000-00-00 00:00:00"){
            const fdataHora = el.fimAtv;
            const fdataObj = new Date(fdataHora);
            fHora = fdataObj.getHours();
            fMinutos = fdataObj.getMinutes();
            if(fHora < 10){
                fHora="0"+fHora;
            }else if(fMinutos < 10){
                fMinutos="0"+fMinutos;
            }
            fHoraM =  fHora + ':' + fMinutos.toString().padStart(2,'0');
        }
        data.push([
                el.id,
                el.atividade,
                //"<input type='time' name='horario' class='form-control' id='horario' value='"+ iHoraM+"'>",
                "<div class='horaInicio' id='"+el.id+"'>"+ iHoraM+"</div>",
                fHoraM,
                el.prazo,
                el.responsavel,
                "<div class='status"+el.status+"'>"+ el.status+"</div>",
                el.obs,
                "<img src='"+img+"/edit.svg' alt='' class='imgTabela' id=edit>",
                "<img src='"+img+"/delete.svg' alt='' class='imgTabela' id='delete'>",
         ])
     })
     let table = new DataTable('#myTable', {
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
    //hora()
    funcTab()
    
}

// Função para editar dados da tabela
let editarDados=(tr)=>{
// selecionar todos os elementos <td> filhos do <tr>
let tds = tr.querySelectorAll('td');
const atv=document.querySelector("#atividade")
const dataAtv=document.querySelector("#dataAtv")
const horario=document.querySelector("#horario")
const responsavel=document.querySelector("#seleResp")
const obs=document.querySelector("#obs")
const dataPesquisa=document.querySelector("#dataPesquisa")
const status=document.querySelector("#inputGroupSelect01")


atv.value=tds[1].innerHTML
dataAtv.value=dataPesquisa.value
horario.value=tds[4].innerHTML
responsavel.value=tds[5].innerHTML
// status.value = tds[6].firstElementChild.innerHTML
obs.value=tds[7].innerHTML

}

// Função para obter os dados da tabela e editar e apagar
let funcTab=()=>{
    const editTabela=[...document.querySelectorAll(".imgTabela")]
    const Tabela=document.querySelector("tbody")
    const dataPesquisa=document.querySelector("#dataPesquisa")
    //hora()
    editTabela.map((el)=>{
        el.addEventListener("click",(evt)=>{ 
            let tr=el.parentNode.parentNode.firstElementChild
            if(el.id=="edit"){
                var myModal = new bootstrap.Modal(document.getElementById('exampleModal'), {
                });
                let idForm=document.querySelector("#idRot")
                //Verificar se o id existe se não cria um novo
                if(idForm == null){
                    const formAddAtiv=document.querySelector("#formAddAtiv")
                    const novoInp=document.createElement("input")
                    novoInp.setAttribute("type","hidden")
                    novoInp.setAttribute("name","id")
                    novoInp.setAttribute("id","idRot")
                    novoInp.value= tr.innerHTML 
                    formAddAtiv.appendChild(novoInp)
                }
                // nome.value = tr.innerHTML
                myModal.show()
                let trI=el.parentNode.parentNode
                editarDados(trI)
            }else if(el.id=="delete"){
                let id=tr.innerHTML
                apagarAtiv(id,Tabela,evt)
                // Tabela.removeChild(evt.target.parentNode.parentNode)
            }
        })
    })
}

//Apagar atividades
let apagarAtiv=(id,Tabela,evt)=>{
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
        if(res.retorno == true){
            Tabela.removeChild(evt.target.parentNode.parentNode)
        }else{
            alert(res.msg)
        }
    })
}

//Salvar nova atividade para o banco de dados
const form=document.querySelector("#formAddAtiv")
form.addEventListener('submit',(event)=>{
    event.preventDefault();
    const formData = new FormData(document.getElementById('formAddAtiv'));
    const botaoEnvio = form.querySelector('button[type="submit"]');
    const divRetorno=document.querySelector("#retorno");
    divRetorno.setAttribute("role","alert");
    const idRot=document.querySelector("#idRot");
    var selectElement = document.getElementById("inputGroupSelect01");

    // for (const [campo, valor] of formData.entries()) {
    //     console.log(campo, valor);
    //   }
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
    // Reabilita o botão de envio após 1 segundo
    setTimeout(() => {
        tblIn()  
        botaoEnvio.disabled = false;
        botaoEnvio.textContent = 'Salvar';
        }, 1000);
})


$('#myTable').DataTable().on('draw', () => {
    funcTab()
});

function ngOnDestroy(){
    var elemento = document.getElementById("idRot");
    const divRetorno=document.querySelector("#retorno")
    divRetorno.removeAttribute("class")
    divRetorno.innerHTML=""
    if(elemento !== null){
        elemento.parentNode.removeChild(elemento);
    }
    const formul=document.querySelector("#formAddAtiv")
    formul.reset()
    $("body>.modal-backdrop").remove()
}

//carregar atividades de rotina de acordo com o dia 
function inserAtvDiaria(){
    const hoje = new Date().toLocaleDateString();
    const ultimoAcesso = localStorage.getItem('ultimo_acesso');

    if (ultimoAcesso !== hoje) {
        // A requisição ainda não foi feita hoje, então faz a requisição
        url= getRoot()+'controllers/controllerRequisicao_diaria'
        fetch(url)
        .then(res=>res.json()) 
        .then(res=>{
            tblIn()
        })
        // Armazena o dia atual no localStorage
        localStorage.setItem('ultimo_acesso', hoje);
    }
}

inserAtvDiaria()

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
function carregarNomes1() {
    const seleEdit =  document.querySelector("#seleResp1");
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

// function hora(){
//     const horaInicio=[...document.querySelectorAll(".horaInicio")];
//     horaInicio.map((evt)=>{
//         evt.addEventListener("dblclick",(event)=>{
//             if(evt.classList.contains("horaInicio")){
//                 let horainiciot=evt.innerHTML;
//                 evt.setAttribute("class","HoraInicioEditar");
//                 evt.innerHTML = "<input type='time' name='horario' class='form-control' id='horarioInicio' value='"+ horainiciot+"'>"

//                 let horarioInicioEdit = document.querySelector("#horarioInicio");
//                 horarioInicioEdit.focus();
//                 horarioInicioEdit.addEventListener("blur",(evento)=>{
//                     console.log(evt.parentNode.parentNode);
//                     evt.innerHTML=horarioInicioEdit.value
//                     if(evt.innerHTML ==""){
//                         evt.innerHTML="--:--";
//                     }
//                     evt.setAttribute("class","horaInicio");

//                     console.log("o campo perdeu o foco");
//                 });
//             }
//         });
//     })
// }

tabelaBody.addEventListener("dblclick",(event)=>{
    const cell = event.target
    const cell1 = event.target
    const originalValue = cell.innerHTML;
    const row = cell.parentNode;
    let columnIndex = cell.cellIndex;
    let id = "";
    if(cell.tagName === "TD"){
        id = cell.parentNode.firstElementChild.innerHTML;
    }else{
        id = cell.parentNode.parentNode.firstElementChild.innerHTML;
        columnIndex = cell.parentNode.cellIndex;
    }
    if(columnIndex !=0 && columnIndex < 8){
        let input=document.createElement("input");
        input.setAttribute("class","alterAtivTab");
        input.value = originalValue;
        switch(columnIndex){
            case 2:
                input.setAttribute("type","time");
                break
            case 3:
                input.setAttribute("type","time");
                break
            case 5:
                input=document.createElement("select");
                input.setAttribute("name","responsavel");
                input.setAttribute("id","seleResp1");
                break
            case 6:
                input=document.createElement("select");
                input.setAttribute("name","status");
                input.setAttribute("id","status");

                let option=document.createElement("option");
                let option1=document.createElement("option");
                let option2=document.createElement("option");

                option.value = "Iniciar";
                option1.value = "Finalizar";
                option2.value = "Pendente";

                option.text = "Iniciar";
                option1.text = "Finalizar";
                option2.text = "Pendente";
                input.appendChild(option);
                input.appendChild(option1);
                input.appendChild(option2);
                break
            }
            cell.innerHTML = "";
            cell.appendChild(input);
            carregarNomes1();
            input.focus();

            input.addEventListener("blur",(evt)=>{
                let editedValue = input.value;
                if(input.value == "Iniciar"){
                    cell1.setAttribute("class","statusEm Andamento");
                    editedValue="Em Andamento";
                }else if(input.value == "Finalizar"){
                    cell1.setAttribute("class","statusConcluído");
                    editedValue="Concluído";
                }else if(input.value == "Pendente"){
                    cell1.setAttribute("class","statusPendente");
                }
                
                cell.innerHTML=editedValue;
                //atualizar a logica para o bd
                AtAtivTab(id,columnIndex,cell.innerHTML)
            });
        }
    
});

let AtAtivTab=(id,coluna,infor)=>{
    let urlEdit= getRoot()+'controllers/controllerAtividade'
    let dados={
        id:id,
        coluna:coluna,
        infor:infor
    }
    fetch(urlEdit, {
        method: 'POST',
        body: JSON.stringify(dados)
    })
    .then(res=>res.json()) 
    .then(res=>{
        console.log(res);
    })
}