<?php
/**
 * Single: Event (Upcoming Mission)
 */
get_header();
while ( have_posts() ) : the_post();
    $event_date = get_post_meta( get_the_ID(), '_nmm_event_date',     true );
    $event_time = get_post_meta( get_the_ID(), '_nmm_event_time',     true );
    $location   = get_post_meta( get_the_ID(), '_nmm_event_location', true );
    $reg_link   = get_post_meta( get_the_ID(), '_nmm_register_link',  true );
    $is_future  = $event_date ? ( strtotime( $event_date ) >= strtotime( 'today' ) ) : true;
    $img_url    = nmm_get_post_thumbnail_url( get_the_ID(), 'nmm-hero' );
?>

<div class="page-hero">
    <div class="container">
        <div class="page-hero__content">
            <h1 class="page-hero__title" style="max-width:750px;"><?php the_title(); ?></h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'nas-medical-mission' ); ?></a></li>
                <li><a href="<?php echo esc_url( home_url( '/medical-missions/' ) ); ?>"><?php esc_html_e( 'Medical Missions', 'nas-medical-mission' ); ?></a></li>
                <li><a href="<?php echo esc_url( home_url( '/medical-missions/events/' ) ); ?>"><?php esc_html_e( 'Upcoming', 'nas-medical-mission' ); ?></a></li>
                <li class="current"><?php the_title(); ?></li>
            </ol>
        </div>
    </div>
</div>

