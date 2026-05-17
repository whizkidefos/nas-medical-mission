<?php
/**
 * Template Name: Home Page
 * Front page template for NAS Medical Mission
 */
get_header();
?>

<!-- ======================================================
     HERO SECTION
     ====================================================== -->
<section class="hero" aria-label="<?php esc_attr_e( 'Hero', 'nas-medical-mission' ); ?>">
    <div class="hero__bg" aria-hidden="true"></div>
    <div class="hero__overlay" aria-hidden="true"></div>
    <div class="hero__accent" aria-hidden="true"></div>

    <div class="container">
        <div class="hero__content">
            <div class="hero__eyebrow">
                <span class="hero__eyebrow-dot" aria-hidden="true"></span>
                <?php esc_html_e( 'NAS Medical Mission', 'nas-medical-mission' ); ?>
            </div>

            <h1 class="hero__title">
                <?php echo wp_kses_post( nmm_opt( 'nmm_hero_title', 'Bringing Healthcare <em>To Those Who Need It Most</em>' ) ); ?>
            </h1>

            <p class="hero__subtitle">
                <?php echo esc_html( nmm_opt( 'nmm_hero_subtitle', 'NAS Medical Mission delivers free, compassionate healthcare to underserved rural communities across Nigeria — one mission at a time.' ) ); ?>
            </p>

            <div class="hero__actions">
                <a href="<?php echo esc_url( home_url( '/medical-missions/' ) ); ?>" class="btn btn-accent">
                    <i class="fas fa-map-marked-alt" aria-hidden="true"></i>
                    <?php esc_html_e( 'View Our Missions', 'nas-medical-mission' ); ?>
                </a>
                <a href="<?php echo esc_url( home_url( '/support/' ) ); ?>" class="btn btn-white">
                    <i class="fas fa-heart" aria-hidden="true"></i>
                    <?php esc_html_e( 'Support a Mission', 'nas-medical-mission' ); ?>
                </a>
            </div>
        </div>
    </div>

    <!-- Stats Bar -->
    <div class="hero__stats" aria-label="<?php esc_attr_e( 'Impact statistics', 'nas-medical-mission' ); ?>">
        <div class="container">
            <div class="hero__stats-inner">
                <div class="hero__stat">
                    <span class="hero__stat-number counter" data-target="2763"><?php echo esc_html( nmm_opt( 'nmm_stat_patients', '2,763+' ) ); ?></span>
                    <span class="hero__stat-label"><?php esc_html_e( 'Patients Treated', 'nas-medical-mission' ); ?></span>
                </div>
                <div class="hero__stat">
                    <span class="hero__stat-number counter" data-target="23"><?php echo esc_html( nmm_opt( 'nmm_stat_missions', '23+' ) ); ?></span>
                    <span class="hero__stat-label"><?php esc_html_e( 'Medical Missions', 'nas-medical-mission' ); ?></span>
                </div>
                <div class="hero__stat">
                    <span class="hero__stat-number counter" data-target="16"><?php echo esc_html( nmm_opt( 'nmm_stat_communities', '16+' ) ); ?></span>
                    <span class="hero__stat-label"><?php esc_html_e( 'Communities Reached', 'nas-medical-mission' ); ?></span>
                </div>
                <div class="hero__stat">
                    <span class="hero__stat-number counter" data-target="9"><?php echo esc_html( nmm_opt( 'nmm_stat_states', '9' ) ); ?></span>
                    <span class="hero__stat-label"><?php esc_html_e( 'States + FCT', 'nas-medical-mission' ); ?></span>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /HERO -->


<!-- ======================================================
     MISSION PILLARS
     ====================================================== -->
