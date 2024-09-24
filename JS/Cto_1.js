function enviarMensaje(event) {
    var nombre = document.getElementById('nombre').value.trim();
    var email = document.getElementById('email').value.trim();
    var mensaje = document.getElementById('mensaje').value.trim();

    if (nombre === '' || email === '' || mensaje === '') {
        alert('Por favor, completa todos los campos antes de enviar el formulario.');
        event.preventDefault(); 
        return;
    }

    var emailRegex = /^[^\s@]+@[^\s@]+\.[a-zA-Z]{2,}$/;
    if (!emailRegex.test(email)) {
        alert('Por favor, ingresa un correo electrónico válido.');
        event.preventDefault(); 
        return;
    }
}


function reservarAhora(event) {
    var nombre = document.getElementById('nombre').value.trim(); 
    var email = document.getElementById('email').value.trim();
    var fecha = document.getElementById('fecha').value;
    var hora = document.getElementById('hora').value; 
    var personas = document.getElementById('personas').value;

    var hoy = new Date().toISOString().split('T')[0];
    document.getElementById('fecha').setAttribute('min', hoy);
 
    if (nombre === '' || email === '' || fecha === '' || hora === '' || personas === '') {
        alert('Por favor, completa todos los campos antes de enviar el formulario.');
        event.preventDefault(); 
        return;
    }

    var emailRegex = /^[^\s@]+@[^\s@]+\.[a-zA-Z]{2,}$/;
    if (!emailRegex.test(email)) {
        alert('Por favor, ingresa un correo electrónico válido.');
        event.preventDefault();
        return;
    }

    if (fecha < hoy) {
        alert('La fecha debe ser a partir de hoy.');
        event.preventDefault(); 
        return;
    }
}