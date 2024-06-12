document.addEventListener('DOMContentLoaded', () => {
    const nombreInput = document.getElementById('nombre');
    const pesoInput = document.getElementById('peso');

    nombreInput.addEventListener('input', () => {
        if (!/^[a-zA-Z\s]*$/.test(nombreInput.value)) {
            alert('El nombre del electrodoméstico solo puede contener letras.');
            nombreInput.value = nombreInput.value.replace(/[^a-zA-Z\s]/g, '');
        }
    });

    pesoInput.addEventListener('input', () => {
        if (!/^\d*\.?\d*$/.test(pesoInput.value)) {
            alert('El peso solo puede contener números.');
            pesoInput.value = pesoInput.value.replace(/[^\d\.]/g, '');
        }
    });
});