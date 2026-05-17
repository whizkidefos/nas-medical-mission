<?php
/**
 * Template Name: Support
 */
get_header();
?>

<div class="page-hero">
    <div class="container">
        <div class="page-hero__content">
            <h1 class="page-hero__title"><?php esc_html_e( 'Support Our Mission', 'nas-medical-mission' ); ?></h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'nas-medical-mission' ); ?></a></li>
                <li class="current"><?php esc_html_e( 'Support', 'nas-medical-mission' ); ?></li>
            </ol>
        </div>
    </div>
</div>

<!-- Support Intro -->
<section class="section">
    <div class="container" style="max-width:800px; text-align:center;">
        <span class="section-eyebrow" style="justify-content:center;"><?php esc_html_e( 'Make a Difference', 'nas-medical-mission' ); ?></span>
        <h2 class="section-title"><?php esc_html_e( 'Your Support Powers Free Healthcare', 'nas-medical-mission' ); ?></h2>
        <p><?php esc_html_e( 'Every naira donated, every volunteer hour given, and every partnership formed helps us reach more communities across Nigeria with life-changing free healthcare. Here\'s how you can get involved.', 'nas-medical-mission' ); ?></p>
    </div>
</section>

<!-- Ways to Support -->
<section class="section section--alt">
    <div class="container">
        <div class="grid-3" style="gap:2rem;">
            <?php
            $ways = [
                [
                    'icon'  => 'fas fa-donate',
                    'title' => 'Financial Donation',
                    'text'  => 'A direct financial contribution funds medical supplies, transportation, and logistics for our quarterly missions. Every donation — large or small — makes a direct impact.',
                    'cta'   => 'Donate Now',
                    'url'   => home_url( '/donate/' ),
                ],
                [
                    'icon'  => 'fas fa-user-md',
                    'title' => 'Volunteer Your Skills',
                    'text'  => 'Are you a doctor, nurse, pharmacist, lab scientist, or dentist? Join our roster of medical volunteers for upcoming quarterly missions across Nigeria.',
                    'cta'   => 'Register as Volunteer',
                    'url'   => home_url( '/volunteer/' ),
                ],
                [
                    'icon'  => 'fas fa-handshake',
                    'title' => 'Corporate Partnership',
                    'text'  => 'Partner with NAS Medical Mission as a corporate sponsor. Provide medical equipment, fund an entire mission, or sponsor a health awareness campaign.',
                    'cta'   => 'Become a Partner',
                    'url'   => home_url( '/contact/' ),
                ],
            ];
            foreach ( $ways as $w ) :
            ?>
                <div class="pillar-card fade-up" style="text-align:center;">
                    <div class="pillar-card__icon" style="margin:0 auto 1.5rem; font-size:1.6rem;">
                        <i class="<?php echo esc_attr( $w['icon'] ); ?>"></i>
                    </div>
                    <h3 class="pillar-card__title"><?php echo esc_html( $w['title'] ); ?></h3>
                    <p class="pillar-card__text"><?php echo esc_html( $w['text'] ); ?></p>
                    <a href="<?php echo esc_url( $w['url'] ); ?>" class="btn btn-primary" style="margin-top:1.5rem; font-size:.875rem;">
                        <?php echo esc_html( $w['cta'] ); ?>
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Donation Section -->
<section class="section" id="donate">
    <div class="container" style="max-width:700px;">
        <div style="text-align:center; margin-bottom:2.5rem;">
            <span class="section-eyebrow" style="justify-content:center;"><?php esc_html_e( 'Donate', 'nas-medical-mission' ); ?></span>
            <h2 class="section-title"><?php esc_html_e( 'Make a Direct Donation', 'nas-medical-mission' ); ?></h2>
            <p><?php esc_html_e( 'All donations go directly towards funding medical missions, supplies, and outreach. Please use the bank details below to transfer your support.', 'nas-medical-mission' ); ?></p>
        </div>

        <div style="background:var(--color-primary); border-radius:var(--radius-xl); padding:2.5rem; color:white; margin-bottom:2rem;">
            <h3 style="color:var(--color-accent); margin-bottom:1.5rem; display:flex; align-items:center; gap:.75rem;">
                <i class="fas fa-university"></i>
                <?php esc_html_e( 'Bank Transfer Details', 'nas-medical-mission' ); ?>
            </h3>

            <?php
            $bank_details = [
                'Account Name'   => 'NAS Medical Mission',
                'Bank'           => 'Contact us for current bank details',
                'Account Number' => 'Contact us for account number',
                'Sort Code'      => 'Contact us for sort code',
            ];
            ?>

            <table style="width:100%; border-collapse:collapse;">
                <?php foreach ( $bank_details as $label => $value ) : ?>
                <tr style="border-bottom:1px solid rgba(255,255,255,.1);">
                    <td style="padding:10px 0; font-size:.82rem; font-weight:700; letter-spacing:.08em; text-transform:uppercase; color:rgba(255,255,255,.6); width:160px;"><?php echo esc_html( $label ); ?></td>
                    <td style="padding:10px 0; font-size:.95rem; font-weight:600;"><?php echo esc_html( $value ); ?></td>
                </tr>
                <?php endforeach; ?>
            </table>

            <p style="margin-top:1.5rem; font-size:.85rem; color:rgba(255,255,255,.7);">
                <?php esc_html_e( 'After making your transfer, please email us at ', 'nas-medical-mission' ); ?>
                <a href="mailto:<?php echo esc_attr( nmm_opt( 'nmm_email', 'info@nasmedicalmission.org' ) ); ?>" style="color:var(--color-accent);">
                    <?php echo esc_html( nmm_opt( 'nmm_email', 'info@nasmedicalmission.org' ) ); ?>
                </a>
                <?php esc_html_e( ' with your name, amount, and reference "NMM Donation".', 'nas-medical-mission' ); ?>
            </p>
        </div>

        <div style="text-align:center;">
            <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn-outline">
                <i class="fas fa-envelope"></i>
                <?php esc_html_e( 'Contact Us for More Info', 'nas-medical-mission' ); ?>
            </a>
        </div>
    </div>
</section>

<?php get_footer(); ?>
