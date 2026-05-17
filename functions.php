<?php
require_once get_template_directory() . '/inc/walker-nav.php';
/**
 * NAS Medical Mission — functions.php
 * Theme setup, asset enqueuing, menus, widgets, CPTs, helpers
 */

defined( 'ABSPATH' ) || exit;

/* ============================================================
   1. THEME SETUP
   ============================================================ */
function nmm_theme_setup() {
    load_theme_textdomain( 'nas-medical-mission', get_template_directory() . '/languages' );

    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', [ 'search-form','comment-form','comment-list','gallery','caption','style','script' ] );
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'customize-selective-refresh-widgets' );
    add_theme_support( 'wp-block-styles' );
    add_theme_support( 'align-wide' );
    add_theme_support( 'responsive-embeds' );
    add_theme_support( 'editor-styles' );

    // Custom logo
    add_theme_support( 'custom-logo', [
        'height'      => 120,
        'width'       => 300,
        'flex-height' => true,
        'flex-width'  => true,
    ] );

    // Thumbnail sizes
    add_image_size( 'nmm-card',    640, 420, true );
    add_image_size( 'nmm-hero',   1600, 800, true );
    add_image_size( 'nmm-thumb',   400, 300, true );
    add_image_size( 'nmm-square',  600, 600, true );

    // Menus
    register_nav_menus( [
        'primary' => __( 'Primary Navigation', 'nas-medical-mission' ),
        'footer'  => __( 'Footer Navigation',  'nas-medical-mission' ),
        'social'  => __( 'Social Links',        'nas-medical-mission' ),
    ] );
}
add_action( 'after_setup_theme', 'nmm_theme_setup' );


/* ============================================================
   2. ENQUEUE ASSETS
   ============================================================ */
function nmm_enqueue_assets() {
    $ver = wp_get_theme()->get( 'Version' );
    $dir = get_template_directory_uri();

    // Google Fonts — Playfair Display + DM Sans
    wp_enqueue_style(
        'nmm-fonts',
        'https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;0,900;1,700&family=DM+Sans:ital,opsz,wght@0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;1,9..40,400&display=swap',
        [],
        null
    );

    // Tailwind CDN (play version — swap for compiled build in production)
    wp_enqueue_script( 'tailwind-cdn', 'https://cdn.tailwindcss.com', [], null, false );

    // Font Awesome
    wp_enqueue_style(
        'font-awesome',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css',
        [],
        '6.5.0'
    );

    // Theme stylesheet
    wp_enqueue_style( 'nmm-style', get_stylesheet_uri(), [ 'nmm-fonts', 'font-awesome' ], $ver );

    // Main JS
    wp_enqueue_script( 'nmm-main', $dir . '/js/main.js', [], $ver, true );

    // Pass data to JS
    wp_localize_script( 'nmm-main', 'NMM', [
        'ajaxUrl' => admin_url( 'admin-ajax.php' ),
        'nonce'   => wp_create_nonce( 'nmm_nonce' ),
        'siteUrl' => get_site_url(),
    ] );

    // Comments
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'nmm_enqueue_assets' );

// Tailwind config inline — must come after tailwind CDN
function nmm_tailwind_config() { ?>
<script>
tailwind.config = {
    theme: {
        extend: {
            colors: {
                primary:  { DEFAULT: '#6E378B', dark: '#4D2065', light: '#8E52AD', pale: '#F3EDF8' },
                accent:   { DEFAULT: '#E8C547', dark: '#C9A830' },
                charcoal: '#1A1A2E',
                nmm:      { slate: '#2D3748', mid: '#718096' },
            },
            fontFamily: {
                display: ['"Playfair Display"', 'Georgia', 'serif'],
                body:    ['"DM Sans"', 'system-ui', 'sans-serif'],
            },
        }
    }
}
</script>
<?php }
add_action( 'wp_head', 'nmm_tailwind_config', 5 );


/* ============================================================
   3. WIDGETS / SIDEBARS
   ============================================================ */
function nmm_register_sidebars() {
    $defaults = [ 'before_widget' => '<div class="widget %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="widget__title">', 'after_title' => '</h4>' ];

    register_sidebar( array_merge( $defaults, [
        'name' => __( 'Blog Sidebar', 'nas-medical-mission' ),
        'id'   => 'sidebar-blog',
    ] ) );

    register_sidebar( array_merge( $defaults, [
        'name' => __( 'Footer Column 1', 'nas-medical-mission' ),
        'id'   => 'footer-1',
    ] ) );

    register_sidebar( array_merge( $defaults, [
        'name' => __( 'Footer Column 2', 'nas-medical-mission' ),
        'id'   => 'footer-2',
    ] ) );
}
add_action( 'widgets_init', 'nmm_register_sidebars' );


/* ============================================================
   4. CUSTOM POST TYPES
   ============================================================ */

// Medical Missions CPT
function nmm_register_cpts() {
    // Missions
    register_post_type( 'nmm_mission', [
        'labels'  => nmm_cpt_labels( 'Mission', 'Missions' ),
        'public'  => true,
        'has_archive' => true,
        'menu_icon'   => 'dashicons-heart',
        'rewrite'     => [ 'slug' => 'medical-missions' ],
        'supports'    => [ 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ],
        'show_in_rest' => true,
    ] );

    // Campaigns
    register_post_type( 'nmm_campaign', [
        'labels'  => nmm_cpt_labels( 'Campaign', 'Campaigns' ),
        'public'  => true,
        'has_archive' => true,
        'menu_icon'   => 'dashicons-megaphone',
        'rewrite'     => [ 'slug' => 'campaigns' ],
        'supports'    => [ 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ],
        'show_in_rest' => true,
    ] );

    // Team Members
    register_post_type( 'nmm_team', [
        'labels'  => nmm_cpt_labels( 'Team Member', 'Team Members' ),
        'public'  => true,
        'menu_icon'   => 'dashicons-groups',
        'rewrite'     => [ 'slug' => 'team' ],
        'supports'    => [ 'title', 'editor', 'thumbnail', 'custom-fields' ],
        'show_in_rest' => true,
    ] );

    // Events (Upcoming Missions)
    register_post_type( 'nmm_event', [
        'labels'  => nmm_cpt_labels( 'Event', 'Events' ),
        'public'  => true,
        'has_archive' => true,
        'menu_icon'   => 'dashicons-calendar-alt',
        'rewrite'     => [ 'slug' => 'events' ],
        'supports'    => [ 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ],
        'show_in_rest' => true,
    ] );

    // Projects
    register_post_type( 'nmm_project', [
        'labels'      => nmm_cpt_labels( 'Project', 'Projects' ),
        'public'      => true,
        'has_archive' => true,
        'menu_icon'   => 'dashicons-portfolio',
        'rewrite'     => [ 'slug' => 'projects' ],
        'supports'    => [ 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ],
        'show_in_rest' => true,
    ] );

    // Volunteer Applications
    register_post_type( 'nmm_volunteer', [
        'labels'          => nmm_cpt_labels( 'Volunteer Application', 'Volunteer Applications' ),
        'public'          => false,
        'show_ui'         => true,
        'show_in_menu'    => true,
        'menu_icon'       => 'dashicons-universal-access',
        'menu_position'   => 26,
        'capability_type' => 'post',
        'capabilities'    => [ 'create_posts' => 'do_not_allow' ],
        'map_meta_cap'    => true,
        'supports'        => [ 'title', 'custom-fields' ],
        'has_archive'     => false,
        'rewrite'         => false,
        'query_var'       => false,
        'show_in_rest'    => false,
    ] );
}
add_action( 'init', 'nmm_register_cpts' );

function nmm_cpt_labels( string $singular, string $plural ): array {
    return [
        'name'               => $plural,
        'singular_name'      => $singular,
        'add_new'            => "Add New $singular",
        'add_new_item'       => "Add New $singular",
        'edit_item'          => "Edit $singular",
        'new_item'           => "New $singular",
        'view_item'          => "View $singular",
        'search_items'       => "Search $plural",
        'not_found'          => "No $plural found",
        'not_found_in_trash' => "No $plural found in Trash",
        'menu_name'          => $plural,
    ];
}

// Custom Taxonomies
function nmm_register_taxonomies() {
    // Mission State (location taxonomy)
    register_taxonomy( 'nmm_state', [ 'nmm_mission', 'nmm_event' ], [
        'label'        => 'State / Location',
        'hierarchical' => true,
        'rewrite'      => [ 'slug' => 'mission-state' ],
        'show_in_rest' => true,
    ] );

    // Mission Type
    register_taxonomy( 'nmm_type', [ 'nmm_mission' ], [
        'label'        => 'Mission Type',
        'hierarchical' => false,
        'rewrite'      => [ 'slug' => 'mission-type' ],
        'show_in_rest' => true,
    ] );
}
add_action( 'init', 'nmm_register_taxonomies' );


/* ============================================================
   5. CUSTOM META BOXES
   ============================================================ */
function nmm_add_meta_boxes() {
    add_meta_box( 'nmm_mission_details', 'Mission Details', 'nmm_mission_details_cb', 'nmm_mission', 'normal', 'high' );
    add_meta_box( 'nmm_event_details',   'Event Details',   'nmm_event_details_cb',   'nmm_event',   'normal', 'high' );
    add_meta_box( 'nmm_team_details',    'Team Member Details', 'nmm_team_details_cb', 'nmm_team',   'normal', 'high' );
}
add_action( 'add_meta_boxes', 'nmm_add_meta_boxes' );

