<!-- Encabezado de la sección -->
<p class="text-contacto text-center bordered-text p-3">¡Nos encantaría saber de ti! Si tienes alguna pregunta sobre
    nuestros productos o servicios, no dudes en ponerte en contacto con nosotros. Estamos aquí para ayudarte.</p>

</main>

<!-- Contenedor principal -->
<div class="container-contacto p-4">

    <!-- Tarjeta de información de contacto -->
    <div class="card mb-3">
        <div class="row-contacto row g-0">
            <div class="col-md-4 p-2">
                <!-- Imagen del equipo -->
                <img src="<?php echo base_url('assets/img/frikiverse_team.jpeg');?>" class="img-fluid rounded-circle"
                    alt="Equipo FrikiVerse">
            </div>
            <div class="col-md-8">
                <div class="card-body ms-3">
                    <!-- Detalles de contacto -->
                    <h5 class="card-title">Información de Contacto:</h5>
                    <p class="card-text">Nombre del Titular de la Empresa: Ariel, Mauri y Yami</p>
                    <p class="card-text">Razón Social: FrikiVerse S.R.L.</p>
                    <p class="card-text card-text-contacto">Domicilio: <a
                            href="https://www.google.com/maps?q=Corrientes,+Argentina">Corrientes, Argentina</a></p>
                    <p class="card-text">Teléfono: +54 379-XXXXXXX</p>
                    <p class="card-text">Correo Electrónico: <a
                            href="mailto:frikiverse@example.com">frikiverse@example.com</a></p>
                    <p class="card-text card-text-contacto">Redes Sociales:
                        <a href="https://www.instagram.com/frikiverse"><img
                                src="<?php echo base_url('assets/img/redes/ig.png');?>" alt="Instagram" width="30"
                                height="30"> @FrikiVerse</a>
                        <a href="https://wa.me/379XXXXXXX"><img src="<?php echo base_url('assets/img/redes/wpp.png');?>"
                                alt="WhatsApp" width="30" height="30"> +54 379-XXXXXXX</a>
                        <a href="https://www.facebook.com/frikiverse"><img
                                src="<?php echo base_url('assets/img/redes/fc.png');?>" alt="Facebook" width="30"
                                height="30"> FrikiVerse</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Formulario de contacto -->
    <div class="container-contacto p-3">
        <div class="row row-cols-1 row-cols-md-2">
            <div class="col pb-3">

                <?php echo form_open('contacto') ?>

                <div class="card formulario">
                    <div class="card-body">
                        <h5 class="m-3 text-center">Formulario de Contacto:</h5>

                        <!-- Campos del formulario -->
                        <div class="mb-3">
                            <label for="correo_consulta" class="form-label">Correo electrónico</label>
                            <?php echo form_input(['name' => 'correo_consulta', 'id' => 'correo_consulta', 'type' => 'email', 'class' => 'form-control', 'placeholder' => 'name@example.com', 'value' => set_value('correo_consulta')]) ?>

                            <?php if (isset($validation) && $validation->hasError('correo_consulta')): ?>
                            <div class="alert alert-danger">
                                <?= $validation->getError('correo_consulta'); ?>
                            </div>
                            <?php endif; ?>
                        </div>

                        <div class="mb-3">
                            <label for="telefono_consulta" class="form-label">Número de teléfono</label>
                            <?php echo form_input(['name' => 'telefono_consulta', 'id' => 'telefono_consulta', 'type' => 'text', 'class' => 'form-control', 'placeholder' => '+54 379-XXXXXXX', 'value' => set_value('telefono_consulta')]) ?>

                            <?php if (isset($validation) && $validation->hasError('telefono_consulta')): ?>
                            <div class="alert alert-danger m-auto">
                                <?= $validation->getError('telefono_consulta'); ?>
                            </div>
                            <?php endif; ?>
                        </div>

                        <div class="mb-3">
                            <label for="motivo_consulta" class="form-label">Motivo de la consulta</label>
                            <?php echo form_input(['name' => 'motivo_consulta', 'id' => 'motivo_consulta', 'type' => 'text', 'class' => 'form-control', 'placeholder' => '¿Qué necesitas saber?', 'value' => set_value('motivo_consulta')]) ?>

                            <?php if (isset($validation) && $validation->hasError('motivo_consulta')): ?>
                            <div class="alert alert-danger m-auto">
                                <?= $validation->getError('motivo_consulta'); ?>
                            </div>
                            <?php endif; ?>
                        </div>

                        <div class="mb-3">
                            <label for="texto_consulta" class="form-label">Consulta</label>
                            <?php echo form_textarea(['name' => 'texto_consulta', 'id' => 'texto_consulta', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Dejanos tu mensaje...', 'rows' => '3', 'value' => set_value('texto_consulta')]) ?>

                            <?php if (isset($validation) && $validation->hasError('texto_consulta')): ?>
                            <div class="alert alert-danger m-auto">
                                <?= $validation->getError('texto_consulta'); ?>
                            </div>
                            <?php endif; ?>
                        </div>

                        <div class="col d-flex justify-content-center">
                            <?php echo form_submit('contacto', 'Enviar', "class='boton p-2'")?>
                        </div>
                    </div>
                </div>

                <?php echo form_close();?>

                <?php if (session('mensaje')): ?>
                <div class="alert alert-success" role="alert">
                    <?= session('mensaje') ?>
                </div>
                <?php endif; ?>

            </div>

            <!-- Mapa de ubicación -->
            <div class="col">
                <div class="card formulario card-map rounded-circle border-5">
                    <div class="card-body">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3540.071745457106!2d-58.83307702526276!3d-27.467025676321075!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94456ca0c84e09af%3A0xb763eed3997e5df0!2s9%20de%20Julio%201449%2C%20W3400%20AZB%2C%20Corrientes!5e0!3m2!1ses-419!2sar!4v1713802777065!5m2!1ses-419!2sar"
                            class="rounded-circle" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Texto de instrucciones -->
    <div class="text p-2">
        <h4 class="text-center mb-4">Por favor, completa el formulario y nos pondremos en contacto contigo lo antes
            posible.</h4>
    </div>

</div>