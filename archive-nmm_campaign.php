<?php
/**
 * Archive: Campaigns
 */
get_header();
?>

<div class="page-hero">
    <div class="container">
        <div class="page-hero__content">
            <h1 class="page-hero__title"><?php esc_html_e( 'Health Awareness Campaigns', 'nas-medical-mission' ); ?></h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'nas-medical-mission' ); ?></a></li>
                <li class="current"><?php esc_html_e( 'Campaigns', 'nas-medical-mission' ); ?></li>
            </ol>
        </div>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="text-center" style="margin-bottom:3rem;">
            <span class="section-eyebrow" style="justify-content:center;"><?php esc_html_e( 'Public Health', 'nas-medical-mission' ); ?></span>
            <h2 class="section-title"><?php esc_html_e( 'Our Campaigns', 'nas-medical-mission' ); ?></h2>
            <p class="section-subtitle" style="margin:0 auto;"><?php esc_html_e( 'NAS Medical Mission organises and supports targeted health awareness campaigns across Nigeria to educate, protect, and empower communities.', 'nas-medical-mission' ); ?></p>
        </div>

        <?php if ( have_posts() ) : ?>
            <div class="campaigns__grid">
                <?php while ( have_posts() ) : the_post();
                    $img_url = nmm_get_post_thumbnail_url( get_the_ID(), 'nmm-card' );
                ?>
                    <div class="campaign-card fade-up">
                        <div class="campaign-card__img-wrap">
                            <img class="campaign-card__img" src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" loading="lazy">
                        </div>
                        <div class="campaign-card__body">
                            <p style="font-size:.78rem; color:var(--color-muted); margin-bottom:.4rem;"><?php echo esc_html( get_the_date( 'M j, Y' ) ); ?></p>
                            <h3 class="campaign-card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <p class="campaign-card__text"><?php echo esc_html( get_the_excerpt() ); ?></p>
                            <a href="<?php the_permalink(); ?>" class="mission-card__link" style="margin-top:1rem; display:inline-flex;">
                                <?php esc_html_e( 'Read More', 'nas-medical-mission' ); ?>
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M3 8H13M13 8L9 4M13 8L9 12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </a>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>

            <div style="margin-top:3rem; display:flex; justify-content:center;">
                <?php the_posts_pagination( [ 'prev_text' => '&larr;', 'next_text' => '&rarr;' ] ); ?>
            </div>

        <?php else : ?>
            <div style="text-align:center; padding:3rem 0;">
                <i class="fas fa-bullhorn" style="font-size:3rem; color:var(--color-primary-pale); display:block; margin-bottom:1rem;"></i>
                <p><?php esc_html_e( 'No campaigns listed yet. Add campaigns via Campaigns in the WordPress admin.', 'nas-medical-mission' ); ?></p>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php get_footer(); ?>
