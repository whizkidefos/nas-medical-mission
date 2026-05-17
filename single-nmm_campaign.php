<?php
/**
 * Single: Campaign
 */
get_header();
while ( have_posts() ) : the_post();
    $img_url = nmm_get_post_thumbnail_url( get_the_ID(), 'nmm-hero' );
?>

<div class="page-hero">
    <div class="container">
        <div class="page-hero__content">
            <h1 class="page-hero__title" style="max-width:750px;"><?php the_title(); ?></h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'nas-medical-mission' ); ?></a></li>
                <li><a href="<?php echo esc_url( home_url( '/campaigns/' ) ); ?>"><?php esc_html_e( 'Campaigns', 'nas-medical-mission' ); ?></a></li>
                <li class="current"><?php the_title(); ?></li>
            </ol>
        </div>
    </div>
</div>

<section class="section">
    <div class="container">
        <div style="display:grid; grid-template-columns:1fr 300px; gap:3rem; align-items:start;">

            <article>
                <!-- Meta bar -->
                <div style="display:flex; flex-wrap:wrap; gap:1.5rem; align-items:center; margin-bottom:2rem; padding-bottom:1.5rem; border-bottom:1px solid var(--color-border);">
                    <span style="display:flex; align-items:center; gap:.4rem; font-size:.85rem; color:var(--color-muted);">
                        <i class="fas fa-calendar-alt fa-xs" aria-hidden="true"></i>
                        <?php echo esc_html( get_the_date( 'F j, Y' ) ); ?>
                    </span>
                    <span class="blog-card__tag" style="background:var(--color-primary-pale); color:var(--color-primary);">
                        <?php esc_html_e( 'Health Campaign', 'nas-medical-mission' ); ?>
                    </span>
                </div>

                <!-- Featured Image -->
                <?php if ( has_post_thumbnail() ) : ?>
                    <figure style="margin-bottom:2rem; border-radius:var(--radius-xl); overflow:hidden;">
                        <?php the_post_thumbnail( 'nmm-hero', [
                            'style'   => 'width:100%;max-height:480px;object-fit:cover;',
                            'loading' => 'eager',
                        ] ); ?>
                    </figure>
                <?php else : ?>
                    <figure style="margin-bottom:2rem; border-radius:var(--radius-xl); overflow:hidden;">
                        <img src="<?php echo esc_url( $img_url ); ?>"
                             alt="<?php echo esc_attr( get_the_title() ); ?>"
                             style="width:100%;max-height:480px;object-fit:cover;"
                             loading="eager">
                    </figure>
                <?php endif; ?>

                <!-- Content -->
                <div class="entry-content" style="font-size:1.05rem; line-height:1.8; color:var(--color-slate);">
                    <?php the_content(); ?>
                </div>

                <!-- Share -->
                <div style="margin-top:2.5rem; padding-top:1.5rem; border-top:1px solid var(--color-border); display:flex; align-items:center; gap:1rem; flex-wrap:wrap;">
                    <span style="font-size:.82rem; font-weight:700; text-transform:uppercase; letter-spacing:.1em; color:var(--color-muted);"><?php esc_html_e( 'Share:', 'nas-medical-mission' ); ?></span>
                    <?php $url = urlencode( get_permalink() ); $title_enc = urlencode( get_the_title() ); ?>
                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $url; ?>" target="_blank" rel="noopener" class="btn btn-outline" style="font-size:.8rem; padding:.4rem .9rem;">
                        <i class="fab fa-facebook-f"></i> Facebook
                    </a>
                    <a href="https://twitter.com/intent/tweet?url=<?php echo $url; ?>&text=<?php echo $title_enc; ?>" target="_blank" rel="noopener" class="btn btn-outline" style="font-size:.8rem; padding:.4rem .9rem;">
                        <i class="fab fa-x-twitter"></i> X
                    </a>
                    <a href="https://wa.me/?text=<?php echo $title_enc; ?>%20<?php echo $url; ?>" target="_blank" rel="noopener" class="btn btn-outline" style="font-size:.8rem; padding:.4rem .9rem;">
                        <i class="fab fa-whatsapp"></i> WhatsApp
                    </a>
                </div>
            </article>

            <!-- Sidebar -->
            <aside style="position:sticky; top:100px;">

                <!-- Support CTA -->
                <div style="background:var(--color-primary); border-radius:var(--radius-lg); padding:2rem; color:white; text-align:center; margin-bottom:1.5rem;">
                    <i class="fas fa-bullhorn" style="font-size:2rem; color:var(--color-accent); display:block; margin-bottom:1rem;"></i>
                    <h4 style="color:white; margin-bottom:.5rem;"><?php esc_html_e( 'Spread the Word', 'nas-medical-mission' ); ?></h4>
                    <p style="font-size:.88rem; color:rgba(255,255,255,.8); margin-bottom:1.25rem;"><?php esc_html_e( 'Help us reach more people by sharing this campaign with your network.', 'nas-medical-mission' ); ?></p>
                    <a href="<?php echo esc_url( home_url( '/support/' ) ); ?>" class="btn btn-accent" style="width:100%; justify-content:center; font-size:.85rem;">
                        <i class="fas fa-heart"></i> <?php esc_html_e( 'Support NMM', 'nas-medical-mission' ); ?>
                    </a>
                </div>

                <!-- Other Campaigns -->
                <?php
                $others = new WP_Query( [
                    'post_type'      => 'nmm_campaign',
                    'posts_per_page' => 4,
                    'post__not_in'   => [ get_the_ID() ],
                    'orderby'        => 'date',
                    'order'          => 'DESC',
                ] );
                if ( $others->have_posts() ) :
                ?>
                    <div style="background:var(--color-surface); border-radius:var(--radius-lg); padding:1.5rem; margin-bottom:1.5rem;">
                        <h4 style="font-size:.82rem; text-transform:uppercase; letter-spacing:.1em; color:var(--color-muted); margin-bottom:1rem;"><?php esc_html_e( 'Other Campaigns', 'nas-medical-mission' ); ?></h4>
                        <ul style="list-style:none;">
                            <?php while ( $others->have_posts() ) : $others->the_post(); ?>
                                <li style="border-bottom:1px solid var(--color-border); padding:.65rem 0;">
                                    <a href="<?php the_permalink(); ?>" style="font-size:.875rem; font-weight:600; color:var(--color-charcoal); display:flex; align-items:flex-start; gap:.5rem;">
                                        <i class="fas fa-chevron-right fa-xs" style="color:var(--color-primary); margin-top:3px; flex-shrink:0;"></i>
                                        <?php the_title(); ?>
                                    </a>
                                </li>
                            <?php endwhile; wp_reset_postdata(); ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <a href="<?php echo esc_url( home_url( '/volunteer/' ) ); ?>" class="btn btn-outline" style="width:100%; justify-content:center;">
                    <i class="fas fa-hands-helping"></i> <?php esc_html_e( 'Volunteer With Us', 'nas-medical-mission' ); ?>
                </a>
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