function nmm_mission_details_cb( WP_Post $post ) {
    wp_nonce_field( 'nmm_mission_meta', 'nmm_mission_nonce' );
    $date      = get_post_meta( $post->ID, '_nmm_mission_date',      true );
    $location  = get_post_meta( $post->ID, '_nmm_mission_location',  true );
    $patients  = get_post_meta( $post->ID, '_nmm_patients_seen',     true );
    $community = get_post_meta( $post->ID, '_nmm_community',         true );
    $lga       = get_post_meta( $post->ID, '_nmm_lga',               true );
    nmm_meta_fields( [
        [ 'label' => 'Mission Date',      'name' => '_nmm_mission_date',     'type' => 'date',   'value' => $date ],
        [ 'label' => 'Location / Venue',  'name' => '_nmm_mission_location', 'type' => 'text',   'value' => $location ],
        [ 'label' => 'Community',         'name' => '_nmm_community',        'type' => 'text',   'value' => $community ],
        [ 'label' => 'LGA',               'name' => '_nmm_lga',              'type' => 'text',   'value' => $lga ],
        [ 'label' => 'Patients Seen',     'name' => '_nmm_patients_seen',    'type' => 'number', 'value' => $patients ],
    ] );
}

function nmm_event_details_cb( WP_Post $post ) {
    wp_nonce_field( 'nmm_event_meta', 'nmm_event_nonce' );
    $date     = get_post_meta( $post->ID, '_nmm_event_date',     true );
    $time     = get_post_meta( $post->ID, '_nmm_event_time',     true );
    $location = get_post_meta( $post->ID, '_nmm_event_location', true );
    $register = get_post_meta( $post->ID, '_nmm_register_link',  true );
    nmm_meta_fields( [
        [ 'label' => 'Event Date',        'name' => '_nmm_event_date',     'type' => 'date', 'value' => $date ],
        [ 'label' => 'Event Time',        'name' => '_nmm_event_time',     'type' => 'time', 'value' => $time ],
        [ 'label' => 'Location / Venue',  'name' => '_nmm_event_location', 'type' => 'text', 'value' => $location ],
        [ 'label' => 'Registration Link', 'name' => '_nmm_register_link',  'type' => 'url',  'value' => $register ],
    ] );
}

function nmm_team_details_cb( WP_Post $post ) {
    wp_nonce_field( 'nmm_team_meta', 'nmm_team_nonce' );
    $role    = get_post_meta( $post->ID, '_nmm_team_role',    true );
    $email   = get_post_meta( $post->ID, '_nmm_team_email',   true );
    $linkedin= get_post_meta( $post->ID, '_nmm_team_linkedin',true );
    nmm_meta_fields( [
        [ 'label' => 'Role / Position', 'name' => '_nmm_team_role',     'type' => 'text',  'value' => $role ],
        [ 'label' => 'Email Address',   'name' => '_nmm_team_email',    'type' => 'email', 'value' => $email ],
        [ 'label' => 'LinkedIn URL',    'name' => '_nmm_team_linkedin', 'type' => 'url',   'value' => $linkedin ],
    ] );
}

function nmm_meta_fields( array $fields ) {
    echo '<table class="form-table"><tbody>';
    foreach ( $fields as $f ) {
        printf(
            '<tr><th><label for="%1$s">%2$s</label></th><td><input type="%3$s" id="%1$s" name="%1$s" value="%4$s" class="regular-text" /></td></tr>',
            esc_attr( $f['name'] ),
            esc_html( $f['label'] ),
            esc_attr( $f['type'] ),
            esc_attr( $f['value'] )
        );
    }
    echo '</tbody></table>';
}

// Save meta
function nmm_save_meta( int $post_id ) {
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;

    $fields_map = [
        'nmm_mission' => [ '_nmm_mission_date', '_nmm_mission_location', '_nmm_community', '_nmm_lga', '_nmm_patients_seen' ],
        'nmm_event'   => [ '_nmm_event_date', '_nmm_event_time', '_nmm_event_location', '_nmm_register_link' ],
        'nmm_team'    => [ '_nmm_team_role', '_nmm_team_email', '_nmm_team_linkedin' ],
    ];

    $post_type = get_post_type( $post_id );
    if ( ! isset( $fields_map[ $post_type ] ) ) return;

    foreach ( $fields_map[ $post_type ] as $key ) {
        if ( isset( $_POST[ $key ] ) ) {
            update_post_meta( $post_id, $key, sanitize_text_field( wp_unslash( $_POST[ $key ] ) ) );
        }
    }
}
add_action( 'save_post', 'nmm_save_meta' );


/* ============================================================
   6. CUSTOMIZER OPTIONS
   ============================================================ */
function nmm_customizer( WP_Customize_Manager $wp_customize ) {
    // Panel
    $wp_customize->add_panel( 'nmm_panel', [
        'title'    => __( 'NAS Medical Mission', 'nas-medical-mission' ),
        'priority' => 30,
    ] );

    // — Hero Section —
    $wp_customize->add_section( 'nmm_hero', [
        'title' => __( 'Hero Section', 'nas-medical-mission' ),
        'panel' => 'nmm_panel',
    ] );
    nmm_customizer_text( $wp_customize, 'nmm_hero', 'nmm_hero_title',    'Hero Title',    'Bringing Healthcare <em>To Those Who Need It Most</em>' );
    nmm_customizer_text( $wp_customize, 'nmm_hero', 'nmm_hero_subtitle', 'Hero Subtitle', 'NAS Medical Mission delivers free, compassionate healthcare to underserved rural communities across Nigeria — one mission at a time.' );

    // — Contact Info —
    $wp_customize->add_section( 'nmm_contact_info', [
        'title' => __( 'Contact Information', 'nas-medical-mission' ),
        'panel' => 'nmm_panel',
    ] );
    nmm_customizer_text( $wp_customize, 'nmm_contact_info', 'nmm_phone',   'Phone Number', '+234 (0) 817 777 1952' );
    nmm_customizer_text( $wp_customize, 'nmm_contact_info', 'nmm_email',   'Email Address', 'info@nasmedicalmission.org' );
    nmm_customizer_text( $wp_customize, 'nmm_contact_info', 'nmm_address', 'Address', 'Plot D122, Gado Nasko Road, Kubwa, Abuja FCT, Nigeria' );

    // — Social Links —
    $wp_customize->add_section( 'nmm_social', [
        'title' => __( 'Social Media Links', 'nas-medical-mission' ),
        'panel' => 'nmm_panel',
    ] );
    foreach ( [ 'Facebook' => 'nmm_facebook', 'Twitter/X' => 'nmm_twitter', 'Instagram' => 'nmm_instagram', 'YouTube' => 'nmm_youtube' ] as $label => $key ) {
        nmm_customizer_text( $wp_customize, 'nmm_social', $key, $label . ' URL', '' );
    }

    // — Stats —
    $wp_customize->add_section( 'nmm_stats', [
        'title' => __( 'Impact Statistics', 'nas-medical-mission' ),
        'panel' => 'nmm_panel',
    ] );
    nmm_customizer_text( $wp_customize, 'nmm_stats', 'nmm_stat_patients',     'Patients Seen',     '2,763+' );
    nmm_customizer_text( $wp_customize, 'nmm_stats', 'nmm_stat_missions',     'Total Missions',    '23+' );
    nmm_customizer_text( $wp_customize, 'nmm_stats', 'nmm_stat_communities',  'Communities',       '16+' );
    nmm_customizer_text( $wp_customize, 'nmm_stats', 'nmm_stat_states',       'States + FCT',      '9' );
}
add_action( 'customize_register', 'nmm_customizer' );

function nmm_customizer_text( $wpc, string $section, string $key, string $label, string $default ) {
    $wpc->add_setting( $key, [ 'default' => $default, 'sanitize_callback' => 'wp_kses_post', 'transport' => 'refresh' ] );
    $wpc->add_control( $key, [ 'label' => $label, 'section' => $section, 'type' => 'text' ] );
}


/* ============================================================
   7. CONTACT FORM AJAX HANDLER
   ============================================================ */
function nmm_handle_contact() {
    check_ajax_referer( 'nmm_nonce', 'nonce' );

    $name    = sanitize_text_field( wp_unslash( $_POST['name']    ?? '' ) );
    $email   = sanitize_email(      wp_unslash( $_POST['email']   ?? '' ) );
    $subject = sanitize_text_field( wp_unslash( $_POST['subject'] ?? '' ) );
    $message = sanitize_textarea_field( wp_unslash( $_POST['message'] ?? '' ) );

    if ( ! $name || ! is_email( $email ) || ! $message ) {
        wp_send_json_error( [ 'message' => __( 'Please fill in all required fields.', 'nas-medical-mission' ) ] );
    }

    $to      = get_option( 'admin_email' );
    $headers = [
        'Content-Type: text/html; charset=UTF-8',
        "Reply-To: $name <$email>",
    ];

    $body = sprintf(
        '<h3>New Contact Form Submission</h3><p><strong>Name:</strong> %s</p><p><strong>Email:</strong> %s</p><p><strong>Subject:</strong> %s</p><p><strong>Message:</strong><br>%s</p>',
        esc_html( $name ), esc_html( $email ), esc_html( $subject ), nl2br( esc_html( $message ) )
    );

    $sent = wp_mail( $to, "NMM Contact: $subject", $body, $headers );

    if ( $sent ) {
        wp_send_json_success( [ 'message' => __( 'Thank you! Your message has been sent successfully.', 'nas-medical-mission' ) ] );
    } else {
        wp_send_json_error( [ 'message' => __( 'Sorry, there was an error sending your message. Please try again.', 'nas-medical-mission' ) ] );
    }
}
add_action( 'wp_ajax_nmm_contact',        'nmm_handle_contact' );
add_action( 'wp_ajax_nopriv_nmm_contact', 'nmm_handle_contact' );


/* ============================================================
   8. HELPER FUNCTIONS (used in templates)
   ============================================================ */

