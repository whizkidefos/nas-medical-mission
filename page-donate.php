<?php
/**
 * Template Name: Donate
 *
 * Dedicated donation page. Bank details are managed via
 * Appearance → Customize → NAS Medical Mission → Donation Details.
 */
get_header();

// Pull bank details from Customiser
$bank_name    = nmm_opt( 'nmm_bank_name',    'Contact us for bank details' );
$bank_acct    = nmm_opt( 'nmm_bank_account', 'Contact us for account number' );
$bank_sort    = nmm_opt( 'nmm_bank_sort',    '' );
$bank_routing = nmm_opt( 'nmm_bank_routing', '' );
$paypal       = nmm_opt( 'nmm_paypal',       '' );
$phone        = nmm_opt( 'nmm_phone',        '+234 (0) 817 777 1952' );
$email        = nmm_opt( 'nmm_email',        'info@nasmedicalmission.org' );
?>

<!-- Page Hero -->
<div class="page-hero" style="background:linear-gradient(135deg,#4D2065,#6E378B);">
    <div class="container">
        <div class="page-hero__content">
            <h1 class="page-hero__title"><?php esc_html_e( 'Donate to NAS Medical Mission', 'nas-medical-mission' ); ?></h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'nas-medical-mission' ); ?></a></li>
                <li><a href="<?php echo esc_url( home_url( '/support/' ) ); ?>"><?php esc_html_e( 'Support', 'nas-medical-mission' ); ?></a></li>
                <li class="current"><?php esc_html_e( 'Donate', 'nas-medical-mission' ); ?></li>
            </ol>
        </div>
    </div>
</div>

<!-- Impact Banner -->
<div style="background:var(--color-accent); padding:1.25rem 0;">
    <div class="container">
        <div style="display:flex; flex-wrap:wrap; gap:2rem; align-items:center; justify-content:center; text-align:center;">
            <?php
            $impacts = [
                [ '₦5,000',   'covers medicines for 5 patients' ],
                [ '₦20,000',  'funds a day\'s lab consumables' ],
                [ '₦50,000',  'sponsors transport for a mission team' ],
                [ '₦200,000', 'funds an entire community outreach' ],
            ];
            foreach ( $impacts as $imp ) :
            ?>
                <div style="display:flex; align-items:center; gap:.5rem; font-size:.88rem; color:var(--color-charcoal);">
                    <strong style="font-family:var(--font-display); font-size:1.05rem;"><?php echo esc_html( $imp[0] ); ?></strong>
                    <span><?php echo esc_html( $imp[1] ); ?></span>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<!-- Main Content -->
