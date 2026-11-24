<?php
/**
 * Default content of every editable field (shown until the owner changes it in the Customizer).
 * Image values starting with "img:" point to files in assets/img of the theme.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function s24_defaults() {
	static $d = null;
	if ( null !== $d ) {
		return $d;
	}
	$base = 'https://sklad24.com.ua';
	$d    = array(
		// Contacts.
		'phone'            => '+380931775631',
		'phone_label'      => '+38 093 177 5631',
		'telegram'         => 'https://t.me/sklad24ua_bot',
		'lead_email'       => '',
		'logo_main'        => 'Склад',
		'logo_accent'      => '24',
		'logo_sub'         => 'Техніка для складу',
		'search_action'    => $base . '/',
		'lang_ru_url'      => $base . '/ru/',
		'meta_description' => 'Рокли, штабелери, навантажувачі та підйомники з сервісом по Україні.',

		// Hero slides.
		'hero_1_title'     => "Позашляховий\nнавантажувач",
		'hero_1_text'      => 'Навантажувач підвищеної прохідності для роботи в умовах бездоріжжя',
		'hero_1_btn'       => 'Дізнатись детальніше',
		'hero_1_url'       => $base . '/katalog/pogruzchik/',
		'hero_1_img'       => 'img:hero-clean.jpg',
		'hero_1_mode'      => 'bg',
		'hero_2_title'     => "Електричні\nштабелери HELI",
		'hero_2_text'      => 'Підйом палет до 3500 мм — офіційний дилер, гарантія та сервіс по Україні',
		'hero_2_btn'       => 'Дізнатись детальніше',
		'hero_2_url'       => $base . '/katalog/shtabeleryi/',
		'hero_2_img'       => 'img:hero2.webp',
		'hero_2_mode'      => 'pic',
		'hero_3_title'     => "Триколісний\nнавантажувач EP",
		'hero_3_text'      => 'Компактний електронавантажувач на 2 тонни для вузьких проходів складу',
		'hero_3_btn'       => 'Дізнатись детальніше',
		'hero_3_url'       => $base . '/product/elektrychnyi-trykolisnyi-navantazhuvach-ep-tdl201/',
		'hero_3_img'       => 'img:hero3.webp',
		'hero_3_mode'      => 'pic',

		// Feature tiles under the slider.
		'feat_1_title'     => 'Підібрати навантажувач',
		'feat_1_text'      => 'Зручний пошук навантажувача для будь-яких завдань',
		'feat_1_url'       => $base . '/katalog/pogruzchik/',
		'feat_2_title'     => 'Сервіс',
		'feat_2_text'      => 'Записатися на сервісне обслуговування',
		'feat_2_url'       => $base . '/servis/',
		'feat_3_title'     => 'Підбір запчастин',
		'feat_3_text'      => 'Оригінальні запчастини для техніки Heli',
		'feat_3_url'       => $base . '/katalog/zapchast/',
		'feat_4_title'     => 'Отримати консультацію',
		'feat_4_text'      => "Замовити зворотний дзвінок або зв'язатися з консультантом",
		'feat_4_url'       => '#form',

		// Catalog tiles.
		'cat_title'        => 'Каталог',
		'cat_title_em'     => 'складської техніки',
		'cat_1_title'      => 'Гідравлічні візки',
		'cat_1_url'        => $base . '/katalog/gidravlicheskie-telezhki/',
		'cat_1_img'        => 'img:cat1.jpg',
		'cat_2_title'      => 'Штабелери',
		'cat_2_url'        => $base . '/katalog/shtabeleryi/',
		'cat_2_img'        => 'img:cat2.jpg',
		'cat_3_title'      => 'Підйомні столи',
		'cat_3_url'        => $base . '/katalog/gidravlicheskie-stolyi/',
		'cat_3_img'        => 'img:cat3.jpg',
		'cat_4_title'      => 'Електричні візки',
		'cat_4_url'        => $base . '/katalog/samoxodnyie-telezhki/',
		'cat_4_img'        => 'img:cat4.jpg',
		'cat_5_title'      => 'Річтраки',
		'cat_5_url'        => $base . '/katalog/pogruzchik/',
		'cat_5_img'        => 'img:cat5.jpg',
		'cat_6_title'      => 'Навантажувачі',
		'cat_6_url'        => $base . '/katalog/pogruzchik/',
		'cat_6_img'        => 'img:cat6.jpg',
		'cat_7_title'      => 'Підйомники',
		'cat_7_url'        => $base . '/katalog/podemniki/',
		'cat_7_img'        => 'img:cat7.jpg',
		'cat_8_title'      => 'Запчастини',
		'cat_8_url'        => $base . '/katalog/zapchast/',
		'cat_8_img'        => 'img:cat8.jpg',

		// Why us.
		'why_title'        => 'Чому',
		'why_title_em'     => 'СКЛАД 24',
		'why_1'            => 'СКЛАД 24 – це високотехнологічний парк, який включає машинобудівні заводи і власний науково-дослідний центр',
		'why_2'            => 'Особлива увага приділяється якості продукції, що випускається, підприємство сертифіковане за ISO9001 і ISO14001, техніка відповідає вимогам європейських стандартів',
		'why_3'            => 'Широкий асортимент дозволяє підібрати і купити складську техніку, яка підійде під всі вимоги внутрішньої логістики підприємства',
		'why_4'            => 'У 2020 році СКЛАД 24 увійшла в ТОП-7 світових виробників і її позиції ростуть з року в рік',
		'why_5'            => 'Компанія державного рівня, яка вже 30 років займає 1 місце в Китаї серед інших виробників',
		'why_6'            => 'Вантажно-розвантажувальні роботи для складу СКЛАД 24 імпортується більш ніж в 150 країн світу, в Європі відкритий офіційний дистрибуційний центр',
		'why_7'            => 'Гарантія на вилочні навантажувачі до 2 років',
		'why_8'            => 'На ринку з 1958 року, досвід виробництва перевищує 60 років',

		// Clients.
		'clients_title'    => 'НАШІ ПОСТІЙНІ КЛІЄНТИ',
		'client_1_img'     => 'img:logo1.jpg',
		'client_1_alt'     => 'АТБ',
		'client_2_img'     => 'img:logo2.jpg',
		'client_2_alt'     => 'Comfy',
		'client_3_img'     => 'img:logo3.jpg',
		'client_3_alt'     => 'Дарниця',
		'client_4_img'     => 'img:logo4.jpg',
		'client_4_alt'     => 'Епіцентр',
		'client_5_img'     => 'img:logo5.jpg',
		'client_5_alt'     => 'Галичина',

		// Service + form.
		'svc_title'        => 'Сервісне обслуговування',
		'svc_img'          => 'img:service.jpg',
		'svc_url'          => $base . '/servis/',
		'svc_text'         => "Для нашої компанії продаж складської техніки не закінчується на етапі реалізації. В рамках підприємства діє окремий виробничий підрозділ, метою якого є гарантійна підтримка, технічне обслуговування і, при необхідності, ремонт складської техніки Heli. Фахівці сервісної служби пройшли необхідне навчання сервісного обслуговування навантажувачів Heli, що підтверджується сертифікатом виробника. Будучи ексклюзивним дилером тільки компанія <b>«СКЛАД24»</b> має авторизоване право займатися просуванням, продажем і сервісним обслуговуванням складської техніки Heli на території України.\n\nКупівля навантажувачів у офіційного дилера – запорука успішних інвестицій в ефективність складу і впевненість в подальшому професійному сервісному супроводі.",
		'form_title'       => 'Задайте Ваше питання',
		'form_lead'        => "Заповніть дані і наш менеджер зв'яжеться з вами",
		'form_ok'          => "Дякуємо! Менеджер зв'яжеться з вами найближчим часом.",

		// Numbers.
		'nums_title'       => 'SKLAD',
		'nums_title_em'    => '24',
		'nums_title_after' => 'у цифрах',
		'num_1_value'      => '5',
		'num_1_label'      => "Сервісних центрів\nв Україні",
		'num_2_value'      => '1000+',
		'num_2_label'      => "Моделей\nскладської техніки",
		'num_3_value'      => '24/7',
		'num_3_label'      => "Прийом\nонлайн-замовлень",
		'num_4_value'      => '100%',
		'num_4_label'      => "Орієнтація\nна клієнта",
		'num_5_value'      => '12',
		'num_5_label'      => "Місяців\nгарантії",

		// Section titles.
		'news_title'       => 'Новинки техніки HELI',
		'reviews_title'    => 'ОТЗЫВЫ НАШИХ КЛИЕНТОВ',
		'faq_title'        => 'Часті запитання',
		'faq_sub'          => 'Короткі відповіді перед заявкою — щоб швидше обрати роклу чи штабелер.',
		'faq_ask'          => 'Не знайшли відповідь? Напишіть нам →',

		// Contacts / map.
		'contacts_title'   => 'Контакти',
		'cities'           => "Запоріжжя | (095) 69-45-076 | ТОВ Зевс вилочні навантажувачі, Східна вулиця, 9, Запоріжжя\nКиїв | (095) 69-45-076 | Київ\nДніпро | (095) 69-45-076 | Дніпро\nОдеса | (095) 69-45-076 | Одеса\nЛьвів | (095) 69-45-076 | Львів\nХарків | (095) 69-45-076 | Харків\nВінниця | (095) 69-45-076 | Вінниця",

		// Footer.
		'footer_text'      => "Рокли, штабелери, навантажувачі\nта підйомники з прайсом і сервісом\nпо Україні.",
		'footer_copy'      => '© {year} Sklad24',
		'price_url'        => $base . '/contact/',
		'soc_facebook'     => '#',
		'soc_youtube'      => '#',
		'soc_instagram'    => '#',
		'soc_linkedin'     => '#',
	);
	return $d;
}

/**
 * Default menus: location => list of [title, url].
 */
