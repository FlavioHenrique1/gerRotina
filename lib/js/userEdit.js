// const nome=document.querySelector("#nome");
const prontuario=document.querySelector("#prontuario");
const local=document.querySelector("#local");
const cargo=document.querySelector("#cargo");
const setor=document.querySelector("#setor");
const dataNascimento=document.querySelector("#dataNascimento");
const img=document.querySelector("#imagem-preview");


function getRoot()
{
    var root="http://"+document.location.hostname+":8080/DiarioDeBordo/";
    return root;
}

function caminhoImg() {
    caminho = getRoot()+"img/imgUser/";
    return caminho;
}

document.addEventListener('DOMContentLoaded',getDataUser);

function getDataUser(){
    url= getRoot()+'controllers/controllerUser'
    fetch(url)
    .then(res=>res.json()) 
    .then(res=>{
        console.log(res);
        nome.value =  removerAcentos(res.data.nome);
        prontuario.value=res.data.prontuario;
        local.value=res.data.local;
        cargo.value=res.data.cargo;
        setor.value = res.data.setor;
        dataNascimento.value = res.data.dataNascimento;

        if(res.data.img != ""){
            img.setAttribute('src',caminhoImg()+res.data.img);
        }

    })
}

function exibirImagem(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            const file = input.files[0];
            const fileName = file.name.toLowerCase();
            const allowedExtensions = ["jpg", "jpeg", "png", "gif"];
            const fileExtension = fileName.split(".").pop();
            const isImageByExtension = allowedExtensions.includes(fileExtension);
            // Verifica se o arquivo é uma imagem pelo tipo MIME
            const isImageByMimeType = file.type.startsWith("image/");
            // Realiza a validação
            if (isImageByExtension || isImageByMimeType) {
              // O arquivo é uma imagem
              document.getElementById('imagem-preview').setAttribute('src', e.target.result);
            } else {
              // O arquivo não é uma imagem
              alert("Arquivo não é uma imagem!");
              input.value="";
            }
        }
        reader.readAsDataURL(input.files[0]);
    }
}

//Salvar nova atividade para o banco de dados
const form=document.querySelector("#formEditUser")
form.addEventListener('submit',(event)=>{
    event.preventDefault();
    const formData = new FormData(document.getElementById('formEditUser'));
    const divRetorno=document.querySelector("#ret");
    divRetorno.setAttribute("role","alert");

    url= getRoot()+'controllers/controllerUser'

    let dados = {
        nome: formData.get('nome'),
        prontuario: formData.get('prontuario'),
        local: formData.get('local'),
        cargo: formData.get('cargo'),
        setor: formData.get('setor'),
        dataNascimento: formData.get('dataNascimento'),
        senha: formData.get('senha'),
        senhaConf: formData.get('senhaConf')

    };
    fetch(url, {
        method: 'PUT',
        headers: {
            'Contente-Type' : 'aplication/json'
        },
        body: JSON.stringify(dados)
    })
    .then(res=>res.json())
    .then(res=>{
        if(res.retorno == "erro"){
            divRetorno.setAttribute("class","alert alert-danger")
            divRetorno.innerHTML=res.erros
        }else{
            divRetorno.setAttribute("class","alert alert-success")
            divRetorno.innerHTML="Dados atualizado com sucesso!" 
        }
    })
});

//Botão cancelar
const btnCanEdit=document.querySelector("#btnCanEdit");
btnCanEdit.addEventListener("click",(evt)=>{
    window.location.href=getRoot()+"atividades";
});