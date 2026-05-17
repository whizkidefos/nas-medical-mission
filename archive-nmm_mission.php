<?php
/**
 * Archive: Medical Missions (nmm_mission CPT)
 */
get_header();
?>

<div class="page-hero">
    <div class="container">
        <div class="page-hero__content">
            <h1 class="page-hero__title"><?php esc_html_e( 'Medical Missions', 'nas-medical-mission' ); ?></h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'nas-medical-mission' ); ?></a></li>
                <li class="current"><?php esc_html_e( 'Medical Missions', 'nas-medical-mission' ); ?></li>
            </ol>
        </div>
    </div>
</div>

<!-- Mission Stats Bar -->
<div style="background:var(--color-charcoal); padding:1.5rem 0;">
    <div class="container">
        <div style="display:grid; grid-template-columns:repeat(4,1fr); gap:1rem; text-align:center;">
            <?php
            $stats = [
                [ '23+', 'Total Missions' ], [ '16+', 'Communities' ],
                [ '9', 'States + FCT' ],     [ '2,763+', 'Patients Served' ],
            ];
            foreach ( $stats as $s ) :
            ?>
                <div>
                    <span style="display:block; font-family:var(--font-display); font-size:1.8rem; font-weight:700; color:var(--color-accent);"><?php echo esc_html( $s[0] ); ?></span>
                    <span style="font-size:.75rem; font-weight:600; text-transform:uppercase; letter-spacing:.08em; color:rgba(255,255,255,.5);"><?php echo esc_html( $s[1] ); ?></span>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<section class="section">
    <div class="container">
        <?php if ( have_posts() ) : ?>
            <div class="missions__grid">
                <?php while ( have_posts() ) : the_post();
                    $img_url  = nmm_get_post_thumbnail_url( get_the_ID(), 'nmm-card' );
                    $date_val = get_post_meta( get_the_ID(), '_nmm_mission_date', true );
                    $location = get_post_meta( get_the_ID(), '_nmm_mission_location', true );
                ?>
                    <article class="mission-card fade-up">
                        <div class="mission-card__img-wrap">
                            <img class="mission-card__img" src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" loading="lazy">
                            <span class="mission-card__category"><?php esc_html_e( 'Medical Mission', 'nas-medical-mission' ); ?></span>
                        </div>
                        <div class="mission-card__body">
                            <p class="mission-card__date">
                                <i class="fas fa-calendar-alt fa-xs"></i>
                                <?php echo esc_html( $date_val ? date( 'M j, Y', strtotime( $date_val ) ) : get_the_date( 'M j, Y' ) ); ?>
                                <?php if ( $location ) : ?>
                                    &nbsp;·&nbsp;<i class="fas fa-map-marker-alt fa-xs"></i> <?php echo esc_html( $location ); ?>
                                <?php endif; ?>
                            </p>
                            <h2 class="mission-card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            <p class="mission-card__excerpt"><?php echo esc_html( get_the_excerpt() ); ?></p>
                            <a href="<?php the_permalink(); ?>" class="mission-card__link">
                                <?php esc_html_e( 'Read Report', 'nas-medical-mission' ); ?>
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M3 8H13M13 8L9 4M13 8L9 12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </a>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>

            <div style="margin-top:3rem; display:flex; justify-content:center;">
                <?php the_posts_pagination( [ 'prev_text' => '&larr;', 'next_text' => '&rarr;' ] ); ?>
            </div>

        <?php else : ?>
            <div style="text-align:center; padding:4rem 0;">
                <i class="fas fa-heartbeat" style="font-size:3rem; color:var(--color-primary-pale); display:block; margin-bottom:1rem;"></i>
                <h2><?php esc_html_e( 'No missions listed yet.', 'nas-medical-mission' ); ?></h2>
                <p><?php esc_html_e( 'Check back soon — we run quarterly missions across Nigeria.', 'nas-medical-mission' ); ?></p>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-primary" style="margin-top:1rem;"><?php esc_html_e( 'Back to Home', 'nas-medical-mission' ); ?></a>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php get_footer(); ?>
