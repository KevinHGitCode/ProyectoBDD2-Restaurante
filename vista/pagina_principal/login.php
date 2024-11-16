
<!-- formulario de inicio de seccion -->

<style>
    body {
        background-image: url('../../Images/fondo.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        height: 100vh;
    }
</style>

<div class="container w-50 mx-auto" 
     style="margin-top:3%; height: 100vh; padding-top:7%; font-family: 'Georgia'; color: #D4A59A;">
    <h1 style="color: #FAE3D9">Iniciar Sesión</h1>
    <form action="../../controlador/ctlLogin.php" method="POST">
        <div class="form-group">
            <label for="username">Nombre de Usuario:</label>
            <input type="text" class="form-control" 
                   id="username" name="username" 
                   required>
        </div>
        <div class="form-group">
            <label for="password">Contraseña:</label>
            <input type="password" class="form-control" 
                   id="password" name="password" 
                   required>
        </div>
        <button type="submit" 
                class="btn btn-lg" 
                style= "background-color: #2A6041; color: #FAE3D9">Iniciar Sesión</button>
    </form>
</div>