function s24_default_menus() {
	$base = 'https://sklad24.com.ua';
	$cat  = array(
		array( 'Рокли', $base . '/katalog/gidravlicheskie-telezhki/' ),
		array( 'Електророкли', $base . '/katalog/samoxodnyie-telezhki/' ),
		array( 'Штабелери', $base . '/katalog/shtabeleryi/' ),
		array( 'Гідравлічні столи', $base . '/katalog/gidravlicheskie-stolyi/' ),
		array( 'Навантажувачі', $base . '/katalog/pogruzchik/' ),
		array( 'Підйомники', $base . '/katalog/podemniki/' ),
		array( 'Запчастини', $base . '/katalog/zapchast/' ),
	);
	return array(
		'top'     => array(
			array( 'Про нас', $base . '/about/' ),
			array( 'Сервіс', $base . '/servis/' ),
			array( 'Блог', $base . '/blog/' ),
			array( 'Контакти', '#contacts' ),
		),
		'catalog' => $cat,
		'footer'  => array(
			$cat[0],
			$cat[2],
			$cat[5],
			$cat[6],
			array( 'Електро рокли', $base . '/katalog/samoxodnyie-telezhki/' ),
			$cat[4],
			$cat[3],
		),
		'legal'   => array(
			array( 'Оплата і доставка', '#' ),
			array( 'Політика повернення', '#' ),
			array( 'Політика конфіденційності', '#' ),
		),
	);
}
