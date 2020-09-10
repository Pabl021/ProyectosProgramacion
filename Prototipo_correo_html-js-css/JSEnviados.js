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


//encargado de cambiarme los correos a enviados cuando 
//paso el tiempo y el cambio de variable se encuentra en false
var tempCor = localStorage.getItem("tempCorreos");
tempCor = JSON.parse(tempCor);
var sesion = [];
if (tempCor === null || tempCor.length === 0) {
    tempCor = [];
}
else {
    var borrar = [];


    setTimeout(function () {
        var ded = JSON.parse(tempCor[0]);
        var dest = ded.destino;
        
        buzSal[ded.correo - 1] = JSON.stringify({
            remitente: ded.remitente,
            nomUsu: ded.nomUsu,
            destino: ded.destino,
            asunto: ded.asunto,
            mensaje: ded.mensaje,
            fecha: ded.fecha,
            enviado: true
        });
        localStorage.setItem("usuarioCorreos", JSON.stringify(buzSal));
        tempCor.splice(0, 1);
        localStorage.setItem("tempCorreos", JSON.stringify(tempCor));
        $("#tablaE tbody").remove();
        alertaMod("¡El correo destinado a: " + dest + " fue enviado exitosamente!","info");
        
    }, 30000);
}

var buzSal = localStorage.getItem("usuarioCorreos");
buzSal = JSON.parse(buzSal);
var sesion = [];
if (buzSal === null) {
    buzSal = [];
}

//se encarga de insertarme las filas y columnas de la tabla para mostrar los datos
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

//me carga la tabla con los datos que este encuentra en el local storage y sus respectivos botones
function cargarTablaEnviados() {

    var userN = JSON.parse(localStorage.getItem('usuLog'));
    var ULog = userN.usuario;
    $("#datarow").html("");
    var con = 0;
    for (var i in tempCor) {
        var d = JSON.parse(tempCor[i]);


        if (!d.enviado) {
            if (d.nomUsu == ULog) {
                con += 1;

                var tbody = document.querySelector('#tablaE tbody');

                $("#datarowEnv").append(
                    "<tr>" +
                    "<td>" + d.destino + "</td>" +
                    "<td>" + d.mensaje + "</td>" +
                    "<td>" + d.fecha + "</td>" +
                    "<th><a   onclick='loadBS(" + i + ")' data-toggle='modal' data-target='#basicExampleModal' >👁️</a></th>" +
                    "<th><a idbs='" + i + "' class='btnBS' href='#' onclick='deletedBS(" + i + ")' >🗑️</a></th>" +
                    "<th><a id='" + i + "' href='#'  onclick='editarInfo(" + i + ")' class='btnEditar' data-toggle='modal' data-target='#basicExampleModal'>✏️</a></th>" +
                    "</tr>"
                );

            }
        }

    }
    if (con == 0) {
        alertaMod("¡No cuentas con mensajes en esta sección!","danger");  
        
    }
}



//se ecnarga de insertarme las filas y columnas que más adelante ocuparemos para insertar la información
//que este recolecta del local storage
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

//me muestra la información en la tabla con sus respectivos botones
function cargarTablaTrue() {

    var userN = JSON.parse(localStorage.getItem('usuLog'));
    var ULog = userN.usuario;



    $("#datarowE").html("");
    for (var i in buzSal) {
        var d = JSON.parse(buzSal[i]);

        var con = 0;
        if (d.enviado) {          
            if (d.nomUsu == ULog) {
                con += 1;
                var tbody = document.querySelector('#tablaEnvListo tbody');
                var tar = d.destino;
                var gin = `esta es la ruta ${tar}`
                $("#datarowE").append(
                    "<tr>" +
                    "<td>" + d.destino + "</td>" +
                    "<td>" + d.mensaje + "</td>" +
                    "<td>" + d.fecha + "</td>" +
                    "<th><a   onclick='loadCorEnv(" + i + ")' data-toggle='modal' data-target='#basicExampleModal' >👁️</a></th>" +
                    "<th><a id='" + i + "' class='btnEliminarEnv' href='#' onclick='deletedEnv(" + i + ")' >🗑️</a></th>" +
                    "</tr>"
                );

            }


        }

    }

}

//me carga la información del correo enviado en el popup
// del correo selecionado al presionar el boton del ojo
function loadCorEnv(info) {
    var dilon = JSON.stringify(buzSal[info]);
    var info = JSON.parse(dilon);
    var infoPar = JSON.parse(info);

    $("#datTrue").empty();
    $("#datTrue").append(
        " <h4>" + "Destinatario: " + infoPar.destino + "</h4>",
        " <h4>" + "Mensaje: " + infoPar.mensaje + "</h4>",
        " <h4>" + "Fecha: " + infoPar.fecha + "</h4>"
    );
}

