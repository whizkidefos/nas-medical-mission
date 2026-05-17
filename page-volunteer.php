<?php
/**
 * Template Name: Volunteer
 */
get_header();
?>

<!-- Page Hero -->
<div class="page-hero" style="background:linear-gradient(135deg, var(--color-primary-dark), var(--color-primary));">
    <div class="container">
        <div class="page-hero__content">
            <h1 class="page-hero__title"><?php esc_html_e( 'Volunteer With NAS Medical Mission', 'nas-medical-mission' ); ?></h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'nas-medical-mission' ); ?></a></li>
                <li class="current"><?php esc_html_e( 'Volunteer', 'nas-medical-mission' ); ?></li>
            </ol>
        </div>
    </div>
</div>

<!-- Why Volunteer -->
<section class="section">
    <div class="container">
        <div class="about__inner">

            <!-- Media -->
            <div class="about__media fade-up">
                <div class="about__img-accent" aria-hidden="true"></div>
                <img class="about__img-main"
                     src="https://images.pexels.com/photos/6129507/pexels-photo-6129507.jpeg?auto=compress&cs=tinysrgb&w=800&h=600&fit=crop"
                     alt="<?php esc_attr_e( 'Medical volunteers at work', 'nas-medical-mission' ); ?>"
                     loading="eager" width="600" height="480">
                <div class="about__img-badge">
                    <strong>4×</strong>
                    <span><?php esc_html_e( 'Per Year', 'nas-medical-mission' ); ?></span>
                </div>
            </div>

            <!-- Content -->
            <div class="about__content fade-up">
                <span class="section-eyebrow"><?php esc_html_e( 'Join Our Team', 'nas-medical-mission' ); ?></span>
                <h2 class="section-title"><?php esc_html_e( 'Your Skills Can Change Lives', 'nas-medical-mission' ); ?></h2>
                <p><?php esc_html_e( 'NAS Medical Mission runs quarterly free medical outreach programmes across Nigeria. We welcome volunteers at every level — from frontline medical professionals to logisticians, photographers, and community organisers.', 'nas-medical-mission' ); ?></p>
                <p><?php esc_html_e( 'Every mission is a team effort. When you volunteer, you join a network of committed professionals united by one goal: bringing quality healthcare to those who need it most.', 'nas-medical-mission' ); ?></p>

                <ul class="about__list">
                    <li><span class="about__list-icon"><i class="fas fa-check fa-xs"></i></span><?php esc_html_e( 'Doctors, nurses, pharmacists, dentists & lab scientists', 'nas-medical-mission' ); ?></li>
                    <li><span class="about__list-icon"><i class="fas fa-check fa-xs"></i></span><?php esc_html_e( 'Logisticians, drivers & field coordinators', 'nas-medical-mission' ); ?></li>
                    <li><span class="about__list-icon"><i class="fas fa-check fa-xs"></i></span><?php esc_html_e( 'Photographers, videographers & social media volunteers', 'nas-medical-mission' ); ?></li>
                    <li><span class="about__list-icon"><i class="fas fa-check fa-xs"></i></span><?php esc_html_e( 'Community health educators & translators', 'nas-medical-mission' ); ?></li>
                    <li><span class="about__list-icon"><i class="fas fa-check fa-xs"></i></span><?php esc_html_e( 'Administrative & fundraising support volunteers', 'nas-medical-mission' ); ?></li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- How It Works -->
<section class="section section--alt">
    <div class="container">
        <div class="text-center" style="margin-bottom:3rem;">
            <span class="section-eyebrow" style="justify-content:center;"><?php esc_html_e( 'The Process', 'nas-medical-mission' ); ?></span>
            <h2 class="section-title"><?php esc_html_e( 'How to Get Involved', 'nas-medical-mission' ); ?></h2>
        </div>

        <div class="pillars__grid">
            <?php
            $steps = [
                [ '01', 'fas fa-file-alt',    'Apply Below',          'Fill out the volunteer application form below. Tell us about your profession, skills, and availability for quarterly missions.' ],
                [ '02', 'fas fa-user-check',  'We\'ll Review',        'Our volunteer coordinator will review your application and reach out within 5–7 business days to discuss the next steps.' ],
                [ '03', 'fas fa-calendar-alt', 'Join a Mission',      'Once onboarded, you\'ll be matched to upcoming quarterly missions based on your profession, location, and availability.' ],
                [ '04', 'fas fa-heartbeat',    'Make an Impact',      'You\'ll be part of a team delivering free healthcare to hundreds of patients in one of Nigeria\'s underserved communities.' ],
            ];
            foreach ( $steps as $s ) :
            ?>
                <div class="pillar-card fade-up" style="text-align:center; <?php echo count($steps) === 4 ? '' : ''; ?>">
                    <span class="pillar-card__number" aria-hidden="true"><?php echo esc_html( $s[0] ); ?></span>
                    <div class="pillar-card__icon" style="margin:0 auto 1.25rem; font-size:1.5rem;">
                        <i class="<?php echo esc_attr( $s[1] ); ?>"></i>
                    </div>
                    <h3 class="pillar-card__title"><?php echo esc_html( $s[2] ); ?></h3>
                    <p class="pillar-card__text"><?php echo esc_html( $s[3] ); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Volunteer Application Form -->
