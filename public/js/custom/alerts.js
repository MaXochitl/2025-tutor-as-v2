document.addEventListener('DOMContentLoaded', () => {
    const alerts = document.querySelectorAll('.alert');

    alerts.forEach(alert => {
        // transicion suave: solo opacity y transform (GPU-friendly)
        alert.style.transition = 'opacity 0.5s ease, transform 0.5s ease';

        // auto-cierre despues de 10 segundos
        setTimeout(() => closeAlert(alert), 20000);

        // cierre manual con boton "X"
        const closeBtn = alert.querySelector('.btn-close');
        if (closeBtn) {
            closeBtn.addEventListener('click', () => closeAlert(alert));
        }
    });

    // funcion que cierra el alert suavemente
    function closeAlert(alert) {
        alert.style.opacity = '0';
        alert.style.transform = 'translateY(-20px)';
        setTimeout(() => alert.remove(), 500); // eliminar despues de la animacion
    }
});