<section class="pillars section" aria-labelledby="pillars-heading">
    <div class="container">
        <div class="text-center">
            <span class="section-eyebrow"><?php esc_html_e( 'Our Purpose', 'nas-medical-mission' ); ?></span>
            <h2 class="section-title" id="pillars-heading">
                <?php esc_html_e( 'Three Words. One Mission.', 'nas-medical-mission' ); ?>
            </h2>
            <p class="section-subtitle" style="margin:0 auto 0;">
                <?php esc_html_e( 'Every mission we run is guided by three fundamental commitments to the communities we serve.', 'nas-medical-mission' ); ?>
            </p>
        </div>

        <div class="pillars__grid">
            <div class="pillar-card fade-up">
                <span class="pillar-card__number" aria-hidden="true">01</span>
                <div class="pillar-card__icon" aria-hidden="true">🩺</div>
                <h3 class="pillar-card__title"><?php esc_html_e( 'To Care', 'nas-medical-mission' ); ?></h3>
                <p class="pillar-card__text">
                    <?php esc_html_e( 'Providing compassionate, free healthcare services to indigent Nigerians in rural and underserved communities through quarterly medical missions.', 'nas-medical-mission' ); ?>
                </p>
            </div>

            <div class="pillar-card fade-up">
                <span class="pillar-card__number" aria-hidden="true">02</span>
                <div class="pillar-card__icon" aria-hidden="true">📢</div>
                <h3 class="pillar-card__title"><?php esc_html_e( 'To Inform', 'nas-medical-mission' ); ?></h3>
                <p class="pillar-card__text">
                    <?php esc_html_e( 'Running targeted health awareness campaigns on critical issues — from MPOX and CPR to diabetes and eye health — empowering communities with life-saving knowledge.', 'nas-medical-mission' ); ?>
                </p>
            </div>

            <div class="pillar-card fade-up">
                <span class="pillar-card__number" aria-hidden="true">03</span>
                <div class="pillar-card__icon" aria-hidden="true">💊</div>
                <h3 class="pillar-card__title"><?php esc_html_e( 'To Treat', 'nas-medical-mission' ); ?></h3>
                <p class="pillar-card__text">
                    <?php esc_html_e( 'Delivering clinical consultations, laboratory services, pharmaceutical care, dental, eye care, and referral services at no cost to patients.', 'nas-medical-mission' ); ?>
                </p>
            </div>
        </div>
    </div>
</section>
<!-- /PILLARS -->


<!-- ======================================================
     ABOUT SECTION
     ====================================================== -->
<section class="about section section--alt" aria-labelledby="about-heading">
    <div class="container">
        <div class="about__inner">

            <!-- Media -->
            <div class="about__media fade-up">
                <div class="about__img-accent" aria-hidden="true"></div>
                <img
                    class="about__img-main"
                    src="https://images.pexels.com/photos/5863365/pexels-photo-5863365.jpeg?auto=compress&cs=tinysrgb&w=800&h=600&fit=crop"
                    alt="<?php esc_attr_e( 'NAS Medical Mission volunteers providing healthcare', 'nas-medical-mission' ); ?>"
                    loading="lazy"
                    width="600"
                    height="480"
                >
                <div class="about__img-badge" aria-label="<?php esc_attr_e( 'Founded in 2012', 'nas-medical-mission' ); ?>">
                    <strong>2012</strong>
                    <span><?php esc_html_e( 'Founded', 'nas-medical-mission' ); ?></span>
                </div>
            </div>

            <!-- Content -->
            <div class="about__content fade-up">
                <span class="section-eyebrow"><?php esc_html_e( 'About NMM', 'nas-medical-mission' ); ?></span>
                <h2 class="section-title" id="about-heading">
                    <?php esc_html_e( 'Medical Intervention for Humanistic Ideals', 'nas-medical-mission' ); ?>
                </h2>
                <p>
                    <?php esc_html_e( 'Since 1952, the 3rd Compass Point has been a major objective for the National Association of Seadogs (Pyrates Confraternity) — carrying out medical humanitarian causes including equipping health facilities, paying medical bills for indigent patients, and organising free medical missions.', 'nas-medical-mission' ); ?>
                </p>
                <p>
                    <?php esc_html_e( 'In November 2010, under Oscar Egwuonwu\'s leadership, NAS organised its first community free medical mission. In August 2012, the NAS Medical Mission was formally structured as a quarterly event to reach underserved communities systematically.', 'nas-medical-mission' ); ?>
                </p>

                <ul class="about__list">
                    <li>
                        <span class="about__list-icon" aria-hidden="true"><i class="fas fa-check fa-xs"></i></span>
                        <?php esc_html_e( 'Free clinical consultations, lab services & pharmaceutical care', 'nas-medical-mission' ); ?>
                    </li>
                    <li>
                        <span class="about__list-icon" aria-hidden="true"><i class="fas fa-check fa-xs"></i></span>
                        <?php esc_html_e( '80+ dental care patients served across missions', 'nas-medical-mission' ); ?>
                    </li>
                    <li>
                        <span class="about__list-icon" aria-hidden="true"><i class="fas fa-check fa-xs"></i></span>
                        <?php esc_html_e( '582 eye care patients & 247 diabetes screenings completed', 'nas-medical-mission' ); ?>
                    </li>
                    <li>
                        <span class="about__list-icon" aria-hidden="true"><i class="fas fa-check fa-xs"></i></span>
                        <?php esc_html_e( 'Active health awareness campaigns including MPOX and CPR', 'nas-medical-mission' ); ?>
                    </li>
                    <li>
                        <span class="about__list-icon" aria-hidden="true"><i class="fas fa-check fa-xs"></i></span>
                        <?php esc_html_e( 'Blood bank support and medical equipment donations', 'nas-medical-mission' ); ?>
                    </li>
                </ul>

                <div style="display:flex;gap:1rem;flex-wrap:wrap;">
                    <a href="<?php echo esc_url( home_url( '/about-us/' ) ); ?>" class="btn btn-primary">
                        <?php esc_html_e( 'Our Full Story', 'nas-medical-mission' ); ?>
                        <i class="fas fa-arrow-right" aria-hidden="true"></i>
                    </a>
                    <a href="<?php echo esc_url( home_url( '/team/' ) ); ?>" class="btn btn-outline">
                        <?php esc_html_e( 'Meet the Team', 'nas-medical-mission' ); ?>
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>
<!-- /ABOUT -->


