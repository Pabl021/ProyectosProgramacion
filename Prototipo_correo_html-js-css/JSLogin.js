//funcion encargada de implementarme bootstrap en las alertas dependiendo del color que desee
function alertaMod(mensaje,color){
    $("#myAlert").empty();
var newAlert=`<div class="alert alert-${color} alert-dismissible fade show" role="alert">
  ${mensaje}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>`;
$("#myAlert").append(newAlert);
setTimeout(function(){
    $("#myAlert").empty();

    }, 3000);
}

//valida que los datos del login no se encuentren vacios 
function validarDatosLogin() {

    if (document.getElementById("usuarioLog").value == 0) {
        alertaMod("¡Digite su usuario!","danger");       
        document.getElementById("usuarioLog").value = "";
        document.getElementById("usuarioLog").focus();
        return false;
    } else if (document.getElementById("contraseña").value == 0) {
        alertaMod("¡Digite su contraseña!","danger");
        document.getElementById("contraseña").value = "";
        document.getElementById("contraseña").focus();
        return false;
    }

}


var carRec = localStorage.getItem("correosRecibidos");
carRec = JSON.parse(carRec);

var sesion = [];
if (carRec === null) {
    carRec = [];
}

//en esta se encuentran quemados en el local storage los datos 
//de los correos entrantes 
function correosRecibidos() {

    let persona1 = [{
        remitente: "josepablobc21@gmail.com",
        nomUsu: "pabl021",
        destino: "matias@gmail.com",
        asunto: "viaje",
        mensaje: "excursion a la playa en semana santa",
        fecha: "10/4/2020"
    },
    {
        remitente: "josepablobc21@gmail.com",
        nomUsu: "pabl021",
        destino: "julian@gmail.com",
        asunto: "navidad2020",
        mensaje: "venta de arboles navideños a domicilio",
        fecha: "20/4/2020"
    },
    {
        remitente: "josepablobc21@gmail.com",
        nomUsu: "pabl021",
        destino: "esteban@gmail.com",
        asunto: "rally",
        mensaje: "invitación al rally en la fortuna de SC",
        fecha: "2/4/2020"
    },
    {
        remitente: "josepablobc21@gmail.com",
        nomUsu: "pabl021",
        destino: "maria@gmail.com",
        asunto: "IMAS",
        mensaje: "su solicitud de beca ha sido aceptada",
        fecha: "2/4/2020"
    }
    ];

    localStorage.setItem('correosRecibidos', JSON.stringify(persona1));
}


//se encarga de reficarme si en el login se encuentran datos pra inicar
function preguntarDatos() {

    var u = document.getElementById("usuarioLog").value;
    var pass = document.getElementById("contraseña").value;
    if (u != "" && pass != "") {
        valDatosLog(u, pass);
    }
}

//me obtene el usuario logueado en ese momento
function preUsuario(u) {
    let us = JSON.parse(localStorage.getItem("usuariosReg"));

    console.log(us);
    return us;
}

//se encarga de revisar que los datos esten en el sistema 
//o si las contraseñas no coinciden para iniciar sesión
function valDatosLog(u, pass) {
    var us = preUsuario(u);
    if (us != null) {

        let usuSystem = us.registrados.find((user) => user.usuario === u && user.contra === pass);

        if (usuSystem) {

            localStorage.setItem("usuLog", JSON.stringify(usuSystem));

            location.href = 'Principal.html';

            var userName = document.getElementById('usuarioLog');
            alertaMod("Bienvenid@ " + userName.value,"info");
            

        } else {
            limpiar();
            alertaMod("¡Usuario o contraseña incorrecta!","danger");
            
        }
    } else if (us === null) {
        limpiar();
        alertaMod("¡No te encuentras registrado en el sistema!","danger")
        


    } else {
        limpiar();
        alertMod("¡Usuario o contraseña incorrecta!","danger")     

    }
}

//me limpia los txt de la información errorea
function limpiar() {
    document.getElementById("usuarioLog").value = "";
    document.getElementById("contraseña").value = "";
}
