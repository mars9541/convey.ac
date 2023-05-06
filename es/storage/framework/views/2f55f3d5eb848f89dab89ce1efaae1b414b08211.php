<?php $__env->startSection('content'); ?>
    <div class="padding-top-large"></div>

    <div class="bussiness-component-title">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="business-title-middle">
                        <h2>DATOS protegidos</h2>
                        <span class="title-border-middle"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="bussiness-highlight-text">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <p>Todos los Expedientes Transferibles se almacenan de forma segura en el BANCO DE DATOS CONVEY, que es un recurso centralizado de posición neutral situado dentro de la plataforma CONVEY. La plataforma CONVEY ha sido creada siguiendo el principio de "Protección de datos desde el diseño y por defecto", lo que significa que la seguridad y la privacidad de los datos es el elemento central en torno al cual se establece todo lo demás. Este principio está recogido en el artículo 25 del GDPR y abarca todo, desde la forma en que los datos entran en la plataforma, envueltos en una capa de encriptación TLS (Seguridad en Capa de Transporte) que hace que los datos sean imposibles de leer mientras están en circulación, hasta la encriptación de los expedientes y de los campos, e incluso la eliminación de los expedientes tras completarse una solicitud.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="padding-top-large"></div>

    <div class="about-business-2x">
        <div class="container">
            <div class="about-business-content-2x">
                <div class="row">
                    <div class="col-md-8">
                        <div class="about-business-left-2x">
                            <h5>Almacenamiento SEGURO de los datos</h5>
                            <span class="title-border-left"></span>
                            <p>La plataforma CONVEY está ubicada de forma segura en nuestros centros de datos con certificación ISO27001:2013, que cuentan con seguridad in situ 24 horas al día y 7 días a la semana, y con supervisión de CCTV con identificación por foto y entrada con tarjeta magnética. Para garantizar el máximo tiempo de funcionamiento de la plataforma CONVEY, nuestro hardware está conectado a fuentes de alimentación redundantes e ininterrumpidas.<br>
                                <br>Nuestra infraestructura también se beneficia de un sistema de protección anti-DDoS (denegación de servicio distribuido) de 1 Tbps. Los ataques DDOS pueden paralizar muchos servidores, pero con este sistema, en caso de ataque la plataforma CONVEY podrá seguir procesando DATOS sin interrupción.</p>
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="about-business-right-2x">
                            <img class="img-responsive" src="<?php echo e(asset('landing_front')); ?>/images/es/sec.png" alt="sample image">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="padding-top-large"></div>
    <div class="business-feature-1x">
        <div class="container">
            <div class="business-features">
                <div class="row">
                    <div class="col-md-4">
                        <div class="single-features">
                            <div class="media">
                                <img class="mr-3" src="<?php echo e(asset('landing_front')); ?>/images/icon/leader.png" alt="Generic placeholder image">
                                <div class="media-body">
                                    <h5 class="mt-0">Seguridad del correo electrónico.<br><br> Para proteger nuestros sistemas, todos los correos electrónicos enviados desde y hacia la plataforma CONVEY se someten a un avanzado escaneo de protección antivirus y antispam de triple capa.<br><br></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="single-features">
                            <div class="media">
                                <img class="mr-3" src="<?php echo e(asset('landing_front')); ?>/images/icon/world-map.png" alt="Generic placeholder image">
                                <div class="media-body">
                                    <h5 class="mt-0">Ataques maliciosos.<br><br> Nuestro Cortafuegos de Aplicaciones Web realiza una inspección de milisegundos de cada solicitud HTTP en busca de inyecciones SQL, troyanos, secuencias de comandos en sitios cruzados, cruce de rutas y muchos otros tipos de ataques.</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="single-features">
                            <div class="media">
                                <img class="mr-3" src="<?php echo e(asset('landing_front')); ?>/images/icon/money.png" alt="Generic placeholder image">
                                <div class="media-body">
                                    <h5 class="mt-0">COPIAS DE SEGURIDAD DE LOS DATOS.<br><br> Toda la plataforma CONVEY se beneficia de las copias de seguridad automatizadas que se producen en puntos determinados a lo largo del día. Estas copias de seguridad garantizan que nuestros sistemas sean totalmente recuperables.<br></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="padding-top-large"></div>


    <div class="business-cta-2x">
        <div class="business-cta-2-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="business-cta-left-2">
                            <h2>Un Gran Salto Adelante ...</h2>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="business-cta-right-2">
                            <a href="<?php echo e(route('register')); ?>" class=" btn bussiness-btn-larg">ACTUALIZAR AHORA</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="padding-top-large"></div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.frontend-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/sites/15a/f/fc05c3f35d/public_html/es/resources/views/front/secure.blade.php ENDPATH**/ ?>