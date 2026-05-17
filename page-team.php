<?php
/**
 * Template Name: Team
 */
get_header();
?>

<div class="page-hero">
    <div class="container">
        <div class="page-hero__content">
            <h1 class="page-hero__title"><?php esc_html_e( 'Our Team', 'nas-medical-mission' ); ?></h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'nas-medical-mission' ); ?></a></li>
                <li><a href="<?php echo esc_url( home_url( '/about-us/' ) ); ?>"><?php esc_html_e( 'About Us', 'nas-medical-mission' ); ?></a></li>
                <li class="current"><?php esc_html_e( 'Team', 'nas-medical-mission' ); ?></li>
            </ol>
        </div>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="text-center" style="margin-bottom:3rem;">
            <span class="section-eyebrow" style="justify-content:center;"><?php esc_html_e( 'Meet the People', 'nas-medical-mission' ); ?></span>
            <h2 class="section-title"><?php esc_html_e( 'The NAS Medical Mission Team', 'nas-medical-mission' ); ?></h2>
            <p class="section-subtitle" style="margin:0 auto;"><?php esc_html_e( 'Dedicated medical professionals, volunteers, and administrators working together to bring free healthcare to Nigeria\'s underserved communities.', 'nas-medical-mission' ); ?></p>
        </div>

        <?php
        $team_query = new WP_Query( [ 'post_type' => 'nmm_team', 'posts_per_page' => -1, 'orderby' => 'menu_order', 'order' => 'ASC' ] );
        if ( $team_query->have_posts() ) :
        ?>
            <div class="grid-4">
                <?php while ( $team_query->have_posts() ) : $team_query->the_post();
                    $role     = get_post_meta( get_the_ID(), '_nmm_team_role',     true );
                    $email    = get_post_meta( get_the_ID(), '_nmm_team_email',    true );
                    $linkedin = get_post_meta( get_the_ID(), '_nmm_team_linkedin', true );
                ?>
                    <div class="fade-up" style="background:var(--color-white); border:1px solid var(--color-border); border-radius:var(--radius-lg); overflow:hidden; text-align:center; transition:var(--transition);">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <img src="<?php echo esc_url( get_the_post_thumbnail_url( get_the_ID(), 'nmm-square' ) ); ?>"
                                 alt="<?php echo esc_attr( get_the_title() ); ?>"
                                 style="width:100%; height:200px; object-fit:cover; object-position:top;">
                        <?php else : ?>
                            <div style="width:100%; height:200px; background:var(--color-primary-pale); display:flex; align-items:center; justify-content:center;">
                                <i class="fas fa-user-circle" style="font-size:5rem; color:var(--color-primary-light);"></i>
                            </div>
                        <?php endif; ?>

                        <div style="padding:1.5rem;">
                            <h3 style="font-size:1.05rem; margin-bottom:.25rem;"><?php the_title(); ?></h3>
                            <?php if ( $role ) : ?>
                                <p style="font-size:.82rem; font-weight:600; color:var(--color-primary); text-transform:uppercase; letter-spacing:.06em; margin-bottom:1rem;"><?php echo esc_html( $role ); ?></p>
                            <?php endif; ?>
                            <div style="display:flex; justify-content:center; gap:.5rem;">
                                <?php if ( $email ) : ?>
                                    <a href="mailto:<?php echo esc_attr( $email ); ?>" class="footer__social-link" aria-label="Email <?php echo esc_attr( get_the_title() ); ?>">
                                        <i class="fas fa-envelope"></i>
                                    </a>
                                <?php endif; ?>
                                <?php if ( $linkedin ) : ?>
                                    <a href="<?php echo esc_url( $linkedin ); ?>" target="_blank" rel="noopener" class="footer__social-link" aria-label="LinkedIn">
                                        <i class="fab fa-linkedin-in"></i>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>

        <?php else : ?>
            <div style="text-align:center; padding:3rem 0;">
                <p><?php esc_html_e( 'Team profiles coming soon. Add team members via the WordPress admin under Team Members.', 'nas-medical-mission' ); ?></p>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php get_footer(); ?>
