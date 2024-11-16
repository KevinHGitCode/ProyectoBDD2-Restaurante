<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light shadow-sm" style="background-color: #2A6041;">
    <div class="container">
        <a class="navbar-brand text-uppercase font-weight-bold" href="#" style="color: #FAE3D9">Restaurante</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" 
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link font-weight-bold" href="main.php?view=home" style="color: #FAE3D9;">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link font-weight-bold" href="main.php?view=contact" style="color: #FAE3D9;">Contacto</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link font-weight-bold" href="main.php?view=about" style="color: #FAE3D9">Nosotros</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link font-weight-bold" href="main.php?view=login" style="color: #FAE3D9">Iniciar Sesión</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link font-weight-bold" href="main.php?view=register" style="color: #FAE3D9">Registrarse</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Agrega este estilo CSS dentro de <style> o en tu archivo CSS -->
<style>
    .nav-link {
        transition: transform 0.3s ease, color 0.3s ease; /* Efecto de transición */
    }

    .nav-link:hover {
        transform: scale(1.3); /* Hace que el botón se haga un 10% más grande */
        color: #FFD700; /* Cambia el color cuando se pasa el cursor (opcional) */
    }
</style>