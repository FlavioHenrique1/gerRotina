function getRoot()
{
    var root="http://"+document.location.hostname+":8080/DiarioDeBordo/";
    return root;
}    
url= getRoot()+'controllers/controllerEvents'
let pegarData=(data)=>{

  let today = new Date(data);
  let year = today.getFullYear();
  let month = (today.getMonth() + 1).toString().padStart(2, '0');
  let day = today.getDate().toString().padStart(2, '0');
  let date = `${year}-${month}-${day}`;
  return date
}

let pegarHora=(data)=>{
  // Criar uma data
const minhaData = new Date(data);
// Obter a hora, minuto e segundo da data
let hora = minhaData.getHours();
let minuto = minhaData.getMinutes();
let segundo = minhaData.getSeconds();

if(minuto < 10){
  minuto='0'+minuto
}
if(hora < 10){
  hora='0'+hora
}
const horas=hora+':'+minuto
return horas

}

//Exibir o calendario
function getCalendar(perfil, div) {
  let calendarEl = document.querySelector(div)
  let calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: 'dayGridMonth',
    headerToolbar: {
      start: 'prev,next,today',
      center: 'title',
      end: 'dayGridMonth, timeGridWeek, timeGridDay'
    },
    buttonText: {
      today: 'hoje',
      month: 'mês',
      week: 'semana',
      day: 'dia'
    },
    locale: 'pt-br',
    dateClick: function (info) {
      if(perfil == 'manager'){
        calendar.changeView('timeGrid',info.dateStr)
        if(info.view.type == 'timeGrid'){

          modalTeste();
          const meuModal = new bootstrap.Modal(document.getElementById('exampleModal23'));
          let time=document.querySelector("#time")
          let dateF=document.querySelector("#date")
          data=pegarData(info.dateStr)
          hora=pegarHora(info.dateStr)
          dateF.value = data
          time.value=hora
          meuModal.show();
          //window.location.href='views/add?date='+info.dateStr
        }
      }else{
        if(info.view.type == 'dayGridMonth'){
          calendar.changeView('timeGrid',info.dateStr)
        }else{
          window.location.href='views/add?date='+info.dateStr
        }
      }
      info.dayEl.style.backgroundColor = 'red';
    },
    events: getRoot() + 'controllers/controllerEvents',
    eventClick: function (info) {
      if(perfil == 'manager'){
        modalTeste("Editar Dados","SalvarDados('PUT')");
        let idF=document.querySelector("#id")
        let titleF=document.querySelector("#title")
        let dateF=document.querySelector("#date")
        let descriptionF=document.querySelector("#description")
        let time=document.querySelector("#time")
        const meuModal = new bootstrap.Modal(document.getElementById('exampleModal23'));
        idF.value=info.event.id
        titleF.value=info.event.title
        data=pegarData(info.event.start)
        hora=pegarHora(info.event.start)
        time.value=hora
        dateF.value = data
        descriptionF.value=info.event.extendedProps.description
        meuModal.show();
        //window.location.href = `views/editar?id=${info.event.id}`
      }else{
        calendar.changeView('timeGrid',info.event)
      }
    }
  });
  calendar.render()
}

if(document.querySelector('.calendarUser')){
  getCalendar('user','.calendarUser')
}else if(document.querySelector('.calendarManager')){
  getCalendar('manager','.calendarManager')
}


// Salvar dados das atividades de rotinas
function SalvarDados(metodo="POST"){
  const formData = new FormData(document.getElementById('formCelend'))
  //const divRetorno=document.querySelector("#retorno")
  //divRetorno.setAttribute("role","alert")
  let data=document.querySelector("#date").value
  let time=document.querySelector("#time").value
  let title=document.querySelector("#title").value
  let description=document.querySelector("#description").value
  let id=document.querySelector("#id").value
  const divRetorno=document.querySelector("#resultadoCal")
  divRetorno.setAttribute("role","alert")

  let dados={
    id:id,
    time:time,
    data:data,
    title:title,
    description:description,
    id:id,
  }
  url= getRoot()+'controllers/controllerEvents'
  fetch(url, {
    method: metodo,
    body: JSON.stringify(dados)
  })
  .then(res=>res.json())
  .then(res=>{
    if(res.retorno == "erro"){
      divRetorno.setAttribute("class","alert alert-danger")
      divRetorno.innerHTML=res.erros
    }else{
      divRetorno.setAttribute("class","alert alert-success")
      divRetorno.innerHTML="Atividade salva com sucesso!" 
      const formul=document.querySelector("#formCelend");
      formul.reset();
      window.location.href= getRoot() +'calendario';
    }
    
  })

}