/**
 * Get the Pexels/Unsplash fallback image for a post.
 */
function nmm_get_post_thumbnail_url( int $post_id, string $size = 'nmm-card' ): string {
    if ( has_post_thumbnail( $post_id ) ) {
        return get_the_post_thumbnail_url( $post_id, $size );
    }

    $fallbacks = [
        'https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?w=640&auto=format&fit=crop&q=80',
        'https://images.unsplash.com/photo-1559757175-5700dde675bc?w=640&auto=format&fit=crop&q=80',
        'https://images.pexels.com/photos/5863365/pexels-photo-5863365.jpeg?w=640&auto=compress&cs=tinysrgb',
        'https://images.pexels.com/photos/3259629/pexels-photo-3259629.jpeg?w=640&auto=compress&cs=tinysrgb',
    ];

    return $fallbacks[ $post_id % count( $fallbacks ) ];
}

/**
 * Render the site logo — custom logo or text fallback.
 */
function nmm_logo( string $class = 'site-logo' ): void {
    echo '<a href="' . esc_url( home_url( '/' ) ) . '" class="' . esc_attr( $class ) . '" rel="home" aria-label="' . esc_attr( get_bloginfo( 'name' ) ) . '">';

    if ( has_custom_logo() ) {
        $logo_id  = get_theme_mod( 'custom_logo' );
        $logo_url = wp_get_attachment_image_url( $logo_id, 'full' );
        echo '<img src="' . esc_url( $logo_url ) . '" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '" loading="eager" />';
    } else {
        // Fallback: use the uploaded logo from theme images folder
        echo '<img src="' . esc_url( get_template_directory_uri() . '/images/logo.png' ) . '" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '" loading="eager" onerror="this.style.display=\'none\'" />';
    }

    echo '<div class="site-logo__text">';
    echo '<span class="site-logo__name">NAS Medical Mission</span>';
    echo '<span class="site-logo__tagline">To Care · To Inform · To Treat</span>';
    echo '</div>';
    echo '</a>';
}

/**
 * Get customizer value with fallback.
 */
function nmm_opt( string $key, string $default = '' ): string {
    return (string) get_theme_mod( $key, $default );
}

/**
 * Render navigation with dropdown support.
 */
function nmm_primary_nav(): void {
    wp_nav_menu( [
        'theme_location' => 'primary',
        'container'      => false,
        'menu_class'     => 'main-nav',
        'walker'         => class_exists( 'NMM_Walker_Nav' ) ? new NMM_Walker_Nav() : null,
        'fallback_cb'    => 'nmm_default_nav',
    ] );
}

function nmm_default_nav(): void {
    $pages = [
        'Home'            => home_url( '/' ),
        'About Us'        => home_url( '/about-us/' ),
        'Medical Missions' => home_url( '/medical-missions/' ),
        'Campaigns'       => home_url( '/campaigns/' ),
        'Support'         => home_url( '/support/' ),
        'Blog'            => home_url( '/blog/' ),
        'Contact'         => home_url( '/contact/' ),
    ];
    echo '<ul class="main-nav">';
    foreach ( $pages as $label => $url ) {
        printf( '<li><a href="%s">%s</a></li>', esc_url( $url ), esc_html( $label ) );
    }
    echo '</ul>';
}

/**
 * Social icon links.
 */
function nmm_social_links( string $class = 'top-bar__social' ): void {
    $socials = [
        'facebook'  => [ 'url' => nmm_opt( 'nmm_facebook' ),  'icon' => 'fab fa-facebook-f',  'label' => 'Facebook' ],
        'twitter'   => [ 'url' => nmm_opt( 'nmm_twitter' ),   'icon' => 'fab fa-x-twitter',    'label' => 'Twitter/X' ],
        'instagram' => [ 'url' => nmm_opt( 'nmm_instagram' ), 'icon' => 'fab fa-instagram',    'label' => 'Instagram' ],
        'youtube'   => [ 'url' => nmm_opt( 'nmm_youtube' ),   'icon' => 'fab fa-youtube',      'label' => 'YouTube' ],
    ];

    echo '<div class="' . esc_attr( $class ) . '">';
    foreach ( $socials as $network => $data ) {
        if ( ! $data['url'] ) continue;
        printf(
            '<a href="%s" target="_blank" rel="noopener noreferrer" aria-label="%s"><i class="%s"></i></a>',
            esc_url( $data['url'] ),
            esc_attr( $data['label'] ),
            esc_attr( $data['icon'] )
        );
    }
    echo '</div>';
}

/**
 * Excerpt length.
 */
add_filter( 'excerpt_length', fn() => 25 );
add_filter( 'excerpt_more',   fn() => '&hellip;' );

/**
 * Body classes.
 */
function nmm_body_classes( array $classes ): array {
    if ( is_singular() && ! is_front_page() ) {
        $classes[] = 'is-singular';
    }
    if ( is_front_page() ) {
        $classes[] = 'is-home';
    }
    return $classes;
}
add_filter( 'body_class', 'nmm_body_classes' );

/**
 * Disable WordPress emoji scripts.
 */
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

/**
 * Clean up WP head.
 */
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'rsd_link' );


/* ============================================================
   9. CONTACT SUBMISSIONS — CPT + DB storage + email routing
   ============================================================ */

/**
 * Register the Contact Submission CPT (admin-only, not public).
 */
function nmm_register_submission_cpt() {
    register_post_type( 'nmm_submission', [
        'labels' => [
            'name'               => __( 'Contact Submissions', 'nas-medical-mission' ),
            'singular_name'      => __( 'Contact Submission',  'nas-medical-mission' ),
            'menu_name'          => __( 'Submissions',         'nas-medical-mission' ),
            'all_items'          => __( 'All Submissions',     'nas-medical-mission' ),
            'view_item'          => __( 'View Submission',     'nas-medical-mission' ),
            'search_items'       => __( 'Search Submissions',  'nas-medical-mission' ),
            'not_found'          => __( 'No submissions found.', 'nas-medical-mission' ),
            'not_found_in_trash' => __( 'No submissions in trash.', 'nas-medical-mission' ),
        ],
        'public'             => false,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'menu_icon'          => 'dashicons-email-alt2',
        'menu_position'      => 25,
        'capability_type'    => 'post',
        'capabilities'       => [
            'create_posts' => 'do_not_allow', // no one can create via UI
        ],
        'map_meta_cap'       => true,
        'supports'           => [ 'title', 'custom-fields' ],
        'has_archive'        => false,
        'rewrite'            => false,
        'query_var'          => false,
        'show_in_rest'       => false,
    ] );
}
add_action( 'init', 'nmm_register_submission_cpt' );


/**
 * Customiser: add recipient email(s) setting.
 */
function nmm_customizer_contact( WP_Customize_Manager $wp_customize ) {
    // Section already exists (nmm_contact_info) — just add the setting
    $wp_customize->add_setting( 'nmm_contact_recipients', [
        'default'           => get_option( 'admin_email' ),
        'sanitize_callback' => 'nmm_sanitize_email_list',
        'transport'         => 'refresh',
    ] );
    $wp_customize->add_control( 'nmm_contact_recipients', [
        'label'       => __( 'Contact Form Recipient Email(s)', 'nas-medical-mission' ),
        'description' => __( 'Comma-separated email addresses that receive contact form submissions.', 'nas-medical-mission' ),
        'section'     => 'nmm_contact_info',
        'type'        => 'textarea',
    ] );

    // Auto-reply toggle
    $wp_customize->add_setting( 'nmm_contact_autoreply', [
        'default'           => '1',
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ] );
    $wp_customize->add_control( 'nmm_contact_autoreply', [
        'label'   => __( 'Send auto-reply to submitter', 'nas-medical-mission' ),
        'section' => 'nmm_contact_info',
        'type'    => 'checkbox',
    ] );
}
add_action( 'customize_register', 'nmm_customizer_contact' );

function nmm_sanitize_email_list( string $value ): string {
    $parts = array_map( 'trim', explode( ',', $value ) );
    $valid = array_filter( $parts, 'is_email' );
    return implode( ', ', $valid );
}


/**
 * Rewritten AJAX handler — saves to DB + sends email(s).
 */
remove_action( 'wp_ajax_nmm_contact',        'nmm_handle_contact' );
remove_action( 'wp_ajax_nopriv_nmm_contact', 'nmm_handle_contact' );

