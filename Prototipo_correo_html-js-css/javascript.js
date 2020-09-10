
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
      alert("El correo destinado a: "+dest+" fue enviado exitosamente!!");
},15000);
}

var buzSal = localStorage.getItem("usuarioCorreos");
buzSal = JSON.parse(buzSal);
var sesion = [];
if (buzSal === null) {
    buzSal = [];
}

var carRec = localStorage.getItem("correosRecibidos");
carRec = JSON.parse(carRec);

var sesion = [];
if (carRec === null) {
    carRec = [];
}



/*
//se encarga de validarme que las casillas en el formulario 
//no se encuentren vacias a la hora de guardar los datos
function validarDatos() {

    tel = document.getElementById("telefono").value;
    correo = document.getElementById("correo").value;


    if (document.getElementById("nombre").value == 0) {
        alert("El nombre es requerido");
        document.getElementById("nombre").value = "";
        document.getElementById("nombre").focus();
        return false;
    } else if (document.getElementById("apellido").value == 0) {
        alert("El apellido es requerido");
        document.getElementById("apellido").value = "";
        document.getElementById("apellido").focus();
        return false;
    } else if (document.getElementById("telefono").value == 0) {
        alert("El teléfono es requerido");
        document.getElementById("telefono").value = "";
        document.getElementById("telefono").focus();
        return false;

    } else if (!(/^\d{8}$/.test(tel))) {
        alert("El número es inválido");
        document.getElementById("telefono").value = "";
        document.getElementById("telefono").focus();
        return false;
    } else if (!(/^([\da-z_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/.test(correo))) {
        alert("El correo es inválido");
        document.getElementById("correo").value = "";
        document.getElementById("correo").focus();
        return false;
    } else if (document.getElementById("direccion").value == 0) {
        alert("La dirección es requerida");
        document.getElementById("direccion").value = "";
        document.getElementById("direccion").focus();
        return false;
    } else if (document.getElementById("usuario").value == 0) {
        alert("El usuario es requerido");
        document.getElementById("usuario").value = "";
        document.getElementById("usuario").focus();
        return false;
    } else if (document.getElementById("contra").value == 0) {
        alert("La contraseña es requerida");
        document.getElementById("contra").value = "";
        document.getElementById("contra").focus();
        return false;
    } else {
        return true;
    }

}
*/

/*
//valida que los datos del login no se encuentren vacios 
function validarDatosLogin() {

    if (document.getElementById("usuarioLog").value == 0) {
        //alert("Digite su usuario");
        abrirpopup("Digite su usuario");
        document.getElementById("usuarioLog").value = "";
        document.getElementById("usuarioLog").focus();
        return false;
    } else if (document.getElementById("contraseña").value == 0) {
        alert("Digite su contraseña");
        document.getElementById("contraseña").value = "";
        document.getElementById("contraseña").focus();
        return false;
    }

}
*/

/*
//valida que los datos no se encuentren vacios 
//a la hora de enviar un correo
function validarDatosEnviarCorreo() {

    dest = document.getElementById("destino").value;

    if (document.getElementById("destino").value == 0) {
        alert("El destinatario no puede estar vacío");
        document.getElementById("destino").value = "";
        document.getElementById("destino").focus();
        return false;
    } else if (!(/^([\da-z_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/.test(dest))) {
        alert("El correo es inválido");
        document.getElementById("destino").value = "";
        document.getElementById("destino").focus();
    } else if (document.getElementById("asunto").value == 0) {
        alert("El asunto no puede estar vacío");
        document.getElementById("asunto").value = "";
        document.getElementById("asunto").focus();
    } else if (document.getElementById("info").value == 0) {
        alert("El contenido no puede estar vacío");
        document.getElementById("info").value = "";
        document.getElementById("info").focus();
    } else {
        guardarCorreo();
        window.location.replace("Principal.html");
    }

}
*/
/*
function capturarDatos() {

    var nomb = document.getElementById("nombre").value;
    var ape = document.getElementById("apellido").value;
    var tel = document.getElementById("telefono").value;
    var cor = document.getElementById("correo").value;
    var dir = document.getElementById("direccion").value;
    var usu = document.getElementById("usuario").value;
    var cont = document.getElementById("contra").value;

    if (validarDatos()) {

        let persona = {
            nom: nomb,
            apellido: ape,
            telefono: tel,
            correo: cor,
            direccion: dir,
            usuario: usu,
            contra: cont
        };

        registrados = localStorage.getItem("usuariosReg");
        let infoUsu;
        if (registrados) {
            infoUsu = JSON.parse(registrados);
            infoUsu.registrados = [...infoUsu.registrados, persona];

        } else {

            infoUsu = { registrados: [persona] }
        }
        localStorage.setItem("usuariosReg", JSON.stringify(infoUsu));
        alert("¡Su cuenta ha sido guardada exitosamente!");
        location.href = 'Login.html';
    }

}

*/

