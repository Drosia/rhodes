<?php
/**
 * The Header for our theme.
 */
?>
<!doctype html>
<html class="no-js" <?php language_attributes(); ?>>

	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="apple-touch-icon" href="icon.png">
		<!-- Place favicon.ico in the root directory -->

		<meta name="theme-color" content="#fafafa">
		<?php wp_head(); ?>
	</head>

	<body <?php body_class(); ?>>
		<!--[if IE]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
		<![endif]-->

		<div id="app">
		<header class="header">
				<div class="container container--header">
					<?php 
						$email = get_field( 'email', 'options' );
						$telephone = get_field( 'telephone', 'options' );
					?>
					<?php if ( $email || $telephone ) : ?>
						<div class="header__top">
							<?php if ( $email ) : ?>
								<a href="<?= $email['url'] ?>"> <?= $email['title'] ?> </a>
							<?php endif; ?>
							<?php if ( $telephone ) : ?>
								<a href="<?= $telephone['url'] ?>"> <?= $telephone['title'] ?> </a>
							<?php endif; ?>
						</div>
					<?php endif; ?>
					<div class="header-row">
						<div class="header__left">
							<a href="<?php echo home_url(); ?>" class="header-logo">
								<?php $website_logo = get_field( 'logo', 'options' );?>
								<img src="<?php echo $website_logo; ?>" alt="website logo" width="162" height="60">
							</a>
							<div class="menu-toggle jsMenuToggle">
								<div class="menu-toggle__wrapper">
									<div class="line line--top"></div>
									<div class="line line--mid"></div>
									<div class="line line--bottom"></div>
								</div>
							</div>
						</div>
						<div class="header__center">
							<div class="header-nav-menu jsHeaderMenuSimple">
								<?php
								wp_nav_menu(array(
									'theme_location' => 'primary', // Replace with the name of your menu location
									'menu_id' => 'primary-menu',   // Add an ID for your menu
									'container' => 'nav',          // Wrap the menu in a <nav> element
									'container_class' => 'menu-class', // Add a CSS class to the <nav> element
									'menu_class' => 'menu-list menu-list--simple',   // Add a CSS class to the <ul> element
								));
								?>
								<div class="btn btn--200">
									<span>BOOK A CRUISE</span>
								</div>
							</div><!-- /.header-menu-wrapper -->
						</div>
						<div class="header__right">
							<div class="btn btn--icon-white">
								<span>BOOK A CRUISE</span>
							</div>
						</div>
					</div>
				</div>
			</header>
