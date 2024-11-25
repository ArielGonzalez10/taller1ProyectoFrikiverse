<!-- Barra de navegación -->
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">

        <!-- Boton con el nombre de la pagina -->
        <a class="navbar-brand" href="<?php echo base_url('principal');?>">FrikiVerse</a>

        <!-- Botón desplegable para móviles -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menú de navegación -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('principal');?>">Principal</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('comercializacion');?>">Comercialización</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('quienesSomos');?>">¿Quiénes Somos?</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('contacto');?>">Contacto</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('terminosyUsos');?>">Términos y Usos</a>
                </li>
            </ul>

            <!-- Botones de Inicio de Sesión y Registro -->
            <div class="d-flex">
                <button class="btn btn-outline-dark me-2" type="button">Iniciar Sesión</button>
                <button class="btn btn-dark" type="button">Registrarse</button>
            </div>
        </div>
    </div>
</nav>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>