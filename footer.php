<!-- ======================================================
     SITE FOOTER
     ====================================================== -->
<footer class="site-footer" role="contentinfo">
    <div class="container">
        <div class="footer__grid">

            <!-- Brand Column -->
            <div class="footer__brand">
                <div class="footer__logo">
                    <?php if ( has_custom_logo() ) :
                        $logo_id  = get_theme_mod( 'custom_logo' );
                        $logo_url = wp_get_attachment_image_url( $logo_id, 'full' );
                    ?>
                        <img src="<?php echo esc_url( $logo_url ); ?>" alt="<?php bloginfo( 'name' ); ?>" style="height:48px;">
                    <?php else : ?>
                        <img src="<?php echo esc_url( get_template_directory_uri() . '/images/logo.png' ); ?>"
                             alt="<?php bloginfo( 'name' ); ?>"
                             style="height:48px;"
                             onerror="this.style.display='none'">
                    <?php endif; ?>
                    <span class="footer__logo-name">NAS Medical<br>Mission</span>
                </div>

                <p class="footer__tagline">
                    Delivering free, compassionate healthcare to underserved communities across Nigeria.
                    <em>To Care · To Inform · To Treat.</em>
                </p>

                <?php nmm_social_links( 'footer__social' ); ?>
            </div>

            <!-- Quick Links -->
            <div class="footer__col">
                <h4 class="footer__col-title"><?php esc_html_e( 'Quick Links', 'nas-medical-mission' ); ?></h4>
                <ul class="footer__links">
                    <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                        <i class="fas fa-chevron-right fa-xs"></i> <?php esc_html_e( 'Home', 'nas-medical-mission' ); ?>
                    </a></li>
                    <li><a href="<?php echo esc_url( home_url( '/about-us/' ) ); ?>">
                        <i class="fas fa-chevron-right fa-xs"></i> <?php esc_html_e( 'About Us', 'nas-medical-mission' ); ?>
                    </a></li>
                    <li><a href="<?php echo esc_url( home_url( '/team/' ) ); ?>">
                        <i class="fas fa-chevron-right fa-xs"></i> <?php esc_html_e( 'Our Team', 'nas-medical-mission' ); ?>
                    </a></li>
                    <li><a href="<?php echo esc_url( home_url( '/medical-missions/' ) ); ?>">
                        <i class="fas fa-chevron-right fa-xs"></i> <?php esc_html_e( 'Medical Missions', 'nas-medical-mission' ); ?>
                    </a></li>
                    <li><a href="<?php echo esc_url( home_url( '/campaigns/' ) ); ?>">
                        <i class="fas fa-chevron-right fa-xs"></i> <?php esc_html_e( 'Campaigns', 'nas-medical-mission' ); ?>
                    </a></li>
                    <li><a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>">
                        <i class="fas fa-chevron-right fa-xs"></i> <?php esc_html_e( 'Blog & News', 'nas-medical-mission' ); ?>
                    </a></li>
                    <li><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">
                        <i class="fas fa-chevron-right fa-xs"></i> <?php esc_html_e( 'Contact', 'nas-medical-mission' ); ?>
                    </a></li>
                </ul>
            </div>

            <!-- Missions -->
            <div class="footer__col">
                <h4 class="footer__col-title"><?php esc_html_e( 'Our Work', 'nas-medical-mission' ); ?></h4>
                <ul class="footer__links">
                    <li><a href="<?php echo esc_url( home_url( '/medical-missions/events/' ) ); ?>">
                        <i class="fas fa-chevron-right fa-xs"></i> <?php esc_html_e( 'Upcoming Missions', 'nas-medical-mission' ); ?>
                    </a></li>
                    <li><a href="<?php echo esc_url( home_url( '/past-events/' ) ); ?>">
                        <i class="fas fa-chevron-right fa-xs"></i> <?php esc_html_e( 'Past Missions', 'nas-medical-mission' ); ?>
                    </a></li>
                    <li><a href="<?php echo esc_url( home_url( '/projects/' ) ); ?>">
                        <i class="fas fa-chevron-right fa-xs"></i> <?php esc_html_e( 'Projects', 'nas-medical-mission' ); ?>
                    </a></li>
                    <li><a href="<?php echo esc_url( home_url( '/support/' ) ); ?>">
                        <i class="fas fa-chevron-right fa-xs"></i> <?php esc_html_e( 'Support Us', 'nas-medical-mission' ); ?>
                    </a></li>
                    <li><a href="<?php echo esc_url( home_url( '/volunteer/' ) ); ?>">
                        <i class="fas fa-chevron-right fa-xs"></i> <?php esc_html_e( 'Volunteer', 'nas-medical-mission' ); ?>
                    </a></li>
                </ul>
            </div>

            <!-- Contact -->
            <div class="footer__col">
                <h4 class="footer__col-title"><?php esc_html_e( 'Contact Us', 'nas-medical-mission' ); ?></h4>

                <?php
                $phone   = nmm_opt( 'nmm_phone',   '+234 (0) 817 777 1952' );
                $email   = nmm_opt( 'nmm_email',   'info@nasmedicalmission.org' );
                $address = nmm_opt( 'nmm_address', 'Plot D122, Gado Nasko Road, Kubwa, Abuja FCT, Nigeria' );
                ?>

                <ul class="footer__links">
                    <li>
                        <a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $phone ) ); ?>">
                            <i class="fas fa-phone-alt fa-xs"></i>
                            <?php echo esc_html( $phone ); ?>
                        </a>
                    </li>
                    <li>
                        <a href="mailto:<?php echo esc_attr( $email ); ?>">
                            <i class="fas fa-envelope fa-xs"></i>
                            <?php echo esc_html( $email ); ?>
                        </a>
                    </li>
                    <li style="align-items:flex-start;">
                        <span style="display:flex;gap:.4rem;color:rgba(255,255,255,.6);">
                            <i class="fas fa-map-marker-alt fa-xs" style="margin-top:3px;flex-shrink:0;"></i>
                            <?php echo esc_html( $address ); ?>
                        </span>
                    </li>
                </ul>

                <div style="margin-top:1.5rem;">
                    <a href="<?php echo esc_url( home_url( '/donate/' ) ); ?>" class="btn btn-accent" style="font-size:.85rem;padding:.7rem 1.5rem;">
                        <i class="fas fa-heart"></i>
                        <?php esc_html_e( 'Donate Now', 'nas-medical-mission' ); ?>
                    </a>
                </div>
            </div>

        </div><!-- /.footer__grid -->

        <!-- Footer Bottom Bar -->
        <div class="footer__bottom">
            <p>
                &copy; <?php echo esc_html( date( 'Y' ) ); ?>
                <?php bloginfo( 'name' ); ?>.
                <?php esc_html_e( 'All rights reserved.', 'nas-medical-mission' ); ?>
                <?php esc_html_e( 'National Association of Seadogs (Pyrates Confraternity).', 'nas-medical-mission' ); ?>
            </p>
            <div style="display:flex;gap:1.5rem;">
                <a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>"><?php esc_html_e( 'Privacy Policy', 'nas-medical-mission' ); ?></a>
                <a href="<?php echo esc_url( home_url( '/terms/' ) ); ?>"><?php esc_html_e( 'Terms of Use', 'nas-medical-mission' ); ?></a>
            </div>
        </div>

    </div><!-- /.container -->
</footer>
<!-- /SITE FOOTER -->

<?php wp_footer(); ?>
</body>
</html>
