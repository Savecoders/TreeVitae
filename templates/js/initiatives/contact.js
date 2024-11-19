function validarFormulario(){
    let esValido = true;
    const validacion = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/;

    if(nombres.value===""){
        window.alert("Les falta poner sus nombres.");
        esValido = false;
    }else if (nombres.value.length < 3) {
        window.alert("Los nombres deben tener más de 3 caracteres.");
        esValido = false;
    }else if (!validacion.test(nombres.value)) {
        window.alert("Los nombres solo deben contener letras y espacios.");
        esValido = false;
    }else if (apellidos.value==="") {
        window.alert("Les falta poner sus apellidos.");
        esValido = false;
    }else if (apellidos.value.length < 3) {
        window.alert("Los apellidos deben tener más de 3 caracteres.");
        esValido = false;
    }else if (!validacion.test(apellidos.value)) {
        window.alert("Los apellidos solo deben contener letras y espacios.");
        esValido = false;
    }else if (telefono.value==="") {
        window.alert("Le falta poner su telefono.");
        esValido = false;
    }else if (telefono.value.length !== 10 || !/^\d+$/.test(telefono.value)) {
        window.alert("El número telefónico debe tener exactamente 10 dígitos.");
        esValido = false;
    }else if(nensaje.value===""){
        window.alert("Le falta poner un mensaje.");
        esValido = false;
    }
    return esValido;
}