<!-- ======================================================
     RECENT MISSIONS
     ====================================================== -->
<section class="missions section" aria-labelledby="missions-heading">
    <div class="container">
        <div class="missions__header">
            <div>
                <span class="section-eyebrow"><?php esc_html_e( 'Latest Outreach', 'nas-medical-mission' ); ?></span>
                <h2 class="section-title" id="missions-heading">
                    <?php esc_html_e( 'Recent Medical Missions', 'nas-medical-mission' ); ?>
                </h2>
            </div>
            <a href="<?php echo esc_url( home_url( '/medical-missions/' ) ); ?>" class="btn btn-outline">
                <?php esc_html_e( 'All Missions', 'nas-medical-mission' ); ?>
                <i class="fas fa-arrow-right" aria-hidden="true"></i>
            </a>
        </div>

        <div class="missions__grid">
            <?php
            $missions_query = new WP_Query( [
                'post_type'      => [ 'post', 'nmm_mission' ],
                'posts_per_page' => 3,
                'category_name'  => 'medical-missions',
                'post_status'    => 'publish',
                'orderby'        => 'date',
                'order'          => 'DESC',
            ] );

            if ( $missions_query->have_posts() ) :
                while ( $missions_query->have_posts() ) : $missions_query->the_post();
                    $img_url   = nmm_get_post_thumbnail_url( get_the_ID(), 'nmm-card' );
                    $cats      = get_the_category();
                    $cat_label = ! empty( $cats ) ? $cats[0]->name : __( 'Medical Mission', 'nas-medical-mission' );
                    $date      = get_the_date( 'M j, Y' );
            ?>
                <article class="mission-card fade-up">
                    <div class="mission-card__img-wrap">
                        <img
                            class="mission-card__img"
                            src="<?php echo esc_url( $img_url ); ?>"
                            alt="<?php echo esc_attr( get_the_title() ); ?>"
                            loading="lazy"
                            width="640"
                            height="220"
                        >
                        <span class="mission-card__category"><?php echo esc_html( $cat_label ); ?></span>
                    </div>
                    <div class="mission-card__body">
                        <p class="mission-card__date">
                            <i class="fas fa-calendar-alt fa-xs" aria-hidden="true"></i>
                            <?php echo esc_html( $date ); ?>
                        </p>
                        <h3 class="mission-card__title">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h3>
                        <p class="mission-card__excerpt"><?php echo esc_html( get_the_excerpt() ); ?></p>
                        <a href="<?php the_permalink(); ?>" class="mission-card__link" aria-label="<?php echo esc_attr( sprintf( __( 'Read more about %s', 'nas-medical-mission' ), get_the_title() ) ); ?>">
                            <?php esc_html_e( 'Read More', 'nas-medical-mission' ); ?>
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" aria-hidden="true">
                                <path d="M3 8H13M13 8L9 4M13 8L9 12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                    </div>
                </article>
            <?php
                endwhile;
                wp_reset_postdata();
            else :
                // Fallback static cards when no posts exist
                $static_missions = [
                    [
                        'title'   => 'Quarter Two Medical Mission — Owo Town, Enugu State',
                        'date'    => 'Feb 6, 2026',
                        'cat'     => 'Medical Missions',
                        'excerpt' => 'Free clinical consultations, laboratory services, pharmaceutical care, health education, and referral services delivered to underserved residents of Owo Town, Nkanu East LGA.',
                        'img'     => 'https://images.pexels.com/photos/5863365/pexels-photo-5863365.jpeg?auto=compress&cs=tinysrgb&w=640&h=300&fit=crop',
                        'url'     => home_url( '/medical-missions/' ),
                    ],
                    [
                        'title'   => 'Medical Mission Outreach — Kukwaba Village, FCT Abuja',
                        'date'    => 'Jul 12, 2025',
                        'cat'     => 'Medical Missions',
                        'excerpt' => 'A joint free medical outreach conducted by NAS Abuja Sahara and Zuma Deck at Kukwaba Village within the Kubwa district of Bwari Area Council.',
                        'img'     => 'https://images.pexels.com/photos/3259629/pexels-photo-3259629.jpeg?auto=compress&cs=tinysrgb&w=640&h=300&fit=crop',
                        'url'     => home_url( '/medical-missions/' ),
                    ],
                    [
                        'title'   => 'NAS Medical Mission — Egini Community, Udu Delta State',
                        'date'    => 'Nov 1, 2024',
                        'cat'     => 'Medical Missions',
                        'excerpt' => 'Comprehensive primary healthcare outreach at Egini Primary Health Centre serving the Egini Community in Udu Local Government Area.',
                        'img'     => 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?w=640&auto=format&fit=crop&q=80',
                        'url'     => home_url( '/medical-missions/' ),
                    ],
                ];
                foreach ( $static_missions as $m ) :
            ?>
                <article class="mission-card fade-up">
                    <div class="mission-card__img-wrap">
                        <img class="mission-card__img" src="<?php echo esc_url( $m['img'] ); ?>" alt="<?php echo esc_attr( $m['title'] ); ?>" loading="lazy" width="640" height="220">
                        <span class="mission-card__category"><?php echo esc_html( $m['cat'] ); ?></span>
                    </div>
                    <div class="mission-card__body">
                        <p class="mission-card__date">
                            <i class="fas fa-calendar-alt fa-xs" aria-hidden="true"></i>
                            <?php echo esc_html( $m['date'] ); ?>
                        </p>
                        <h3 class="mission-card__title"><a href="<?php echo esc_url( $m['url'] ); ?>"><?php echo esc_html( $m['title'] ); ?></a></h3>
                        <p class="mission-card__excerpt"><?php echo esc_html( $m['excerpt'] ); ?></p>
                        <a href="<?php echo esc_url( $m['url'] ); ?>" class="mission-card__link">
                            <?php esc_html_e( 'Read More', 'nas-medical-mission' ); ?>
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" aria-hidden="true">
                                <path d="M3 8H13M13 8L9 4M13 8L9 12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                    </div>
                </article>
            <?php endforeach; endif; ?>
        </div>
    </div>
