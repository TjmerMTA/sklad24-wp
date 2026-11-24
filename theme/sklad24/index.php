<?php
/**
 * Any other page or post: header, content, footer.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
get_header();
?>
<main class="sec s24-page">
  <div class="wrap">
<?php
if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();
		?>
    <article <?php post_class(); ?>>
		<?php if ( is_singular() ) : ?>
      <h1 class="title"><?php the_title(); ?></h1>
      <div class="title-line"></div>
      <div class="s24-content"><?php the_content(); ?></div>
		<?php else : ?>
      <h2 class="s24-list-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
      <div class="s24-content"><?php the_excerpt(); ?></div>
		<?php endif; ?>
    </article>
		<?php
	endwhile;
	the_posts_pagination();
else :
	?>
    <h1 class="title">Сторінку не знайдено</h1>
    <div class="title-line"></div>
    <p><a href="<?php echo esc_url( home_url( '/' ) ); ?>">На головну →</a></p>
<?php endif; ?>
  </div>
</main>
<?php
get_footer();
