<?php
/**
 * Single: Medical Mission
 */
get_header();
while ( have_posts() ) : the_post();
    $mission_date = get_post_meta( get_the_ID(), '_nmm_mission_date',    true );
    $location     = get_post_meta( get_the_ID(), '_nmm_mission_location', true );
    $community    = get_post_meta( get_the_ID(), '_nmm_community',        true );
    $lga          = get_post_meta( get_the_ID(), '_nmm_lga',              true );
    $patients     = get_post_meta( get_the_ID(), '_nmm_patients_seen',    true );
    $img_url      = nmm_get_post_thumbnail_url( get_the_ID(), 'nmm-hero' );
?>

<div class="page-hero">
    <div class="container">
        <div class="page-hero__content">
            <h1 class="page-hero__title" style="max-width:750px;"><?php the_title(); ?></h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'nas-medical-mission' ); ?></a></li>
                <li><a href="<?php echo esc_url( home_url( '/medical-missions/' ) ); ?>"><?php esc_html_e( 'Medical Missions', 'nas-medical-mission' ); ?></a></li>
                <li class="current"><?php the_title(); ?></li>
            </ol>
        </div>
    </div>
</div>

<section class="section">
    <div class="container">
        <div style="display:grid; grid-template-columns:1fr 300px; gap:3rem; align-items:start;">

            <article>
                <!-- Mission Meta Cards -->
                <div style="display:grid; grid-template-columns:repeat(auto-fit,minmax(140px,1fr)); gap:1rem; margin-bottom:2.5rem;">
                    <?php
                    $meta_items = [
                        [ 'fas fa-calendar-alt', 'Date',      $mission_date ? date( 'F j, Y', strtotime( $mission_date ) ) : get_the_date( 'F j, Y' ) ],
                        [ 'fas fa-map-marker-alt', 'Location', $location ?: '—' ],
                        [ 'fas fa-city', 'Community',         $community ?: '—' ],
                        [ 'fas fa-landmark', 'LGA',           $lga ?: '—' ],
                        [ 'fas fa-users', 'Patients Served',  $patients ? number_format( (int) $patients ) : '—' ],
                    ];
                    foreach ( $meta_items as $m ) :
                    ?>
                        <div style="background:var(--color-surface); border:1px solid var(--color-border); border-radius:var(--radius-md); padding:1rem; text-align:center;">
                            <i class="<?php echo esc_attr( $m[0] ); ?>" style="color:var(--color-primary); margin-bottom:.4rem; display:block; font-size:1.1rem;"></i>
                            <span style="display:block; font-size:.7rem; font-weight:700; text-transform:uppercase; letter-spacing:.08em; color:var(--color-muted); margin-bottom:.2rem;"><?php echo esc_html( $m[1] ); ?></span>
                            <span style="font-size:.9rem; font-weight:600; color:var(--color-charcoal);"><?php echo esc_html( $m[2] ); ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Featured Image -->
                <?php if ( has_post_thumbnail() ) : ?>
                    <figure style="margin-bottom:2rem; border-radius:var(--radius-xl); overflow:hidden;">
                        <?php the_post_thumbnail( 'nmm-hero', [ 'style' => 'width:100%;max-height:480px;object-fit:cover;', 'loading' => 'eager' ] ); ?>
                    </figure>
                <?php else : ?>
                    <figure style="margin-bottom:2rem; border-radius:var(--radius-xl); overflow:hidden;">
                        <img src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" style="width:100%;max-height:480px;object-fit:cover;">
                    </figure>
                <?php endif; ?>

                <!-- Content -->
                <div class="entry-content" style="font-size:1.05rem; line-height:1.8; color:var(--color-slate);">
                    <?php the_content(); ?>
                </div>

                <!-- Share -->
                <div style="margin-top:2.5rem; padding-top:1.5rem; border-top:1px solid var(--color-border); display:flex; align-items:center; gap:1rem; flex-wrap:wrap;">
                    <span style="font-size:.82rem; font-weight:700; text-transform:uppercase; letter-spacing:.1em; color:var(--color-muted);"><?php esc_html_e( 'Share:', 'nas-medical-mission' ); ?></span>
                    <?php $url = urlencode( get_permalink() ); $title = urlencode( get_the_title() ); ?>
                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $url; ?>" target="_blank" rel="noopener" class="btn btn-outline" style="font-size:.8rem; padding:.4rem .9rem;">
                        <i class="fab fa-facebook-f"></i> Facebook
                    </a>
                    <a href="https://twitter.com/intent/tweet?url=<?php echo $url; ?>&text=<?php echo $title; ?>" target="_blank" rel="noopener" class="btn btn-outline" style="font-size:.8rem; padding:.4rem .9rem;">
                        <i class="fab fa-x-twitter"></i> X
                    </a>
                    <a href="https://wa.me/?text=<?php echo $title; ?>%20<?php echo $url; ?>" target="_blank" rel="noopener" class="btn btn-outline" style="font-size:.8rem; padding:.4rem .9rem;">
                        <i class="fab fa-whatsapp"></i> WhatsApp
                    </a>
                </div>
            </article>

            <!-- Sidebar -->
            <aside style="position:sticky; top:100px;">
                <div style="background:var(--color-primary); border-radius:var(--radius-lg); padding:2rem; color:white; text-align:center; margin-bottom:1.5rem;">
                    <i class="fas fa-heart" style="font-size:2rem; color:var(--color-accent); display:block; margin-bottom:1rem;"></i>
                    <h4 style="color:white; margin-bottom:.5rem;"><?php esc_html_e( 'Support This Work', 'nas-medical-mission' ); ?></h4>
                    <p style="font-size:.88rem; color:rgba(255,255,255,.8); margin-bottom:1.25rem;"><?php esc_html_e( 'Your donation helps us run more free medical missions across Nigeria.', 'nas-medical-mission' ); ?></p>
                    <a href="<?php echo esc_url( home_url( '/support/' ) ); ?>" class="btn btn-accent" style="font-size:.85rem; width:100%; justify-content:center;">
                        <i class="fas fa-heart"></i> <?php esc_html_e( 'Donate Now', 'nas-medical-mission' ); ?>
                    </a>
                </div>

                <div style="background:var(--color-surface); border-radius:var(--radius-lg); padding:1.5rem; margin-bottom:1.5rem;">
                    <h4 style="font-size:.82rem; text-transform:uppercase; letter-spacing:.1em; color:var(--color-muted); margin-bottom:1rem;"><?php esc_html_e( 'More Missions', 'nas-medical-mission' ); ?></h4>
                    <?php
                    $others = new WP_Query( [ 'post_type' => 'nmm_mission', 'posts_per_page' => 4, 'post__not_in' => [ get_the_ID() ], 'orderby' => 'date', 'order' => 'DESC' ] );
                    if ( $others->have_posts() ) :
                        echo '<ul style="list-style:none;">';
                        while ( $others->have_posts() ) : $others->the_post();
                    ?>
                        <li style="border-bottom:1px solid var(--color-border); padding:.6rem 0;">
                            <a href="<?php the_permalink(); ?>" style="font-size:.875rem; font-weight:600; color:var(--color-charcoal); display:flex; align-items:flex-start; gap:.5rem;">
                                <i class="fas fa-chevron-right fa-xs" style="color:var(--color-primary); margin-top:3px; flex-shrink:0;"></i>
                                <?php the_title(); ?>
                            </a>
                        </li>
                    <?php endwhile; wp_reset_postdata();
                        echo '</ul>';
                    else :
                        echo '<p style="font-size:.88rem; color:var(--color-muted);">' . esc_html__( 'No other missions yet.', 'nas-medical-mission' ) . '</p>';
                    endif; ?>
                </div>

                <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn-outline" style="width:100%; justify-content:center;">
                    <i class="fas fa-hands-helping"></i> <?php esc_html_e( 'Volunteer', 'nas-medical-mission' ); ?>
                </a>
            </aside>
        </div>
    </div>
</section>

<?php endwhile; ?>

<style>
.entry-content h2,.entry-content h3{margin:1.75rem 0 .75rem;color:var(--color-charcoal);}
.entry-content p{margin-bottom:1.25rem;}
.entry-content ul,.entry-content ol{padding-left:1.5rem;margin-bottom:1.25rem;}
.entry-content li{margin-bottom:.4rem;}
.entry-content a{color:var(--color-primary);text-decoration:underline;}
.entry-content img{border-radius:var(--radius-md);margin:1.5rem 0;}
.entry-content blockquote{border-left:4px solid var(--color-primary);padding:1rem 1.5rem;background:var(--color-primary-pale);border-radius:0 var(--radius-md) var(--radius-md) 0;margin:1.5rem 0;font-style:italic;}
</style>

<?php get_footer(); ?>
