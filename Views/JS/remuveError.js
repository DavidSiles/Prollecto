/*
document.body.addEventListener('click', function() {
    const h3Elements = document.querySelectorAll('h3');
    h3Elements.forEach(function(element) {
        if (element.style.display !== 'none') {
            element.style.display = 'none';
        }
    });
});
*/
document.body.addEventListener('click', function() {
    const h3Elements = document.querySelectorAll('h3');
    // Iterar sobre todos los elementos h3
    h3Elements.forEach(function(element) {
        // Aplicar clase hidden después de 5 segundos
        setTimeout(function() {
            element.classList.add('hidden');
            // Ocultar el elemento después de que la animación termine
            setTimeout(function() {
                element.style.display = 'none';
            }, 1000); // 1 segundo (duración de la animación)
        }, 7000); // 7 segundos
    });
});