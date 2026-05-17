<?php
/**
 * Template Name: Contact
 */
get_header();

$phone   = nmm_opt( 'nmm_phone',   '+234 (0) 817 777 1952' );
$email   = nmm_opt( 'nmm_email',   'info@nasmedicalmission.org' );
$address = nmm_opt( 'nmm_address', 'National Association of Seadogs International Secretariat, Plot D122, Gado Nasko Road, Kubwa, Abuja FCT, Nigeria' );
?>

<!-- Page Hero -->
<div class="page-hero">
    <div class="container">
        <div class="page-hero__content">
            <h1 class="page-hero__title"><?php esc_html_e( 'Contact Us', 'nas-medical-mission' ); ?></h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'nas-medical-mission' ); ?></a></li>
                <li class="current"><?php esc_html_e( 'Contact', 'nas-medical-mission' ); ?></li>
            </ol>
        </div>
    </div>
</div>

<!-- Contact Section -->
<section class="section">
    <div class="container">
        <div class="contact__inner" style="gap:5rem;">

            <!-- Info Column -->
            <div class="fade-up">
                <span class="section-eyebrow"><?php esc_html_e( 'Get in Touch', 'nas-medical-mission' ); ?></span>
                <h2 class="section-title"><?php esc_html_e( 'We\'d Love to Hear From You', 'nas-medical-mission' ); ?></h2>
                <p><?php esc_html_e( 'Whether you want to partner with us, volunteer your medical skills, make a donation, or simply learn more — reach out through any of the channels below.', 'nas-medical-mission' ); ?></p>

                <div style="margin-top:2rem; display:flex; flex-direction:column; gap:1.5rem;">
                    <div class="contact__info-item">
                        <div class="contact__icon"><i class="fas fa-phone-alt"></i></div>
                        <div>
                            <p class="contact__info-label"><?php esc_html_e( 'Phone', 'nas-medical-mission' ); ?></p>
                            <a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $phone ) ); ?>" class="contact__info-value"><?php echo esc_html( $phone ); ?></a>
                        </div>
                    </div>
                    <div class="contact__info-item">
                        <div class="contact__icon"><i class="fas fa-envelope"></i></div>
                        <div>
                            <p class="contact__info-label"><?php esc_html_e( 'Email', 'nas-medical-mission' ); ?></p>
                            <a href="mailto:<?php echo esc_attr( $email ); ?>" class="contact__info-value"><?php echo esc_html( $email ); ?></a>
                        </div>
                    </div>
                    <div class="contact__info-item">
                        <div class="contact__icon"><i class="fas fa-map-marker-alt"></i></div>
                        <div>
                            <p class="contact__info-label"><?php esc_html_e( 'Address', 'nas-medical-mission' ); ?></p>
                            <p class="contact__info-value"><?php echo esc_html( $address ); ?></p>
                        </div>
                    </div>
                    <div class="contact__info-item">
                        <div class="contact__icon"><i class="fas fa-clock"></i></div>
                        <div>
                            <p class="contact__info-label"><?php esc_html_e( 'Response Time', 'nas-medical-mission' ); ?></p>
                            <p class="contact__info-value"><?php esc_html_e( 'We respond within 1–3 business days.', 'nas-medical-mission' ); ?></p>
                        </div>
                    </div>
                </div>

                <!-- Social -->
                <div style="margin-top:2.5rem; padding-top:2rem; border-top:1px solid var(--color-border);">
                    <p class="contact__info-label" style="margin-bottom:0.75rem;"><?php esc_html_e( 'Follow Us', 'nas-medical-mission' ); ?></p>
                    <?php nmm_social_links( 'footer__social' ); ?>
                </div>

                <!-- Volunteer CTA -->
                <div style="margin-top:2.5rem; background:var(--color-primary-pale); border:1px solid rgba(110,55,139,.2); border-radius:var(--radius-lg); padding:1.5rem;">
                    <h4 style="margin-bottom:.5rem;"><?php esc_html_e( 'Volunteer Your Skills', 'nas-medical-mission' ); ?></h4>
                    <p style="font-size:.9rem; margin-bottom:1rem;"><?php esc_html_e( 'Are you a medical professional, logistician, or organiser? We welcome volunteers at every level.', 'nas-medical-mission' ); ?></p>
                    <a href="<?php echo esc_url( home_url( '/support/' ) ); ?>" class="btn btn-primary" style="font-size:.875rem; padding:.7rem 1.5rem;">
                        <i class="fas fa-hands-helping"></i> <?php esc_html_e( 'Get Involved', 'nas-medical-mission' ); ?>
                    </a>
                </div>
            </div>

            <!-- Form Column -->
            <div class="contact-form fade-up" style="animation-delay:.15s;">
                <h3 class="contact-form__title"><?php esc_html_e( 'Send Us a Message', 'nas-medical-mission' ); ?></h3>
                <p style="font-size:.9rem; color:var(--color-muted); margin-bottom:1.5rem;">
                    <?php esc_html_e( 'All submissions are captured in our system and you\'ll receive an auto-reply confirming we received your message.', 'nas-medical-mission' ); ?>
                </p>

                <div id="contact-form-msg" role="alert" aria-live="polite" style="display:none;"></div>

                <form id="nmm-contact-form" novalidate>
                    <?php wp_nonce_field( 'nmm_nonce', 'nmm_contact_nonce' ); ?>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="cf-name"><?php esc_html_e( 'Full Name', 'nas-medical-mission' ); ?> <span style="color:var(--color-danger);" aria-hidden="true">*</span></label>
                            <input type="text" id="cf-name" name="name" placeholder="<?php esc_attr_e( 'Your full name', 'nas-medical-mission' ); ?>" required autocomplete="name">
                        </div>
                        <div class="form-group">
                            <label for="cf-email"><?php esc_html_e( 'Email Address', 'nas-medical-mission' ); ?> <span style="color:var(--color-danger);" aria-hidden="true">*</span></label>
                            <input type="email" id="cf-email" name="email" placeholder="<?php esc_attr_e( 'your@email.com', 'nas-medical-mission' ); ?>" required autocomplete="email">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="cf-phone"><?php esc_html_e( 'Phone Number', 'nas-medical-mission' ); ?></label>
                            <input type="tel" id="cf-phone" name="phone" placeholder="<?php esc_attr_e( '+234...', 'nas-medical-mission' ); ?>" autocomplete="tel">
                        </div>
                        <div class="form-group">
                            <label for="cf-subject"><?php esc_html_e( 'Subject', 'nas-medical-mission' ); ?></label>
                            <select id="cf-subject" name="subject">
                                <option value=""><?php esc_html_e( '— Select a topic —', 'nas-medical-mission' ); ?></option>
                                <option value="General Enquiry"><?php esc_html_e( 'General Enquiry', 'nas-medical-mission' ); ?></option>
                                <option value="Volunteering"><?php esc_html_e( 'Volunteering', 'nas-medical-mission' ); ?></option>
                                <option value="Donation / Support"><?php esc_html_e( 'Donation / Support', 'nas-medical-mission' ); ?></option>
                                <option value="Partnership"><?php esc_html_e( 'Partnership / Sponsorship', 'nas-medical-mission' ); ?></option>
                                <option value="Media / Press"><?php esc_html_e( 'Media / Press', 'nas-medical-mission' ); ?></option>
                                <option value="Medical Mission Enquiry"><?php esc_html_e( 'Medical Mission Enquiry', 'nas-medical-mission' ); ?></option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="cf-message"><?php esc_html_e( 'Message', 'nas-medical-mission' ); ?> <span style="color:var(--color-danger);" aria-hidden="true">*</span></label>
                        <textarea id="cf-message" name="message" placeholder="<?php esc_attr_e( 'How can we help you?', 'nas-medical-mission' ); ?>" required></textarea>
                    </div>

                    <!-- Honeypot (spam prevention) -->
                    <div style="display:none;" aria-hidden="true">
                        <label for="cf-website">Website</label>
                        <input type="text" id="cf-website" name="website" tabindex="-1" autocomplete="off">
                    </div>

                    <button type="submit" class="btn btn-primary" id="cf-submit" style="width:100%; justify-content:center; padding:1rem 2rem; font-size:1rem;">
                        <i class="fas fa-paper-plane"></i>
                        <span><?php esc_html_e( 'Send Message', 'nas-medical-mission' ); ?></span>
                    </button>

                    <p style="font-size:.78rem; color:var(--color-muted); text-align:center; margin-top:.75rem;">
                        <?php esc_html_e( 'Your information is never shared with third parties.', 'nas-medical-mission' ); ?>
                    </p>
                </form>
            </div>

        </div>
    </div>
</section>

<?php get_footer(); ?>
