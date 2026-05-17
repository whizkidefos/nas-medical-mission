<?php
/**
 * Template Name: Campaigns
 */
get_header();
?>

<!-- Page Hero -->
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

<!-- Intro -->
<section class="section">
    <div class="container" style="max-width:800px; text-align:center;">
        <span class="section-eyebrow" style="justify-content:center;"><?php esc_html_e( 'Public Health Education', 'nas-medical-mission' ); ?></span>
        <h2 class="section-title"><?php esc_html_e( 'Informing Communities, Saving Lives', 'nas-medical-mission' ); ?></h2>
        <p><?php esc_html_e( 'NAS Medical Mission organises and supports targeted health awareness campaigns across Nigeria — equipping communities with the knowledge they need to protect themselves and their families.', 'nas-medical-mission' ); ?></p>
    </div>
</section>

<!-- Featured Campaigns -->
<section class="section section--alt">
    <div class="container">
        <div class="missions__header">
            <div>
                <span class="section-eyebrow"><?php esc_html_e( 'Active Campaigns', 'nas-medical-mission' ); ?></span>
                <h2 class="section-title"><?php esc_html_e( 'Current Health Campaigns', 'nas-medical-mission' ); ?></h2>
            </div>
        </div>

        <?php
        $campaigns_query = new WP_Query( [
            'post_type'      => 'nmm_campaign',
            'posts_per_page' => 6,
            'post_status'    => 'publish',
            'orderby'        => 'date',
            'order'          => 'DESC',
        ] );

        if ( $campaigns_query->have_posts() ) :
        ?>
            <div class="campaigns__grid">
                <?php while ( $campaigns_query->have_posts() ) : $campaigns_query->the_post();
                    $img_url = nmm_get_post_thumbnail_url( get_the_ID(), 'nmm-card' );
                ?>
                    <article class="campaign-card fade-up">
                        <div class="campaign-card__img-wrap">
                            <img class="campaign-card__img"
                                 src="<?php echo esc_url( $img_url ); ?>"
                                 alt="<?php echo esc_attr( get_the_title() ); ?>"
                                 loading="lazy" width="640" height="200">
                        </div>
                        <div class="campaign-card__body">
                            <p style="font-size:.78rem; color:var(--color-muted); margin-bottom:.4rem;">
                                <i class="fas fa-calendar-alt fa-xs"></i>
                                <?php echo esc_html( get_the_date( 'M j, Y' ) ); ?>
                            </p>
                            <h3 class="campaign-card__title">
                                <a href="<?php the_permalink(); ?>" style="color:var(--color-charcoal);"><?php the_title(); ?></a>
                            </h3>
                            <p class="campaign-card__text"><?php echo esc_html( get_the_excerpt() ); ?></p>
                            <a href="<?php the_permalink(); ?>" class="mission-card__link" style="margin-top:1rem; display:inline-flex;">
                                <?php esc_html_e( 'Read More', 'nas-medical-mission' ); ?>
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" aria-hidden="true">
                                    <path d="M3 8H13M13 8L9 4M13 8L9 12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </a>
                        </div>
                    </article>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>

        <?php else :
            // Static fallback campaigns from the live site
            $static_campaigns = [
                [
                    'title'   => 'MPOX Awareness Campaign',
                    'text'    => 'Comprehensive public education on MPOX — covering symptoms, prevention, transmission routes, and treatment. Delivered across communities in Nigeria through awareness materials and outreach.',
                    'img'     => 'https://images.pexels.com/photos/3952224/pexels-photo-3952224.jpeg?auto=compress&cs=tinysrgb&w=640&h=400&fit=crop',
                    'link'    => 'https://www.nasmedicalmission.org/understanding-mpox/',
                    'ext'     => true,
                ],
                [
                    'title'   => 'World Resuscitation Day — CPR Training',
                    'text'    => 'Every year on October 16th, NAS leads life-saving CPR and resuscitation awareness events, equipping individuals across Nigeria with critical emergency skills. Magna Carta Deck leads by example.',
                    'img'     => 'https://images.pexels.com/photos/6129507/pexels-photo-6129507.jpeg?auto=compress&cs=tinysrgb&w=640&h=400&fit=crop',
                    'link'    => home_url( '/blog/' ),
                    'ext'     => false,
                ],
                [
                    'title'   => 'Diabetes & Eye Health Screening',
                    'text'    => 'Free diabetes testing and comprehensive eye care delivered to rural and peri-urban communities who have no access to diagnostic healthcare services.',
                    'img'     => 'https://images.pexels.com/photos/4226219/pexels-photo-4226219.jpeg?auto=compress&cs=tinysrgb&w=640&h=400&fit=crop',
                    'link'    => home_url( '/medical-missions/' ),
                    'ext'     => false,
                ],
                [
                    'title'   => 'Cervical Cancer Awareness & Screening',
                    'text'    => 'Free cervical cancer screening campaigns dating back to our founding mission at Ugep General Hospital in 2010 — a cornerstone of NAS Medical Mission\'s preventive healthcare work.',
                    'img'     => 'https://images.pexels.com/photos/5863365/pexels-photo-5863365.jpeg?auto=compress&cs=tinysrgb&w=640&h=400&fit=crop',
                    'link'    => home_url( '/campaigns/' ),
                    'ext'     => false,
                ],
                [
                    'title'   => 'Blood Donation & Bank Support',
                    'text'    => 'Supporting hospital blood banks across Nigeria through donation drives and awareness campaigns — ensuring critical blood supply for emergency and surgical care in underserved facilities.',
                    'img'     => 'https://images.pexels.com/photos/3259629/pexels-photo-3259629.jpeg?auto=compress&cs=tinysrgb&w=640&h=400&fit=crop',
                    'link'    => home_url( '/campaigns/' ),
                    'ext'     => false,
                ],
                [
                    'title'   => 'COVID-19 Vaccine Awareness',
                    'text'    => 'NAS Medical Mission contributed to national COVID-19 vaccine education efforts — helping demystify the vaccines and encouraging uptake in hesitant communities across Nigeria.',
                    'img'     => 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?w=640&auto=format&fit=crop&q=80',
                    'link'    => home_url( '/blog/' ),
                    'ext'     => false,
                ],
            ];
            echo '<div class="campaigns__grid">';
            foreach ( $static_campaigns as $i => $c ) :
        ?>
                <article class="campaign-card fade-up">
                    <div class="campaign-card__img-wrap">
                        <img class="campaign-card__img"
                             src="<?php echo esc_url( $c['img'] ); ?>"
                             alt="<?php echo esc_attr( $c['title'] ); ?>"
                             loading="lazy" width="640" height="200">
                    </div>
                    <div class="campaign-card__body">
                        <h3 class="campaign-card__title"><?php echo esc_html( $c['title'] ); ?></h3>
                        <p class="campaign-card__text"><?php echo esc_html( $c['text'] ); ?></p>
                        <a href="<?php echo esc_url( $c['link'] ); ?>"
                           class="mission-card__link"
                           style="margin-top:1rem; display:inline-flex;"
                           <?php echo $c['ext'] ? 'target="_blank" rel="noopener noreferrer"' : ''; ?>>
                            <?php esc_html_e( 'Learn More', 'nas-medical-mission' ); ?>
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" aria-hidden="true">
                                <path d="M3 8H13M13 8L9 4M13 8L9 12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                    </div>
                </article>
        <?php endforeach; echo '</div>'; endif; ?>
    </div>