</section>
<!-- /MISSIONS -->


<!-- ======================================================
     IMPACT COUNTERS
     ====================================================== -->
<section class="impact" aria-labelledby="impact-heading">
    <div class="container">
        <div class="impact__inner">
            <span class="section-eyebrow" style="color:rgba(255,255,255,.6);">
                <?php esc_html_e( 'Making a Difference', 'nas-medical-mission' ); ?>
            </span>
            <h2 class="impact__title" id="impact-heading">
                <?php esc_html_e( 'Our Impact in Numbers', 'nas-medical-mission' ); ?>
            </h2>
            <p class="impact__subtitle">
                <?php esc_html_e( 'Over a decade of quarterly medical missions, health campaigns, and community outreach across Nigeria.', 'nas-medical-mission' ); ?>
            </p>

            <div class="impact__grid">
                <div class="impact__item">
                    <span class="impact__number" data-count="2763">2,763+</span>
                    <span class="impact__label"><?php esc_html_e( 'Total Patients', 'nas-medical-mission' ); ?></span>
                </div>
                <div class="impact__item">
                    <span class="impact__number" data-count="582">582</span>
                    <span class="impact__label"><?php esc_html_e( 'Eye Care Patients', 'nas-medical-mission' ); ?></span>
                </div>
                <div class="impact__item">
                    <span class="impact__number" data-count="247">247</span>
                    <span class="impact__label"><?php esc_html_e( 'Diabetes Screenings', 'nas-medical-mission' ); ?></span>
                </div>
                <div class="impact__item">
                    <span class="impact__number" data-count="80">80+</span>
                    <span class="impact__label"><?php esc_html_e( 'Dental Care', 'nas-medical-mission' ); ?></span>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /IMPACT -->