function nmm_handle_contact_v2() {
    // Verify nonce
    if ( ! check_ajax_referer( 'nmm_nonce', 'nonce', false ) ) {
        wp_send_json_error( [ 'message' => __( 'Security check failed. Please refresh and try again.', 'nas-medical-mission' ) ] );
    }

    // Sanitise input
    $name    = sanitize_text_field( wp_unslash( $_POST['name']    ?? '' ) );
    $email   = sanitize_email(      wp_unslash( $_POST['email']   ?? '' ) );
    $subject = sanitize_text_field( wp_unslash( $_POST['subject'] ?? 'General Enquiry' ) );
    $message = sanitize_textarea_field( wp_unslash( $_POST['message'] ?? '' ) );
    $phone   = sanitize_text_field( wp_unslash( $_POST['phone']   ?? '' ) );

    // Validate
    if ( ! $name ) {
        wp_send_json_error( [ 'message' => __( 'Please enter your name.', 'nas-medical-mission' ) ] );
    }
    if ( ! is_email( $email ) ) {
        wp_send_json_error( [ 'message' => __( 'Please enter a valid email address.', 'nas-medical-mission' ) ] );
    }
    if ( ! $message ) {
        wp_send_json_error( [ 'message' => __( 'Please enter a message.', 'nas-medical-mission' ) ] );
    }

    // ── 1. SAVE TO DATABASE ──────────────────────────────────
    $post_id = wp_insert_post( [
        'post_type'   => 'nmm_submission',
        'post_title'  => sprintf( '%s — %s', $name, $subject ),
        'post_status' => 'publish',
        'post_author' => 0,
    ] );

    if ( $post_id && ! is_wp_error( $post_id ) ) {
        update_post_meta( $post_id, '_nmm_sub_name',    $name );
        update_post_meta( $post_id, '_nmm_sub_email',   $email );
        update_post_meta( $post_id, '_nmm_sub_phone',   $phone );
        update_post_meta( $post_id, '_nmm_sub_subject', $subject );
        update_post_meta( $post_id, '_nmm_sub_message', $message );
        update_post_meta( $post_id, '_nmm_sub_ip',      sanitize_text_field( $_SERVER['REMOTE_ADDR'] ?? '' ) );
        update_post_meta( $post_id, '_nmm_sub_status',  'new' );
        update_post_meta( $post_id, '_nmm_sub_date',    current_time( 'mysql' ) );
    }

    // ── 2. SEND EMAIL TO RECIPIENTS ─────────────────────────
    $recipients_raw = get_theme_mod( 'nmm_contact_recipients', get_option( 'admin_email' ) );
    $recipients     = array_filter(
        array_map( 'trim', explode( ',', $recipients_raw ) ),
        'is_email'
    );
    if ( empty( $recipients ) ) {
        $recipients = [ get_option( 'admin_email' ) ];
    }

    $admin_subject = sprintf( '[NMM] New Contact: %s — %s', $name, $subject );
    $admin_body    = nmm_email_template( [
        'heading'   => 'New Contact Form Submission',
        'intro'     => 'You have received a new message via the NAS Medical Mission website.',
        'fields'    => [
            'Name'    => $name,
            'Email'   => $email,
            'Phone'   => $phone ?: '—',
            'Subject' => $subject,
            'Message' => nl2br( esc_html( $message ) ),
            'Date'    => current_time( 'F j, Y g:i A' ),
            'View in Admin' => $post_id ? '<a href="' . esc_url( get_edit_post_link( $post_id ) ) . '" style="color:#6E378B;">View Submission →</a>' : '—',
        ],
    ] );

    $headers = [
        'Content-Type: text/html; charset=UTF-8',
        "Reply-To: $name <$email>",
    ];

    foreach ( $recipients as $recipient ) {
        wp_mail( $recipient, $admin_subject, $admin_body, $headers );
    }

    // ── 3. AUTO-REPLY TO SUBMITTER ───────────────────────────
    if ( get_theme_mod( 'nmm_contact_autoreply', '1' ) ) {
        $reply_subject = __( 'Thank you for contacting NAS Medical Mission', 'nas-medical-mission' );
        $reply_body    = nmm_email_template( [
            'heading' => 'Thank You, ' . esc_html( $name ) . '!',
            'intro'   => 'We have received your message and will get back to you as soon as possible.',
            'fields'  => [
                'Your Subject' => $subject,
                'Your Message' => nl2br( esc_html( $message ) ),
                'Response Time' => 'We typically respond within 1–3 business days.',
            ],
            'footer_extra' => '<p style="text-align:center;font-size:13px;color:#718096;">For urgent matters, please call us at <strong>+234 (0) 817 777 1952</strong></p>',
        ] );

        wp_mail( $email, $reply_subject, $reply_body, [
            'Content-Type: text/html; charset=UTF-8',
            'From: NAS Medical Mission <' . get_option( 'admin_email' ) . '>',
        ] );
    }

    wp_send_json_success( [
        'message' => __( "Thank you! Your message has been received. We'll be in touch soon.", 'nas-medical-mission' ),
    ] );
}
add_action( 'wp_ajax_nmm_contact',        'nmm_handle_contact_v2' );
add_action( 'wp_ajax_nopriv_nmm_contact', 'nmm_handle_contact_v2' );


/**
 * HTML email template.
 */
function nmm_email_template( array $args ): string {
    $heading     = $args['heading']     ?? '';
    $intro       = $args['intro']       ?? '';
    $fields      = $args['fields']      ?? [];
    $footer_extra= $args['footer_extra'] ?? '';

    $rows = '';
    foreach ( $fields as $label => $value ) {
        $rows .= sprintf(
            '<tr><td style="padding:10px 0;border-bottom:1px solid #eee;font-size:13px;color:#718096;font-weight:600;width:140px;vertical-align:top;">%s</td><td style="padding:10px 0 10px 16px;border-bottom:1px solid #eee;font-size:14px;color:#2D3748;">%s</td></tr>',
            esc_html( $label ),
            $value // already escaped/nl2br'd above
        );
    }

    return '<!DOCTYPE html><html><head><meta charset="UTF-8"><title>' . esc_html( $heading ) . '</title></head><body style="margin:0;padding:0;background:#f7f8fc;font-family:\'DM Sans\',Arial,sans-serif;">
<table width="100%" cellpadding="0" cellspacing="0" style="background:#f7f8fc;padding:40px 0;">
  <tr><td align="center">
    <table width="600" cellpadding="0" cellspacing="0" style="background:#ffffff;border-radius:16px;overflow:hidden;box-shadow:0 4px 24px rgba(0,0,0,0.08);max-width:600px;width:100%;">
      <!-- Header -->
      <tr><td style="background:linear-gradient(135deg,#4D2065,#6E378B);padding:36px 40px;text-align:center;">
        <div style="font-size:28px;font-weight:700;color:#ffffff;font-family:Georgia,serif;">' . esc_html( $heading ) . '</div>
        <div style="width:48px;height:3px;background:#E8C547;margin:12px auto 0;border-radius:2px;"></div>
      </td></tr>
      <!-- Body -->
      <tr><td style="padding:32px 40px;">
        ' . ( $intro ? '<p style="font-size:15px;color:#718096;margin:0 0 24px;">' . esc_html( $intro ) . '</p>' : '' ) . '
        <table width="100%" cellpadding="0" cellspacing="0">' . $rows . '</table>
        ' . $footer_extra . '
      </td></tr>
      <!-- Footer -->
      <tr><td style="background:#f7f8fc;padding:20px 40px;text-align:center;border-top:1px solid #E2E8F0;">
        <p style="font-size:12px;color:#A0AEC0;margin:0;">NAS Medical Mission — To Care · To Inform · To Treat</p>
        <p style="font-size:12px;color:#A0AEC0;margin:4px 0 0;"><a href="https://www.nasmedicalmission.org" style="color:#6E378B;">www.nasmedicalmission.org</a></p>
      </td></tr>
    </table>
  </td></tr>
</table>
</body></html>';
}


/**
 * Admin columns for Submissions CPT.
 */
function nmm_submission_columns( array $cols ): array {
    return [
        'cb'             => $cols['cb'],
        'title'          => __( 'Name / Subject', 'nas-medical-mission' ),
        'nmm_email'      => __( 'Email', 'nas-medical-mission' ),
        'nmm_phone'      => __( 'Phone', 'nas-medical-mission' ),
        'nmm_subject'    => __( 'Subject', 'nas-medical-mission' ),
        'nmm_status'     => __( 'Status', 'nas-medical-mission' ),
        'nmm_message'    => __( 'Message (preview)', 'nas-medical-mission' ),
        'date'           => __( 'Received', 'nas-medical-mission' ),
    ];
}
add_filter( 'manage_nmm_submission_posts_columns', 'nmm_submission_columns' );

function nmm_submission_column_data( string $col, int $post_id ): void {
    switch ( $col ) {
        case 'nmm_email':
            $e = get_post_meta( $post_id, '_nmm_sub_email', true );
            echo $e ? '<a href="mailto:' . esc_attr( $e ) . '">' . esc_html( $e ) . '</a>' : '—';
            break;
        case 'nmm_phone':
            $p = get_post_meta( $post_id, '_nmm_sub_phone', true );
            echo $p ? esc_html( $p ) : '—';
            break;
        case 'nmm_subject':
            echo esc_html( get_post_meta( $post_id, '_nmm_sub_subject', true ) ?: '—' );
            break;
        case 'nmm_status':
            $status = get_post_meta( $post_id, '_nmm_sub_status', true ) ?: 'new';
            $labels = [ 'new' => 'New', 'read' => 'Read', 'replied' => 'Replied' ];
            printf( '<span class="nmm-submission-badge nmm-submission-badge--%s">%s</span>',
                esc_attr( $status ),
                esc_html( $labels[ $status ] ?? ucfirst( $status ) )
            );
            break;
        case 'nmm_message':
            $msg = get_post_meta( $post_id, '_nmm_sub_message', true );
            echo '<span title="' . esc_attr( $msg ) . '">' . esc_html( wp_trim_words( $msg, 12 ) ) . '</span>';
            break;
    }
}
add_action( 'manage_nmm_submission_posts_custom_column', 'nmm_submission_column_data', 10, 2 );

// Make columns sortable
function nmm_submission_sortable_columns( array $cols ): array {
    $cols['nmm_status']  = 'nmm_status';
    $cols['nmm_subject'] = 'nmm_subject';
    return $cols;
}
add_filter( 'manage_edit-nmm_submission_sortable_columns', 'nmm_submission_sortable_columns' );


/**
 * Meta box on the edit-submission screen showing all fields.
 */
function nmm_submission_detail_metabox(): void {
    add_meta_box(
        'nmm_sub_detail',
        __( 'Submission Details', 'nas-medical-mission' ),
        'nmm_sub_detail_cb',
        'nmm_submission',
        'normal',
        'high'
    );
    add_meta_box(
        'nmm_sub_status_box',
        __( 'Status', 'nas-medical-mission' ),
        'nmm_sub_status_cb',
        'nmm_submission',
        'side',
        'high'
    );
}
add_action( 'add_meta_boxes', 'nmm_submission_detail_metabox' );

