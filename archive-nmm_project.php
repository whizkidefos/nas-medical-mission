<?php
/**
 * Archive: Projects
 */
get_header();
?>

<div class="page-hero">
    <div class="container">
        <div class="page-hero__content">
            <h1 class="page-hero__title"><?php esc_html_e( 'Our Projects', 'nas-medical-mission' ); ?></h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'nas-medical-mission' ); ?></a></li>
                <li><a href="<?php echo esc_url( home_url( '/campaigns/' ) ); ?>"><?php esc_html_e( 'Campaigns', 'nas-medical-mission' ); ?></a></li>
                <li class="current"><?php esc_html_e( 'Projects', 'nas-medical-mission' ); ?></li>
            </ol>
        </div>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="text-center" style="margin-bottom:3rem;">
            <span class="section-eyebrow" style="justify-content:center;"><?php esc_html_e( 'Long-Term Impact', 'nas-medical-mission' ); ?></span>
            <h2 class="section-title"><?php esc_html_e( 'NAS Medical Mission Projects', 'nas-medical-mission' ); ?></h2>
            <p class="section-subtitle" style="margin:0 auto;"><?php esc_html_e( 'Beyond quarterly missions, NAS Medical Mission runs structured long-term projects to address specific healthcare gaps across Nigeria.', 'nas-medical-mission' ); ?></p>
        </div>

        <?php if ( have_posts() ) : ?>

            <div class="missions__grid">
                <?php while ( have_posts() ) : the_post();
                    $status   = get_post_meta( get_the_ID(), '_nmm_project_status',   true ) ?: 'Active';
                    $location = get_post_meta( get_the_ID(), '_nmm_project_location', true );
                    $start    = get_post_meta( get_the_ID(), '_nmm_project_start',    true );
                    $end      = get_post_meta( get_the_ID(), '_nmm_project_end',      true );
                    $img_url  = nmm_get_post_thumbnail_url( get_the_ID(), 'nmm-card' );

                    $status_colors = [
                        'Active'    => '#27ae60',
                        'Ongoing'   => '#27ae60',
                        'Completed' => '#3498db',
                        'Planned'   => '#f39c12',
                        'On Hold'   => '#e74c3c',
                    ];
                    $status_color = $status_colors[ $status ] ?? '#6E378B';
                ?>
                    <article class="mission-card fade-up">
                        <div class="mission-card__img-wrap">
                            <img class="mission-card__img"
                                 src="<?php echo esc_url( $img_url ); ?>"
                                 alt="<?php echo esc_attr( get_the_title() ); ?>"
                                 loading="lazy" width="640" height="220">
                            <span style="position:absolute; top:1rem; left:1rem; background:<?php echo esc_attr( $status_color ); ?>; color:white; font-size:.72rem; font-weight:700; letter-spacing:.08em; text-transform:uppercase; padding:.3rem .75rem; border-radius:100px;">
                                <?php echo esc_html( $status ); ?>
                            </span>
                        </div>
                        <div class="mission-card__body">
                            <?php if ( $location ) : ?>
                                <p class="mission-card__date">
                                    <i class="fas fa-map-marker-alt fa-xs"></i>
                                    <?php echo esc_html( $location ); ?>
                                    <?php if ( $start ) : ?>
                                        &nbsp;·&nbsp;<i class="fas fa-calendar-alt fa-xs"></i>
                                        <?php echo esc_html( date( 'Y', strtotime( $start ) ) ); ?>
                                        <?php if ( $end ) : ?>
                                            &ndash; <?php echo esc_html( date( 'Y', strtotime( $end ) ) ); ?>
                                        <?php else : ?>
                                            &ndash; <?php esc_html_e( 'Present', 'nas-medical-mission' ); ?>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </p>
                            <?php endif; ?>
                            <h2 class="mission-card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            <p class="mission-card__excerpt"><?php echo esc_html( get_the_excerpt() ); ?></p>
                            <a href="<?php the_permalink(); ?>" class="mission-card__link">
                                <?php esc_html_e( 'View Project', 'nas-medical-mission' ); ?>
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" aria-hidden="true">
                                    <path d="M3 8H13M13 8L9 4M13 8L9 12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </a>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>

            <div style="margin-top:3rem; display:flex; justify-content:center;">
                <?php the_posts_pagination( [ 'prev_text' => '&larr;', 'next_text' => '&rarr;' ] ); ?>
            </div>

        <?php else :
            // Static fallback
            $static_projects = [
                [
                    'title'    => 'Primary Healthcare Equipment Donation Drive',
                    'status'   => 'Ongoing',
                    'color'    => '#27ae60',
                    'location' => 'Multiple States, Nigeria',
                    'text'     => 'Sourcing and donating medical equipment to under-resourced primary healthcare centres across Nigeria — including diagnostic tools, beds, and surgical supplies.',
                    'img'      => 'https://images.pexels.com/photos/5863365/pexels-photo-5863365.jpeg?auto=compress&cs=tinysrgb&w=640&h=300&fit=crop',
                ],
                [
                    'title'    => 'Indigent Patient Medical Bill Sponsorship',
                    'status'   => 'Active',
                    'color'    => '#27ae60',
                    'location' => 'Nationwide',
                    'text'     => 'Identifying and funding the medical bills of indigent Nigerians who cannot afford critical hospital care — a core humanitarian pillar since the founding of NAS.',
                    'img'      => 'https://images.pexels.com/photos/3259629/pexels-photo-3259629.jpeg?auto=compress&cs=tinysrgb&w=640&h=300&fit=crop',
                ],
                [
                    'title'    => 'Blood Bank Support Programme',
                    'status'   => 'Ongoing',
                    'color'    => '#27ae60',
                    'location' => 'Partner Hospitals Nationwide',
                    'text'     => 'Partnering with hospitals to run regular blood donation drives, ensuring blood banks across Nigeria are stocked for emergency and elective surgical procedures.',
                    'img'      => 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?w=640&auto=format&fit=crop&q=80',
                ],
            ];
        ?>
            <div class="missions__grid">
                <?php foreach ( $static_projects as $p ) : ?>
                    <div class="mission-card fade-up">
                        <div class="mission-card__img-wrap">
                            <img class="mission-card__img" src="<?php echo esc_url( $p['img'] ); ?>" alt="<?php echo esc_attr( $p['title'] ); ?>" loading="lazy" width="640" height="220">
                            <span style="position:absolute;top:1rem;left:1rem;background:<?php echo esc_attr( $p['color'] ); ?>;color:white;font-size:.72rem;font-weight:700;letter-spacing:.08em;text-transform:uppercase;padding:.3rem .75rem;border-radius:100px;">
                                <?php echo esc_html( $p['status'] ); ?>
                            </span>
                        </div>
                        <div class="mission-card__body">
                            <p class="mission-card__date"><i class="fas fa-map-marker-alt fa-xs"></i> <?php echo esc_html( $p['location'] ); ?></p>
                            <h2 class="mission-card__title"><?php echo esc_html( $p['title'] ); ?></h2>
                            <p class="mission-card__excerpt"><?php echo esc_html( $p['text'] ); ?></p>
                            <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="mission-card__link">
                                <?php esc_html_e( 'Get Involved', 'nas-medical-mission' ); ?>
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" aria-hidden="true"><path d="M3 8H13M13 8L9 4M13 8L9 12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

    </div>
</section>

<!-- CTA -->
<section class="cta-banner">
    <div class="cta-banner__bg" aria-hidden="true"></div>
    <div class="container">
        <div class="cta-banner__content">
            <h2 class="cta-banner__title"><?php esc_html_e( 'Partner on a Project', 'nas-medical-mission' ); ?></h2>
            <p class="cta-banner__subtitle"><?php esc_html_e( 'Sponsor a project, donate equipment, or fund an initiative that creates lasting change in Nigeria\'s healthcare landscape.', 'nas-medical-mission' ); ?></p>
            <div class="cta-banner__actions">
                <a href="<?php echo esc_url( home_url( '/support/' ) ); ?>" class="btn btn-accent"><i class="fas fa-heart"></i> <?php esc_html_e( 'Support a Project', 'nas-medical-mission' ); ?></a>
                <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn-outline" style="color:white;border-color:rgba(255,255,255,.5);"><?php esc_html_e( 'Get in Touch', 'nas-medical-mission' ); ?></a>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
