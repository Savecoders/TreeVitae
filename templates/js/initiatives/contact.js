function validarFormulario(){
    let esValido = true;
    if(nombreIniciativa.value===""){
        window.alert("Le falta poner el nombre");
        esValido = false;
    }else if(comentario.value===""){
        window.alert("Le falta poner un comentario");
        esValido = false;
    }
}
