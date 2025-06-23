<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php bloginfo('name'); ?></title>
    <?php wp_head(); ?>

    <!-- Bootstrap -->
    <?php wp_enqueue_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css', array(), '5.3.3', 'all'); ?>
    <?php wp_enqueue_style('meu-tema-style', get_stylesheet_uri(), array('bootstrap'), '1.0', 'all'); ?>
</head>

<body <?php body_class(); ?>>

    <!-- Navbar -->
    <div class="container-fluid bg-body-tertiary">
        <div class="nav-scroller px-5 mb-3 border-bottom d-none d-md-block">
            <nav class="nav justify-content-between py-2">
                <a class="nav-item nav-link text-dark d-flex flex-column align-items-center"
                    href="<?php echo home_url('/'); ?>" style="width: 100px; padding: 0px;">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/logo_black.png" class="w-75"
                        alt="Experimentos">
                    <p class="text-center" style="width: 97px; margin: 0">Home</p>
                </a>
                <a class="nav-item nav-link text-dark d-flex flex-column align-items-center"
                    href="<?php echo home_url('/simulacoes'); ?>" style="width: 90px; padding: 0px;">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/simulacoes.png" class="w-75"
                        alt="Experimentos">
                    <p class="text-center" style="width: 97px; margin: 0">Vídeos</p>
                </a>
                <a class="nav-item nav-link text-dark d-flex flex-column align-items-center"
                    href="<?php echo home_url('/solucionador'); ?>" style="width: 90px; padding: 0px;">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/solucionador.png" class="w-75"
                        alt="Simuladores">
                    <p class="text-center" style="width: 97px; margin: 0">Simuladores</p>
                </a>
                <a class="nav-item nav-link text-dark d-flex flex-column align-items-center"
                    href="<?php echo home_url('/aprenda-aqui'); ?>" style="width: 90px; padding: 0px;">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/aprendaAqui.png" class="w-75" alt="Blog">
                    <p class="text-center" style="width: 97px; margin: 0">Referências</p>
                </a>
                <a class="nav-item nav-link text-dark d-flex flex-column align-items-center"
                    href="<?php echo home_url('/contatos'); ?>" style="width: 90px; padding: 0px;">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/contatos.png" class="w-75" alt="Contatos">
                    <p class="text-center" style="width: 97px; margin: 0;">Contatos</p>
                </a>
            </nav>
        </div>

        <!-- Navbar for Mobile -->
        <div class="d-md-none position-relative">
            <button class="btn btn-link text-dark w-100 text-start px-3 py-2 text-decoration-none" type="button" data-bs-toggle="collapse"
                data-bs-target="#mobileMenu" aria-expanded="false" aria-controls="mobileMenu">
                ☰ Menu
            </button>
            <div class="collapse position-absolute w-100 bg-white shadow" id="mobileMenu" style="z-index: 1050;">
                <div class="card card-body p-2">
                    <nav class="nav flex-column">
                        <a class="nav-item nav-link text-dark" href="<?php echo home_url('/'); ?>">Home</a>
                        <a class="nav-item nav-link text-dark" href="<?php echo home_url('/simulacoes'); ?>">Vídeos</a>
                        <a class="nav-item nav-link text-dark" href="<?php echo home_url('/solucionador'); ?>">Simuladores</a>
                        <a class="nav-item nav-link text-dark" href="<?php echo home_url('/aprenda-aqui'); ?>">Referências</a>
                        <a class="nav-item nav-link text-dark" href="<?php echo home_url('/contatos'); ?>">Contatos</a>
                    </nav>
                </div>
            </div>
        </div>


    </div>

    <?php wp_footer(); ?>