<section class="section">
    <div class="container">
        <div style="display:grid; grid-template-columns:1fr 1fr; gap:4rem; align-items:start;">

            <!-- Left: How to Donate -->
            <div class="fade-up">
                <span class="section-eyebrow"><?php esc_html_e( 'Every Naira Counts', 'nas-medical-mission' ); ?></span>
                <h2 class="section-title"><?php esc_html_e( 'Your Donation in Action', 'nas-medical-mission' ); ?></h2>
                <p><?php esc_html_e( 'All donations go directly towards funding medical supplies, diagnostic consumables, team transportation, and the logistics of running quarterly free medical outreach missions across Nigeria. We do not take administrative cuts from public donations.', 'nas-medical-mission' ); ?></p>

                <!-- Bank Transfer Card -->
                <div style="background:var(--color-primary); border-radius:var(--radius-xl); padding:2rem; color:white; margin-top:2rem; margin-bottom:1.5rem;">
                    <h3 style="color:white; display:flex; align-items:center; gap:.75rem; margin-bottom:1.5rem; font-size:1.2rem;">
                        <i class="fas fa-university" style="color:var(--color-accent);"></i>
                        <?php esc_html_e( 'Bank Transfer', 'nas-medical-mission' ); ?>
                    </h3>
                    <table style="width:100%; border-collapse:collapse;">
                        <?php
                        $bank_rows = [
                            [ 'Account Name',   'NAS Medical Mission' ],
                            [ 'Bank',           $bank_name ],
                            [ 'Account Number', $bank_acct ],
                        ];
                        if ( $bank_sort )    $bank_rows[] = [ 'Sort Code',    $bank_sort ];
                        if ( $bank_routing ) $bank_rows[] = [ 'Routing No.',  $bank_routing ];
                        foreach ( $bank_rows as $row ) :
                        ?>
                            <tr style="border-bottom:1px solid rgba(255,255,255,.12);">
                                <td style="padding:10px 0; font-size:.78rem; font-weight:700; text-transform:uppercase; letter-spacing:.08em; color:rgba(255,255,255,.6); width:150px; vertical-align:top;">
                                    <?php echo esc_html( $row[0] ); ?>
                                </td>
                                <td style="padding:10px 0; font-size:.95rem; font-weight:600; color:white;">
                                    <?php echo esc_html( $row[1] ); ?>
                                </td>
                                <td style="padding:10px 0; width:32px; text-align:right; vertical-align:middle;">
                                    <button type="button"
                                            class="copy-btn"
                                            data-copy="<?php echo esc_attr( $row[1] ); ?>"
                                            title="Copy"
                                            style="background:rgba(255,255,255,.1); border:none; border-radius:6px; padding:4px 8px; color:rgba(255,255,255,.7); cursor:pointer; font-size:.75rem; transition:all .2s;">
                                        <i class="fas fa-copy"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>

                    <div style="margin-top:1.25rem; padding:1rem; background:rgba(232,197,71,.15); border:1px solid rgba(232,197,71,.3); border-radius:var(--radius-md);">
                        <p style="font-size:.83rem; color:rgba(255,255,255,.85); margin:0; line-height:1.6;">
                            <i class="fas fa-info-circle" style="color:var(--color-accent);"></i>
                            <?php printf(
                                esc_html__( 'After transferring, please email %s with your name, amount, and the reference "NMM Donation" so we can acknowledge your gift.', 'nas-medical-mission' ),
                                '<a href="mailto:' . esc_attr( $email ) . '" style="color:var(--color-accent);">' . esc_html( $email ) . '</a>'
                            ); ?>
                        </p>
                    </div>
                </div>

                <?php if ( $paypal ) : ?>
                <!-- PayPal Option -->
                <div style="background:var(--color-surface); border:1px solid var(--color-border); border-radius:var(--radius-lg); padding:1.5rem; margin-bottom:1.5rem; display:flex; align-items:center; justify-content:space-between; gap:1rem; flex-wrap:wrap;">
                    <div>
                        <h4 style="margin-bottom:.25rem; font-size:1rem;"><?php esc_html_e( 'Donate via PayPal', 'nas-medical-mission' ); ?></h4>
                        <p style="font-size:.88rem; margin:0;"><?php esc_html_e( 'Secure international donations via PayPal.', 'nas-medical-mission' ); ?></p>
                    </div>
                    <a href="<?php echo esc_url( $paypal ); ?>" target="_blank" rel="noopener" class="btn btn-primary" style="flex-shrink:0;">
                        <i class="fab fa-paypal"></i> PayPal
                    </a>
                </div>
                <?php endif; ?>

                <!-- What your donation funds -->
                <div style="background:var(--color-surface); border-radius:var(--radius-lg); padding:1.75rem; border:1px solid var(--color-border);">
                    <h4 style="margin-bottom:1rem;"><?php esc_html_e( 'Where Your Money Goes', 'nas-medical-mission' ); ?></h4>
                    <?php
                    $uses = [
                        [ 'fas fa-pills',          'Medicines & Consumables', '40%', '#6E378B' ],
                        [ 'fas fa-truck',          'Transport & Logistics',   '25%', '#8E52AD' ],
                        [ 'fas fa-microscope',     'Lab & Diagnostics',       '20%', '#E8C547' ],
                        [ 'fas fa-bullhorn',       'Awareness Campaigns',     '15%', '#4D2065' ],
                    ];
                    foreach ( $uses as $u ) :
                    ?>
                        <div style="margin-bottom:1rem;">
                            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:.35rem; font-size:.88rem;">
                                <span style="display:flex; align-items:center; gap:.5rem; font-weight:600; color:var(--color-slate);">
                                    <i class="<?php echo esc_attr( $u[0] ); ?>" style="color:var(--color-primary); width:16px; text-align:center;"></i>
                                    <?php echo esc_html( $u[1] ); ?>
                                </span>
                                <strong style="color:var(--color-primary);"><?php echo esc_html( $u[2] ); ?></strong>
                            </div>
                            <div style="height:6px; background:var(--color-border); border-radius:3px; overflow:hidden;">
                                <div style="height:100%; width:<?php echo esc_attr( $u[2] ); ?>; background:<?php echo esc_attr( $u[3] ); ?>; border-radius:3px; transition:width 1s ease;"></div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Right: Donation Intent Form -->
            <div class="fade-up" style="animation-delay:.15s; position:sticky; top:100px;">
                <div class="contact-form" style="border-radius:var(--radius-xl);">
                    <h3 class="contact-form__title" style="display:flex; align-items:center; gap:.75rem;">
                        <span style="width:40px; height:40px; background:var(--color-primary-pale); border-radius:50%; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                            <i class="fas fa-heart" style="color:var(--color-primary); font-size:.9rem;"></i>
                        </span>
                        <?php esc_html_e( 'Notify Us of Your Donation', 'nas-medical-mission' ); ?>
                    </h3>
                    <p style="font-size:.88rem; color:var(--color-muted); margin-bottom:1.5rem;">
                        <?php esc_html_e( 'After making your bank transfer, fill this form so we can acknowledge your gift and send you a confirmation.', 'nas-medical-mission' ); ?>
                    </p>

                    <div id="donate-form-msg" role="alert" aria-live="polite" style="display:none;"></div>

                    <form id="nmm-donate-form" novalidate>
                        <?php wp_nonce_field( 'nmm_nonce', 'nmm_donate_nonce' ); ?>

                        <!-- Amount selector -->
                        <div class="form-group">
                            <label><?php esc_html_e( 'Donation Amount', 'nas-medical-mission' ); ?></label>
                            <div style="display:grid; grid-template-columns:repeat(4,1fr); gap:.5rem; margin-bottom:.75rem;" id="amount-presets">
                                <?php foreach ( [ '₦5,000', '₦10,000', '₦20,000', '₦50,000' ] as $amt ) : ?>
                                    <button type="button" class="amount-preset btn btn-outline"
                                            data-amount="<?php echo esc_attr( str_replace( ['₦',','], '', $amt ) ); ?>"
                                            style="font-size:.82rem; padding:.6rem .5rem; justify-content:center;">
                                        <?php echo esc_html( $amt ); ?>
                                    </button>
                                <?php endforeach; ?>
                            </div>
                            <input type="text" id="donate-amount" name="amount"
                                   placeholder="<?php esc_attr_e( 'Or enter custom amount (₦)', 'nas-medical-mission' ); ?>">
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="donate-name"><?php esc_html_e( 'Full Name', 'nas-medical-mission' ); ?> <span style="color:var(--color-danger);" aria-hidden="true">*</span></label>
                                <input type="text" id="donate-name" name="donor_name"
                                       placeholder="<?php esc_attr_e( 'Your full name', 'nas-medical-mission' ); ?>"
                                       required autocomplete="name">
                            </div>
                            <div class="form-group">
                                <label for="donate-email"><?php esc_html_e( 'Email Address', 'nas-medical-mission' ); ?> <span style="color:var(--color-danger);" aria-hidden="true">*</span></label>
                                <input type="email" id="donate-email" name="donor_email"
                                       placeholder="<?php esc_attr_e( 'your@email.com', 'nas-medical-mission' ); ?>"
                                       required autocomplete="email">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="donate-phone"><?php esc_html_e( 'Phone Number', 'nas-medical-mission' ); ?></label>
                            <input type="tel" id="donate-phone" name="donor_phone"
                                   placeholder="<?php esc_attr_e( '+234...', 'nas-medical-mission' ); ?>"
                                   autocomplete="tel">
                        </div>

                        <div class="form-group">
                            <label for="donate-type"><?php esc_html_e( 'Donation Type', 'nas-medical-mission' ); ?></label>
                            <select id="donate-type" name="donation_type">
                                <option value="One-time"><?php esc_html_e( 'One-time Donation', 'nas-medical-mission' ); ?></option>
                                <option value="Monthly"><?php esc_html_e( 'Monthly Pledge', 'nas-medical-mission' ); ?></option>
                                <option value="Mission Sponsor"><?php esc_html_e( 'Mission Sponsorship', 'nas-medical-mission' ); ?></option>
                                <option value="Equipment"><?php esc_html_e( 'Equipment / In-Kind', 'nas-medical-mission' ); ?></option>
                                <option value="Corporate"><?php esc_html_e( 'Corporate Donation', 'nas-medical-mission' ); ?></option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="donate-message"><?php esc_html_e( 'Message / Reference (optional)', 'nas-medical-mission' ); ?></label>
                            <textarea id="donate-message" name="donor_message" style="height:90px;"
                                      placeholder="<?php esc_attr_e( 'Any notes, the mission you\'d like to support, or your bank transfer reference...', 'nas-medical-mission' ); ?>"></textarea>
                        </div>

                        <!-- Anonymous option -->
                        <div style="display:flex; align-items:center; gap:.6rem; margin-bottom:1.25rem;">
                            <input type="checkbox" id="donate-anon" name="anonymous" value="1" style="width:16px; height:16px; accent-color:var(--color-primary);">
                            <label for="donate-anon" style="font-size:.88rem; font-weight:500; margin:0; cursor:pointer;">
                                <?php esc_html_e( 'Keep my donation anonymous (name not published)', 'nas-medical-mission' ); ?>
                            </label>
                        </div>

                        <button type="submit" class="btn btn-accent" id="donate-submit"
                                style="width:100%; justify-content:center; padding:1rem 2rem; font-size:1rem; font-weight:700;">
                            <i class="fas fa-heart" aria-hidden="true"></i>
                            <span><?php esc_html_e( 'Confirm My Donation', 'nas-medical-mission' ); ?></span>
                        </button>

                        <p style="font-size:.75rem; color:var(--color-muted); text-align:center; margin-top:.75rem; line-height:1.5;">
                            <i class="fas fa-lock fa-xs"></i>
                            <?php esc_html_e( 'Your details are secure and never shared. This form records your donation intent — payment is made via bank transfer.', 'nas-medical-mission' ); ?>
                        </p>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Other Ways to Give -->