<section class="section" id="volunteer-form">
    <div class="container" style="max-width:860px;">
        <div class="text-center" style="margin-bottom:2.5rem;">
            <span class="section-eyebrow" style="justify-content:center;"><?php esc_html_e( 'Get Started', 'nas-medical-mission' ); ?></span>
            <h2 class="section-title"><?php esc_html_e( 'Volunteer Application', 'nas-medical-mission' ); ?></h2>
            <p><?php esc_html_e( 'All applications are reviewed by our team. Fields marked * are required.', 'nas-medical-mission' ); ?></p>
        </div>

        <div class="contact-form" style="border-radius:var(--radius-xl); max-width:100%;">

            <div id="vol-form-msg" role="alert" aria-live="polite" style="display:none;"></div>

            <form id="nmm-volunteer-form" novalidate>
                <?php wp_nonce_field( 'nmm_nonce', 'nmm_vol_nonce' ); ?>

                <!-- Personal Information -->
                <div style="margin-bottom:1.5rem; padding-bottom:1.5rem; border-bottom:1px solid var(--color-border);">
                    <h4 style="font-size:.82rem; text-transform:uppercase; letter-spacing:.12em; color:var(--color-muted); margin-bottom:1.25rem;"><?php esc_html_e( 'Personal Information', 'nas-medical-mission' ); ?></h4>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="vol-first-name"><?php esc_html_e( 'First Name', 'nas-medical-mission' ); ?> <span style="color:var(--color-danger);" aria-hidden="true">*</span></label>
                            <input type="text" id="vol-first-name" name="first_name" placeholder="<?php esc_attr_e( 'First name', 'nas-medical-mission' ); ?>" required autocomplete="given-name">
                        </div>
                        <div class="form-group">
                            <label for="vol-last-name"><?php esc_html_e( 'Last Name', 'nas-medical-mission' ); ?> <span style="color:var(--color-danger);" aria-hidden="true">*</span></label>
                            <input type="text" id="vol-last-name" name="last_name" placeholder="<?php esc_attr_e( 'Last name', 'nas-medical-mission' ); ?>" required autocomplete="family-name">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="vol-email"><?php esc_html_e( 'Email Address', 'nas-medical-mission' ); ?> <span style="color:var(--color-danger);" aria-hidden="true">*</span></label>
                            <input type="email" id="vol-email" name="email" placeholder="<?php esc_attr_e( 'your@email.com', 'nas-medical-mission' ); ?>" required autocomplete="email">
                        </div>
                        <div class="form-group">
                            <label for="vol-phone"><?php esc_html_e( 'Phone Number', 'nas-medical-mission' ); ?></label>
                            <input type="tel" id="vol-phone" name="phone" placeholder="<?php esc_attr_e( '+234...', 'nas-medical-mission' ); ?>" autocomplete="tel">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="vol-location"><?php esc_html_e( 'City / State of Residence', 'nas-medical-mission' ); ?></label>
                        <input type="text" id="vol-location" name="location" placeholder="<?php esc_attr_e( 'e.g. Lagos, Abuja, Port Harcourt...', 'nas-medical-mission' ); ?>">
                    </div>
                </div>

                <!-- Professional Information -->
                <div style="margin-bottom:1.5rem; padding-bottom:1.5rem; border-bottom:1px solid var(--color-border);">
                    <h4 style="font-size:.82rem; text-transform:uppercase; letter-spacing:.12em; color:var(--color-muted); margin-bottom:1.25rem;"><?php esc_html_e( 'Professional Details', 'nas-medical-mission' ); ?></h4>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="vol-profession"><?php esc_html_e( 'Profession / Role', 'nas-medical-mission' ); ?> <span style="color:var(--color-danger);" aria-hidden="true">*</span></label>
                            <select id="vol-profession" name="profession" required>
                                <option value=""><?php esc_html_e( '— Select your role —', 'nas-medical-mission' ); ?></option>
                                <optgroup label="<?php esc_attr_e( 'Medical Professionals', 'nas-medical-mission' ); ?>">
                                    <option value="Doctor / Physician"><?php esc_html_e( 'Doctor / Physician', 'nas-medical-mission' ); ?></option>
                                    <option value="Nurse / Midwife"><?php esc_html_e( 'Nurse / Midwife', 'nas-medical-mission' ); ?></option>
                                    <option value="Pharmacist"><?php esc_html_e( 'Pharmacist', 'nas-medical-mission' ); ?></option>
                                    <option value="Dentist"><?php esc_html_e( 'Dentist', 'nas-medical-mission' ); ?></option>
                                    <option value="Optometrist"><?php esc_html_e( 'Optometrist', 'nas-medical-mission' ); ?></option>
                                    <option value="Medical Laboratory Scientist"><?php esc_html_e( 'Medical Laboratory Scientist', 'nas-medical-mission' ); ?></option>
                                    <option value="Physiotherapist"><?php esc_html_e( 'Physiotherapist', 'nas-medical-mission' ); ?></option>
                                    <option value="Community Health Worker"><?php esc_html_e( 'Community Health Worker', 'nas-medical-mission' ); ?></option>
                                    <option value="Paramedic / EMT"><?php esc_html_e( 'Paramedic / EMT', 'nas-medical-mission' ); ?></option>
                                </optgroup>
                                <optgroup label="<?php esc_attr_e( 'Support Roles', 'nas-medical-mission' ); ?>">
                                    <option value="Logistician / Driver"><?php esc_html_e( 'Logistician / Driver', 'nas-medical-mission' ); ?></option>
                                    <option value="Photographer / Videographer"><?php esc_html_e( 'Photographer / Videographer', 'nas-medical-mission' ); ?></option>
                                    <option value="Social Media / Communications"><?php esc_html_e( 'Social Media / Communications', 'nas-medical-mission' ); ?></option>
                                    <option value="Fundraising / Administrative"><?php esc_html_e( 'Fundraising / Administrative', 'nas-medical-mission' ); ?></option>
                                    <option value="Translator / Interpreter"><?php esc_html_e( 'Translator / Interpreter', 'nas-medical-mission' ); ?></option>
                                    <option value="General Volunteer"><?php esc_html_e( 'General Volunteer', 'nas-medical-mission' ); ?></option>
                                    <option value="Other"><?php esc_html_e( 'Other', 'nas-medical-mission' ); ?></option>
                                </optgroup>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="vol-specialty"><?php esc_html_e( 'Specialty / Subspecialty', 'nas-medical-mission' ); ?></label>
                            <input type="text" id="vol-specialty" name="specialty" placeholder="<?php esc_attr_e( 'e.g. Cardiology, Paediatrics, General Practice...', 'nas-medical-mission' ); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="vol-availability"><?php esc_html_e( 'Availability', 'nas-medical-mission' ); ?></label>
                        <select id="vol-availability" name="availability">
                            <option value=""><?php esc_html_e( '— Select availability —', 'nas-medical-mission' ); ?></option>
                            <option value="Weekends only"><?php esc_html_e( 'Weekends only', 'nas-medical-mission' ); ?></option>
                            <option value="Weekdays only"><?php esc_html_e( 'Weekdays only', 'nas-medical-mission' ); ?></option>
                            <option value="Weekdays & weekends"><?php esc_html_e( 'Weekdays & weekends', 'nas-medical-mission' ); ?></option>
                            <option value="Quarterly missions only"><?php esc_html_e( 'Quarterly missions only', 'nas-medical-mission' ); ?></option>
                            <option value="Flexible"><?php esc_html_e( 'Flexible — as needed', 'nas-medical-mission' ); ?></option>
                        </select>
                    </div>
                </div>

                <!-- Background & Motivation -->
                <div style="margin-bottom:1.5rem;">
                    <h4 style="font-size:.82rem; text-transform:uppercase; letter-spacing:.12em; color:var(--color-muted); margin-bottom:1.25rem;"><?php esc_html_e( 'Background & Motivation', 'nas-medical-mission' ); ?></h4>
                    <div class="form-group">
                        <label for="vol-experience"><?php esc_html_e( 'Relevant Experience', 'nas-medical-mission' ); ?></label>
                        <textarea id="vol-experience" name="experience" style="height:110px;"
                                  placeholder="<?php esc_attr_e( 'Briefly describe your relevant professional experience, qualifications, or previous volunteer work...', 'nas-medical-mission' ); ?>"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="vol-motivation"><?php esc_html_e( 'Why Do You Want to Volunteer?', 'nas-medical-mission' ); ?></label>
                        <textarea id="vol-motivation" name="motivation" style="height:110px;"
                                  placeholder="<?php esc_attr_e( 'Tell us what motivates you to volunteer with NAS Medical Mission...', 'nas-medical-mission' ); ?>"></textarea>
                    </div>
                </div>

                <!-- Honeypot -->
                <div style="display:none;" aria-hidden="true">
                    <input type="text" name="website" tabindex="-1" autocomplete="off">
                </div>

                <button type="submit" class="btn btn-primary" id="vol-submit" style="width:100%; justify-content:center; padding:1rem 2rem; font-size:1rem;">
                    <i class="fas fa-paper-plane" aria-hidden="true"></i>
                    <span><?php esc_html_e( 'Submit Application', 'nas-medical-mission' ); ?></span>
                </button>

                <p style="font-size:.78rem; color:var(--color-muted); text-align:center; margin-top:.75rem;">
                    <?php esc_html_e( 'By submitting, you agree to be contacted by NAS Medical Mission regarding volunteer opportunities. We never share your details.', 'nas-medical-mission' ); ?>
                </p>
            </form>
        </div>
    </div>