/*
function preguntarDatos() {

    var u = document.getElementById("usuarioLog").value;
    var pass = document.getElementById("contraseña").value;
    if (u != "" && pass != "") {
        valDatosLog(u, pass);
    }
}

function preUsuario(u) {
    let us = JSON.parse(localStorage.getItem("usuariosReg"));

    console.log(us);
    return us;
}


function valDatosLog(u, pass) {
    var us = preUsuario(u);
    if (us != null) {

        let usuSystem = us.registrados.find((user) => user.usuario === u && user.contra === pass);

        if (usuSystem) {

            localStorage.setItem("usuLog", JSON.stringify(usuSystem));

            location.href = 'Principal.html';

            var userName = document.getElementById('usuarioLog');
            alert("Bienvenid@ " + userName.value);

        } else {
            limpiar();
            alert("Usuario o contraseña incorrecta");
        }
    } else if (us === null) {
        limpiar();
        alert("¡No tienes una cuenta disponible!\nTe invitamos a crear una");


    } else {
        limpiar();
        alert("Usuario o contraseña incorrecta");

    }
}

function limpiar() {
    document.getElementById("usuarioLog").value = "";
    document.getElementById("contraseña").value = "";
}
*/

/*
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
            correo: id
        });
        tempCor.push(temp);
        localStorage.setItem("tempCorreos", JSON.stringify(tempCor));

        alert("¡correo guardado!");
        location.href = 'Principal.html';
    }
}
*/


