<?php get_header(); ?>

<!-- Page Hero -->
<div class="page-hero">
    <div class="container">
        <div class="page-hero__content">
            <h1 class="page-hero__title">
                <?php
                if ( is_category() ) {
                    echo esc_html( single_cat_title( '', false ) );
                } elseif ( is_tag() ) {
                    echo esc_html( single_tag_title( '', false ) );
                } elseif ( is_author() ) {
                    echo esc_html( get_the_author() );
                } elseif ( is_search() ) {
                    printf( esc_html__( 'Search Results for: %s', 'nas-medical-mission' ), '<em>' . esc_html( get_search_query() ) . '</em>' );
                } elseif ( is_archive() ) {
                    esc_html_e( 'Archives', 'nas-medical-mission' );
                } else {
                    esc_html_e( 'Blog & News', 'nas-medical-mission' );
                }
                ?>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'nas-medical-mission' ); ?></a></li>
                <li class="current"><?php esc_html_e( 'Blog', 'nas-medical-mission' ); ?></li>
            </ol>
        </div>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="blog-archive__layout">

            <!-- Posts -->
            <main role="main" class="blog-archive__main">
                <?php if ( have_posts() ) : ?>
                    <div class="blog__grid blog-archive__grid">
                        <?php while ( have_posts() ) : the_post(); ?>
                            <?php
                            $img_url = nmm_get_post_thumbnail_url( get_the_ID(), 'nmm-card' );
                            $cats    = get_the_category();
                            $tag     = ! empty( $cats ) ? $cats[0]->name : __( 'News', 'nas-medical-mission' );
                            ?>
                            <article class="blog-card fade-up">
                                <div class="blog-card__img-wrap">
                                    <img class="blog-card__img" src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" loading="lazy" width="640" height="200">
                                </div>
                                <div class="blog-card__body">
                                    <div class="blog-card__meta">
                                        <span class="blog-card__tag"><?php echo esc_html( $tag ); ?></span>
                                        <span class="blog-card__date"><?php echo esc_html( get_the_date( 'M j, Y' ) ); ?></span>
                                    </div>
                                    <h2 class="blog-card__title" style="font-size:1.05rem;">
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </h2>
                                    <p class="blog-card__excerpt"><?php echo esc_html( get_the_excerpt() ); ?></p>
                                    <a href="<?php the_permalink(); ?>" class="blog-card__link">
                                        <?php esc_html_e( 'Read More', 'nas-medical-mission' ); ?>
                                        <i class="fas fa-arrow-right fa-xs"></i>
                                    </a>
                                </div>
                            </article>
                        <?php endwhile; ?>
                    </div>

                    <!-- Pagination -->
                    <div class="blog-archive__pagination">
                        <?php
                        the_posts_pagination( [
                            'mid_size'  => 2,
                            'prev_text' => '<i class="fas fa-chevron-left"></i>',
                            'next_text' => '<i class="fas fa-chevron-right"></i>',
                        ] );
                        ?>
                    </div>

                <?php else : ?>
                    <div style="text-align:center; padding:4rem 0;">
                        <i class="fas fa-newspaper" style="font-size:3rem; color:var(--color-muted); margin-bottom:1rem; display:block;"></i>
                        <h2><?php esc_html_e( 'No posts found', 'nas-medical-mission' ); ?></h2>
                        <p><?php esc_html_e( 'Check back soon for the latest news and updates.', 'nas-medical-mission' ); ?></p>
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-primary" style="margin-top:1rem;">
                            <?php esc_html_e( 'Back to Home', 'nas-medical-mission' ); ?>
                        </a>
                    </div>
                <?php endif; ?>
            </main>

            <!-- Sidebar -->
            <aside role="complementary" class="blog-archive__sidebar">
                <?php if ( is_active_sidebar( 'sidebar-blog' ) ) : ?>
                    <?php dynamic_sidebar( 'sidebar-blog' ); ?>
                <?php else : ?>
                    <!-- Default sidebar content -->
                    <div class="blog-sidebar-card blog-sidebar-card--surface">
                        <h4 class="blog-sidebar-card__title"><?php esc_html_e( 'About NMM', 'nas-medical-mission' ); ?></h4>
                        <p><?php esc_html_e( 'NAS Medical Mission delivers free healthcare to underserved communities across Nigeria — quarterly, consistently, compassionately.', 'nas-medical-mission' ); ?></p>
                        <a href="<?php echo esc_url( home_url( '/about-us/' ) ); ?>" class="btn btn-outline blog-sidebar-card__btn">
                            <?php esc_html_e( 'Learn More', 'nas-medical-mission' ); ?>
                        </a>
                    </div>

                    <div class="blog-sidebar-card blog-sidebar-card--primary">
                        <i class="fas fa-heart blog-sidebar-card__icon" aria-hidden="true"></i>
                        <h4 class="blog-sidebar-card__title"><?php esc_html_e( 'Support a Mission', 'nas-medical-mission' ); ?></h4>
                        <p><?php esc_html_e( 'Your donation helps us reach more communities in need.', 'nas-medical-mission' ); ?></p>
                        <a href="<?php echo esc_url( home_url( '/support/' ) ); ?>" class="btn btn-accent blog-sidebar-card__btn">
                            <?php esc_html_e( 'Donate Now', 'nas-medical-mission' ); ?>
                        </a>
                    </div>
                <?php endif; ?>
            </aside>

        </div>
    </div>
</section>

<?php get_footer(); ?>
