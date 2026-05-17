<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- Critical reset: must come BEFORE wp_head so Tailwind preflight cannot override -->
    <style>
        /* Hard-reset any browser/Tailwind margin injection */
        html, body { margin: 0 !important; padding: 0 !important; }
        /* Admin bar offset */
        body.admin-bar .site-header { top: 32px; }
        @media screen and (max-width: 782px) { body.admin-bar .site-header { top: 46px; } }
    </style>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- ======================================================
     TOP BAR
     ====================================================== -->
<div class="top-bar" role="complementary" aria-label="Contact information">
    <div class="container">
        <div class="top-bar__inner">
            <div class="top-bar__contact">
                <?php $phone = nmm_opt( 'nmm_phone', '+234 (0) 817 777 1952' ); ?>
                <?php $email = nmm_opt( 'nmm_email', 'info@nasmedicalmission.org' ); ?>

                <a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $phone ) ); ?>">
                    <i class="fas fa-phone-alt" aria-hidden="true"></i>
                    <span><?php echo esc_html( $phone ); ?></span>
                </a>

                <a href="mailto:<?php echo esc_attr( $email ); ?>">
                    <i class="fas fa-envelope" aria-hidden="true"></i>
                    <span><?php echo esc_html( $email ); ?></span>
                </a>

                <span>
                    <i class="fas fa-map-marker-alt" aria-hidden="true"></i>
                    <span>Kubwa, Abuja FCT, Nigeria</span>
                </span>
            </div>

            <?php nmm_social_links( 'top-bar__social' ); ?>
        </div>
    </div>
</div>
<!-- /TOP BAR -->

<!-- ======================================================
     MAIN HEADER
     ====================================================== -->
<header class="site-header" id="site-header" role="banner">
    <div class="container">
        <div class="header__inner">

            <!-- Logo -->
            <?php nmm_logo( 'site-logo' ); ?>

            <!-- Primary Navigation -->
            <nav role="navigation" aria-label="<?php esc_attr_e( 'Primary Navigation', 'nas-medical-mission' ); ?>">
                <?php nmm_primary_nav(); ?>
            </nav>

            <!-- Header CTA Buttons -->
            <div class="header__cta">
                <a href="<?php echo esc_url( home_url( '/volunteer/' ) ); ?>" class="btn btn-outline btn-sm">
                    <i class="fas fa-hands-helping" aria-hidden="true"></i>
                    <?php esc_html_e( 'Volunteer', 'nas-medical-mission' ); ?>
                </a>
                <a href="<?php echo esc_url( home_url( '/donate/' ) ); ?>" class="btn btn-primary btn-sm">
                    <i class="fas fa-heart" aria-hidden="true"></i>
                    <?php esc_html_e( 'Donate', 'nas-medical-mission' ); ?>
                </a>
            </div>

            <!-- Hamburger (mobile) -->
            <button class="hamburger" id="hamburger-btn"
                    aria-label="<?php esc_attr_e( 'Toggle mobile menu', 'nas-medical-mission' ); ?>"
                    aria-expanded="false"
                    aria-controls="mobile-nav"
                    type="button">
                <span></span>
                <span></span>
                <span></span>
            </button>

        </div>
    </div>
</header>

<!-- ======================================================
     MOBILE NAVIGATION DRAWER (outside <header> so sticky doesn't clip it)
     ====================================================== -->
<div id="mobile-nav-overlay" class="mobile-nav-overlay" aria-hidden="true"></div>
<nav id="mobile-nav"
     class="mobile-nav"
     aria-label="<?php esc_attr_e( 'Mobile Navigation', 'nas-medical-mission' ); ?>"
     aria-hidden="true">

    <div class="mobile-nav__header">
        <span class="mobile-nav__brand">Menu</span>
        <button class="mobile-nav__close" id="mobile-nav-close" type="button" aria-label="<?php esc_attr_e( 'Close menu', 'nas-medical-mission' ); ?>">
            <i class="fas fa-times"></i>
        </button>
    </div>

    <ul class="mobile-nav__list">
        <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'nas-medical-mission' ); ?></a></li>

        <li class="mobile-nav__has-sub">
            <button class="mobile-nav__sub-toggle" type="button" aria-expanded="false">
                <?php esc_html_e( 'About Us', 'nas-medical-mission' ); ?>
                <i class="fas fa-chevron-down fa-xs"></i>
            </button>
            <ul class="mobile-nav__sub">
                <li><a href="<?php echo esc_url( home_url( '/about-us/' ) ); ?>"><?php esc_html_e( 'About Us', 'nas-medical-mission' ); ?></a></li>
                <li><a href="<?php echo esc_url( home_url( '/team/' ) ); ?>"><?php esc_html_e( 'Our Team', 'nas-medical-mission' ); ?></a></li>
            </ul>
        </li>

        <li class="mobile-nav__has-sub">
            <button class="mobile-nav__sub-toggle" type="button" aria-expanded="false">
                <?php esc_html_e( 'Medical Missions', 'nas-medical-mission' ); ?>
                <i class="fas fa-chevron-down fa-xs"></i>
            </button>
            <ul class="mobile-nav__sub">
                <li><a href="<?php echo esc_url( home_url( '/medical-missions/' ) ); ?>"><?php esc_html_e( 'All Missions', 'nas-medical-mission' ); ?></a></li>
                <li><a href="<?php echo esc_url( home_url( '/medical-missions/events/' ) ); ?>"><?php esc_html_e( 'Upcoming Missions', 'nas-medical-mission' ); ?></a></li>
                <li><a href="<?php echo esc_url( home_url( '/past-events/' ) ); ?>"><?php esc_html_e( 'Past Missions', 'nas-medical-mission' ); ?></a></li>
            </ul>
        </li>

        <li class="mobile-nav__has-sub">
            <button class="mobile-nav__sub-toggle" type="button" aria-expanded="false">
                <?php esc_html_e( 'Campaigns', 'nas-medical-mission' ); ?>
                <i class="fas fa-chevron-down fa-xs"></i>
            </button>
            <ul class="mobile-nav__sub">
                <li><a href="<?php echo esc_url( home_url( '/campaigns/' ) ); ?>"><?php esc_html_e( 'All Campaigns', 'nas-medical-mission' ); ?></a></li>
                <li><a href="<?php echo esc_url( home_url( '/projects/' ) ); ?>"><?php esc_html_e( 'Projects', 'nas-medical-mission' ); ?></a></li>
            </ul>
        </li>

        <li><a href="<?php echo esc_url( home_url( '/support/' ) ); ?>"><?php esc_html_e( 'Support', 'nas-medical-mission' ); ?></a></li>
        <li><a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>"><?php esc_html_e( 'Blog', 'nas-medical-mission' ); ?></a></li>
        <li><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Contact', 'nas-medical-mission' ); ?></a></li>
    </ul>

    <div class="mobile-nav__cta">
        <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn-outline" style="flex:1; justify-content:center;">
            <i class="fas fa-hands-helping"></i> <?php esc_html_e( 'Volunteer', 'nas-medical-mission' ); ?>
        </a>
        <a href="<?php echo esc_url( home_url( '/support/' ) ); ?>" class="btn btn-primary" style="flex:1; justify-content:center;">
            <i class="fas fa-heart"></i> <?php esc_html_e( 'Donate', 'nas-medical-mission' ); ?>
        </a>
    </div>
</nav>
<!-- /MOBILE NAV -->