// Criar o modal do calendario
function modalTeste(textoH1="Novo Evento",funcao="SalvarDados()"){

  const divModal=document.createElement("div")
  divModal.setAttribute("id","exampleModal23")
  divModal.setAttribute("class","modal fade")
  divModal.setAttribute("tabindex","-1")
  divModal.setAttribute("aria-labelledby","exampleModalLabel")
  divModal.setAttribute("aria-hidden","true")
  divTeste=document.querySelector(".teste")
  divTeste.appendChild(divModal)

  const divModaldial=document.createElement("div")
  divModaldial.setAttribute("class","modal-dialog")
  divModal.appendChild(divModaldial)

  const divModalCont=document.createElement("div")
  divModalCont.setAttribute("class","modal-content")
  divModaldial.appendChild(divModalCont)

  const divHeader=document.createElement("div")
  divHeader.setAttribute("class","modal-header")
  divModalCont.appendChild(divHeader)

  const h1h=document.createElement("h1")
  h1h.setAttribute("class","modal-title fs-5")
  h1h.setAttribute("id","exampleModalLabel")
  h1h.innerHTML=textoH1

  const btnClose=document.createElement("button")
  btnClose.setAttribute("class","btn-close")
  btnClose.setAttribute("data-bs-dismiss","modal")
  btnClose.setAttribute("aria-label","Close")
  btnClose.setAttribute("onclick","fecharMod()")
  divHeader.appendChild(h1h)
  divHeader.appendChild(btnClose)

  const divBody=document.createElement("div")
  divBody.setAttribute("class","modal-body")
  divModalCont.appendChild(divBody)

  const divRes=document.createElement("div")
  divRes.setAttribute("id","resultadoCal")
  divBody.appendChild(divRes)


  let form=document.createElement("form")
  form.setAttribute("name","formCelend")
  form.setAttribute("id","formCelend")

  divBody.appendChild(form)

  let divMb=document.createElement("div")
  divMb.setAttribute("class","mb-3")
  form.appendChild(divMb)
  
  const inputId=document.createElement("input")
  inputId.setAttribute("type","hidden")
  inputId.setAttribute("name","id")
  inputId.setAttribute("id","id")

  let label1 =document.createElement("label")
  label1.setAttribute("class","col-form-label")
  label1.innerHTML="Data:"
  divMb.appendChild(inputId)
  divMb.appendChild(label1)

  const inputData=document.createElement("input")
  inputData.setAttribute("type","date")
  inputData.setAttribute("name","date")
  inputData.setAttribute("disabled","disabled")
  inputData.setAttribute("id","date")


  inputData.setAttribute("class","form-control")

  divMb.appendChild(inputData)

  let divMb2=document.createElement("div")
  divMb2.setAttribute("class","mb-3")
  form.appendChild(divMb2)

  let label2 =document.createElement("label")
  label2.setAttribute("class","col-form-label")
  label2.innerHTML="Hora:"

  divMb2.appendChild(label2)

  const input2=document.createElement("input")
  input2.setAttribute("type","time")
  input2.setAttribute("name","time")
  input2.setAttribute("disabled","disabled")
  input2.setAttribute("id","time")
  input2.setAttribute("class","form-control")
  divMb2.appendChild(input2)

  let divMb3=document.createElement("div")
  divMb3.setAttribute("class","mb-3")
  form.appendChild(divMb3)

  let labelT =document.createElement("label")
  labelT.setAttribute("class","col-form-label")
  labelT.innerHTML="Atividade:"

  divMb3.appendChild(labelT)
  
  const inputTitle=document.createElement("input")
  inputTitle.setAttribute("type","text")
  inputTitle.setAttribute("name","title")
  inputTitle.setAttribute("id","title")
  inputTitle.setAttribute("pattern","([aA-zZ]+)")
  inputTitle.setAttribute("class","form-control")
  divMb3.appendChild(inputTitle)
  
  let divMb4=document.createElement("div")
  divMb4.setAttribute("class","mb-3")
  form.appendChild(divMb4)
  
  let labelD =document.createElement("label")
  labelD.setAttribute("class","col-form-label")
  labelD.innerHTML="Observação:"
  divMb4.appendChild(labelD)
  
  const inputDescruption=document.createElement("input");
  inputDescruption.setAttribute("type","text");
  inputDescruption.setAttribute("name","description");
  inputDescruption.setAttribute("id","description");
  inputDescruption.setAttribute("class","form-control");
  divMb4.appendChild(inputDescruption);
  
  let divMb5=document.createElement("div");
  divMb5.setAttribute("class","md-3");
  form.appendChild(divMb5);
  
  let divClass =document.createElement("class");
  divClass.setAttribute("class","form-check form-switch");
  let divInput=document.createElement("input");
  divInput.setAttribute("class","form-check-input");
  divInput.setAttribute("type","checkbox");
  divInput.setAttribute("role","switch");
  divInput.setAttribute("id","flexSwitchCheckDefault");
  divClass.appendChild(divInput);
  let divlabel=document.createElement("label");
  divlabel.setAttribute("class","form-check-label");
  divlabel.setAttribute("for","flexSwitchCheckDefault");
  divlabel.innerHTML= "Repetir atividade";
  divClass.appendChild(divlabel);
  divMb5.appendChild(divClass);
  
  let inputRepet=document.querySelector("#flexSwitchCheckDefault");
  inputRepet.addEventListener("click",(evt)=>{
    if(inputRepet.checked == true){
      checado(divMb5);
      const meuModal = new bootstrap.Modal(document.getElementById('exampleModal234'));
      meuModal.show();
    }else{

    }
  });
  // const inputColor=document.createElement("input")
  // inputColor.setAttribute("type","color")
  // inputColor.setAttribute("name","color")
  // inputColor.setAttribute("id","color")
  // inputColor.setAttribute("class","form-control")
  // divMb5.appendChild(inputColor)
  
  let divFooter=document.createElement("div")
  divFooter.setAttribute("class","modal-footer")
  divModalCont.appendChild(divFooter)
  
  if(textoH1 == "Editar Dados"){

    const btnDeleteFooter=document.createElement("input")
    btnDeleteFooter.setAttribute("type","button")
    btnDeleteFooter.setAttribute("class","btn btn-danger")
    btnDeleteFooter.setAttribute("id","btnExcluirCale")
    btnDeleteFooter.setAttribute("onclick","excluirEventos()")
    btnDeleteFooter.value = "Excluir"
    divFooter.appendChild(btnDeleteFooter)

  }

  const btnCloseFooter=document.createElement("input")
  btnCloseFooter.setAttribute("type","button")
  btnCloseFooter.setAttribute("data-bs-dismiss","modal")
  btnCloseFooter.setAttribute("class","btn btn-secondary")
  btnCloseFooter.setAttribute("onclick","fecharMod()")
  btnCloseFooter.value = "Cancelar"
  divFooter.appendChild(btnCloseFooter)

  const btnSendFooter=document.createElement("input")
  btnSendFooter.setAttribute("type","button")
  btnSendFooter.setAttribute("class","btn btn-primary")
  btnSendFooter.setAttribute("id","btnSalvarCale")
  btnSendFooter.setAttribute("onclick",funcao)
  btnSendFooter.value = "Salvar"
  divFooter.appendChild(btnSendFooter)
}