<!-- ======================================================
     CAMPAIGNS
     ====================================================== -->
<section class="campaigns section" aria-labelledby="campaigns-heading">
    <div class="container">
        <div class="text-center" style="margin-bottom:3rem;">
            <span class="section-eyebrow"><?php esc_html_e( 'Health Awareness', 'nas-medical-mission' ); ?></span>
            <h2 class="section-title" id="campaigns-heading">
                <?php esc_html_e( 'Our Campaigns', 'nas-medical-mission' ); ?>
            </h2>
            <p class="section-subtitle" style="margin:0 auto;">
                <?php esc_html_e( 'NAS Medical Mission organises and supports targeted health awareness campaigns across Nigeria to educate and protect communities.', 'nas-medical-mission' ); ?>
            </p>
        </div>

        <div class="campaigns__grid">
            <?php
            $campaigns = [
                [
                    'title' => 'MPOX Awareness Campaign',
                    'text'  => 'Comprehensive public education on MPOX symptoms, prevention, and treatment across communities in Nigeria.',
                    'img'   => 'https://images.pexels.com/photos/3952224/pexels-photo-3952224.jpeg?auto=compress&cs=tinysrgb&w=640&h=400&fit=crop',
                    'url'   => home_url( '/campaigns/' ),
                ],
                [
                    'title' => 'Resuscitation Day / CPR Training',
                    'text'  => 'Every year on October 16th, NAS leads life-saving CPR awareness events, equipping individuals with critical resuscitation skills.',
                    'img'   => 'https://images.pexels.com/photos/6129507/pexels-photo-6129507.jpeg?auto=compress&cs=tinysrgb&w=640&h=400&fit=crop',
                    'url'   => home_url( '/campaigns/' ),
                ],
                [
                    'title' => 'Diabetes & Eye Health Screening',
                    'text'  => 'Free screening events bringing diabetes testing and eye care to rural communities who lack access to diagnostic services.',
                    'img'   => 'https://images.pexels.com/photos/4226219/pexels-photo-4226219.jpeg?auto=compress&cs=tinysrgb&w=640&h=400&fit=crop',
                    'url'   => home_url( '/campaigns/' ),
                ],
            ];
            foreach ( $campaigns as $c ) :
            ?>
                <div class="campaign-card fade-up">
                    <div class="campaign-card__img-wrap">
                        <img
                            class="campaign-card__img"
                            src="<?php echo esc_url( $c['img'] ); ?>"
                            alt="<?php echo esc_attr( $c['title'] ); ?>"
                            loading="lazy"
                            width="640"
                            height="200"
                        >
                    </div>
                    <div class="campaign-card__body">
                        <h3 class="campaign-card__title"><?php echo esc_html( $c['title'] ); ?></h3>
                        <p class="campaign-card__text"><?php echo esc_html( $c['text'] ); ?></p>
                        <a href="<?php echo esc_url( $c['url'] ); ?>" class="mission-card__link" style="margin-top:1rem;display:inline-flex;">
                            <?php esc_html_e( 'Learn More', 'nas-medical-mission' ); ?>
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" aria-hidden="true">
                                <path d="M3 8H13M13 8L9 4M13 8L9 12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<!-- /CAMPAIGNS -->


<!-- ======================================================
     CTA BANNER
     ====================================================== -->