</section>

<!-- Volunteer FAQ -->
<section class="section section--alt">
    <div class="container" style="max-width:720px;">
        <div class="text-center" style="margin-bottom:2.5rem;">
            <span class="section-eyebrow" style="justify-content:center;"><?php esc_html_e( 'Common Questions', 'nas-medical-mission' ); ?></span>
            <h2 class="section-title"><?php esc_html_e( 'Volunteer FAQs', 'nas-medical-mission' ); ?></h2>
        </div>

        <?php
        $faqs = [
            [ 'Do I need to be a medical professional?',     'No — while medical professionals are essential, we also need logisticians, photographers, social media volunteers, translators, and administrative support at every mission.' ],
            [ 'Are missions only in Abuja?',                 'No. NAS Medical Mission operates across Nigeria. Past missions have covered 9 States + FCT including Delta, Enugu, Lagos, Cross River, and others. You can volunteer near your location.' ],
            [ 'Is volunteering paid?',                       'Volunteering is unpaid. However, we cover in-mission meals and logistics where possible. The real reward is the direct impact you make in the lives of hundreds of patients.' ],
            [ 'How often are missions held?',                'Missions are held quarterly — four times per year. You can choose to volunteer at one or all four missions annually, based on your availability.' ],
            [ 'What should I bring to a mission?',           'Once accepted, our coordinator will brief you fully. Typically, medical volunteers bring their own instruments (stethoscopes, etc.), and wear comfortable field clothing. All medical supplies are provided.' ],
            [ 'How long after applying will I hear back?',   'Our team reviews applications within 5–7 business days. You\'ll receive an email confirmation once your application is reviewed, and a call to discuss next steps if you\'re accepted.' ],
        ];
        foreach ( $faqs as $i => $faq ) :
        ?>
            <div class="fade-up" style="border:1px solid var(--color-border); border-radius:var(--radius-md); margin-bottom:1rem; overflow:hidden;">
                <button type="button"
                        class="faq-toggle"
                        style="width:100%; text-align:left; padding:1.25rem 1.5rem; background:var(--color-white); border:none; cursor:pointer; display:flex; align-items:center; justify-content:space-between; gap:1rem; font-family:var(--font-body); font-size:.95rem; font-weight:600; color:var(--color-charcoal);"
                        aria-expanded="false"
                        data-faq="<?php echo esc_attr( $i ); ?>">
                    <span><?php echo esc_html( $faq[0] ); ?></span>
                    <i class="fas fa-plus" style="color:var(--color-primary); flex-shrink:0; transition:transform .25s ease;"></i>
                </button>
                <div class="faq-answer" id="faq-<?php echo esc_attr( $i ); ?>"
                     style="max-height:0; overflow:hidden; transition:max-height .35s ease;">
                    <p style="padding:0 1.5rem 1.25rem; font-size:.93rem; margin:0; color:var(--color-mid);">
                        <?php echo esc_html( $faq[1] ); ?>
                    </p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<script>
