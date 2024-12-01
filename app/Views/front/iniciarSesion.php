<h2 class="texto-Formulario">¡Bienvenido a FrikiVerse!</h2>
<p class="texto-Formulario">Regístrate para estar informado sobre las novedades de nuestra tienda.</p>

<div class="form-container">
    <h2>Iniciar Sesión</h2>
    <form action="/login" method="post">
        <label for="email">Correo Electrónico</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Contraseña</label>
        <input type="password" id="password" name="password" required>

        <input type="submit" value="Iniciar Sesión">
    </form>
    <p class="texto-Formulario">
        ¿Aun no tienes cuenta? <a href="<?= base_url('registrarse') ?>" class="no-subrayado">Registrate</a>
    </p>
    <p class="texto-Formulario">
        <a href="<?= base_url('iniciarSesion') ?>" class="no-subrayado">¿Olvidaste tu contraseña?</a>
    </p>
</div>