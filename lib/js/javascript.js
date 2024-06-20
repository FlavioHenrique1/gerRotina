//Máscaras do formulário de cadastro
$('#cpf , #dataNascimento').on('focus', function () {
    var id=$(this).attr("id");
    if(id == "cpf"){VMasker(document.querySelector("#cpf")).maskPattern("999.999.999-99");}
    if(id == "dataNascimento"){VMasker(document.querySelector("#dataNascimento")).maskPattern("99/99/9999")};
});

//Retorno do root
function getRoot()
{
    var root="http://"+document.location.hostname+"";
    return root;
}

//Ajax do formulário de cadastro
$("#formCadastro").on("submit",function(event){
    event.preventDefault();
    var dados=$(this).serialize();
    $.ajax({
       url: getRoot()+'controllers/controllerCadastro',
        type: 'post',
        dataType: 'json',
        data: dados,
        success: function (response) {
            $('.retornoCad').empty();
            if(response.retorno == 'erro'){
                console.log(response);
                $.each(response.erros,function(key,value){
                    $('.retornoCad').append(value+'<br>');
                });
            }else{
                // alert("Cadastro realizado com sucesso!")
                // window.location.href=getRoot()+'login',
                $('.retornoCad').append('Dados inseridos com sucesso!');
                window.location.href= getRoot();
            }
        }
    });
});

//Ajax do formulário de login
$("#formLogin").on("submit",function(event){
    event.preventDefault();
    var dados=$(this).serialize();

    $.ajax({
       url: getRoot()+'controllers/controllerLogin',
        type: 'post',
        dataType: 'json',
        data: dados,
        success: function (response) {
            if(response.retorno == 'success'){
                lemLogin();
                window.location.href=response.page
            }else{
                if(response.tentativas == true){
                    $('.loginFormulario').hide();
                }
                $('.resultadoForm').empty();
                $.each(response.erros,function(key,value){
                    $('.resultadoForm').append(value+'<br>');
                });
            }
        }
    });
});

//Ajax do formulário de confirmação de senha
$("#formSenha").on("submit",function(event){
    event.preventDefault();
    var dados=$(this).serialize();

    $.ajax({
        url: getRoot()+'controllers/controllerSenha',
        type: 'post',
        dataType: 'json',
        data: dados,
        success: function (response) {
            if(response.retorno == 'success'){
                $('.retornoSen').html("Redefinição de senha enviada com sucesso!");
            }else{
                $('.retornoSen').empty();
                $.each(response.erros,function(key,value){
                    $('.retornoSen').append(value+'');
                });
            }
        }
    });
});

//CapsLock
$("#senha").keypress(function(e){
    kc=e.keyCode?e.keyCode:e.which;
    sk=e.shiftKey?e.shiftKey:((kc==16)?true:false);
    if(((kc>=65 && kc<=90) && !sk)||(kc>=97 && kc<=122)&&sk){
        $(".resultadoForm").html("Caps Lock Ligado");
    }else{
        $(".resultadoForm").empty();
    }
});

//Cancelar cadastro
function cancelar() {
    window.location.href=getRoot();
}


//Setor e cargo do cadastro
let setorCargo=()=>{
    url= getRoot()+'controllers/controllerGetDadosCad'
    fetch(url)
    .then(res=>res.json()) 
    .then(res=>{
        var selectElement = document.getElementById("setor");
        if(selectElement){     
            // Passo 2: Execute a função que retorna os dados
            var dadosSetor = res.setor;
            // Adicione novas opções ao <select> do setor
            dadosSetor.forEach(function(dado) {
                var optionElement = document.createElement("option");
                optionElement.value = dado.id; // Defina o valor do <option>
                optionElement.text = dado.setor; // Defina o texto do <option>
                selectElement.appendChild(optionElement);
            });
        }

        var selectElementCargo = document.getElementById("cargo");
        if(selectElementCargo){
            var dadosCargo = res.cargo;
            // Adicione novas opções ao <select> do setor
            dadosCargo.forEach(function(dado) {
                var optionElement = document.createElement("option");
                optionElement.value = dado.id; // Defina o valor do <option>
                optionElement.text = dado.cargo; // Defina o texto do <option>
                selectElementCargo.appendChild(optionElement);
            });
        }

        var selectElementCD = document.getElementById("local");

        if(selectElementCD){
            var dadosCD= res.cd;
            // Adicione novas opções ao <select> do setor
            dadosCD.forEach(function(dado) {
                var optionElement = document.createElement("option");
                optionElement.value = dado.cd; // Defina o valor do <option>
                optionElement.text = dado.cd; // Defina o texto do <option>
                selectElementCD.appendChild(optionElement);
            });
        }
    })
}

