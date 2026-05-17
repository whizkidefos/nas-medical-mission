<?php
/**
 * Archive: Events (Upcoming Missions)
 */
get_header();
?>

<div class="page-hero">
    <div class="container">
        <div class="page-hero__content">
            <h1 class="page-hero__title"><?php esc_html_e( 'Upcoming Missions', 'nas-medical-mission' ); ?></h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'nas-medical-mission' ); ?></a></li>
                <li><a href="<?php echo esc_url( home_url( '/medical-missions/' ) ); ?>"><?php esc_html_e( 'Medical Missions', 'nas-medical-mission' ); ?></a></li>
                <li class="current"><?php esc_html_e( 'Upcoming', 'nas-medical-mission' ); ?></li>
            </ol>
        </div>
    </div>
</div>

<section class="section">
    <div class="container">

        <?php if ( have_posts() ) : ?>
            <div style="display:flex; flex-direction:column; gap:1.5rem; max-width:800px; margin:0 auto;">
                <?php while ( have_posts() ) : the_post();
                    $event_date = get_post_meta( get_the_ID(), '_nmm_event_date',     true );
                    $event_time = get_post_meta( get_the_ID(), '_nmm_event_time',     true );
                    $location   = get_post_meta( get_the_ID(), '_nmm_event_location', true );
                    $reg_link   = get_post_meta( get_the_ID(), '_nmm_register_link',  true );
                    $img_url    = nmm_get_post_thumbnail_url( get_the_ID(), 'nmm-thumb' );
                    $is_future  = $event_date ? ( strtotime( $event_date ) >= strtotime( 'today' ) ) : true;
                ?>
                    <div class="fade-up" style="background:var(--color-white); border:1px solid var(--color-border); border-radius:var(--radius-lg); overflow:hidden; display:flex; gap:0; transition:var(--transition);">

                        <!-- Date block -->
                        <div style="background:<?php echo $is_future ? 'var(--color-primary)' : 'var(--color-slate)'; ?>; color:white; display:flex; flex-direction:column; align-items:center; justify-content:center; padding:1.5rem 1.25rem; min-width:90px; text-align:center; flex-shrink:0;">
                            <?php if ( $event_date ) : ?>
                                <span style="font-family:var(--font-display); font-size:2rem; font-weight:700; line-height:1; color:var(--color-accent);"><?php echo esc_html( date( 'j', strtotime( $event_date ) ) ); ?></span>
                                <span style="font-size:.75rem; font-weight:700; text-transform:uppercase; letter-spacing:.08em; opacity:.8;"><?php echo esc_html( date( 'M', strtotime( $event_date ) ) ); ?></span>
                                <span style="font-size:.7rem; opacity:.6; margin-top:.2rem;"><?php echo esc_html( date( 'Y', strtotime( $event_date ) ) ); ?></span>
                            <?php else : ?>
                                <i class="fas fa-calendar-alt" style="font-size:1.5rem; color:var(--color-accent);"></i>
                                <span style="font-size:.7rem; margin-top:.4rem; opacity:.8;"><?php esc_html_e( 'TBD', 'nas-medical-mission' ); ?></span>
                            <?php endif; ?>
                        </div>

                        <!-- Content -->
                        <div style="padding:1.5rem; flex:1;">
                            <div style="display:flex; flex-wrap:wrap; gap:.75rem; align-items:flex-start; justify-content:space-between; margin-bottom:.5rem;">
                                <h2 style="font-size:1.1rem; margin:0; line-height:1.3;">
                                    <a href="<?php the_permalink(); ?>" style="color:var(--color-charcoal);"><?php the_title(); ?></a>
                                </h2>
                                <?php if ( ! $is_future ) : ?>
                                    <span style="font-size:.72rem; font-weight:700; text-transform:uppercase; letter-spacing:.08em; background:var(--color-border); color:var(--color-muted); padding:.2rem .6rem; border-radius:100px;"><?php esc_html_e( 'Past Event', 'nas-medical-mission' ); ?></span>
                                <?php endif; ?>
                            </div>

                            <div style="display:flex; flex-wrap:wrap; gap:1rem; font-size:.82rem; color:var(--color-muted); margin-bottom:.75rem;">
                                <?php if ( $event_time ) : ?>
                                    <span><i class="fas fa-clock fa-xs"></i> <?php echo esc_html( $event_time ); ?></span>
                                <?php endif; ?>
                                <?php if ( $location ) : ?>
                                    <span><i class="fas fa-map-marker-alt fa-xs"></i> <?php echo esc_html( $location ); ?></span>
                                <?php endif; ?>
                            </div>

                            <p style="font-size:.9rem; color:var(--color-mid); margin-bottom:1rem;"><?php echo esc_html( get_the_excerpt() ); ?></p>

                            <div style="display:flex; gap:.75rem; flex-wrap:wrap;">
                                <a href="<?php the_permalink(); ?>" class="btn btn-outline" style="font-size:.8rem; padding:.5rem 1rem;">
                                    <?php esc_html_e( 'Learn More', 'nas-medical-mission' ); ?>
                                </a>
                                <?php if ( $reg_link && $is_future ) : ?>
                                    <a href="<?php echo esc_url( $reg_link ); ?>" target="_blank" rel="noopener" class="btn btn-primary" style="font-size:.8rem; padding:.5rem 1rem;">
                                        <i class="fas fa-check-circle"></i> <?php esc_html_e( 'Register', 'nas-medical-mission' ); ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>

                    </div>
                <?php endwhile; ?>
            </div>

            <div style="margin-top:3rem; display:flex; justify-content:center;">
                <?php the_posts_pagination( [ 'prev_text' => '&larr;', 'next_text' => '&rarr;' ] ); ?>
            </div>

        <?php else : ?>
            <div style="text-align:center; padding:4rem 0; max-width:500px; margin:0 auto;">
                <i class="fas fa-calendar-plus" style="font-size:3rem; color:var(--color-primary-pale); display:block; margin-bottom:1rem;"></i>
                <h2><?php esc_html_e( 'No upcoming missions yet.', 'nas-medical-mission' ); ?></h2>
                <p><?php esc_html_e( 'We run quarterly missions — check back soon or follow us on social media for announcements.', 'nas-medical-mission' ); ?></p>
                <a href="<?php echo esc_url( home_url( '/past-events/' ) ); ?>" class="btn btn-primary" style="margin-top:1rem;">
                    <?php esc_html_e( 'View Past Missions', 'nas-medical-mission' ); ?>
                </a>
            </div>
        <?php endif; ?>

    </div>
</section>

<?php get_footer(); ?>