function nmm_sub_detail_cb( WP_Post $post ): void {
    $fields = [
        'Name'       => '_nmm_sub_name',
        'Email'      => '_nmm_sub_email',
        'Phone'      => '_nmm_sub_phone',
        'Subject'    => '_nmm_sub_subject',
        'IP Address' => '_nmm_sub_ip',
        'Received'   => '_nmm_sub_date',
    ];

    echo '<table class="form-table" style="margin:0;"><tbody>';
    foreach ( $fields as $label => $key ) {
        $value = get_post_meta( $post->ID, $key, true );
        echo '<tr><th style="width:120px;padding:8px 0;">' . esc_html( $label ) . '</th>';
        echo '<td style="padding:8px 0;">';
        if ( $key === '_nmm_sub_email' && $value ) {
            echo '<a href="mailto:' . esc_attr( $value ) . '">' . esc_html( $value ) . '</a>';
        } else {
            echo esc_html( $value ?: '—' );
        }
        echo '</td></tr>';
    }
    echo '</tbody></table>';

    $message = get_post_meta( $post->ID, '_nmm_sub_message', true );
    echo '<hr style="margin:16px 0;">';
    echo '<h4 style="margin:0 0 8px;">' . esc_html__( 'Message', 'nas-medical-mission' ) . '</h4>';
    echo '<div style="background:#f7f8fc;border:1px solid #E2E8F0;border-radius:8px;padding:16px;font-size:14px;line-height:1.7;white-space:pre-wrap;">';
    echo esc_html( $message );
    echo '</div>';
}

function nmm_sub_status_cb( WP_Post $post ): void {
    wp_nonce_field( 'nmm_sub_status', 'nmm_sub_status_nonce' );
    $current = get_post_meta( $post->ID, '_nmm_sub_status', true ) ?: 'new';
    $options = [ 'new' => 'New', 'read' => 'Read', 'replied' => 'Replied' ];
    echo '<select name="nmm_sub_status" style="width:100%;padding:6px;">';
    foreach ( $options as $val => $label ) {
        printf( '<option value="%s"%s>%s</option>', esc_attr( $val ), selected( $current, $val, false ), esc_html( $label ) );
    }
    echo '</select>';
    echo '<p style="margin-top:8px;font-size:12px;color:#718096;">';
    printf( esc_html__( 'Received: %s', 'nas-medical-mission' ), esc_html( get_post_meta( $post->ID, '_nmm_sub_date', true ) ?: get_the_date( 'F j, Y g:i A', $post ) ) );
    echo '</p>';

    // Quick-reply link
    $email = get_post_meta( $post->ID, '_nmm_sub_email', true );
    $subj  = get_post_meta( $post->ID, '_nmm_sub_subject', true );
    if ( $email ) {
        printf(
            '<a href="mailto:%s?subject=Re: %s" class="button button-secondary" style="margin-top:8px;width:100%;text-align:center;">Reply via Email</a>',
            esc_attr( $email ),
            esc_attr( $subj )
        );
    }
}

// Save status
function nmm_save_submission_status( int $post_id ): void {
    if ( ! isset( $_POST['nmm_sub_status_nonce'] ) ) return;
    if ( ! wp_verify_nonce( $_POST['nmm_sub_status_nonce'], 'nmm_sub_status' ) ) return;
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;
    if ( isset( $_POST['nmm_sub_status'] ) ) {
        $allowed = [ 'new', 'read', 'replied' ];
        $status  = sanitize_text_field( $_POST['nmm_sub_status'] );
        if ( in_array( $status, $allowed, true ) ) {
            update_post_meta( $post_id, '_nmm_sub_status', $status );
        }
    }
}
add_action( 'save_post_nmm_submission', 'nmm_save_submission_status' );


/**
 * Mark submission as 'read' when admin opens it.
 */
function nmm_mark_submission_read(): void {
    global $post;
    if ( ! $post || 'nmm_submission' !== $post->post_type ) return;
    if ( 'new' === get_post_meta( $post->ID, '_nmm_sub_status', true ) ) {
        update_post_meta( $post->ID, '_nmm_sub_status', 'read' );
    }
}
add_action( 'load-post.php', 'nmm_mark_submission_read' );


/**
 * Dashboard widget: latest submissions count.
 */
function nmm_submissions_dashboard_widget(): void {
    $new_count = wp_count_posts( 'nmm_submission' )->publish ?? 0;
    $new_subs  = get_posts( [
        'post_type'      => 'nmm_submission',
        'posts_per_page' => 5,
        'meta_key'       => '_nmm_sub_status',
        'meta_value'     => 'new',
        'post_status'    => 'publish',
    ] );

    echo '<p style="font-size:14px;margin-bottom:12px;">';
    printf(
        '<strong>%d</strong> unread contact submission(s).',
        count( $new_subs )
    );
    echo '</p>';

    if ( $new_subs ) {
        echo '<ul>';
        foreach ( $new_subs as $sub ) {
            printf(
                '<li style="margin-bottom:8px;font-size:13px;"><a href="%s"><strong>%s</strong></a> — %s</li>',
                esc_url( get_edit_post_link( $sub->ID ) ),
                esc_html( get_post_meta( $sub->ID, '_nmm_sub_name', true ) ),
                esc_html( wp_trim_words( get_post_meta( $sub->ID, '_nmm_sub_message', true ), 8 ) )
            );
        }
        echo '</ul>';
    }

    printf(
        '<a href="%s" class="button button-primary" style="margin-top:8px;">View All Submissions</a>',
        esc_url( admin_url( 'edit.php?post_type=nmm_submission' ) )
    );
}

function nmm_register_dashboard_widget(): void {
    wp_add_dashboard_widget(
        'nmm_submissions_widget',
        __( 'NMM Contact Submissions', 'nas-medical-mission' ),
        'nmm_submissions_dashboard_widget'
    );
}
add_action( 'wp_dashboard_setup', 'nmm_register_dashboard_widget' );


/* ============================================================
   10. PROJECTS META BOX
   ============================================================ */
