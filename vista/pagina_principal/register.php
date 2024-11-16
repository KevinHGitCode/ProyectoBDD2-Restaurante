
<!-- formulario de registro de clientes -->

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
     style="margin-top:3%; font-family: 'Times New Roman'; color: #D4A59A;">
    <h1 style="color: #FAE3D9;">Registro</h1>
    <!--<form action="register_process.php" method="POST">-->
    <form action="index.php?controlador=ctlAutenticacion&accion=registerUser" method="POST">
        <div class="form-group">
            <label for="username">Nombre de Usuario:</label>
            <input type="text" class="form-control" 
                   id="username" name="username"
                   required>
        </div>
        <div class="form-group">
            <label for="email">Correo Electrónico:</label>
            <input type="email" class="form-control" 
                   id="email" name="email"
                   required>
        </div>
        <div class="form-group">
            <label for="password">Contraseña:</label>
            <input type="password" class="form-control" 
                   id="password" name="password"
                   required>
        </div>
        <div class="form-group">
            <label for="confirm_password">Confirmar Contraseña:</label>
            <input type="password" class="form-control" 
                   id="confirm_password" name="confirm_password" 
                   required>
        </div>
        <button type="submit" 
                class="btn btn-lg"
                style= "background-color: #2A6041; color: #FAE3D9">Registrarse</button>
    </form>
</div>
