<?php
/**
 * Home page.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
get_header();

$feat_svg = array(
	1 => '<svg viewBox="0 0 64 64" fill="none" stroke="currentColor" stroke-linecap="round"><circle cx="26" cy="26" r="17" stroke-width="3"/><path class="accent" stroke="currentColor" d="M15 22a12 12 0 0 1 9-8" stroke-width="3" style="color:var(--red)"/><path d="M38.5 38.5 56 56" stroke-width="6"/></svg>',
	2 => '<svg viewBox="0 0 64 64" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M10 54 34 30"/><path d="M40 8a10 10 0 0 0-8 14l-4 4 10 10 4-4a10 10 0 0 0 14-8l-6 2-6-6 2-6z"/><path d="M8 12l6-4 26 26-4 4L10 18z" style="color:var(--red)" stroke="currentColor"/><path d="M36 40l14 14a4 4 0 0 0 6-6L42 34"/></svg>',
	3 => '<svg viewBox="0 0 64 64" fill="none" stroke="currentColor" stroke-width="3" stroke-linejoin="round"><path d="M27 6h10l2 7 6 3 7-3 7 7-3 7 3 6 7 2v10l-7 2-3 6 3 7-7 7-7-3-6 3-2 7H27l-2-7-6-3-7 3-7-7 3-7-3-6-7-2V27l7-2 3-6-3-7 7-7 7 3 6-3z" transform="translate(0 0) scale(.9) translate(3.5 3.5)"/><circle cx="32" cy="32" r="11" style="color:var(--red)" stroke="currentColor" stroke-width="4"/></svg>',
	4 => '<svg viewBox="0 0 64 64" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M14 22c-4 4-3 12 6 22s18 12 22 8l4-4-8-8-5 4c-3-1-9-7-10-10l4-5-8-8z"/><circle cx="44" cy="18" r="13" style="color:var(--red)" stroke="currentColor"/><path d="M44 11v9M44 25v.5" style="color:var(--red)" stroke="currentColor"/></svg>',
);
$why_icons = array( 1 => 'factory', 'award', 'boxes', 'trending-up', 'trophy', 'globe', 'shield-check', 'calendar-days' );
$num_icons = array( 1 => 'wrench', 'forklift', 'monitor-smartphone', 'handshake', 'shield-check' );
?>

<section class="hero" id="hero">
<?php
for ( $i = 1; $i <= 3; $i++ ) :
	$title = s24_mod( "hero_{$i}_title" );
	if ( '' === trim( $title ) ) {
		continue;
	}
	$img  = s24_mod( "hero_{$i}_img" );
	$mode = s24_mod( "hero_{$i}_mode" );
	$cls  = ( 'bg' === $mode ) ? 's1' : 's2';
	?>
  <div class="slide <?php echo esc_attr( $cls ); ?><?php echo 1 === $i ? ' on' : ''; ?>">
    <div class="bg"<?php echo ( 'bg' === $mode && $img ) ? ' style="background-image:url(' . esc_url( $img ) . ')"' : ''; ?>></div>
	<?php if ( 'bg' !== $mode && $img ) : ?>
    <div class="pic"><img src="<?php echo esc_url( $img ); ?>" alt="<?php echo esc_attr( str_replace( "\n", ' ', $title ) ); ?>"<?php echo 1 === $i ? '' : ' loading="lazy"'; ?>></div>
	<?php endif; ?>
    <div class="txt">
      <h2><?php echo s24_br( $title ); // phpcs:ignore ?></h2>
      <p><?php echo esc_html( s24_mod( "hero_{$i}_text" ) ); ?></p>
	<?php if ( s24_mod( "hero_{$i}_btn" ) ) : ?>
      <a class="btn" href="<?php echo esc_url( s24_mod( "hero_{$i}_url" ) ); ?>"><?php echo esc_html( s24_mod( "hero_{$i}_btn" ) ); ?></a>
	<?php endif; ?>
    </div>
  </div>
<?php endfor; ?>
  <button class="arr prev" aria-label="Попередній"><?php echo s24_icon( 'chevron-left' ); // phpcs:ignore ?></button>
  <button class="arr next" aria-label="Наступний"><?php echo s24_icon( 'chevron-right' ); // phpcs:ignore ?></button>
  <div class="dots"></div>
</section>

<section class="features">
  <div class="row">
<?php for ( $i = 1; $i <= 4; $i++ ) : ?>
    <a class="feat" href="<?php echo esc_url( s24_mod( "feat_{$i}_url" ) ); ?>">
      <div class="fi"><?php echo $feat_svg[ $i ]; // phpcs:ignore -- static markup. ?></div>
      <div><h3><?php echo esc_html( s24_mod( "feat_{$i}_title" ) ); ?></h3><p><?php echo esc_html( s24_mod( "feat_{$i}_text" ) ); ?></p></div>
    </a>
<?php endfor; ?>
  </div>
</section>

<section class="sec" id="catalog">
  <div class="wrap">
    <h2 class="title"><?php echo esc_html( s24_mod( 'cat_title' ) ); ?> <em><?php echo esc_html( s24_mod( 'cat_title_em' ) ); ?></em></h2>
    <div class="title-line"></div>
    <div class="cat-grid">
<?php
for ( $i = 1; $i <= 8; $i++ ) :
	$t = s24_mod( "cat_{$i}_title" );
	if ( '' === trim( $t ) ) {
		continue;
	}
	?>
      <a class="cat" href="<?php echo esc_url( s24_mod( "cat_{$i}_url" ) ); ?>"><h3><?php echo esc_html( $t ); ?></h3><img src="<?php echo esc_url( s24_mod( "cat_{$i}_img" ) ); ?>" alt="<?php echo esc_attr( $t ); ?>" loading="lazy"></a>
<?php endfor; ?>
    </div>
  </div>
</section>

<section class="why">
  <div class="wrap">
    <h2 class="title"><?php echo esc_html( s24_mod( 'why_title' ) ); ?> <em><?php echo esc_html( s24_mod( 'why_title_em' ) ); ?></em></h2>
    <div class="title-line" style="max-width:520px;margin-bottom:30px"></div>
    <div class="why-grid">
<?php
for ( $i = 1; $i <= 8; $i++ ) :
	$t = s24_mod( "why_{$i}" );
	if ( '' === trim( $t ) ) {
		continue;
	}
	?>
      <div class="why-item"><div class="wi"><?php echo s24_icon( $why_icons[ $i ] ); // phpcs:ignore ?></div><?php echo esc_html( $t ); ?></div>
<?php endfor; ?>
    </div>
  </div>
</section>

<section class="clients">
  <div class="wrap">
    <h3><?php echo esc_html( s24_mod( 'clients_title' ) ); ?></h3>
    <div class="logos">
<?php
for ( $i = 1; $i <= 5; $i++ ) :
	$src = s24_mod( "client_{$i}_img" );
	if ( ! $src ) {
		continue;
	}
	?>
      <div><img src="<?php echo esc_url( $src ); ?>" alt="<?php echo esc_attr( s24_mod( "client_{$i}_alt" ) ); ?>" loading="lazy"></div>
<?php endfor; ?>
    </div>
  </div>
</section>

<section class="service">
  <div class="wrap cols">
    <div>
      <h2 class="h-under"><?php echo esc_html( s24_mod( 'svc_title' ) ); ?></h2>
      <a class="svc-banner" href="<?php echo esc_url( s24_mod( 'svc_url' ) ); ?>"><img src="<?php echo esc_url( s24_mod( 'svc_img' ) ); ?>" alt="<?php echo esc_attr( s24_mod( 'svc_title' ) ); ?>" loading="lazy"></a>
      <div class="svc-text"><?php echo wpautop( wp_kses_post( s24_mod( 'svc_text' ) ) ); // phpcs:ignore ?></div>
    </div>
    <div class="form" id="form">
      <h2 class="h-under"><?php echo esc_html( s24_mod( 'form_title' ) ); ?></h2>
      <p class="lead"><?php echo esc_html( s24_mod( 'form_lead' ) ); ?></p>
      <form id="qform" novalidate>
        <input name="name" placeholder="Ім'я" required autocomplete="name">
        <input name="phone" type="tel" placeholder="Телефон" required autocomplete="tel">
        <input name="city" placeholder="Місто" autocomplete="address-level2">
        <input name="email" type="email" placeholder="E-mail" autocomplete="email">
        <textarea name="msg" placeholder="Ваше питання"></textarea>
        <input class="hp" name="website" tabindex="-1" autocomplete="off" aria-hidden="true">
        <button class="send" type="submit">Відправити</button>
        <div class="ok" id="qok" role="status"></div>
        <div class="err" id="qerr" role="alert"></div>
      </form>
    </div>
  </div>
</section>

<section class="nums">
  <div class="wrap">
    <h2 class="title"><?php echo esc_html( s24_mod( 'nums_title' ) ); ?><em><?php echo esc_html( s24_mod( 'nums_title_em' ) ); ?></em> <?php echo esc_html( s24_mod( 'nums_title_after' ) ); ?></h2>
    <div class="title-line"></div>
    <div class="num-row">
<?php
for ( $i = 1; $i <= 5; $i++ ) :
	$v = s24_mod( "num_{$i}_value" );
	if ( '' === trim( $v ) ) {
		continue;
	}
	?>
      <div class="num"><b><?php echo esc_html( $v ); ?></b><?php echo s24_icon( $num_icons[ $i ] ); // phpcs:ignore ?><span><?php echo s24_br( s24_mod( "num_{$i}_label" ) ); // phpcs:ignore ?></span></div>
<?php endfor; ?>
    </div>
  </div>
</section>

<?php
$products = get_posts(
	array(
		'post_type'      => 's24_product',
		'posts_per_page' => 20,
		'orderby'        => array(
			'menu_order' => 'ASC',
			'date'       => 'DESC',
		),
	)
);
if ( $products ) :
	?>
<section class="news">
  <div class="wrap">
    <h2 class="title"><?php echo esc_html( s24_mod( 'news_title' ) ); ?></h2>
    <div class="car">
      <button class="arr prev" aria-label="Назад"><?php echo s24_icon( 'chevron-left' ); // phpcs:ignore ?></button>
      <div class="track" id="track">
	<?php
	foreach ( $products as $p ) :
		$badge = s24_meta( $p->ID, 'badge' );
		$liion = s24_meta( $p->ID, 'liion' );
		$img   = get_the_post_thumbnail_url( $p, 'full' );
		$link  = s24_meta( $p->ID, 'link' );
		?>
        <div class="card">
		<?php if ( $badge ) : ?><span class="badge"><?php echo esc_html( $badge ); ?></span><?php endif; ?>
		<?php if ( $liion ) : ?><span class="liion"><?php echo esc_html( $liion ); ?></span><?php endif; ?>
		<?php if ( $img ) : ?><img src="<?php echo esc_url( $img ); ?>" alt="<?php echo esc_attr( get_the_title( $p ) ); ?>" loading="lazy"><?php endif; ?>
          <h4><?php echo esc_html( get_the_title( $p ) ); ?></h4><div class="ser"><?php echo esc_html( s24_meta( $p->ID, 'series' ) ); ?></div>
          <div class="spec">
		<?php if ( s24_meta( $p->ID, 'weight' ) ) : ?><span><?php echo s24_icon( 'weight' ); // phpcs:ignore ?><?php echo esc_html( s24_meta( $p->ID, 'weight' ) ); ?></span><?php endif; ?>
		<?php if ( s24_meta( $p->ID, 'height' ) ) : ?><span><?php echo s24_icon( 'move-vertical' ); // phpcs:ignore ?><?php echo esc_html( s24_meta( $p->ID, 'height' ) ); ?></span><?php endif; ?>
          </div>
		<?php if ( $link ) : ?><a class="more" href="<?php echo esc_url( $link ); ?>">Докладніше</a><?php endif; ?>
        </div>
	<?php endforeach; ?>
      </div>
      <button class="arr next" aria-label="Далі"><?php echo s24_icon( 'chevron-right' ); // phpcs:ignore ?></button>
    </div>
  </div>
</section>
<?php endif; ?>

<?php
$reviews = get_posts(
	array(
		'post_type'      => 's24_review',
		'posts_per_page' => 3,
		'orderby'        => array(
			'menu_order' => 'ASC',
			'date'       => 'DESC',
		),
	)
);
if ( $reviews ) :
	?>
<section class="reviews">
  <div class="wrap">
    <h2><?php echo esc_html( s24_mod( 'reviews_title' ) ); ?></h2>
    <div class="rv-grid">
	<?php
	foreach ( $reviews as $r ) :
		$img = get_the_post_thumbnail_url( $r, 'full' );
		?>
      <div class="rv"><h5><?php echo esc_html( get_the_title( $r ) ); ?></h5><div class="who"><?php echo esc_html( s24_meta( $r->ID, 'person' ) ); ?></div><div class="date"><?php echo esc_html( s24_meta( $r->ID, 'date' ) ); ?></div>
		<?php echo wpautop( esc_html( $r->post_content ) ); // phpcs:ignore ?>
		<?php if ( $img ) : ?><img src="<?php echo esc_url( $img ); ?>" alt="<?php echo esc_attr( 'Відгук: ' . get_the_title( $r ) ); ?>" loading="lazy"><?php endif; ?>
      </div>
	<?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<?php
$faq = get_posts(
	array(
		'post_type'      => 's24_faq',
		'posts_per_page' => 30,
		'orderby'        => array(
			'menu_order' => 'ASC',
			'date'       => 'ASC',
		),
	)
);
if ( $faq ) :
	?>
<section class="faq">
  <div class="cols wrap">
    <div>
      <h2><?php echo esc_html( s24_mod( 'faq_title' ) ); ?></h2>
      <p class="sub"><?php echo esc_html( s24_mod( 'faq_sub' ) ); ?></p>
      <a class="ask" href="#form"><?php echo esc_html( s24_mod( 'faq_ask' ) ); ?></a>
    </div>
    <div>
	<?php foreach ( $faq as $k => $q ) : ?>
      <div class="qa<?php echo 0 === $k ? ' hl' : ''; ?>"><button><?php echo esc_html( get_the_title( $q ) ); ?><i>+</i></button>
        <div class="ans"><?php echo wpautop( wp_kses_post( $q->post_content ) ); // phpcs:ignore ?></div></div>
	<?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<?php $cities = s24_cities(); ?>
<section class="contacts" id="contacts">
  <div class="wrap">
    <h2><?php echo esc_html( s24_mod( 'contacts_title' ) ); ?></h2>
<?php if ( $cities ) : ?>
    <div class="cities" id="cities">
	<?php foreach ( $cities as $k => $c ) : ?>
      <button class="city<?php echo 0 === $k ? ' on' : ''; ?>" data-q="<?php echo esc_attr( $c['q'] ); ?>"><b><?php echo esc_html( $c['city'] ); ?></b><?php echo $c['phone'] ? 'тел: ' . esc_html( $c['phone'] ) : ''; ?></button>
	<?php endforeach; ?>
    </div>
    <div class="map"><iframe id="map" title="Карта" loading="lazy" referrerpolicy="no-referrer-when-downgrade" src="<?php echo esc_url( s24_map_url( $cities[0]['q'] ) ); ?>"></iframe></div>
<?php endif; ?>
  </div>
</section>

<?php
get_footer();