function correosRecibidos() {

    let persona1 = [{
        remitente: "david45@gmail.com",
        nomUsu: "david45",
        destino: "matias@gmail.com",
        asunto: "viaje",
        mensaje: "excursion a la playa en semana santa",
        fecha: "10/4/2020"
    },
    {
        remitente: "david45@gmail.com",
        nomUsu: "david45",
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

/*
function cargarEnviados() {
    var correoU = localStorage.getItem("usuarioCorreos");
    correoU = JSON.parse(correoU);

    var sesion = [];
    if (correoU === null) {
        correoU = [];
    }

    var userN = JSON.parse(localStorage.getItem('usuLog'));
    var ULog = userN.usuario;
    var corLog = correoU.nomUsu;

    if (correoU) {
        let valCor = JSON.parse(correoU);
        for (var i = 0; i < valCor.correoU.length; i++) {
            if (valCor.correoU[i].nomUsu == ULog) {
                var tbody = document.querySelector('#tablaE tbody');

                for (var i = 0; i < corrRec.correoU.length; i++) {

                    var row = tbody.insertRow(i);
                    var destino = row.insertCell(0);
                    var msj = row.insertCell(1);
                    var fecha = row.insertCell(2);

                    destino.innerHTML = corrRec.correoU[i].destino;
                    msj.innerHTML = corrRec.correoU[i].mensaje;
                    fecha.innerHTML = corrRec.correoU[i].fecha;
                    
                }
            }
        }
    }
}
*/
/*
function cargarTablaEnviados() {

    var userN = JSON.parse(localStorage.getItem('usuLog'));
    var ULog = userN.usuario;
    $("#datarow").html("");
    var con = 0;
    for (var i in buzSal) {
        var d = JSON.parse(buzSal[i]);

       
        if(!d.enviado){
        if (d.nomUsu == ULog) {
            con += 1;

            var tbody = document.querySelector('#tablaE tbody');

            $("#datarowEnv").append(
                "<tr>" +
                "<td>" + d.destino + "</td>" +
                "<td>" + d.mensaje + "</td>" +
                "<td>" + d.fecha + "</td>" +
                "<th><a   onclick=' loadCorBE("+i+") ' data-toggle='modal' data-target='#basicExampleModal' >👁️</a></th>" +
                "<th><a idbs='" + i + "' class='btnBS' href='#' onclick='deletedBS("+i+")' >🗑️</a></th>" +
                "<th><a  href='#'>✏️</a></th>" +
                "</tr>"
            );

        }
    }
       
    }
    if (con == 0) {
        alert("no cuentas con mensajes en esta seccion");
    }
}
*/
/*
function cargarRecibidosPrincipal() {
    var correoUs = localStorage.getItem("correosRecibidos");
    correoUs = JSON.parse(correoUs);

    var sesion = [];
    if (correoUs === null) {
        correoUs = [];
    }

    var userN = JSON.parse(localStorage.getItem('usuLog'));
    var ULog = userN.usuario;
    var corLog = correoUs.nomUsu;

    if (correoUs) {
        let valCor = JSON.parse(correoUs);
        for (var i = 0; i < valCor.correoUs.length; i++) {
            if (valCor.correoUs[i].nomUsu == ULog) {
                var tbody = document.querySelector('#tablaPrincipal tbody');

                for (var i = 0; i < corrRec.correoUs.length; i++) {

                    var row = tbody.insertRow(i);
                    var destino = row.insertCell(0);
                    var msj = row.insertCell(1);
                    var fecha = row.insertCell(2);



                    destino.innerHTML = corrRec.correoUs[i].destino;
                    msj.innerHTML = corrRec.correoUs[i].mensaje;
                    fecha.innerHTML = corrRec.correoUs[i].fecha;
                }
            }
        }
    }
}
function cargarTablaPrincipal() {

    var correoUs = localStorage.getItem("correosRecibidos");
    correoUs = JSON.parse(correoUs);
    var userN = JSON.parse(localStorage.getItem('usuLog'));
    var ULog = userN.usuario;
    $("#datarowPrincipal").html("");
    for (var i in carRec) {

        var s=JSON.stringify(carRec[i]);
        var d = JSON.parse(s);
        
        var con = 0;

        if (d.nomUsu == ULog) {
            console.log(i);
            con += 1;
            var tbody = document.querySelector('#tablaPrincipal tbody');
               
            $("#datarowPrincipal").append(
                "<tr>" +
                "<td>" + d.destino + "</td>" +                
                "<td>" + d.mensaje + "</td>" +
                "<td>" + d.fecha + "</td>" +
                "<th><a   onclick=' loadCorPri("+i+") ' data-toggle='modal' data-target='#basicExampleModal' >👁️</a></th>" +
                "<th><a id='" + i + "' class='btnEliminar' href='#' onclick='deleted("+i+")' >🗑️</a></th>" +
                "</tr>"
            );

        }

    }
    if (con == 0) {
        alert("no cuentas con mensajes en esta seccion");
    }
}
*/

/*
function cargarEnviadosTrue() {
    var correoU = localStorage.getItem("usuarioCorreos");
    correoU = JSON.parse(correoU);

    var sesion = [];
    if (correoU === null) {
        correoU = [];
    }

    var userN = JSON.parse(localStorage.getItem('usuLog'));
    var ULog = userN.usuario;
    var corLog = correoU.nomUsu;

    if (correoU) {
        let valCor = JSON.parse(correoU);
        for (var i = 0; i < valCor.correoU.length; i++) {
            if (valCor.correoU[i].nomUsu == ULog) {
                var tbody = document.querySelector('#tablaEnvListo tbody');

                for (var i = 0; i < corrRec.correoU.length; i++) {

                    var row = tbody.insertRow(i);
                    var destino = row.insertCell(0);
                    var msj = row.insertCell(1);
                    var fecha = row.insertCell(2);

                    destino.innerHTML = corrRec.correoU[i].destino;
                    msj.innerHTML = corrRec.correoU[i].mensaje;
                    fecha.innerHTML = corrRec.correoU[i].fecha;
                    
                }
            }
        }
    }
}


function cargarTablaTrue() {
    
    var userN = JSON.parse(localStorage.getItem('usuLog'));
    var ULog = userN.usuario;

    
  
    $("#datarowE").html("");
    for (var i in buzSal) {
        var d = JSON.parse(buzSal[i]);

        var con = 0;
        if(d.enviado){          //añadi aqui
        if (d.nomUsu == ULog) {
            con += 1;
            var tbody = document.querySelector('#tablaEnvListo tbody');
            var tar=d.destino;
            var gin=`esta es la ruta ${tar}`
            $("#datarowE").append(
                "<tr>" +
                "<td>" + d.destino + "</td>" +
                "<td>" + d.mensaje + "</td>" +
                "<td>" + d.fecha + "</td>" +
                "<th><a   onclick='loadCorEnv("+i+")' data-toggle='modal' data-target='#basicExampleModal' >👁️</a></th>" +
                "<th><a id='" + i + "' class='btnEliminarEnv' href='#' onclick='deletedEnv("+i+")' >🗑️</a></th>" +
                "</tr>"
            );

        }
    
        
    }
    
    }
    if (con == 0) {
        alert("no cuentas con mensajes en esta seccion");
    }
}

*/






/*
function cargarRecibidos() {
    var correoUs = localStorage.getItem("correosRecibidos");
    correoUs = JSON.parse(correoUs);

    var sesion = [];
    if (correoUs === null) {
        correoUs = [];
    }

    var userN = JSON.parse(localStorage.getItem('usuLog'));
    var ULog = userN.usuario;
    var corLog = correoUs.nomUsu;

    if (correoUs) {
        let valCor = JSON.parse(correoUs);
        for (var i = 0; i < valCor.correoUs.length; i++) {
            if (valCor.correoUs[i].nomUsu == ULog) {
                var tbody = document.querySelector('#tablaR tbody');

                for (var i = 0; i < corrRec.correoUs.length; i++) {

                    var row = tbody.insertRow(i);
                    var destino = row.insertCell(0);
                    var msj = row.insertCell(1);
                    var fecha = row.insertCell(2);



                    destino.innerHTML = corrRec.correoUs[i].destino;
                    msj.innerHTML = corrRec.correoUs[i].mensaje;
                    fecha.innerHTML = corrRec.correoUs[i].fecha;
                }
            }
        }
    }
}


function cargarTablaRecibidos() {

    var correoUs = localStorage.getItem("correosRecibidos");
    correoUs = JSON.parse(correoUs);
    var userN = JSON.parse(localStorage.getItem('usuLog'));
    var ULog = userN.usuario;
    $("#datarow").html("");
    for (var i in carRec) {

        var s=JSON.stringify(carRec[i]);
        var d = JSON.parse(s);
        
        var con = 0;

        if (d.nomUsu == ULog) {
            console.log(i);
            con += 1;
            var tbody = document.querySelector('#tablaR tbody');
               
            $("#datarow").append(
                "<tr>" +
                "<td>" + d.destino + "</td>" +
                
                "<td>" + d.mensaje + "</td>" +
                "<td>" + d.fecha + "</td>" +
                "<th><a   onclick='loadCor("+i+") ' data-toggle='modal' data-target='#basicExampleModal' >👁️</a></th>" +
                "<th><a id='" + i + "' class='btnEliminar' href='#' onclick='deleted("+i+")' >🗑️</a></th>" +
                "</tr>"
            );

        }

    }
    if (con == 0) {
        alert("no cuentas con mensajes en esta seccion");
    }
}

*/


/*
function loadCor(id) {
  var dilon=JSON.stringify(carRec[id]);
    var noop = JSON.parse(dilon);
    console.log(noop);
    $("#misdatos").empty();
    $("#misdatos").append(
        " <h4>"+"Destinatario: "+noop.destino+"</h4>",
        " <h4>"+"Mensaje: "+noop.mensaje+"</h4>",
        " <h4>"+"Fecha: "+noop.fecha+"</h4>"      
    );
}
*/

/*
function loadCorPri(idP) {
    var dilon=JSON.stringify(carRec[idP]);
      var noop = JSON.parse(dilon);
      $("#misdatosPri").empty();
      $("#misdatosPri").append(
          " <h4>Destinatario: "+noop.destino+"</h4>",       ya
          " <h4>Mensaje: "+noop.mensaje+"</h4>",
          " <h4>Fecha: "+noop.fecha+"</h4>"      
      );
  }
*/
  
/*
  function loadCorBE(id) {
     
    var dilon=JSON.stringify(tempCor[id]);
      var no = JSON.parse(dilon);
      var noop= JSON.parse(no);
      $("#datBE").empty();
      $("#datBE").append(
          " <h4>"+"Destinatario: "+noop.destino+"</h4>",
          " <h4>"+"Mensaje: "+noop.mensaje+"</h4>",
          " <h4>"+"Fecha: "+noop.fecha+"</h4>"      
      );
  }
*/


   
   /*
  function loadCorEnv(info) {
   var dilon=JSON.stringify(buzSal[info]);
   var info = JSON.parse(dilon);
   var infoPar= JSON.parse(info);
   
      $("#datTrue").empty();
      $("#datTrue").append(
          " <h4>"+"Destinatario: "+infoPar.destino+"</h4>",
          " <h4>"+"Mensaje: "+infoPar.mensaje+"</h4>",
          " <h4>"+"Fecha: "+infoPar.fecha+"</h4>"      
      );
  }
*/





/*
function deleted(numero){
  
    console.log(numero);
    Eliminarcore(numero);
    cargarTablaRecibidos();
    cargarTablaPrincipal();
        
}

function Eliminarcore(e){
    var est=confirm("Desea eliminar el correo?");
    if(est){
    carRec.splice(e,1); 
    localStorage.setItem("correosRecibidos", JSON.stringify(carRec));
    }
  }


$(".btnEliminar").bind("click", function(){
   
    alert("¿ Desea eliminar el correo ?");
    indice_selecionado = $(this).attr("id"); 
    console.log(indice_selecionado);
    console.log(this);
    Eliminar(indice_selecionado); 
    cargarTablaRecibidos()
    cargarTablaPrincipal();
});

*/

/*
function deletedEnv(numero){
    EliminarcoreEnv(numero);
    cargarTablaTrue();      
}

function EliminarcoreEnv(e){
    var est=confirm("Desea eliminar el correo?");
    if(est){
    buzSal.splice(e,1); 
    localStorage.setItem("usuarioCorreos", JSON.stringify(buzSal));
    }
  }


$(".btnEliTru").bind("click", function(){ 
    alert("¿ Desea eliminar el correo ?");
    indice_selecionado = $(this).attr("idTr");    
    Eliminar(indice_selecionado); 
    cargarTablaTrue();
});
*/

/*
function deletedEnv(numero){
  
    console.log(numero);
    EliminarEnv(numero);
    cargarTablaTrue();
        
}

function EliminarEnv(e){
    var est=confirm("Desea eliminar el correo?");
    if(est){
        tempCor.splice(e,1); 
        localStorage.setItem("tempCorreos", JSON.stringify(tempCor));
    }
  }


$(".btnEliminarEnv").bind("click", function(){
   
    alert("¿ Desea eliminar el correo ?");
    indice_selecionado = $(this).attr("id"); 
    console.log(indice_selecionado);
    console.log(this);
    Eliminar(indice_selecionado); 
    cargarTablaTrue();
});
*/