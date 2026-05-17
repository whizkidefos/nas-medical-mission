<?php
/**
 * Template Name: About Us
 */
get_header();
?>

<!-- Page Hero -->
<div class="page-hero">
    <div class="container">
        <div class="page-hero__content">
            <h1 class="page-hero__title"><?php esc_html_e( 'About NAS Medical Mission', 'nas-medical-mission' ); ?></h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'nas-medical-mission' ); ?></a></li>
                <li class="current"><?php esc_html_e( 'About Us', 'nas-medical-mission' ); ?></li>
            </ol>
        </div>
    </div>
</div>

<!-- Mission Statement -->
<section class="section">
    <div class="container">
        <div class="about__inner">
            <div class="about__media fade-up">
                <div class="about__img-accent" aria-hidden="true"></div>
                <img class="about__img-main"
                     src="https://images.pexels.com/photos/5863365/pexels-photo-5863365.jpeg?auto=compress&cs=tinysrgb&w=800&h=600&fit=crop"
                     alt="<?php esc_attr_e( 'Medical mission volunteers', 'nas-medical-mission' ); ?>"
                     loading="eager" width="600" height="480">
                <div class="about__img-badge">
                    <strong>2012</strong>
                    <span><?php esc_html_e( 'Formally Founded', 'nas-medical-mission' ); ?></span>
                </div>
            </div>
            <div class="about__content fade-up">
                <span class="section-eyebrow"><?php esc_html_e( 'Our Mission', 'nas-medical-mission' ); ?></span>
                <h2 class="section-title"><?php esc_html_e( 'Medical Intervention for Humanistic Ideals', 'nas-medical-mission' ); ?></h2>
                <p><?php esc_html_e( 'Since 1952, the 3rd Compass Point has been a major objective for the National Association of Seadogs (Pyrates Confraternity). Over the decades, NAS has carried out several medical humanitarian causes, including equipping health facilities, paying medical bills of indigent patients, organising free medical missions, and supporting various hospital blood banks.', 'nas-medical-mission' ); ?></p>
                <p><?php esc_html_e( 'Responding to the growing desperation for free medical services as many citizens struggled with a regressing economy, members decided to focus increasingly on medical intervention through free medical missions — leveraging broad human resources to help communities and individuals.', 'nas-medical-mission' ); ?></p>
                <ul class="about__list">
                    <li><span class="about__list-icon"><i class="fas fa-check fa-xs"></i></span><?php esc_html_e( 'Free clinical consultations, lab & pharmaceutical care', 'nas-medical-mission' ); ?></li>
                    <li><span class="about__list-icon"><i class="fas fa-check fa-xs"></i></span><?php esc_html_e( 'Dental, eye care & diabetes screening outreach', 'nas-medical-mission' ); ?></li>
                    <li><span class="about__list-icon"><i class="fas fa-check fa-xs"></i></span><?php esc_html_e( 'Health education, referral services & blood bank support', 'nas-medical-mission' ); ?></li>
                    <li><span class="about__list-icon"><i class="fas fa-check fa-xs"></i></span><?php esc_html_e( 'Quarterly structured outreach across Nigeria', 'nas-medical-mission' ); ?></li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Founding Story -->