let checado=(div)=>{
  console.log(div);

  const divModal1=document.createElement("div")
  divModal1.setAttribute("id","exampleModal234")
  divModal1.setAttribute("class","modal fade")
  divModal1.setAttribute("tabindex","-1")
  divModal1.setAttribute("aria-labelledby","exampleModalLabel")
  divModal1.setAttribute("aria-hidden","true")
  divTeste=document.querySelector(".teste")
  divTeste.appendChild(divModal1)

  const divModaldial1=document.createElement("div")
  divModaldial1.setAttribute("class","modal-dialog")
  divModal1.appendChild(divModaldial1)

  const divModalCont1=document.createElement("div")
  divModalCont1.setAttribute("class","modal-content")
  divModaldial1.appendChild(divModalCont1)

  const divHeader=document.createElement("div")
  divHeader.setAttribute("class","modal-header")
  divModalCont1.appendChild(divHeader)

  const h1h=document.createElement("h1")
  h1h.setAttribute("class","modal-title fs-5")
  h1h.setAttribute("id","exampleModalLabel")
  h1h.innerHTML="textoH1"

  const btnClose=document.createElement("button")
  btnClose.setAttribute("class","btn-close")
  btnClose.setAttribute("data-bs-dismiss","modal")
  btnClose.setAttribute("aria-label","Close")
  btnClose.setAttribute("onclick","fecharMod()")
  divHeader.appendChild(h1h)
  divHeader.appendChild(btnClose)

  const divBody=document.createElement("div")
  divBody.setAttribute("class","modal-body")
  divModalCont1.appendChild(divBody)

  const divSelect=document.createElement("div")
  divSelect.setAttribute("class","mb-3")
  divBody.appendChild(divSelect)




}


let excluirEventos=()=>{

  url= getRoot()+'controllers/controllerEvents'
  var confirmacao = confirm("Tem certeza que deseja excluir as atividades corporativas?");
  if (confirmacao) {
    let id=document.querySelector("#id").value
    const divRetorno=document.querySelector("#resultadoCal")
    let dados={
      id:id,
    }


    fetch(url, {
      method: "DELETE",
      body: JSON.stringify(dados)
    })
    .then(res=>res.json())
    .then(res=>{
      if(res.retorno == "erro"){
        divRetorno.setAttribute("class","alert alert-danger")
        divRetorno.innerHTML=res.erros
      }else{
  
        divRetorno.setAttribute("class","alert alert-success")
        divRetorno.innerHTML="Atividade salva com sucesso!" 
        const formul=document.querySelector("#formCelend");
        formul.reset();
        window.location.href= getRoot() +'calendario';
      }
    });
  }

}

document.addEventListener("DOMContentLoaded", function() {
 //modalTeste();
});

function fecharMod() {
  const modal=document.querySelector("#exampleModal23");
  const divRetorno=document.querySelector("#resultadoCal");
  divRetorno.removeAttribute("class");
  divRetorno.innerHTML="";
  const formulaCad=document.querySelector("#formCelend");
  modal.remove();
  formulaCad.reset();
}

