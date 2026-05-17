<?php get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

<!-- Page Hero -->
<div class="page-hero">
    <div class="container">
        <div class="page-hero__content">
            <h1 class="page-hero__title" style="max-width:800px;"><?php the_title(); ?></h1>
            <ol class="breadcrumb" style="margin-top:.75rem;">
                <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'nas-medical-mission' ); ?></a></li>
                <li><a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>"><?php esc_html_e( 'Blog', 'nas-medical-mission' ); ?></a></li>
                <li class="current"><?php the_title(); ?></li>
            </ol>
        </div>
    </div>
</div>

<section class="section">
    <div class="container">
        <div style="display:grid; grid-template-columns:1fr 300px; gap:3rem; align-items:start;">

            <!-- Article -->
            <article class="single-post" role="main">

                <!-- Meta bar -->
                <div style="display:flex; flex-wrap:wrap; gap:1.5rem; align-items:center; margin-bottom:2rem; padding-bottom:1.5rem; border-bottom:1px solid var(--color-border);">
                    <span style="display:flex; align-items:center; gap:.4rem; font-size:.85rem; color:var(--color-muted);">
                        <i class="fas fa-calendar-alt fa-xs"></i>
                        <?php echo esc_html( get_the_date( 'F j, Y' ) ); ?>
                    </span>
                    <?php
                    $cats = get_the_category();
                    if ( $cats ) :
                        foreach ( $cats as $cat ) :
                    ?>
                        <a href="<?php echo esc_url( get_category_link( $cat->term_id ) ); ?>" class="blog-card__tag">
                            <?php echo esc_html( $cat->name ); ?>
                        </a>
                    <?php endforeach; endif; ?>
                </div>

                <!-- Featured Image -->
                <?php if ( has_post_thumbnail() ) : ?>
                    <figure style="margin-bottom:2rem; border-radius:var(--radius-lg); overflow:hidden;">
                        <?php the_post_thumbnail( 'nmm-hero', [
                            'style'   => 'width:100%;max-height:480px;object-fit:cover;',
                            'loading' => 'eager',
                        ] ); ?>
                    </figure>
                <?php endif; ?>

                <!-- Content -->
                <div class="entry-content" style="
                    font-size: 1.05rem;
                    line-height: 1.8;
                    color: var(--color-slate);
                    max-width: 720px;
                ">
                    <?php the_content(); ?>
                </div>

                <!-- Tags -->
                <?php
                $tags = get_the_tags();
                if ( $tags ) :
                ?>
                    <div style="margin-top:2.5rem; padding-top:1.5rem; border-top:1px solid var(--color-border); display:flex; flex-wrap:wrap; gap:.5rem; align-items:center;">
                        <span style="font-size:.82rem; font-weight:700; text-transform:uppercase; letter-spacing:.1em; color:var(--color-muted);"><?php esc_html_e( 'Tags:', 'nas-medical-mission' ); ?></span>
                        <?php foreach ( $tags as $tag ) : ?>
                            <a href="<?php echo esc_url( get_tag_link( $tag->term_id ) ); ?>"
                               style="font-size:.8rem; padding:.25rem .75rem; background:var(--color-surface); border:1px solid var(--color-border); border-radius:100px; color:var(--color-mid); transition:var(--transition);">
                               <?php echo esc_html( $tag->name ); ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <!-- Post Navigation -->
                <nav style="margin-top:3rem; display:grid; grid-template-columns:1fr 1fr; gap:1rem;" aria-label="<?php esc_attr_e( 'Post Navigation', 'nas-medical-mission' ); ?>">
                    <?php
                    $prev = get_previous_post();
                    $next = get_next_post();
                    if ( $prev ) :
                    ?>
                        <a href="<?php echo esc_url( get_permalink( $prev->ID ) ); ?>"
                           style="padding:1.25rem; border:1px solid var(--color-border); border-radius:var(--radius-md); transition:var(--transition); display:flex; flex-direction:column; gap:.25rem;"
                           class="post-nav-link">
                            <span style="font-size:.75rem; font-weight:700; text-transform:uppercase; letter-spacing:.1em; color:var(--color-muted);">
                                <i class="fas fa-chevron-left fa-xs"></i> <?php esc_html_e( 'Previous', 'nas-medical-mission' ); ?>
                            </span>
                            <span style="font-size:.9rem; font-weight:600; color:var(--color-charcoal); line-height:1.3;">
                                <?php echo esc_html( get_the_title( $prev->ID ) ); ?>
                            </span>
                        </a>
                    <?php else : ?>
                        <div></div>
                    <?php endif; ?>

                    <?php if ( $next ) : ?>
                        <a href="<?php echo esc_url( get_permalink( $next->ID ) ); ?>"
                           style="padding:1.25rem; border:1px solid var(--color-border); border-radius:var(--radius-md); transition:var(--transition); text-align:right; display:flex; flex-direction:column; gap:.25rem;"
                           class="post-nav-link">
                            <span style="font-size:.75rem; font-weight:700; text-transform:uppercase; letter-spacing:.1em; color:var(--color-muted);">
                                <?php esc_html_e( 'Next', 'nas-medical-mission' ); ?> <i class="fas fa-chevron-right fa-xs"></i>
                            </span>
                            <span style="font-size:.9rem; font-weight:600; color:var(--color-charcoal); line-height:1.3;">
                                <?php echo esc_html( get_the_title( $next->ID ) ); ?>
                            </span>
                        </a>
                    <?php endif; ?>
                </nav>

            </article>

            <!-- Sidebar -->
            <aside role="complementary">
                <div style="position:sticky; top:100px;">

                    <!-- Donate CTA -->
                    <div style="background:var(--color-primary); border-radius:var(--radius-lg); padding:2rem; color:white; text-align:center; margin-bottom:1.5rem;">
                        <i class="fas fa-heart" style="font-size:2rem; color:var(--color-accent); margin-bottom:1rem; display:block;"></i>
                        <h4 style="color:white; margin-bottom:.5rem;"><?php esc_html_e( 'Support Our Missions', 'nas-medical-mission' ); ?></h4>
                        <p style="color:rgba(255,255,255,0.8); font-size:.88rem; margin-bottom:1.25rem;"><?php esc_html_e( 'Your donation enables free healthcare for thousands of Nigerians.', 'nas-medical-mission' ); ?></p>
                        <a href="<?php echo esc_url( home_url( '/support/' ) ); ?>" class="btn btn-accent" style="font-size:.85rem; padding:.6rem 1.5rem;">
                            <?php esc_html_e( 'Donate Now', 'nas-medical-mission' ); ?>
                        </a>
                    </div>

                    <!-- Recent Posts -->
                    <?php
                    $recent = new WP_Query( [ 'post_type' => 'post', 'posts_per_page' => 4, 'post__not_in' => [ get_the_ID() ] ] );
                    if ( $recent->have_posts() ) :
                    ?>
                        <div style="background:var(--color-surface); border-radius:var(--radius-lg); padding:1.5rem;">
                            <h4 style="font-size:.82rem; text-transform:uppercase; letter-spacing:.12em; color:var(--color-muted); margin-bottom:1rem;"><?php esc_html_e( 'Recent Posts', 'nas-medical-mission' ); ?></h4>
                            <ul style="list-style:none;">
                                <?php while ( $recent->have_posts() ) : $recent->the_post(); ?>
                                    <li style="border-bottom:1px solid var(--color-border); padding:.75rem 0; display:flex; gap:.75rem;">
                                        <a href="<?php the_permalink(); ?>" style="font-size:.875rem; font-weight:600; color:var(--color-charcoal); line-height:1.3; flex:1;">
                                            <?php the_title(); ?>
                                        </a>
                                    </li>
                                <?php endwhile; wp_reset_postdata(); ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                </div>
            </aside>
        </div>
    </div>
</section>

<style>
.post-nav-link:hover { border-color: var(--color-primary); background: var(--color-primary-pale); }
.entry-content h2, .entry-content h3 { margin: 1.75rem 0 .75rem; color: var(--color-charcoal); }
.entry-content p  { margin-bottom: 1.25rem; }
.entry-content ul, .entry-content ol { padding-left: 1.5rem; margin-bottom: 1.25rem; }
.entry-content li { margin-bottom: .4rem; }
.entry-content a  { color: var(--color-primary); text-decoration: underline; }
.entry-content img { border-radius: var(--radius-md); margin: 1.5rem 0; }
.entry-content blockquote {
    border-left: 4px solid var(--color-primary);
    padding: 1rem 1.5rem;
    background: var(--color-primary-pale);
    border-radius: 0 var(--radius-md) var(--radius-md) 0;
    margin: 1.5rem 0;
    font-style: italic;
}
</style>

<?php endwhile; ?>

<?php get_footer(); ?>