setorCargo();

function removerAcentos(texto) {
    const mapaAcentos = {
    '&Aacute;': 'Á',
    '&aacute;': 'á',
    '&Acirc;': 'Â',
    '&acirc;': 'â',
    '&Agrave;': 'À',
    '&agrave;': 'à',
    '&Aring;': 'Å',
    '&aring;': 'å',
    '&Atilde;': 'Ã',
    '&atilde;': 'ã',
    '&Auml;': 'Ä',
    '&auml;': 'ä',
    '&AElig;': 'Æ',
    '&aelig;': 'æ',
    '&Eacute;': 'É',
    '&eacute;': 'é',
    '&Ecirc;': 'Ê',
    '&ecirc;': 'ê',
    '&Egrave;': 'È',
    '&egrave;': 'è',
    '&Euml;': 'Ë',
    '&euml;': 'ë',
    '&ETH;': 'Ð',
    '&eth;': 'ð',
    '&Iacute;': 'Í',
    '&iacute;': 'í',
    '&Icirc;': 'Î',
    '&icirc;': 'î',
    '&Igrave;': 'Ì',
    '&igrave;': 'ì',
    '&Iuml;': 'Ï',
    '&iuml;': 'ï',
    '&Oacute;': 'Ó',
    '&oacute;': 'ó',
    '&Ocirc;': 'Ô',
    '&ocirc;': 'ô',
    '&Ograve;': 'Ò',
    '&ograve;': 'ò',
    '&Oslash;': 'Ø',
    '&oslash;': 'ø',
    '&Otilde;': 'Õ',
    '&otilde;': 'õ',
    '&Ouml;': 'Ö',
    '&ouml;': 'ö',
    '&Uacute;': 'Ú',
    '&uacute;': 'ú',
    '&Ucirc;': 'Û',
    '&ucirc;': 'û',
    '&Ugrave;': 'Ù',
    '&ugrave;': 'ù',
    '&Uuml;': 'Ü',
    '&uuml;': 'ü',
    '&Ccedil;': 'Ç',
    '&ccedil;': 'ç',
    '&Ntilde;': 'Ñ',
    '&ntilde;': 'ñ',
    '&Yacute;': 'Ý',
    '&yacute;': 'ý',
    '&quot;': '"',
    '&lt;': '<',
    '&gt;': '>',
    '&amp;': '&',
    '&reg;': '®',
    '&copy;': '©',
    '&THORN;': 'Þ',
    '&thorn;': 'þ',
    '&szlig;': 'ß'
    };

    return texto.replace(/&[^\s;]+;/g, function(match) {
    return mapaAcentos[match] || match;
    });
}


let lemLogin=()=>{
    let Check=document.querySelector("#flexSwitchCheckReverse");
    let username=document.querySelector('#email').value;
    let password=document.querySelector('#senha').value;
    if(Check.checked){
        var loginData = {
            username: username,
            password: password
        };
        localStorage.setItem("loginData", JSON.stringify(loginData));
    }
}

let DadosLogin=()=>{
    let username=document.querySelector('#email');
    let password=document.querySelector('#senha');
    if(username){
        let localData=localStorage.getItem("loginData");
        if(localData){
            let Check=document.querySelector("#flexSwitchCheckReverse");
            Check.checked=true;
            dados= JSON.parse(localData);
            username.value = dados.username;
            password.value = dados.password;
        }
    }
}

let localData=document.getElementById('flexSwitchCheckReverse');

if(localData !== null){
    DadosLogin();
}