<section class="section section--alt">
    <div class="container" style="max-width:860px;text-align:center;">
        <span class="section-eyebrow" style="justify-content:center;"><?php esc_html_e( 'Our History', 'nas-medical-mission' ); ?></span>
        <h2 class="section-title"><?php esc_html_e( 'Founding the NAS Medical Mission', 'nas-medical-mission' ); ?></h2>

        <div style="display:flex; flex-direction:column; gap:2rem; text-align:left; margin-top:2rem;">
            <?php
            $timeline = [
                [ '2010', 'First Community Free Medical Mission', 'In November 2010, under the leadership of Oscar Egwuonwu, NAS organised a community free medical mission as a major feature of its quarterly meeting at Ugep, Cross River State. A free cervical cancer screening was carried out at Ugep General Hospital.' ],
                [ '2011', 'National Konverge Mission, Abuja', 'In August 2011, as part of its National Konverge, a free medical mission was organised in Abuja under the aegis of NAS We Care — a United States-based charity arm of the organisation.' ],
                [ '2012', 'Formal Institutionalisation', 'In August 2012, under the leadership of Ide Owodiong Idemeko, the office of Head of Medical Mission (Medical Pyrate) was established. Dr. Ken Okoro of the Federal Medical Centre became the first Head. The NAS Medical Mission was structured as a quarterly event. The first quarterly mission held on November 1, 2012 at Ogbe Ijaw Community, Warri.' ],
                [ '2024+', '23 Missions and Counting', 'Today NAS Medical Mission has reached 9 States + FCT, 16+ communities, served 2,763+ patients — with eye care, dental, diabetes screening, and comprehensive primary healthcare delivered entirely free of charge.' ],
            ];
            foreach ( $timeline as $i => $item ) :
            ?>
                <div class="fade-up" style="display:flex; gap:2rem; align-items:flex-start; background:var(--color-white); border-radius:var(--radius-lg); padding:2rem; border:1px solid var(--color-border); box-shadow:var(--shadow-card);">
                    <div style="flex-shrink:0; width:72px; height:72px; background:var(--color-primary); border-radius:var(--radius-md); display:flex; align-items:center; justify-content:center; font-family:var(--font-display); font-size:1rem; font-weight:700; color:white; text-align:center; line-height:1.2;">
                        <?php echo esc_html( $item[0] ); ?>
                    </div>
                    <div>
                        <h3 style="font-size:1.1rem; margin-bottom:.5rem;"><?php echo esc_html( $item[1] ); ?></h3>
                        <p style="margin:0; font-size:.95rem;"><?php echo esc_html( $item[2] ); ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Impact stats -->
<section class="impact">
    <div class="container">
        <div class="impact__inner">
            <span class="section-eyebrow" style="color:rgba(255,255,255,.6); justify-content:center;"><?php esc_html_e( 'Our Impact', 'nas-medical-mission' ); ?></span>
            <h2 class="impact__title"><?php esc_html_e( 'A Decade of Compassionate Care', 'nas-medical-mission' ); ?></h2>
            <p class="impact__subtitle"><?php esc_html_e( 'Every number represents a life touched, a family helped, a community strengthened.', 'nas-medical-mission' ); ?></p>
            <div class="impact__grid">
                <div class="impact__item"><span class="impact__number" data-count="2763">2,763+</span><span class="impact__label"><?php esc_html_e( 'Patients Treated', 'nas-medical-mission' ); ?></span></div>
                <div class="impact__item"><span class="impact__number" data-count="23">23+</span><span class="impact__label"><?php esc_html_e( 'Medical Missions', 'nas-medical-mission' ); ?></span></div>
                <div class="impact__item"><span class="impact__number" data-count="16">16+</span><span class="impact__label"><?php esc_html_e( 'Communities', 'nas-medical-mission' ); ?></span></div>
                <div class="impact__item"><span class="impact__number" data-count="9">9</span><span class="impact__label"><?php esc_html_e( 'States + FCT', 'nas-medical-mission' ); ?></span></div>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="cta-banner">
    <div class="cta-banner__bg"></div>
    <div class="container">
        <div class="cta-banner__content">
            <h2 class="cta-banner__title"><?php esc_html_e( 'Join Our Mission', 'nas-medical-mission' ); ?></h2>
            <p class="cta-banner__subtitle"><?php esc_html_e( 'Whether you volunteer your skills or donate to support operations, you become part of something extraordinary.', 'nas-medical-mission' ); ?></p>
            <div class="cta-banner__actions">
                <a href="<?php echo esc_url( home_url( '/support/' ) ); ?>" class="btn btn-accent"><i class="fas fa-heart"></i> <?php esc_html_e( 'Donate Now', 'nas-medical-mission' ); ?></a>
                <a href="<?php echo esc_url( home_url( '/team/' ) ); ?>" class="btn btn-outline" style="color:white;border-color:rgba(255,255,255,.5);"><?php esc_html_e( 'Meet the Team', 'nas-medical-mission' ); ?></a>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