<section class="section section--alt">
    <div class="container" style="max-width:900px; text-align:center;">
        <span class="section-eyebrow" style="justify-content:center;"><?php esc_html_e( 'Other Ways to Help', 'nas-medical-mission' ); ?></span>
        <h2 class="section-title"><?php esc_html_e( 'You Can Also Support Us By…', 'nas-medical-mission' ); ?></h2>

        <div class="grid-3" style="margin-top:2.5rem; text-align:left;">
            <?php
            $others = [
                [ 'fas fa-user-md',   'Volunteering',         'Join a medical mission as a doctor, nurse, pharmacist, or support volunteer.', home_url( '/volunteer/' ), 'Apply to Volunteer' ],
                [ 'fas fa-handshake', 'Corporate Sponsorship','Fund an entire mission, donate equipment, or become an annual partner.',       home_url( '/contact/' ),   'Get in Touch' ],
                [ 'fas fa-share-alt', 'Spreading the Word',   'Share our work on social media. Awareness brings more donors and volunteers.', home_url( '/blog/' ),      'Read Our Stories' ],
            ];
            foreach ( $others as $o ) :
            ?>
                <div style="background:var(--color-white); border:1px solid var(--color-border); border-radius:var(--radius-lg); padding:1.75rem; transition:var(--transition);" class="fade-up">
                    <div style="width:52px; height:52px; background:var(--color-primary-pale); border-radius:var(--radius-md); display:flex; align-items:center; justify-content:center; margin-bottom:1.25rem; font-size:1.2rem;">
                        <i class="<?php echo esc_attr( $o[0] ); ?>" style="color:var(--color-primary);"></i>
                    </div>
                    <h3 style="font-size:1.05rem; margin-bottom:.5rem;"><?php echo esc_html( $o[1] ); ?></h3>
                    <p style="font-size:.88rem; margin-bottom:1rem;"><?php echo esc_html( $o[2] ); ?></p>
                    <a href="<?php echo esc_url( $o[3] ); ?>" class="btn btn-outline" style="font-size:.82rem; padding:.55rem 1.1rem;">
                        <?php echo esc_html( $o[4] ); ?> <i class="fas fa-arrow-right fa-xs"></i>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Scripts for this page -->