function nmm_project_meta_box(): void {
    add_meta_box( 'nmm_project_details', 'Project Details', 'nmm_project_details_cb', 'nmm_project', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'nmm_project_meta_box' );

function nmm_project_details_cb( WP_Post $post ): void {
    wp_nonce_field( 'nmm_project_meta', 'nmm_project_nonce' );
    nmm_meta_fields( [
        [ 'label' => 'Project Status',     'name' => '_nmm_project_status',   'type' => 'text',   'value' => get_post_meta( $post->ID, '_nmm_project_status',   true ) ],
        [ 'label' => 'Start Date',         'name' => '_nmm_project_start',    'type' => 'date',   'value' => get_post_meta( $post->ID, '_nmm_project_start',    true ) ],
        [ 'label' => 'End Date',           'name' => '_nmm_project_end',      'type' => 'date',   'value' => get_post_meta( $post->ID, '_nmm_project_end',      true ) ],
        [ 'label' => 'Goal / Target',      'name' => '_nmm_project_goal',     'type' => 'text',   'value' => get_post_meta( $post->ID, '_nmm_project_goal',     true ) ],
        [ 'label' => 'Partners / Funders', 'name' => '_nmm_project_partners', 'type' => 'text',   'value' => get_post_meta( $post->ID, '_nmm_project_partners', true ) ],
        [ 'label' => 'Location',           'name' => '_nmm_project_location', 'type' => 'text',   'value' => get_post_meta( $post->ID, '_nmm_project_location', true ) ],
        [ 'label' => 'External Link',      'name' => '_nmm_project_link',     'type' => 'url',    'value' => get_post_meta( $post->ID, '_nmm_project_link',     true ) ],
    ] );
}

function nmm_save_project_meta( int $post_id ): void {
    if ( ! isset( $_POST['nmm_project_nonce'] ) || ! wp_verify_nonce( $_POST['nmm_project_nonce'], 'nmm_project_meta' ) ) return;
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;
    $fields = [ '_nmm_project_status', '_nmm_project_start', '_nmm_project_end', '_nmm_project_goal', '_nmm_project_partners', '_nmm_project_location', '_nmm_project_link' ];
    foreach ( $fields as $key ) {
        if ( isset( $_POST[ $key ] ) ) {
            update_post_meta( $post_id, $key, sanitize_text_field( wp_unslash( $_POST[ $key ] ) ) );
        }
    }
}
add_action( 'save_post_nmm_project', 'nmm_save_project_meta' );


/* ============================================================
   11. VOLUNTEER APPLICATIONS — AJAX handler + admin columns
   ============================================================ */
function nmm_handle_volunteer(): void {
    if ( ! check_ajax_referer( 'nmm_nonce', 'nonce', false ) ) {
        wp_send_json_error( [ 'message' => __( 'Security check failed. Please refresh and try again.', 'nas-medical-mission' ) ] );
    }

    $first_name   = sanitize_text_field( wp_unslash( $_POST['first_name']   ?? '' ) );
    $last_name    = sanitize_text_field( wp_unslash( $_POST['last_name']    ?? '' ) );
    $email        = sanitize_email(      wp_unslash( $_POST['email']        ?? '' ) );
    $phone        = sanitize_text_field( wp_unslash( $_POST['phone']        ?? '' ) );
    $profession   = sanitize_text_field( wp_unslash( $_POST['profession']   ?? '' ) );
    $specialty    = sanitize_text_field( wp_unslash( $_POST['specialty']    ?? '' ) );
    $availability = sanitize_text_field( wp_unslash( $_POST['availability'] ?? '' ) );
    $location     = sanitize_text_field( wp_unslash( $_POST['location']     ?? '' ) );
    $experience   = sanitize_textarea_field( wp_unslash( $_POST['experience'] ?? '' ) );
    $motivation   = sanitize_textarea_field( wp_unslash( $_POST['motivation'] ?? '' ) );

    if ( ! $first_name || ! $last_name ) {
        wp_send_json_error( [ 'message' => __( 'Please enter your full name.', 'nas-medical-mission' ) ] );
    }
    if ( ! is_email( $email ) ) {
        wp_send_json_error( [ 'message' => __( 'Please enter a valid email address.', 'nas-medical-mission' ) ] );
    }
    if ( ! $profession ) {
        wp_send_json_error( [ 'message' => __( 'Please select your profession.', 'nas-medical-mission' ) ] );
    }

    // Save to DB
    $post_id = wp_insert_post( [
        'post_type'   => 'nmm_volunteer',
        'post_title'  => "$first_name $last_name — $profession",
        'post_status' => 'publish',
        'post_author' => 0,
    ] );

    if ( $post_id && ! is_wp_error( $post_id ) ) {
        $meta = compact( 'first_name', 'last_name', 'email', 'phone', 'profession', 'specialty', 'availability', 'location', 'experience', 'motivation' );
        foreach ( $meta as $key => $value ) {
            update_post_meta( $post_id, "_nmm_vol_$key", $value );
        }
        update_post_meta( $post_id, '_nmm_vol_status', 'pending' );
        update_post_meta( $post_id, '_nmm_vol_date',   current_time( 'mysql' ) );
        update_post_meta( $post_id, '_nmm_vol_ip',     sanitize_text_field( $_SERVER['REMOTE_ADDR'] ?? '' ) );
    }

    // Email admins
    $recipients_raw = get_theme_mod( 'nmm_contact_recipients', get_option( 'admin_email' ) );
    $recipients     = array_filter( array_map( 'trim', explode( ',', $recipients_raw ) ), 'is_email' );
    if ( empty( $recipients ) ) $recipients = [ get_option( 'admin_email' ) ];

    $admin_body = nmm_email_template( [
        'heading' => 'New Volunteer Application',
        'intro'   => 'A new volunteer application has been submitted via the NAS Medical Mission website.',
        'fields'  => [
            'Name'         => "$first_name $last_name",
            'Email'        => $email,
            'Phone'        => $phone ?: '—',
            'Profession'   => $profession,
            'Specialty'    => $specialty ?: '—',
            'Availability' => $availability ?: '—',
            'Location'     => $location ?: '—',
            'Experience'   => nl2br( esc_html( $experience ) ) ?: '—',
            'Motivation'   => nl2br( esc_html( $motivation ) ) ?: '—',
            'View in Admin' => $post_id ? '<a href="' . esc_url( get_edit_post_link( $post_id ) ) . '" style="color:#6E378B;">View Application →</a>' : '—',
        ],
    ] );

    foreach ( $recipients as $r ) {
        wp_mail( $r, "NMM Volunteer Application: $first_name $last_name", $admin_body, [
            'Content-Type: text/html; charset=UTF-8',
            "Reply-To: $first_name $last_name <$email>",
        ] );
    }

    // Auto-reply
    if ( get_theme_mod( 'nmm_contact_autoreply', '1' ) ) {
        wp_mail( $email, 'Thank you for volunteering with NAS Medical Mission', nmm_email_template( [
            'heading' => "Thank You, $first_name!",
            'intro'   => 'We have received your volunteer application and will review it shortly. We\'ll be in touch soon.',
            'fields'  => [
                'Your Profession'   => $profession,
                'Your Availability' => $availability ?: '—',
                'Next Steps'        => 'Our volunteer coordinator will contact you within 5–7 business days.',
            ],
            'footer_extra' => '<p style="text-align:center;font-size:13px;color:#718096;">Questions? Email us at <a href="mailto:' . esc_attr( nmm_opt( 'nmm_email', 'info@nasmedicalmission.org' ) ) . '" style="color:#6E378B;">' . esc_html( nmm_opt( 'nmm_email', 'info@nasmedicalmission.org' ) ) . '</a></p>',
        ] ), [ 'Content-Type: text/html; charset=UTF-8', 'From: NAS Medical Mission <' . get_option( 'admin_email' ) . '>' ] );
    }

    wp_send_json_success( [
        'message' => __( 'Thank you! Your volunteer application has been received. We\'ll be in touch within 5–7 business days.', 'nas-medical-mission' ),
    ] );
}
add_action( 'wp_ajax_nmm_volunteer',        'nmm_handle_volunteer' );
add_action( 'wp_ajax_nopriv_nmm_volunteer', 'nmm_handle_volunteer' );

// Admin columns for Volunteer Applications
function nmm_volunteer_columns( array $cols ): array {
    return [
        'cb'               => $cols['cb'],
        'title'            => __( 'Name', 'nas-medical-mission' ),
        'nmm_vol_email'    => __( 'Email', 'nas-medical-mission' ),
        'nmm_vol_phone'    => __( 'Phone', 'nas-medical-mission' ),
        'nmm_vol_prof'     => __( 'Profession', 'nas-medical-mission' ),
        'nmm_vol_avail'    => __( 'Availability', 'nas-medical-mission' ),
        'nmm_vol_location' => __( 'Location', 'nas-medical-mission' ),
        'nmm_vol_status'   => __( 'Status', 'nas-medical-mission' ),
        'date'             => __( 'Applied', 'nas-medical-mission' ),
    ];
}
add_filter( 'manage_nmm_volunteer_posts_columns', 'nmm_volunteer_columns' );

function nmm_volunteer_column_data( string $col, int $post_id ): void {
    $map = [
        'nmm_vol_email'    => '_nmm_vol_email',
        'nmm_vol_phone'    => '_nmm_vol_phone',
        'nmm_vol_prof'     => '_nmm_vol_profession',
        'nmm_vol_avail'    => '_nmm_vol_availability',
        'nmm_vol_location' => '_nmm_vol_location',
    ];
    if ( isset( $map[ $col ] ) ) {
        $val = get_post_meta( $post_id, $map[ $col ], true );
        if ( $col === 'nmm_vol_email' && $val ) {
            echo '<a href="mailto:' . esc_attr( $val ) . '">' . esc_html( $val ) . '</a>';
        } else {
            echo esc_html( $val ?: '—' );
        }
        return;
    }
    if ( $col === 'nmm_vol_status' ) {
        $status = get_post_meta( $post_id, '_nmm_vol_status', true ) ?: 'pending';
        $labels = [ 'pending' => 'Pending', 'reviewed' => 'Reviewed', 'accepted' => 'Accepted', 'declined' => 'Declined' ];
        $colors = [ 'pending' => '#f39c12', 'reviewed' => '#3498db', 'accepted' => '#27ae60', 'declined' => '#e74c3c' ];
        $color  = $colors[ $status ] ?? '#718096';
        printf( '<span style="display:inline-block;padding:2px 8px;border-radius:4px;font-size:11px;font-weight:700;text-transform:uppercase;background:%s22;color:%s;">%s</span>',
            esc_attr( $color ), esc_attr( $color ), esc_html( $labels[ $status ] ?? ucfirst( $status ) ) );
    }
}
add_action( 'manage_nmm_volunteer_posts_custom_column', 'nmm_volunteer_column_data', 10, 2 );

// Meta box for viewing a volunteer application
function nmm_volunteer_meta_box(): void {
    add_meta_box( 'nmm_vol_detail',     'Application Details', 'nmm_vol_detail_cb',     'nmm_volunteer', 'normal', 'high' );
    add_meta_box( 'nmm_vol_status_box', 'Application Status',  'nmm_vol_status_box_cb', 'nmm_volunteer', 'side',   'high' );
}
add_action( 'add_meta_boxes', 'nmm_volunteer_meta_box' );

function nmm_vol_detail_cb( WP_Post $post ): void {
    $fields = [
        'First Name'   => '_nmm_vol_first_name',
        'Last Name'    => '_nmm_vol_last_name',
        'Email'        => '_nmm_vol_email',
        'Phone'        => '_nmm_vol_phone',
        'Profession'   => '_nmm_vol_profession',
        'Specialty'    => '_nmm_vol_specialty',
        'Availability' => '_nmm_vol_availability',
        'Location'     => '_nmm_vol_location',
        'IP Address'   => '_nmm_vol_ip',
        'Applied'      => '_nmm_vol_date',
    ];
    echo '<table class="form-table" style="margin:0;"><tbody>';
    foreach ( $fields as $label => $key ) {
        $val = get_post_meta( $post->ID, $key, true );
        echo '<tr><th style="width:130px;padding:8px 0;">' . esc_html( $label ) . '</th><td style="padding:8px 0;">';
        if ( $key === '_nmm_vol_email' && $val ) {
            echo '<a href="mailto:' . esc_attr( $val ) . '">' . esc_html( $val ) . '</a>';
        } else {
            echo esc_html( $val ?: '—' );
        }
        echo '</td></tr>';
    }
    echo '</tbody></table>';
    foreach ( [ 'Experience' => '_nmm_vol_experience', 'Motivation' => '_nmm_vol_motivation' ] as $label => $key ) {
        $val = get_post_meta( $post->ID, $key, true );
        echo '<hr style="margin:16px 0;"><h4 style="margin:0 0 8px;">' . esc_html( $label ) . '</h4>';
        echo '<div style="background:#f7f8fc;border:1px solid #E2E8F0;border-radius:8px;padding:16px;font-size:14px;line-height:1.7;white-space:pre-wrap;">' . esc_html( $val ?: '—' ) . '</div>';
    }
}

function nmm_vol_status_box_cb( WP_Post $post ): void {
    wp_nonce_field( 'nmm_vol_status', 'nmm_vol_status_nonce' );
    $current = get_post_meta( $post->ID, '_nmm_vol_status', true ) ?: 'pending';
    $options = [ 'pending' => 'Pending Review', 'reviewed' => 'Reviewed', 'accepted' => 'Accepted', 'declined' => 'Declined' ];
    echo '<select name="nmm_vol_status" style="width:100%;padding:6px;">';
    foreach ( $options as $val => $label ) {
        printf( '<option value="%s"%s>%s</option>', esc_attr( $val ), selected( $current, $val, false ), esc_html( $label ) );
    }
    echo '</select>';
    $email = get_post_meta( $post->ID, '_nmm_vol_email', true );
    if ( $email ) {
        printf( '<a href="mailto:%s?subject=Your NMM Volunteer Application" class="button button-secondary" style="margin-top:8px;width:100%%;text-align:center;">Reply via Email</a>', esc_attr( $email ) );
    }
}

function nmm_save_volunteer_status( int $post_id ): void {
    if ( ! isset( $_POST['nmm_vol_status_nonce'] ) || ! wp_verify_nonce( $_POST['nmm_vol_status_nonce'], 'nmm_vol_status' ) ) return;
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;
    $allowed = [ 'pending', 'reviewed', 'accepted', 'declined' ];
    $status  = sanitize_text_field( $_POST['nmm_vol_status'] ?? 'pending' );
    if ( in_array( $status, $allowed, true ) ) {
        update_post_meta( $post_id, '_nmm_vol_status', $status );
    }
}
add_action( 'save_post_nmm_volunteer', 'nmm_save_volunteer_status' );

// Dashboard widget update — include volunteers
function nmm_volunteer_dashboard_widget(): void {
    $pending = get_posts( [ 'post_type' => 'nmm_volunteer', 'posts_per_page' => 5, 'meta_key' => '_nmm_vol_status', 'meta_value' => 'pending' ] );
    echo '<p style="font-size:14px;margin-bottom:12px;"><strong>' . count( $pending ) . '</strong> pending volunteer application(s).</p>';
    if ( $pending ) {
        echo '<ul>';
        foreach ( $pending as $p ) {
            printf( '<li style="margin-bottom:8px;font-size:13px;"><a href="%s"><strong>%s %s</strong></a> — %s</li>',
                esc_url( get_edit_post_link( $p->ID ) ),
                esc_html( get_post_meta( $p->ID, '_nmm_vol_first_name', true ) ),
                esc_html( get_post_meta( $p->ID, '_nmm_vol_last_name',  true ) ),
                esc_html( get_post_meta( $p->ID, '_nmm_vol_profession', true ) )
            );
        }
        echo '</ul>';
    }
    printf( '<a href="%s" class="button button-secondary" style="margin-top:8px;">View All Applications</a>',
        esc_url( admin_url( 'edit.php?post_type=nmm_volunteer' ) ) );
}

function nmm_register_volunteer_widget(): void {
    wp_add_dashboard_widget( 'nmm_volunteer_widget', __( 'NMM Volunteer Applications', 'nas-medical-mission' ), 'nmm_volunteer_dashboard_widget' );
}
add_action( 'wp_dashboard_setup', 'nmm_register_volunteer_widget' );


/* ============================================================
   12. DONATION INTENTS — CPT + Customiser bank details + AJAX
   ============================================================ */

// Register Donation Intents CPT
function nmm_register_donation_cpt(): void {
    register_post_type( 'nmm_donation', [
        'labels'          => nmm_cpt_labels( 'Donation', 'Donations' ),
        'public'          => false,
        'show_ui'         => true,
        'show_in_menu'    => true,
        'menu_icon'       => 'dashicons-money-alt',
        'menu_position'   => 27,
        'capability_type' => 'post',
        'capabilities'    => [ 'create_posts' => 'do_not_allow' ],
        'map_meta_cap'    => true,
        'supports'        => [ 'title', 'custom-fields' ],
        'has_archive'     => false,
        'rewrite'         => false,
        'query_var'       => false,
        'show_in_rest'    => false,
    ] );
}
add_action( 'init', 'nmm_register_donation_cpt' );

// Admin columns for donations
function nmm_donation_columns( array $cols ): array {
    return [
        'cb'              => $cols['cb'],
        'title'           => __( 'Donor', 'nas-medical-mission' ),
        'nmm_don_email'   => __( 'Email', 'nas-medical-mission' ),
        'nmm_don_amount'  => __( 'Amount', 'nas-medical-mission' ),
        'nmm_don_type'    => __( 'Type', 'nas-medical-mission' ),
        'nmm_don_anon'    => __( 'Anonymous', 'nas-medical-mission' ),
        'nmm_don_status'  => __( 'Status', 'nas-medical-mission' ),
        'date'            => __( 'Date', 'nas-medical-mission' ),
    ];
}
add_filter( 'manage_nmm_donation_posts_columns', 'nmm_donation_columns' );

function nmm_donation_column_data( string $col, int $post_id ): void {
    $map = [ 'nmm_don_email' => '_nmm_don_email', 'nmm_don_amount' => '_nmm_don_amount', 'nmm_don_type' => '_nmm_don_type' ];
    if ( isset( $map[ $col ] ) ) {
        $val = get_post_meta( $post_id, $map[ $col ], true );
        if ( $col === 'nmm_don_email' && $val ) {
            echo '<a href="mailto:' . esc_attr( $val ) . '">' . esc_html( $val ) . '</a>';
        } else {
            echo esc_html( $val ?: '—' );
        }
        return;
    }
    if ( $col === 'nmm_don_anon' ) {
        echo get_post_meta( $post_id, '_nmm_don_anonymous', true ) ? '<span style="color:green;">Yes</span>' : '—';
    }
    if ( $col === 'nmm_don_status' ) {
        $s = get_post_meta( $post_id, '_nmm_don_status', true ) ?: 'pending';
        $labels = [ 'pending' => 'Pending', 'confirmed' => 'Confirmed', 'failed' => 'Failed' ];
        $colors = [ 'pending' => '#f39c12', 'confirmed' => '#27ae60', 'failed' => '#e74c3c' ];
        $c = $colors[ $s ] ?? '#718096';
        printf( '<span style="display:inline-block;padding:2px 8px;border-radius:4px;font-size:11px;font-weight:700;text-transform:uppercase;background:%s22;color:%s;">%s</span>',
            esc_attr( $c ), esc_attr( $c ), esc_html( $labels[ $s ] ?? ucfirst( $s ) ) );
    }
}
add_action( 'manage_nmm_donation_posts_custom_column', 'nmm_donation_column_data', 10, 2 );

// Donation detail + status meta boxes
function nmm_donation_meta_boxes(): void {
    add_meta_box( 'nmm_don_detail',     'Donation Details', 'nmm_don_detail_cb',     'nmm_donation', 'normal', 'high' );
    add_meta_box( 'nmm_don_status_box', 'Status',           'nmm_don_status_box_cb', 'nmm_donation', 'side',   'high' );
}
add_action( 'add_meta_boxes', 'nmm_donation_meta_boxes' );

function nmm_don_detail_cb( WP_Post $post ): void {
    $fields = [ 'Name' => '_nmm_don_name', 'Email' => '_nmm_don_email', 'Phone' => '_nmm_don_phone',
                'Amount' => '_nmm_don_amount', 'Type' => '_nmm_don_type', 'Anonymous' => '_nmm_don_anonymous',
                'Date' => '_nmm_don_date', 'IP' => '_nmm_don_ip' ];
    echo '<table class="form-table" style="margin:0;"><tbody>';
    foreach ( $fields as $label => $key ) {
        $val = get_post_meta( $post->ID, $key, true );
        echo '<tr><th style="width:120px;padding:8px 0;">' . esc_html( $label ) . '</th><td style="padding:8px 0;">';
        if ( $key === '_nmm_don_email' && $val ) {
            echo '<a href="mailto:' . esc_attr( $val ) . '">' . esc_html( $val ) . '</a>';
        } elseif ( $key === '_nmm_don_anonymous' ) {
            echo $val ? '<strong style="color:green;">Yes — keep anonymous</strong>' : 'No';
        } else {
            echo esc_html( $val ?: '—' );
        }
        echo '</td></tr>';
    }
    echo '</tbody></table>';
    $msg = get_post_meta( $post->ID, '_nmm_don_message', true );
    if ( $msg ) {
        echo '<hr style="margin:16px 0;"><h4 style="margin:0 0 8px;">Message / Reference</h4>';
        echo '<div style="background:#f7f8fc;border:1px solid #E2E8F0;border-radius:8px;padding:16px;font-size:14px;line-height:1.7;">' . esc_html( $msg ) . '</div>';
    }
}

function nmm_don_status_box_cb( WP_Post $post ): void {
    wp_nonce_field( 'nmm_don_status', 'nmm_don_status_nonce' );
    $current = get_post_meta( $post->ID, '_nmm_don_status', true ) ?: 'pending';
    $options = [ 'pending' => 'Pending', 'confirmed' => 'Confirmed', 'failed' => 'Failed / Cancelled' ];
    echo '<select name="nmm_don_status" style="width:100%;padding:6px;">';
    foreach ( $options as $val => $label ) {
        printf( '<option value="%s"%s>%s</option>', esc_attr( $val ), selected( $current, $val, false ), esc_html( $label ) );
    }
    echo '</select>';
    $email = get_post_meta( $post->ID, '_nmm_don_email', true );
    if ( $email ) {
        printf( '<a href="mailto:%s?subject=Your NMM Donation - Confirmation" class="button button-secondary" style="margin-top:8px;width:100%%;text-align:center;">Send Confirmation Email</a>', esc_attr( $email ) );
    }
}

function nmm_save_donation_status( int $post_id ): void {
    if ( ! isset( $_POST['nmm_don_status_nonce'] ) || ! wp_verify_nonce( $_POST['nmm_don_status_nonce'], 'nmm_don_status' ) ) return;
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;
    $allowed = [ 'pending', 'confirmed', 'failed' ];
    $status  = sanitize_text_field( $_POST['nmm_don_status'] ?? 'pending' );
    if ( in_array( $status, $allowed, true ) ) {
        update_post_meta( $post_id, '_nmm_don_status', $status );
    }
}
add_action( 'save_post_nmm_donation', 'nmm_save_donation_status' );

// Dashboard widget for donations
function nmm_donation_dashboard_widget(): void {
    $pending = get_posts( [ 'post_type' => 'nmm_donation', 'posts_per_page' => 5, 'meta_key' => '_nmm_don_status', 'meta_value' => 'pending' ] );
    echo '<p style="font-size:14px;margin-bottom:12px;"><strong>' . count( $pending ) . '</strong> unconfirmed donation(s) awaiting verification.</p>';
    if ( $pending ) {
        echo '<ul>';
        foreach ( $pending as $d ) {
            printf( '<li style="margin-bottom:8px;font-size:13px;"><a href="%s"><strong>%s</strong></a> — %s</li>',
                esc_url( get_edit_post_link( $d->ID ) ),
                esc_html( get_post_meta( $d->ID, '_nmm_don_name', true ) ),
                esc_html( get_post_meta( $d->ID, '_nmm_don_amount', true ) ?: 'Amount not specified' )
            );
        }
        echo '</ul>';
    }
    printf( '<a href="%s" class="button button-secondary" style="margin-top:8px;">View All Donations</a>', esc_url( admin_url( 'edit.php?post_type=nmm_donation' ) ) );
}
function nmm_register_donation_widget(): void {
    wp_add_dashboard_widget( 'nmm_donation_widget', __( 'NMM Donations', 'nas-medical-mission' ), 'nmm_donation_dashboard_widget' );
}
add_action( 'wp_dashboard_setup', 'nmm_register_donation_widget' );

// Customiser: Bank / Donation settings
function nmm_customizer_donation( WP_Customize_Manager $wp_customize ): void {
    $wp_customize->add_section( 'nmm_donation_details', [
        'title'    => __( 'Donation / Bank Details', 'nas-medical-mission' ),
        'panel'    => 'nmm_panel',
        'priority' => 40,
    ] );
    $fields = [
        'nmm_bank_name'    => 'Bank Name',
        'nmm_bank_account' => 'Account Number',
        'nmm_bank_sort'    => 'Sort Code (optional)',
        'nmm_bank_routing' => 'Routing Number (optional)',
        'nmm_paypal'       => 'PayPal Donation URL (optional)',
    ];
    foreach ( $fields as $key => $label ) {
        $wp_customize->add_setting( $key, [ 'default' => '', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh' ] );
        $wp_customize->add_control( $key, [ 'label' => $label, 'section' => 'nmm_donation_details', 'type' => 'text' ] );
    }
}
add_action( 'customize_register', 'nmm_customizer_donation' );

// AJAX: handle donation intent submission
function nmm_handle_donate_intent(): void {
    if ( ! check_ajax_referer( 'nmm_nonce', 'nonce', false ) ) {
        wp_send_json_error( [ 'message' => __( 'Security check failed.', 'nas-medical-mission' ) ] );
    }

    $name    = sanitize_text_field(     wp_unslash( $_POST['donor_name']    ?? '' ) );
    $email   = sanitize_email(          wp_unslash( $_POST['donor_email']   ?? '' ) );
    $phone   = sanitize_text_field(     wp_unslash( $_POST['donor_phone']   ?? '' ) );
    $amount  = sanitize_text_field(     wp_unslash( $_POST['amount']        ?? '' ) );
    $type    = sanitize_text_field(     wp_unslash( $_POST['donation_type'] ?? 'One-time' ) );
    $message = sanitize_textarea_field( wp_unslash( $_POST['donor_message'] ?? '' ) );
    $anon    = ! empty( $_POST['anonymous'] ) ? 1 : 0;

    if ( ! $name )           { wp_send_json_error( [ 'message' => 'Please enter your name.' ] ); }
    if ( ! is_email($email)) { wp_send_json_error( [ 'message' => 'Please enter a valid email address.' ] ); }

    // Save to DB
    $post_id = wp_insert_post( [
        'post_type'   => 'nmm_donation',
        'post_title'  => ( $anon ? 'Anonymous' : $name ) . ' — ' . ( $amount ?: 'Unspecified' ) . ' (' . $type . ')',
        'post_status' => 'publish',
        'post_author' => 0,
    ] );

    if ( $post_id && ! is_wp_error( $post_id ) ) {
        update_post_meta( $post_id, '_nmm_don_name',      $name );
        update_post_meta( $post_id, '_nmm_don_email',     $email );
        update_post_meta( $post_id, '_nmm_don_phone',     $phone );
        update_post_meta( $post_id, '_nmm_don_amount',    $amount );
        update_post_meta( $post_id, '_nmm_don_type',      $type );
        update_post_meta( $post_id, '_nmm_don_message',   $message );
        update_post_meta( $post_id, '_nmm_don_anonymous', $anon );
        update_post_meta( $post_id, '_nmm_don_status',    'pending' );
        update_post_meta( $post_id, '_nmm_don_date',      current_time( 'mysql' ) );
        update_post_meta( $post_id, '_nmm_don_ip',        sanitize_text_field( $_SERVER['REMOTE_ADDR'] ?? '' ) );
    }

    // Notify admins
    $recipients_raw = get_theme_mod( 'nmm_contact_recipients', get_option( 'admin_email' ) );
    $recipients     = array_filter( array_map( 'trim', explode( ',', $recipients_raw ) ), 'is_email' );
    if ( empty( $recipients ) ) $recipients = [ get_option( 'admin_email' ) ];

    $admin_body = nmm_email_template( [
        'heading' => 'New Donation Notification',
        'intro'   => 'A donor has indicated they have made or intend to make a donation via the NAS Medical Mission website. Please verify receipt via your bank portal.',
        'fields'  => [
            'Donor Name'  => $anon ? 'Anonymous' : $name,
            'Email'       => $email,
            'Phone'       => $phone ?: '—',
            'Amount'      => $amount ?: 'Not specified',
            'Type'        => $type,
            'Message'     => $message ?: '—',
            'Anonymous'   => $anon ? 'Yes' : 'No',
            'View Record' => $post_id ? '<a href="' . esc_url( get_edit_post_link( $post_id ) ) . '" style="color:#6E378B;">View in Admin →</a>' : '—',
        ],
    ] );

    foreach ( $recipients as $r ) {
        wp_mail( $r, 'NMM Donation Notification: ' . ( $anon ? 'Anonymous' : $name ), $admin_body, [
            'Content-Type: text/html; charset=UTF-8',
            "Reply-To: $name <$email>",
        ] );
    }

    // Auto-reply to donor
    if ( get_theme_mod( 'nmm_contact_autoreply', '1' ) ) {
        wp_mail( $email, 'Thank you for your donation to NAS Medical Mission', nmm_email_template( [
            'heading' => 'Thank You, ' . esc_html( $name ) . '!',
            'intro'   => 'We have received your donation notification. We will verify receipt and send you a confirmation shortly.',
            'fields'  => [
                'Amount Notified' => $amount ?: 'Not specified',
                'Donation Type'   => $type,
                'Next Steps'      => 'Our team will verify your bank transfer within 1–3 business days and send a confirmation.',
            ],
            'footer_extra' => '<p style="text-align:center;font-size:13px;color:#718096;">For questions, contact us at <a href="mailto:' . esc_attr( nmm_opt( 'nmm_email', 'info@nasmedicalmission.org' ) ) . '" style="color:#6E378B;">' . esc_html( nmm_opt( 'nmm_email', 'info@nasmedicalmission.org' ) ) . '</a></p>',
        ] ), [ 'Content-Type: text/html; charset=UTF-8', 'From: NAS Medical Mission <' . get_option( 'admin_email' ) . '>' ] );
    }

    wp_send_json_success( [
        'message' => __( 'Thank you! Your donation has been recorded. We\'ll verify receipt and send you a confirmation within 1–3 business days.', 'nas-medical-mission' ),
    ] );
}
add_action( 'wp_ajax_nmm_donate_intent',        'nmm_handle_donate_intent' );
add_action( 'wp_ajax_nopriv_nmm_donate_intent', 'nmm_handle_donate_intent' );

/* ============================================================
   13. BLOG — Reading settings helper
   ============================================================ */

/**
 * Ensure the blog index page is properly set up regardless of
 * whether the user created a /blog page or is using the default
 * posts page. We also add a rewrite for /blog/ → posts index.
 */
function nmm_flush_rewrite_on_save( int $post_id ): void {
    if ( get_post_type( $post_id ) === 'page' ) {
        flush_rewrite_rules();
    }
}
add_action( 'save_post', 'nmm_flush_rewrite_on_save' );

/**
 * Auto-detect and set the posts page if a page with slug 'blog'
 * exists but isn't yet assigned in Reading settings.
 */
function nmm_maybe_set_blog_page(): void {
    if ( get_option( 'page_for_posts' ) ) return; // already set
    $blog_page = get_page_by_path( 'blog' );
    if ( $blog_page ) {
        update_option( 'page_for_posts', $blog_page->ID );
        update_option( 'show_on_front',  'page' );
        flush_rewrite_rules();
    }
}
add_action( 'init', 'nmm_maybe_set_blog_page', 20 );
