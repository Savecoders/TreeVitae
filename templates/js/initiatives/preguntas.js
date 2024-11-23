document.addEventListener('DOMContentLoaded', function() {
    const pregunta = document.querySelectorAll('details');
    pregunta.forEach(detalle => {
        detalle.addEventListener('toggle', function() {
            if (this.open) {
                pregunta.forEach(cerrarPreguntas => {
                    if (cerrarPreguntas !== this && cerrarPreguntas.open) {
                        cerrarPreguntas.open = false;
                    }
                });
            } 
        });
    });

    pregunta.forEach(detalle => {
        const summary = detalle.querySelector('summary');
        const contenidoRepuesta = detalle.querySelector('.answer__question');
        
        summary.addEventListener('click', function() {
            if (!detalle.open) {
                contenidoRepuesta.style.maxHeight = '0px';
            } else {
                contenidoRepuesta.style.maxHeight = `${contenidoRepuesta.scrollHeight}px`;
            }
        });
        
        detalle.addEventListener('toggle', function() {
            if (this.open) {
                setTimeout(() => {
                    contenidoRepuesta.style.maxHeight = `${contenidoRepuesta.scrollHeight}px`;
                }, 10);
            } else {
                contenidoRepuesta.style.maxHeight = '0px';
            }
        });
    });
});