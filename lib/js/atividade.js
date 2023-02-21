function getRoot()
{
    var root="http://"+document.location.hostname+":8080/Qualidade/";
    return root;
}

let url= getRoot()+'controllers/controllerGetAtiv'
let img=getRoot()+'img'

fetch(url)
.then(res=>res.json())
.then(res=>{
    tabela(res)
})
const tabelaBody=document.querySelector("#tabelaBody")

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
    
funcTab()

}

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
                console.log("deletar dados id= "+ tr.innerHTML)
            }
        })
    })
}    

    