//me carga la información del correo de BS en el popup 
//del correo selecionado al presionar el boton del ojo
function loadBS(info) {

    var dilon = JSON.stringify(tempCor[info]);
    var info = JSON.parse(dilon);
    var infoPar = JSON.parse(info);

    $("#datBE").empty();
    $("#editDiv").empty();

    $("#datBE").append(
        " <h4>" + "Destinatario: " + infoPar.destino + "</h4>",
        " <h4>" + "Mensaje: " + infoPar.mensaje + "</h4>",
        " <h4>" + "Fecha: " + infoPar.fecha + "</h4>"
    );
}

//me elimina la fila del id selecionado y me recarga la tabla
function deletedEnv(numero) {
    EliminarcoreEnv(numero);
    cargarTablaTrue();
}

//me elimina el correo enviado
function EliminarcoreEnv(e) {
    var est = confirm("¿Desea eliminar el correo?");
    if (est) {
        buzSal.splice(e, 1);
        localStorage.setItem("usuarioCorreos", JSON.stringify(buzSal));
    }
}

//me elimna el correo escogido
$(".btnEliTru").bind("click", function () {
    alertaMod("¿Desea eliminar este correo?","danger");    
    indice_selecionado = $(this).attr("idTr");
    Eliminar(indice_selecionado);
    cargarTablaTrue();
});


//elimina el correo del BS y me recarga la tabla
function deletedBS(numero) {
    EliminarBS(numero); 
    cargarTablaEnviados();
    location.reload();
}

//me elimina del lcoal storage el correo del id selecionado
function EliminarBS(e) {
    var est = confirm("¿Desea eliminar el correo?");
    if (est) {
       // console.log("El id es: " + e);
        tempCor.splice(e, 1);
        localStorage.setItem("tempCorreos", JSON.stringify(tempCor));
    }
}

//metodo de jquery para eliminar
$(".btnBS").bind("click", function () {
    alertaMod("¿Desea elimar este correo?","danger");  
    
    indice_selecionado = $(this).attr("idbs");
    Eliminar(indice_selecionado);
    cargarTablaEnviados();
});


//se encarga de cargarme algunos datos que se encuentran en el local storage
function Editar() {
    tempCor[indice_selecionado] = JSON.stringify({
        destino: $("#destino").val(),
        asunto: $("#asunto").val(),
        mensaje: $("mensaje").val(),


    });
    localStorage.setItem("tempCorreos", JSON.stringify(tempCor));
    return true;

}

//me carga los datos en el modal para poder tener accedo a editarlos
// y se validan que no quedan vacios 
function modalEditar(info) {
   
    if (document.getElementById("infoDes").value == 0) {
        alertaMod("¡El destinatario no puede estar vacio!","danger");       
        return false;
    }else if(document.getElementById("infoAsu").value == 0){
        alertaMod("¡El asunto no puede estar vacio!","danger");       
        return false;
    }else if(document.getElementById("infoMsj").value == 0){
        alertaMod("¡El mensaje no puede estar vacio!","danger");       
        return false;
    }
    
    var datos = tempCor[0];
    var dataEnviar = JSON.parse(datos);
    console.log(dataEnviar.correo);
    tempCor[0] = JSON.stringify({
        remitente: dataEnviar.remitente,
        nomUsu: dataEnviar.nomUsu,
        destino: $("#infoDes").val(),
        asunto: $("#infoAsu").val(),
        mensaje: $("#infoMsj").val(),
        fecha: dataEnviar.fecha,
        enviado: dataEnviar.enviado,
        correo: dataEnviar.correo,


    });

    localStorage.setItem("tempCorreos", JSON.stringify(tempCor));
    $("#tablaE tbody").empty();
    cargarTablaEnviados();
}

//los datos son editados y se agregar, me aparecera el boton de editar para guardar los datos
function editarInfo(info) {
 
    $("#editDiv").empty();

    var dilon = JSON.stringify(tempCor[info]);
    var infor = JSON.parse(dilon);
    var infoPar = JSON.parse(infor);

    $("#datBE").empty();
    $("#datBE").append(
        "<input type='text' id='infoDes' class='my-4' value='" + infoPar.destino + "'>",
        "<input type='text' id='infoAsu' class='my-4' value='" + infoPar.asunto + "'>",
        "<input type='text' id='infoMsj' class='my-4' value='" + infoPar.mensaje + "'>",

    );
    $("#editDiv").append(

        "<button type='button' onclick='modalEditar(" + info + ")' id='btnEdi' class='btn btn-primary' data-dismiss='modal'>Editar</button>",

    );



}