<script>
(function () {

    /* ── Amount preset buttons ───────────────────────── */
    var presets = document.querySelectorAll('.amount-preset');
    var amtInput = document.getElementById('donate-amount');

    presets.forEach(function (btn) {
        btn.addEventListener('click', function () {
            presets.forEach(function (b) {
                b.classList.remove('btn-primary');
                b.classList.add('btn-outline');
            });
            btn.classList.remove('btn-outline');
            btn.classList.add('btn-primary');
            if (amtInput) amtInput.value = '₦' + Number(btn.getAttribute('data-amount')).toLocaleString();
        });
    });

    /* ── Copy buttons ────────────────────────────────── */
    document.querySelectorAll('.copy-btn').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var text = btn.getAttribute('data-copy');
            if (!text) return;
            navigator.clipboard.writeText(text).then(function () {
                var icon = btn.querySelector('i');
                if (icon) { icon.className = 'fas fa-check'; }
                btn.style.background = 'rgba(56,161,105,.25)';
                setTimeout(function () {
                    if (icon) icon.className = 'fas fa-copy';
                    btn.style.background = '';
                }, 2000);
            });
        });
    });

    /* ── Donation intent form ────────────────────────── */
    var form   = document.getElementById('nmm-donate-form');
    var msgBox = document.getElementById('donate-form-msg');
    var submit = document.getElementById('donate-submit');
    if (!form) return;

    form.addEventListener('submit', function (e) {
        e.preventDefault();

        form.querySelectorAll('.field-error').forEach(function (el) { el.remove(); });
        form.querySelectorAll('input,select,textarea').forEach(function (el) { el.style.borderColor = ''; });

        var name  = form.querySelector('[name="donor_name"]');
        var email = form.querySelector('[name="donor_email"]');
        var valid = true;

        function err(el, msg) {
            if (!el) return;
            el.style.borderColor = '#c53030';
            var sp = document.createElement('span');
            sp.className = 'field-error';
            sp.style.cssText = 'display:block;font-size:.8rem;color:#c53030;margin-top:.3rem;';
            sp.textContent = msg;
            el.parentNode.appendChild(sp);
        }

        if (!name  || !name.value.trim())                                      { err(name,  'Please enter your name.');         valid = false; }
        if (!email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value.trim())) { err(email, 'Please enter a valid email.');     valid = false; }

        if (!valid) { showMsg(msgBox, 'Please fix the highlighted fields.', 'error'); return; }

        var btnIcon = submit.querySelector('i');
        var btnText = submit.querySelector('span');
        submit.disabled = true;
        if (btnText) btnText.textContent = 'Sending…';
        if (btnIcon) btnIcon.className = 'fas fa-spinner fa-spin';

        var data = new FormData(form);
        data.append('action', 'nmm_donate_intent');
        if (typeof NMM !== 'undefined' && NMM.nonce) data.append('nonce', NMM.nonce);

        fetch((typeof NMM !== 'undefined' ? NMM.ajaxUrl : '/wp-admin/admin-ajax.php'), {
            method: 'POST', body: data
        })
        .then(function (r) { return r.json(); })
        .then(function (json) {
            if (json && json.success) {
                showMsg(msgBox, json.data.message || 'Thank you — your donation has been noted!', 'success');
                form.reset();
                presets.forEach(function (b) { b.classList.remove('btn-primary'); b.classList.add('btn-outline'); });
            } else {
                showMsg(msgBox, (json && json.data && json.data.message) || 'Something went wrong.', 'error');
            }
        })
        .catch(function () { showMsg(msgBox, 'Connection error. Please try again.', 'error'); })
        .finally(function () {
            submit.disabled = false;
            if (btnText) btnText.textContent = 'Confirm My Donation';
            if (btnIcon) btnIcon.className = 'fas fa-heart';
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
        if (ok) setTimeout(function () { box.style.display = 'none'; }, 8000);
    }

})();
</script>

<?php get_footer(); ?>