</section>

<!-- Blog posts from Awareness Campaigns category -->
<section class="section">
    <div class="container">
        <div class="missions__header">
            <div>
                <span class="section-eyebrow"><?php esc_html_e( 'Campaign News', 'nas-medical-mission' ); ?></span>
                <h2 class="section-title"><?php esc_html_e( 'Latest Campaign Updates', 'nas-medical-mission' ); ?></h2>
            </div>
            <a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>" class="btn btn-outline">
                <?php esc_html_e( 'All News', 'nas-medical-mission' ); ?>
                <i class="fas fa-arrow-right" aria-hidden="true"></i>
            </a>
        </div>

        <?php
        $news_query = new WP_Query( [
            'post_type'      => 'post',
            'posts_per_page' => 3,
            'category_name'  => 'awareness-campaigns',
            'post_status'    => 'publish',
        ] );

        if ( $news_query->have_posts() ) :
        ?>
            <div class="blog__grid">
                <?php while ( $news_query->have_posts() ) : $news_query->the_post();
                    $img_url = nmm_get_post_thumbnail_url( get_the_ID(), 'nmm-card' );
                ?>
                    <article class="blog-card fade-up">
                        <div class="blog-card__img-wrap">
                            <img class="blog-card__img" src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" loading="lazy">
                        </div>
                        <div class="blog-card__body">
                            <div class="blog-card__meta">
                                <span class="blog-card__tag"><?php esc_html_e( 'Campaign', 'nas-medical-mission' ); ?></span>
                                <span class="blog-card__date"><?php echo esc_html( get_the_date( 'M j, Y' ) ); ?></span>
                            </div>
                            <h3 class="blog-card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <p class="blog-card__excerpt"><?php echo esc_html( get_the_excerpt() ); ?></p>
                            <a href="<?php the_permalink(); ?>" class="blog-card__link">
                                <?php esc_html_e( 'Read More', 'nas-medical-mission' ); ?>
                                <i class="fas fa-arrow-right fa-xs"></i>
                            </a>
                        </div>
                    </article>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- CTA -->
<section class="cta-banner">
    <div class="cta-banner__bg" aria-hidden="true"></div>
    <div class="container">
        <div class="cta-banner__content">
            <h2 class="cta-banner__title"><?php esc_html_e( 'Support Our Health Campaigns', 'nas-medical-mission' ); ?></h2>
            <p class="cta-banner__subtitle"><?php esc_html_e( 'Sponsor a campaign, donate health education materials, or volunteer your expertise to help us educate more communities.', 'nas-medical-mission' ); ?></p>
            <div class="cta-banner__actions">
                <a href="<?php echo esc_url( home_url( '/support/' ) ); ?>" class="btn btn-accent">
                    <i class="fas fa-heart"></i> <?php esc_html_e( 'Donate', 'nas-medical-mission' ); ?>
                </a>
                <a href="<?php echo esc_url( home_url( '/volunteer/' ) ); ?>" class="btn btn-outline" style="color:white; border-color:rgba(255,255,255,.5);">
                    <i class="fas fa-hands-helping"></i> <?php esc_html_e( 'Volunteer', 'nas-medical-mission' ); ?>
                </a>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