<!-- Event Detail -->
<section class="section">
    <div class="container">
        <div style="display:grid; grid-template-columns:1fr 320px; gap:3rem; align-items:start;">

            <article>
                <!-- Event Meta Cards -->
                <div style="display:grid; grid-template-columns:repeat(auto-fit,minmax(160px,1fr)); gap:1rem; margin-bottom:2.5rem;">
                    <?php
                    $meta = [
                        [ 'fas fa-calendar-alt', 'Date',     $event_date ? date( 'l, F j, Y', strtotime( $event_date ) ) : __( 'TBC', 'nas-medical-mission' ) ],
                        [ 'fas fa-clock',        'Time',     $event_time ?: __( 'TBC', 'nas-medical-mission' ) ],
                        [ 'fas fa-map-marker-alt','Location', $location   ?: __( 'TBC', 'nas-medical-mission' ) ],
                        [ 'fas fa-tag',          'Status',   $is_future  ? __( 'Upcoming', 'nas-medical-mission' ) : __( 'Past Event', 'nas-medical-mission' ) ],
                    ];
                    foreach ( $meta as $m ) :
                    ?>
                        <div style="background:var(--color-surface); border:1px solid var(--color-border); border-radius:var(--radius-md); padding:1.1rem; text-align:center;">
                            <i class="<?php echo esc_attr( $m[0] ); ?>" style="color:var(--color-primary); font-size:1.1rem; display:block; margin-bottom:.4rem;"></i>
                            <span style="display:block; font-size:.7rem; font-weight:700; text-transform:uppercase; letter-spacing:.08em; color:var(--color-muted); margin-bottom:.25rem;"><?php echo esc_html( $m[1] ); ?></span>
                            <span style="font-size:.9rem; font-weight:600; color:var(--color-charcoal); line-height:1.3;"><?php echo esc_html( $m[2] ); ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Featured Image -->
                <?php if ( has_post_thumbnail() ) : ?>
                    <figure style="margin-bottom:2rem; border-radius:var(--radius-xl); overflow:hidden;">
                        <?php the_post_thumbnail( 'nmm-hero', [
                            'style'   => 'width:100%;max-height:460px;object-fit:cover;',
                            'loading' => 'eager',
                        ] ); ?>
                    </figure>
                <?php else : ?>
                    <figure style="margin-bottom:2rem; border-radius:var(--radius-xl); overflow:hidden;">
                        <img src="<?php echo esc_url( $img_url ); ?>"
                             alt="<?php echo esc_attr( get_the_title() ); ?>"
                             style="width:100%;max-height:460px;object-fit:cover;"
                             loading="eager">
                    </figure>
                <?php endif; ?>

                <!-- Content -->
                <div class="entry-content" style="font-size:1.05rem; line-height:1.8; color:var(--color-slate);">
                    <?php the_content(); ?>
                </div>

                <!-- Share -->
                <div style="margin-top:2.5rem; padding-top:1.5rem; border-top:1px solid var(--color-border); display:flex; align-items:center; gap:1rem; flex-wrap:wrap;">
                    <span style="font-size:.82rem; font-weight:700; text-transform:uppercase; letter-spacing:.1em; color:var(--color-muted);"><?php esc_html_e( 'Share event:', 'nas-medical-mission' ); ?></span>
                    <?php $url = urlencode( get_permalink() ); $title_enc = urlencode( get_the_title() ); ?>
                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $url; ?>" target="_blank" rel="noopener" class="btn btn-outline" style="font-size:.8rem; padding:.4rem .9rem;"><i class="fab fa-facebook-f"></i> Facebook</a>
                    <a href="https://twitter.com/intent/tweet?url=<?php echo $url; ?>&text=<?php echo $title_enc; ?>" target="_blank" rel="noopener" class="btn btn-outline" style="font-size:.8rem; padding:.4rem .9rem;"><i class="fab fa-x-twitter"></i> X</a>
                    <a href="https://wa.me/?text=<?php echo $title_enc; ?>%20<?php echo $url; ?>" target="_blank" rel="noopener" class="btn btn-outline" style="font-size:.8rem; padding:.4rem .9rem;"><i class="fab fa-whatsapp"></i> WhatsApp</a>
                </div>
            </article>

            <!-- Sidebar -->
            <aside style="position:sticky; top:100px; display:flex; flex-direction:column; gap:1.5rem;">

                <!-- Register / Donate CTA -->
                <?php if ( $reg_link && $is_future ) : ?>
                    <div style="background:var(--color-accent); border-radius:var(--radius-lg); padding:2rem; text-align:center;">
                        <i class="fas fa-check-circle" style="font-size:2rem; color:var(--color-charcoal); display:block; margin-bottom:1rem;"></i>
                        <h4 style="color:var(--color-charcoal); margin-bottom:.5rem;"><?php esc_html_e( 'Register to Attend', 'nas-medical-mission' ); ?></h4>
                        <p style="font-size:.88rem; color:rgba(0,0,0,.7); margin-bottom:1.25rem;"><?php esc_html_e( 'This is a free medical outreach. Register your interest or volunteer as a medical professional.', 'nas-medical-mission' ); ?></p>
                        <a href="<?php echo esc_url( $reg_link ); ?>" target="_blank" rel="noopener" class="btn btn-primary" style="width:100%; justify-content:center;">
                            <i class="fas fa-external-link-alt"></i> <?php esc_html_e( 'Register Now', 'nas-medical-mission' ); ?>
                        </a>
                    </div>
                <?php endif; ?>

                <div style="background:var(--color-primary); border-radius:var(--radius-lg); padding:2rem; color:white; text-align:center;">
                    <i class="fas fa-user-md" style="font-size:2rem; color:var(--color-accent); display:block; margin-bottom:1rem;"></i>
                    <h4 style="color:white; margin-bottom:.5rem;"><?php esc_html_e( 'Volunteer Your Skills', 'nas-medical-mission' ); ?></h4>
                    <p style="font-size:.88rem; color:rgba(255,255,255,.8); margin-bottom:1.25rem;"><?php esc_html_e( 'Medical professionals can register to volunteer at this and future missions.', 'nas-medical-mission' ); ?></p>
                    <a href="<?php echo esc_url( home_url( '/volunteer/' ) ); ?>" class="btn btn-accent" style="width:100%; justify-content:center; font-size:.85rem;">
                        <?php esc_html_e( 'Apply to Volunteer', 'nas-medical-mission' ); ?>
                    </a>
                </div>

                <!-- Other upcoming events -->
                <?php
                $others = new WP_Query( [
                    'post_type'      => 'nmm_event',
                    'posts_per_page' => 4,
                    'post__not_in'   => [ get_the_ID() ],
                    'orderby'        => 'meta_value',
                    'meta_key'       => '_nmm_event_date',
                    'order'          => 'ASC',
                ] );
                if ( $others->have_posts() ) :
                ?>
                    <div style="background:var(--color-surface); border-radius:var(--radius-lg); padding:1.5rem;">
                        <h4 style="font-size:.82rem; text-transform:uppercase; letter-spacing:.1em; color:var(--color-muted); margin-bottom:1rem;"><?php esc_html_e( 'Other Events', 'nas-medical-mission' ); ?></h4>
                        <ul style="list-style:none;">
                            <?php while ( $others->have_posts() ) : $others->the_post();
                                $odate = get_post_meta( get_the_ID(), '_nmm_event_date', true );
                            ?>
                                <li style="border-bottom:1px solid var(--color-border); padding:.65rem 0;">
                                    <a href="<?php the_permalink(); ?>" style="font-size:.875rem; font-weight:600; color:var(--color-charcoal); display:flex; gap:.5rem; align-items:flex-start;">
                                        <i class="fas fa-calendar fa-xs" style="color:var(--color-primary); margin-top:3px; flex-shrink:0;"></i>
                                        <span>
                                            <?php the_title(); ?>
                                            <?php if ( $odate ) : ?>
                                                <span style="display:block; font-size:.75rem; font-weight:400; color:var(--color-muted); margin-top:.15rem;"><?php echo esc_html( date( 'M j, Y', strtotime( $odate ) ) ); ?></span>
                                            <?php endif; ?>
                                        </span>
                                    </a>
                                </li>
                            <?php endwhile; wp_reset_postdata(); ?>
                        </ul>
                    </div>
                <?php endif; ?>

            </aside>
        </div>
    </div>
</section>

<style>
.entry-content h2,.entry-content h3{margin:1.75rem 0 .75rem;color:var(--color-charcoal);}
.entry-content p{margin-bottom:1.25rem;}
.entry-content ul,.entry-content ol{padding-left:1.5rem;margin-bottom:1.25rem;}
.entry-content li{margin-bottom:.4rem;}
.entry-content a{color:var(--color-primary);text-decoration:underline;}
.entry-content img{border-radius:var(--radius-md);margin:1.5rem 0;}
.entry-content blockquote{border-left:4px solid var(--color-primary);padding:1rem 1.5rem;background:var(--color-primary-pale);border-radius:0 var(--radius-md) var(--radius-md) 0;margin:1.5rem 0;font-style:italic;}
</style>

<?php endwhile; ?>
<?php get_footer(); ?>
