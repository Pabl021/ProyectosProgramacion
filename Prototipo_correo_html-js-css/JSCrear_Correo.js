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


//encargado de guardarme la info de los correos 
//temporales que cambian de diferente html dependiendo de cierto tiempo
var tempCor = localStorage.getItem("tempCorreos");
tempCor = JSON.parse(tempCor);
var sesion = [];
if (tempCor === null || tempCor.length===0) {
    tempCor = [];
}
else{
var borrar=[];
var ded = JSON.parse(tempCor[0]);
var dest=ded.destino;

 setTimeout(function(){ 
    
    buzSal[ded.correo-1] = JSON.stringify({
        remitente: ded.remitente,
        nomUsu: ded.nomUsu,
        destino: ded.destino,
        asunto: ded.asunto,
        mensaje: ded.mensaje,
        fecha: ded.fecha,
        enviado:true
      });
      localStorage.setItem("usuarioCorreos", JSON.stringify(buzSal));
      tempCor.splice(0,1);
      localStorage.setItem("tempCorreos", JSON.stringify(tempCor));
      $("#tablaE tbody").remove();
      alertaMod("¡El correo destinado a: "+dest+" fue enviado exitosamente!","info");
},15000);
}

var buzSal = localStorage.getItem("usuarioCorreos");
buzSal = JSON.parse(buzSal);
var sesion = [];
if (buzSal === null) {
    buzSal = [];
}


//valida que los datos no se encuentren vacios 
//a la hora de enviar un correo
function validarDatosEnviarCorreo() {

    dest = document.getElementById("destino").value;

    if (document.getElementById("destino").value == 0) {
        alertaMod("¡El destinatario no puede estar vacío!","danger");
        document.getElementById("destino").value = "";
        document.getElementById("destino").focus();
        return false;
    } else if (!(/^([\da-z_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/.test(dest))) {
        alertaMod("¡El correo es inválido!","danger");      
        document.getElementById("destino").value = "";
        document.getElementById("destino").focus();
    } else if (document.getElementById("asunto").value == 0) {
        alertaMod("¡El asunto no puede estar vacío!","danger");       
        document.getElementById("asunto").value = "";
        document.getElementById("asunto").focus();
    } else if (document.getElementById("info").value == 0) {
        alertaMod("¡El contenido no puede estar vacío!","danger");
        
        document.getElementById("info").value = "";
        document.getElementById("info").focus();
    } else {
        guardarCorreo();
        window.location.replace("Principal.html");
    }

}

//se encarga de guardarme el correo redactado  con sus diferentes atributos
function guardarCorreo() {

    per = JSON.parse(localStorage.getItem("usuLog"));
    var usuario = per.usuario;
    var destino = document.getElementById("destino").value;
    var asunto = document.getElementById("asunto").value;
    var mensaje = document.getElementById("info").value;
    var remitente = per.correo;
   

    var hoy = new Date();
    var dd = hoy.getDate();
    var mm = hoy.getMonth() + 1;
    var yyyy = hoy.getFullYear();
    hoy = dd + '/' + mm + '/' + yyyy;
    console.log(hoy);

    if (destino != "" && asunto != "" && mensaje != "") {
        var info = JSON.stringify({
            remitente: remitente,
            nomUsu: usuario,
            destino: destino,
            asunto: asunto,
            mensaje: mensaje,
            fecha: hoy,
            enviado:false

        });

        buzSal.push(info);
        localStorage.setItem("usuarioCorreos", JSON.stringify(buzSal));
        var id=buzSal.length;
        
        var temp=JSON.stringify({
            remitente: remitente,
            nomUsu: usuario,
            destino: destino,
            asunto: asunto,
            mensaje: mensaje,
            fecha: hoy,
            enviado:false,
            correo: id,
        });
        tempCor.push(temp);
        localStorage.setItem("tempCorreos", JSON.stringify(tempCor));

        alertaMod("¡Correo en proceso de envio!","info");
        location.href = 'Principal.html';
    }
}
