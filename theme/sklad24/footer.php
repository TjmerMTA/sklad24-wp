<?php
/**
 * Footer.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<footer>
  <div class="cols wrap">
    <div class="c1">
      <div class="flogo"><?php echo esc_html( s24_mod( 'logo_main' ) ); ?><span><?php echo esc_html( s24_mod( 'logo_accent' ) ); ?></span></div>
      <p><?php echo s24_br( s24_mod( 'footer_text' ) ); // phpcs:ignore ?></p>
    </div>
    <div>
      <h6>КАТАЛОГ</h6>
      <ul><?php s24_links( 'footer', 'li' ); ?></ul>
    </div>
    <div class="c3">
      <h6>КОНТАКТИ</h6>
      <ul>
        <li><a href="<?php echo esc_url( home_url( '/#form' ) ); ?>">Написати нам</a></li>
        <li><a href="<?php echo esc_url( s24_mod( 'price_url' ) ); ?>">Прайс-лист</a></li>
        <li><a href="<?php echo esc_url( s24_tel() ); ?>"><?php echo esc_html( s24_mod( 'phone_label' ) ); ?></a></li>
      </ul>
    </div>
  </div>
  <div class="bottom wrap">
    <div><?php echo esc_html( str_replace( '{year}', gmdate( 'Y' ), s24_mod( 'footer_copy' ) ) ); ?> <nav style="display:inline"><?php s24_links( 'legal' ); ?></nav></div>
    <div class="soc">
      <?php
      $soc = array(
		'facebook'  => array( 'Facebook', 'facebook' ),
		'youtube'   => array( 'YouTube', 'youtube' ),
		'instagram' => array( 'Instagram', 'instagram' ),
	);
      foreach ( $soc as $key => $s ) {
		printf( '<a href="%s" aria-label="%s" target="_blank" rel="noopener">%s</a>', esc_url( s24_mod( 'soc_' . $key ) ), esc_attr( $s[0] ), s24_icon( $s[1] ) ); // phpcs:ignore
      }
      printf( '<a href="%s" aria-label="Telegram" target="_blank" rel="noopener">%s</a>', esc_url( s24_mod( 'telegram' ) ), s24_icon( 'send' ) ); // phpcs:ignore
      printf( '<a href="%s" aria-label="LinkedIn" target="_blank" rel="noopener">%s</a>', esc_url( s24_mod( 'soc_linkedin' ) ), s24_icon( 'linkedin' ) ); // phpcs:ignore
      ?>
    </div>
  </div>
</footer>

<button class="totop" id="totop" aria-label="Вгору"><?php echo s24_icon( 'chevron-up' ); // phpcs:ignore ?></button>

<?php wp_footer(); ?>
</body>
</html>
