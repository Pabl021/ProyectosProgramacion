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



var carRec = localStorage.getItem("correosRecibidos");
carRec = JSON.parse(carRec);

var sesion = [];
if (carRec === null) {
    carRec = [];
}

//se encuentran los correos recibidos que se encuentran quemados en el sistema
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

//encargada de cargarme las tablas de los correos principales
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

//me muestra los datos en la tabla en cada row dependiendo de la 
//cantidad de datos, aparte me agrega los botonespara las diferentes funciones
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
        alertaMod("¡No cuentas con mensajes en esta sección!","danger"); 
        
    }
    
}

//encargado de mostrarme en el popup la informacion
// cuando se seleciona el ojo refiriendose a ver la info del correo
function loadCorPri(idP) {
    var dilon=JSON.stringify(carRec[idP]);
      var noop = JSON.parse(dilon);
      $("#misdatosPri").empty();
      $("#misdatosPri").append(
          " <h4>Destinatario: "+noop.destino+"</h4>",
          " <h4>Mensaje: "+noop.mensaje+"</h4>",
          " <h4>Fecha: "+noop.fecha+"</h4>"      
      );
  }

//encargado de eliminarme el correo
  function deleted(numero){
  
    //console.log(numero);
    Eliminarcore(numero);
    cargarTablaRecibidos();
    cargarTablaPrincipal();
        
}

// funcion que verifica el correo que debe elimnar 
function Eliminarcore(e){
    var est=confirm("Desea eliminar el correo?");
    if(est){
    carRec.splice(e,1); 
    localStorage.setItem("correosRecibidos", JSON.stringify(carRec));
    }
  }

//funcion de eliminar cuando se seleciona el boton
$(".btnEliminar").bind("click", function(){
    alertaMod("¿Desea eliminar este correo?","danger"); 
   
    indice_selecionado = $(this).attr("id"); 
    //console.log(indice_selecionado);
    //console.log(this);
    Eliminar(indice_selecionado); 
    cargarTablaRecibidos();
    cargarTablaPrincipal();
});


//funcion encargada de cargarme la tabla de los correos recibidos
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

//encargarme de cargas los datos en la tabla junto con sus diferentes 
//botondes dependiendo de los row que s encuentran en el arreglo
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
        alertaMod("¡No cuentas con mensajes en esta sección!","danger"); 
        
    }
}

//encargado de mostrarme la info en el popup cuando se desea ver que contiene este
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


