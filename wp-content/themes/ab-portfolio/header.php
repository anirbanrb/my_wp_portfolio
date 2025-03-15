<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package AB_Portfolio
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<title>
		<?php if (is_front_page() && is_home()) :
			bloginfo('name');
		else :
			wp_title('');
			echo ' | ';
			bloginfo('name');
		endif; ?>
	</title>
	<link rel="icon" type="image/x-icon" href="<?php bloginfo('template_directory'); ?>/assets/images/favicon.png" />

	<!-- Font -->
	<link rel="preconnect" href="https://fonts.googleapis.com/" />
	<link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin />

	<?php wp_head(); ?>
</head>

<body class="home5-page" <?php body_class(); ?>>
	<?php wp_body_open(); ?>

	<video class="body-overlay" muted="" autoplay="" loop="">
		<source src="<?php bloginfo('template_directory'); ?>/assets/images/video5.mp4" type="video/mp4">
	</video>

	<!-- <div class="page-loader">
			<div class="bounceball"></div>
		</div> -->

	<span class="icon-menu">
		<span class="bar"></span>
		<span class="bar"></span>
	</span>

	<div class="responsive-sidebar-menu">
		<div class="overlay"></div>
		<div class="sidebar-menu-inner">
			<div class="menu-wrap">
				<p>Menu</p>

				<?php
				global $post;
				$locations = get_nav_menu_locations();
				$menu_id = $locations['custom-header-menu'];
				$menu_items = wp_get_nav_menu_items($menu_id);

				$menu_tree = [];
				foreach ($menu_items as $item) {

					$icon_class = get_field('menu_icons', $item->ID); // Retrieve ACF field
					$icon_class = !empty($icon_class) ? esc_attr($icon_class) : 'las la-home'; // Default icon

					if ($item->menu_item_parent == 0) {
						$menu_tree[$item->ID] = [
							'title' => $item->title,
							'url'   => $item->url,
							'icon'  => $icon_class,
							'children' => []
						];
					} else {
						$menu_tree[$item->menu_item_parent]['children'][] = [
							'title' => $item->title,
							'url'   => $item->url,
							'icon'  => $icon_class,
						];
					}
				}
				?>

				<ul class="menu scroll-nav-responsive d-flex">
					<?php foreach ($menu_tree as $menu_id => $menu) : ?>
						<li>
							<a class="scroll-to" href="<?php echo esc_url($menu['url']); ?>">
								<i class="<?php echo esc_attr($menu['icon']); ?>"></i> <span><?php echo esc_html($menu['title']); ?></span>
							</a>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>

			<div class="sidebar-social">
				<p>Social</p>
				<ul class="social-links d-flex align-items-center">
					<?php
					// Check rows exists.
					if (have_rows('social_list', 'option')) :
						// Loop through rows.
						while (have_rows('social_list', 'option')) : the_row();
							$social_link = get_sub_field('social_link');
							$social_icon = get_sub_field('social_icon_class');
					?>
							<li>
								<a href="<?php echo esc_url($social_link['url']); ?>" target="<?php echo esc_attr($social_link['target']); ?>">
									<i class="<?php echo esc_attr($social_icon); ?>"></i>
								</a>
							</li>
					<?php
						// End loop.
						endwhile;
					endif;
					?>
				</ul>
			</div>
		</div>
	</div>

	<?php
	global $post;
	$locations = get_nav_menu_locations();
	$menu_id = $locations['custom-header-menu'];
	$menu_items = wp_get_nav_menu_items($menu_id);

	$menu_tree = [];
	foreach ($menu_items as $item) {

		$icon_class = get_field('menu_icons', $item->ID); // Retrieve ACF field
		$icon_class = !empty($icon_class) ? esc_attr($icon_class) : 'las la-home'; // Default icon

		if ($item->menu_item_parent == 0) {
			$menu_tree[$item->ID] = [
				'title' => $item->title,
				'url'   => $item->url,
				'icon'  => $icon_class,
				'children' => []
			];
		} else {
			$menu_tree[$item->menu_item_parent]['children'][] = [
				'title' => $item->title,
				'url'   => $item->url,
				'icon'  => $icon_class,
			];
		}
	}
	?>

	<ul class="menu scroll-nav d-flex">
		<?php foreach ($menu_tree as $menu_id => $menu) : ?>
			<li>
				<a class="scroll-to" href="<?php echo esc_url($menu['url']); ?>">
					<span><?php echo esc_html($menu['title']); ?></span> <i class="<?php echo esc_attr($menu['icon']); ?>"></i>
				</a>
			</li>
		<?php endforeach; ?>
	</ul>

	<?php get_sidebar('me'); ?>