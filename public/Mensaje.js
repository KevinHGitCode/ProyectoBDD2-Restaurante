class Mensaje {
    /**
     * Muestra un mensaje emergente de éxito o error.
     * @param {boolean} exito - Indica si el mensaje es de éxito (true) o de error (false).
     * @param {string} texto - Texto opcional para el cuerpo del mensaje. Si no se proporciona, usa un texto predeterminado.
     */
    static mostrar(exito, texto = '') {
        if (exito) {
            Swal.fire({
                icon: 'success',
                title: '¡Éxito!',
                text: texto || 'La acción se realizó correctamente.',
                timer: 3000,
                showConfirmButton: false
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: '¡Error!',
                text: texto || 'Hubo un problema al realizar la acción. Intenta nuevamente.',
                timer: 3000,
                showConfirmButton: false
            });
        }
    }
}
