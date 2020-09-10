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

// se encrga de validarme que los espacios de texto que tengo
// no se encuentren vacios a la hora de guardar
function validarDatos() {

    tel = document.getElementById("telefono").value;
    correo = document.getElementById("correo").value;


    if (document.getElementById("nombre").value == 0) {
        alertaMod("¡El nombre es requerido!","danger");       
        document.getElementById("nombre").value = "";
        document.getElementById("nombre").focus();
        return false;
    } else if (document.getElementById("apellido").value == 0) {
        alertaMod("¡El apellido es requerido!","danger");
        document.getElementById("apellido").value = "";
        document.getElementById("apellido").focus();
        return false;
    } else if (document.getElementById("telefono").value == 0) {
        alertaMod("¡El teléfono es requerido!","danger");
        document.getElementById("telefono").value = "";
        document.getElementById("telefono").focus();
        return false;

    } else if (!(/^\d{8}$/.test(tel))) {
        alertaMod("¡El número es invalido!","danger");
        document.getElementById("telefono").value = "";
        document.getElementById("telefono").focus();
        return false;
    } else if (!(/^([\da-z_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/.test(correo))) {
        alertaMod("¡El correo es inválido!","danger");
        document.getElementById("correo").value = "";
        document.getElementById("correo").focus();
        return false;
    } else if (document.getElementById("direccion").value == 0) {
        alertaMod("¡La dirección es requerida!","danger");
        document.getElementById("direccion").value = "";
        document.getElementById("direccion").focus();
        return false;
    } else if (document.getElementById("usuario").value == 0) {
        alertaMod("¡El usuario es requerido!","danger");
        document.getElementById("usuario").value = "";
        document.getElementById("usuario").focus();
        return false;
    } else if (document.getElementById("contra").value == 0) {
        alertaMod("¡La contraseña es requerida!","danger");
        document.getElementById("contra").value = "";
        document.getElementById("contra").focus();
        return false;
    } else {
        return true;
    }

}

//encargado de capturarme los datos que se digitaron en la creación de la cuenta y guardarmelos.
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
        alertaMod("¡Su cuenta ha sido guardada exitosamente!","info");
        location.href = 'Login.html';
    }

}

