<?php get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

<!-- Page Hero -->
<div class="page-hero">
    <div class="container">
        <div class="page-hero__content">
            <h1 class="page-hero__title"><?php the_title(); ?></h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'nas-medical-mission' ); ?></a></li>
                <li class="current"><?php the_title(); ?></li>
            </ol>
        </div>
    </div>
</div>

<section class="section">
    <div class="container" style="max-width:900px;">
        <?php if ( has_post_thumbnail() ) : ?>
            <figure style="margin-bottom:2.5rem; border-radius:var(--radius-xl); overflow:hidden;">
                <?php the_post_thumbnail( 'nmm-hero', [
                    'style'   => 'width:100%;max-height:460px;object-fit:cover;',
                    'loading' => 'eager',
                ] ); ?>
            </figure>
        <?php endif; ?>

        <div class="entry-content" style="font-size:1.05rem; line-height:1.8; color:var(--color-slate);">
            <?php the_content(); ?>
        </div>
    </div>
</section>

<?php endwhile; ?>

<?php get_footer(); ?>

<style>
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
