<nav class="navbar navbar-expand-lg navbar-light bg-light;" style= "background-color: #2A6041;">
    <a class="navbar-brand text-uppercase font-weight-bold" href="#" style="color: #FAE3D9;">Restaurante</a>
    <button class="navbar-toggler" type="button" 
            data-toggle="collapse" data-target="#navbarNav" 
            aria-controls="navbarNav" aria-expanded="false" 
            aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse text-uppercase font-weight-bold" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
                <a  class="nav-link" 
                    href="cliente.php?view=#" 
                    style="color: #FAE3D9; font-family: 'Times New Roman';">Ordenes</a>
            </li>
            <li class="nav-item active">
                <a  class="nav-link" 
                    href="cliente.php?view=factura" 
                    style="color: #FAE3D9; font-family: 'Times New Roman';">Ingredientes</a>
            </li>
            <li class="nav-item active">
                <a  class="nav-link" 
                    href="../../controlador/ctlLogout.php" 
                    style="color: #FAE3D9; font-family: 'Times New Roman';">Cerrar sesión</a>
            </li>
        </ul>
    </div>
</nav>

<style>
    .nav-link {
        font-size: 14px;
        transition: transform 0.3s ease, color 0.3s ease; /* Efecto de transición */
    }

    .nav-link:hover {
        transform: scale(1.1); /* Hace que el botón se haga un 10% más grande */
        color: #FFD700; /* Cambia el color cuando se pasa el cursor (opcional) */
        text-decoration: underline; /* Subraya el texto */
    }

    .navbar-brand{
        font-size: 14pk
    }
</style>