<section class="cta-banner" aria-labelledby="cta-heading">
    <div class="cta-banner__bg" aria-hidden="true"></div>
    <div class="container">
        <div class="cta-banner__content">
            <span class="section-eyebrow" style="color:rgba(255,255,255,.6);justify-content:center;">
                <?php esc_html_e( 'Get Involved', 'nas-medical-mission' ); ?>
            </span>
            <h2 class="cta-banner__title" id="cta-heading">
                <?php esc_html_e( 'Help Us Reach More Communities', 'nas-medical-mission' ); ?>
            </h2>
            <p class="cta-banner__subtitle">
                <?php esc_html_e( 'Whether you donate, volunteer, or spread the word — your support powers life-changing healthcare for those who need it most.', 'nas-medical-mission' ); ?>
            </p>
            <div class="cta-banner__actions">
                <a href="<?php echo esc_url( home_url( '/support/' ) ); ?>" class="btn btn-accent">
                    <i class="fas fa-heart" aria-hidden="true"></i>
                    <?php esc_html_e( 'Donate Today', 'nas-medical-mission' ); ?>
                </a>
                <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn-outline" style="color:white;border-color:rgba(255,255,255,0.5);">
                    <?php esc_html_e( 'Volunteer With Us', 'nas-medical-mission' ); ?>
                </a>
            </div>
        </div>
    </div>
</section>
<!-- /CTA BANNER -->


<!-- ======================================================
     LATEST NEWS / BLOG
     ====================================================== -->
<section class="blog section" aria-labelledby="blog-heading">
    <div class="container">
        <div class="blog__header">
            <div>
                <span class="section-eyebrow"><?php esc_html_e( 'News & Updates', 'nas-medical-mission' ); ?></span>
                <h2 class="section-title" id="blog-heading">
                    <?php esc_html_e( 'Latest from NMM', 'nas-medical-mission' ); ?>
                </h2>
            </div>
            <a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>" class="btn btn-outline">
                <?php esc_html_e( 'All Posts', 'nas-medical-mission' ); ?>
                <i class="fas fa-arrow-right" aria-hidden="true"></i>
            </a>
        </div>

        <div class="blog__grid">
            <?php
            $blog_query = new WP_Query( [
                'post_type'      => 'post',
                'posts_per_page' => 3,
                'post_status'    => 'publish',
                'orderby'        => 'date',
                'order'          => 'DESC',
            ] );

            if ( $blog_query->have_posts() ) :
                while ( $blog_query->have_posts() ) : $blog_query->the_post();
                    $img_url = nmm_get_post_thumbnail_url( get_the_ID(), 'nmm-card' );
                    $cats    = get_the_category();
                    $tag     = ! empty( $cats ) ? $cats[0]->name : __( 'News', 'nas-medical-mission' );
            ?>
                <article class="blog-card fade-up">
                    <div class="blog-card__img-wrap">
                        <img class="blog-card__img" src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" loading="lazy" width="640" height="200">
                    </div>
                    <div class="blog-card__body">
                        <div class="blog-card__meta">
                            <span class="blog-card__tag"><?php echo esc_html( $tag ); ?></span>
                            <span class="blog-card__date"><?php echo esc_html( get_the_date( 'M j, Y' ) ); ?></span>
                        </div>
                        <h3 class="blog-card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        <p class="blog-card__excerpt"><?php echo esc_html( get_the_excerpt() ); ?></p>
                        <a href="<?php the_permalink(); ?>" class="blog-card__link">
                            <?php esc_html_e( 'Read More', 'nas-medical-mission' ); ?>
                            <i class="fas fa-arrow-right fa-xs" aria-hidden="true"></i>
                        </a>
                    </div>
                </article>
            <?php
                endwhile;
                wp_reset_postdata();
            else :
                $static_posts = [
                    [
                        'title'  => 'Quarter Two Medical Mission in Owo Town, Nkanu East LGA of Enugu State',
                        'tag'    => 'Medical Missions',
                        'date'   => 'Mar 8, 2026',
                        'text'   => 'On 6th February 2026, NAS Medical Mission conducted its Quarter Two PWC Medical Mission, delivering free clinical consultations and healthcare to underserved residents.',
                        'img'    => 'https://images.pexels.com/photos/5863365/pexels-photo-5863365.jpeg?auto=compress&cs=tinysrgb&w=640&h=300&fit=crop',
                        'url'    => home_url( '/blog/' ),
                    ],
                    [
                        'title'  => 'Magna Carta Deck Leads By Example on Resuscitation Day',
                        'tag'    => 'Awareness Campaigns',
                        'date'   => 'Oct 16, 2025',
                        'text'   => 'On Resuscitation Day (16 October), NAS Magna Carta Deck led life-saving CPR awareness initiatives, highlighting the global need for resuscitation skills.',
                        'img'    => 'https://images.pexels.com/photos/6129507/pexels-photo-6129507.jpeg?auto=compress&cs=tinysrgb&w=640&h=300&fit=crop',
                        'url'    => home_url( '/blog/' ),
                    ],
                    [
                        'title'  => 'Medical Mission Outreach: Kukwaba Village, Kubwa, FCT Abuja',
                        'tag'    => 'News',
                        'date'   => 'Jul 26, 2025',
                        'text'   => 'A joint free medical outreach was conducted at Kukwaba Village, Kubwa as part of a broader NAS humanitarian intervention for the FCT community.',
                        'img'    => 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?w=640&auto=format&fit=crop&q=80',
                        'url'    => home_url( '/blog/' ),
                    ],
                ];
                foreach ( $static_posts as $p ) :
            ?>
                <article class="blog-card fade-up">
                    <div class="blog-card__img-wrap">
                        <img class="blog-card__img" src="<?php echo esc_url( $p['img'] ); ?>" alt="<?php echo esc_attr( $p['title'] ); ?>" loading="lazy" width="640" height="200">
                    </div>
                    <div class="blog-card__body">
                        <div class="blog-card__meta">
                            <span class="blog-card__tag"><?php echo esc_html( $p['tag'] ); ?></span>
                            <span class="blog-card__date"><?php echo esc_html( $p['date'] ); ?></span>
                        </div>
                        <h3 class="blog-card__title"><a href="<?php echo esc_url( $p['url'] ); ?>"><?php echo esc_html( $p['title'] ); ?></a></h3>
                        <p class="blog-card__excerpt"><?php echo esc_html( $p['text'] ); ?></p>
                        <a href="<?php echo esc_url( $p['url'] ); ?>" class="blog-card__link">
                            <?php esc_html_e( 'Read More', 'nas-medical-mission' ); ?>
                            <i class="fas fa-arrow-right fa-xs" aria-hidden="true"></i>
                        </a>
                    </div>
                </article>
            <?php endforeach; endif; ?>
        </div>
    </div>