// FAQ accordion
document.querySelectorAll('.faq-toggle').forEach(function(btn) {
    btn.addEventListener('click', function() {
        var idx    = btn.getAttribute('data-faq');
        var answer = document.getElementById('faq-' + idx);
        var icon   = btn.querySelector('i');
        var isOpen = btn.getAttribute('aria-expanded') === 'true';

        // Close all
        document.querySelectorAll('.faq-toggle').forEach(function(b) {
            var a = document.getElementById('faq-' + b.getAttribute('data-faq'));
            b.setAttribute('aria-expanded', 'false');
            if (a) a.style.maxHeight = '0';
            var ic = b.querySelector('i');
            if (ic) { ic.style.transform = ''; ic.className = 'fas fa-plus'; }
        });

        // Toggle current
        if (!isOpen) {
            btn.setAttribute('aria-expanded', 'true');
            if (answer) answer.style.maxHeight = answer.scrollHeight + 'px';
            if (icon)   { icon.className = 'fas fa-minus'; icon.style.transform = 'rotate(180deg)'; }
        }
    });
});

// Volunteer form submission
(function() {
    var form   = document.getElementById('nmm-volunteer-form');
    var msgBox = document.getElementById('vol-form-msg');
    var submit = document.getElementById('vol-submit');
    if (!form) return;

    form.addEventListener('submit', function(e) {
        e.preventDefault();

        // Clear previous errors
        form.querySelectorAll('.field-error').forEach(function(el) { el.remove(); });
        form.querySelectorAll('input,select,textarea').forEach(function(el) { el.style.borderColor = ''; });

        var valid = true;
        var first      = form.querySelector('[name="first_name"]');
        var last       = form.querySelector('[name="last_name"]');
        var email      = form.querySelector('[name="email"]');
        var profession = form.querySelector('[name="profession"]');

        function fieldErr(el, msg) {
            if (!el) return;
            el.style.borderColor = '#c53030';
            var err = document.createElement('span');
            err.className = 'field-error';
            err.style.cssText = 'display:block;font-size:.8rem;color:#c53030;margin-top:.3rem;';
            err.textContent = msg;
            el.parentNode.appendChild(err);
        }

        if (!first || !first.value.trim())       { fieldErr(first,      'Please enter your first name.');           valid = false; }
        if (!last  || !last.value.trim())         { fieldErr(last,       'Please enter your last name.');            valid = false; }
        if (!email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value)) { fieldErr(email, 'Please enter a valid email.'); valid = false; }
        if (!profession || !profession.value)      { fieldErr(profession, 'Please select your profession.');          valid = false; }

        if (!valid) {
            showMsg(msgBox, 'Please fix the highlighted fields.', 'error');
            return;
        }

        var btnIcon = submit.querySelector('i');
        var btnText = submit.querySelector('span');
        submit.disabled = true;
        if (btnText) btnText.textContent = 'Submitting…';
        if (btnIcon) btnIcon.className = 'fas fa-spinner fa-spin';

        var data = new FormData(form);
        data.append('action', 'nmm_volunteer');
        if (typeof NMM !== 'undefined' && NMM.nonce) data.append('nonce', NMM.nonce);

        var ajaxUrl = (typeof NMM !== 'undefined' && NMM.ajaxUrl) ? NMM.ajaxUrl : '/wp-admin/admin-ajax.php';

        fetch(ajaxUrl, { method: 'POST', body: data })
            .then(function(r) { return r.json(); })
            .then(function(json) {
                if (json && json.success) {
                    showMsg(msgBox, json.data.message || 'Application submitted!', 'success');
                    form.reset();
                } else {
                    showMsg(msgBox, (json && json.data && json.data.message) || 'Something went wrong.', 'error');
                }
            })
            .catch(function() {
                showMsg(msgBox, 'Connection error. Please try again.', 'error');
            })
            .finally(function() {
                submit.disabled = false;
                if (btnText) btnText.textContent = 'Submit Application';
                if (btnIcon) btnIcon.className = 'fas fa-paper-plane';
            });
    });

    function showMsg(box, text, type) {
        if (!box) return;
        var ok = type === 'success';
        box.style.cssText = 'display:block;padding:.85rem 1.25rem;border-radius:8px;margin-bottom:1rem;font-size:.9rem;font-weight:600;' +
            (ok ? 'background:rgba(56,161,105,.12);color:#276749;border:1px solid rgba(56,161,105,.3);'
                : 'background:rgba(197,48,48,.08);color:#c53030;border:1px solid rgba(197,48,48,.25);');
        box.textContent = text;
        box.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        if (ok) setTimeout(function() { box.style.display = 'none'; }, 8000);
    }
})();
</script>

<?php get_footer(); ?>
