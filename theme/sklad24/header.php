<?php
/**
 * Header: top bar, logo, search, phone, catalog menu, mobile drawer.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div class="topbar">
  <div class="wrap">
    <nav><?php s24_links( 'top' ); ?></nav>
    <div class="right">
      <div class="lang"><a href="<?php echo esc_url( s24_mod( 'lang_ru_url' ) ); ?>">RU</a><a class="on" href="<?php echo esc_url( home_url( '/' ) ); ?>">UK</a></div>
      <a class="ic" href="<?php echo esc_url( s24_tel() ); ?>"><?php echo s24_icon( 'phone' ); // phpcs:ignore ?>Подзвонити</a>
      <a class="ic" href="<?php echo esc_url( s24_mod( 'telegram' ) ); ?>" target="_blank" rel="noopener"><?php echo s24_icon( 'send' ); // phpcs:ignore ?>Telegram</a>
    </div>
  </div>
</div>

<header class="header">
  <div class="wrap">
    <button class="burger" aria-label="Меню" id="burger"><?php echo s24_icon( 'menu' ); // phpcs:ignore ?></button>
    <a class="logo" href="<?php echo esc_url( home_url( '/' ) ); ?>"><b><?php echo esc_html( s24_mod( 'logo_main' ) ); ?><span><?php echo esc_html( s24_mod( 'logo_accent' ) ); ?></span></b><small><?php echo esc_html( s24_mod( 'logo_sub' ) ); ?></small></a>
    <form class="search" action="<?php echo esc_url( s24_mod( 'search_action' ) ); ?>" method="get" role="search">
      <input type="search" name="s" placeholder="Пошук" aria-label="Пошук">
      <button type="submit" aria-label="Шукати"><?php echo s24_icon( 'search' ); // phpcs:ignore ?></button>
    </form>
    <a class="phone" href="<?php echo esc_url( s24_tel() ); ?>"><?php echo esc_html( s24_mod( 'phone_label' ) ); ?></a>
  </div>
</header>

<nav class="mainnav" aria-label="Каталог">
  <ul><?php s24_links( 'catalog', 'li' ); ?></ul>
</nav>

<div class="drawer" id="drawer">
  <div class="shade" data-close></div>
  <div class="panel">
    <button class="close" data-close aria-label="Закрити"><?php echo s24_icon( 'x' ); // phpcs:ignore ?></button>
    <div style="clear:both;height:8px"></div>
    <?php s24_links( 'catalog' ); ?>
    <div class="small"><?php s24_links( 'top', 'a', array( '#contacts' => 'data-close' ) ); ?></div>
  </div>
</div>
