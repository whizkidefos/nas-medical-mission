<?php get_header(); ?>

<section class="section" style="min-height:60vh; display:flex; align-items:center;">
    <div class="container" style="text-align:center; max-width:560px;">
        <div style="font-family:var(--font-display); font-size:8rem; font-weight:700; color:var(--color-primary-pale); line-height:1; margin-bottom:.5rem; user-select:none;">404</div>
        <h1 style="margin-bottom:1rem;"><?php esc_html_e( 'Page Not Found', 'nas-medical-mission' ); ?></h1>
        <p><?php esc_html_e( "The page you're looking for doesn't exist or may have been moved. Let's get you back on track.", 'nas-medical-mission' ); ?></p>
        <div style="display:flex; gap:1rem; justify-content:center; flex-wrap:wrap; margin-top:2rem;">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-primary">
                <i class="fas fa-home"></i>
                <?php esc_html_e( 'Back to Home', 'nas-medical-mission' ); ?>
            </a>
            <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn-outline">
                <?php esc_html_e( 'Contact Us', 'nas-medical-mission' ); ?>
            </a>
        </div>
    </div>
</section>

<?php get_footer(); ?>
