<!-- Carrusel de imágenes -->
<div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src=<?= base_url("assets/img/Mangas/akamegakill01.jpg") ?> class="d-block img-fluid mx-auto" alt="Akame Ga Kill Vol.
            1">
        </div>
        <div class="carousel-item">
            <img src=<?= base_url("assets/img/Mangas/chainsawman01.jpg") ?> class="d-block img-fluid mx-auto"
                alt="Akame Ga Kill Vol. 2">
        </div>
        <div class="carousel-item">
            <img src=<?= base_url("assets/img/Mangas/deathnote01.jpg") ?> class="d-block img-fluid mx-auto"
                alt="Akame Ga Kill Vol. 3">
        </div>
    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying"
        data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>

    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying"
        data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
<!-- Texto de bienvena -->
<div class="container">
    <h1 class="text-center mt-4">
        <strong>¡Bienvenidos a FrikiVerse!</strong>
    </h1>
    <p class="texto-bienvenida">
        <bold>Somos FrikiVerse, un espacio dedicado a todos los apasionados del mundo geek, otaku y coleccionista. Desde
            nuestros inicios hace 5 años en la provincia de Corrientes, hemos trabajado con dedicación para ofrecerte
            una experiencia única, donde tus hobbies y pasiones toman vida.</bold>

    </p>
</div>

<!-- Lista de productos -->
<div class="container">
    <h1 class="text-center mt-4">Categorias</h1>
    <div class="row">
        <!-- Producto 1 -->
        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
            <div class="product-item">

                <img src=<?= base_url("assets/img/Comics/spiderman1.jpg") ?> alt="Cómic" class="img-fluid">
                <div class="product-details">
                    <h2 class="product-title">
                        <a href="comics.html">Cómics</a>
                    </h2>
                    <p class="product-description">Explora una gran variedad de cómics de tus superhéroes y villanos
                        favoritos.</p>
                </div>
            </div>
        </div>
        <!-- Producto 2 -->
        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
            <div class="product-item">

                <img src=<?= base_url("assets/img/Mangas/deathnote01.jpg") ?> alt="Manga" class="img-fluid">
                <div class="product-details">
                    <h2 class="product-title">
                        <a href="mangas.html">Mangas</a>
                    </h2>
                    <p class="product-description">Descubre los mejores mangas directamente desde Japón.</p>
                </div>
            </div>
        </div>
        <!-- Producto 3 -->
        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
            <div class="product-item">

                <img src=<?= base_url("assets/img/Figuras/figuraflash.jpg") ?> alt="Figura" class="img-fluid">
                <div class="product-details">
                    <h2 class="product-title">
                        <a href="figuras.html">Figuras</a>
                    </h2>
                    <p class="product-description">Figuras coleccionables de alta calidad para todos los fanáticos.</p>
                </div>
            </div>
        </div>
        <!-- Producto 4 -->
        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
            <div class="product-item">
                <img src=<?= base_url("assets/img/Merch/remerahellfireclub.jpg") ?> alt="Ropa" class="img-fluid">
                <div class="product-details">
                    <h2 class="product-title">
                        <a href="ropa.html">Merchandising</a>
                    </h2>
                    <p class="product-description">Ropa temática para que muestres tu lado friki con estilo.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Últimos ingresos -->
<div class="contenedor-principal">
    <h2 class="titulo">Últimos ingresos</h2>
    <div class="row">
        <!-- Imagen 1 -->
        <div class="col-6 col-md-4 col-lg-3">
            <a href=<?= base_url("https://www.example.com/imagen1") ?> target="_blank">
                <img src=<?= base_url("assets/img/Figuras/figurabrolyssj.jpg") ?> alt="Imagen 1" class="img-fluid">
            </a>
        </div>
        <!-- Imagen 2 -->
        <div class="col-6 col-md-4 col-lg-3">
            <a href=<?= base_url("https://www.example.com/imagen2") ?> target="_blank">
                <img src=<?= base_url("assets/img/Figuras/figuragokussj.jpg") ?> alt="Imagen 2" class="img-fluid">
            </a>
        </div>
        <!-- Imagen 3 -->
        <div class="col-6 col-md-4 col-lg-3">
            <a href=<?= base_url("https://www.example.com/imagen3") ?> target="_blank">
                <img src=<?= base_url("assets/img/Merch/remeraVenom.jpg") ?> alt="Imagen 3" class="img-fluid">
            </a>
        </div>
        <!-- Imagen 4 -->
        <div class="col-6 col-md-4 col-lg-3">
            <a href=<?= base_url("https://www.example.com/imagen4") ?> target="_blank">
                <img src=<?= base_url("assets/img/Merch/remerahellfireclub.jpg") ?> alt="Imagen 4" class="img-fluid">
            </a>
        </div>
    </div>
</div>