</section>
<!-- /BLOG -->


<!-- ======================================================
     CONTACT SECTION
     ====================================================== -->
<section class="contact section section--alt" id="contact" aria-labelledby="contact-heading">
    <div class="container">
        <div class="text-center" style="margin-bottom:3rem;">
            <span class="section-eyebrow"><?php esc_html_e( 'Get In Touch', 'nas-medical-mission' ); ?></span>
            <h2 class="section-title" id="contact-heading">
                <?php esc_html_e( 'Contact NAS Medical Mission', 'nas-medical-mission' ); ?>
            </h2>
        </div>

        <div class="contact__inner">

            <!-- Contact Info -->
            <div>
                <p style="margin-bottom:2rem;">
                    <?php esc_html_e( 'Ready to partner with us, volunteer, or make a donation? Reach out through any of the channels below and our team will be happy to assist.', 'nas-medical-mission' ); ?>
                </p>

                <?php
                $phone   = nmm_opt( 'nmm_phone',   '+234 (0) 817 777 1952' );
                $email   = nmm_opt( 'nmm_email',   'info@nasmedicalmission.org' );
                $address = nmm_opt( 'nmm_address', 'National Association of Seadogs International Secretariat, Plot D122, Gado Nasko Road, Kubwa, Abuja FCT, Nigeria' );
                ?>

                <div class="contact__info-item">
                    <div class="contact__icon" aria-hidden="true"><i class="fas fa-phone-alt"></i></div>
                    <div>
                        <p class="contact__info-label"><?php esc_html_e( 'Phone', 'nas-medical-mission' ); ?></p>
                        <a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $phone ) ); ?>" class="contact__info-value">
                            <?php echo esc_html( $phone ); ?>
                        </a>
                    </div>
                </div>

                <div class="contact__info-item">
                    <div class="contact__icon" aria-hidden="true"><i class="fas fa-envelope"></i></div>
                    <div>
                        <p class="contact__info-label"><?php esc_html_e( 'Email', 'nas-medical-mission' ); ?></p>
                        <a href="mailto:<?php echo esc_attr( $email ); ?>" class="contact__info-value">
                            <?php echo esc_html( $email ); ?>
                        </a>
                    </div>
                </div>

                <div class="contact__info-item">
                    <div class="contact__icon" aria-hidden="true"><i class="fas fa-map-marker-alt"></i></div>
                    <div>
                        <p class="contact__info-label"><?php esc_html_e( 'Address', 'nas-medical-mission' ); ?></p>
                        <p class="contact__info-value"><?php echo esc_html( $address ); ?></p>
                    </div>
                </div>

                <div class="contact__info-item">
                    <div class="contact__icon" aria-hidden="true"><i class="fas fa-globe"></i></div>
                    <div>
                        <p class="contact__info-label"><?php esc_html_e( 'Website', 'nas-medical-mission' ); ?></p>
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="contact__info-value">www.nasmedicalmission.org</a>
                    </div>
                </div>

                <!-- Social links -->
                <div style="margin-top:1.5rem;">
                    <p class="contact__info-label" style="margin-bottom:0.75rem;"><?php esc_html_e( 'Follow Us', 'nas-medical-mission' ); ?></p>
                    <?php nmm_social_links( 'footer__social' ); ?>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="contact-form">
                <h3 class="contact-form__title"><?php esc_html_e( 'Send Us a Message', 'nas-medical-mission' ); ?></h3>

                <div id="contact-form-msg" role="alert" aria-live="polite" style="display:none;"></div>

                <form id="nmm-contact-form" novalidate>
                    <?php wp_nonce_field( 'nmm_nonce', 'nmm_contact_nonce' ); ?>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="cf-name"><?php esc_html_e( 'Full Name', 'nas-medical-mission' ); ?> <span aria-hidden="true" style="color:var(--color-danger)">*</span></label>
                            <input type="text" id="cf-name" name="name" placeholder="<?php esc_attr_e( 'Your full name', 'nas-medical-mission' ); ?>" required autocomplete="name">
                        </div>
                        <div class="form-group">
                            <label for="cf-email"><?php esc_html_e( 'Email Address', 'nas-medical-mission' ); ?> <span aria-hidden="true" style="color:var(--color-danger)">*</span></label>
                            <input type="email" id="cf-email" name="email" placeholder="<?php esc_attr_e( 'your@email.com', 'nas-medical-mission' ); ?>" required autocomplete="email">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="cf-subject"><?php esc_html_e( 'Subject', 'nas-medical-mission' ); ?></label>
                        <select id="cf-subject" name="subject">
                            <option value=""><?php esc_html_e( '— Select a topic —', 'nas-medical-mission' ); ?></option>
                            <option value="General Enquiry"><?php esc_html_e( 'General Enquiry', 'nas-medical-mission' ); ?></option>
                            <option value="Volunteering"><?php esc_html_e( 'Volunteering', 'nas-medical-mission' ); ?></option>
                            <option value="Donation / Support"><?php esc_html_e( 'Donation / Support', 'nas-medical-mission' ); ?></option>
                            <option value="Partnership"><?php esc_html_e( 'Partnership', 'nas-medical-mission' ); ?></option>
                            <option value="Media / Press"><?php esc_html_e( 'Media / Press', 'nas-medical-mission' ); ?></option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="cf-message"><?php esc_html_e( 'Message', 'nas-medical-mission' ); ?> <span aria-hidden="true" style="color:var(--color-danger)">*</span></label>
                        <textarea id="cf-message" name="message" placeholder="<?php esc_attr_e( 'Write your message here...', 'nas-medical-mission' ); ?>" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary" id="cf-submit" style="width:100%;justify-content:center;">
                        <i class="fas fa-paper-plane" aria-hidden="true"></i>
                        <span><?php esc_html_e( 'Send Message', 'nas-medical-mission' ); ?></span>
                    </button>
                </form>
            </div>

        </div>
    </div>
</section>
<!-- /CONTACT -->

<?php get_footer(); ?>
