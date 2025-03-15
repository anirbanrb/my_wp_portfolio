<?php

/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package AB_Portfolio
 */

?>

<div class="left-sidebar">
	<div class="sidebar-header d-flex align-items-center justify-content-between">
		<img src="<?php bloginfo('template_directory'); ?>/assets/images/logo.png" alt="Logo" />
		<span class="designation">Framer Designer & Developer</span>
	</div>
	<img class="me" src="<?php bloginfo('template_directory'); ?>/assets/images/me.jpg" alt="Me" />
	<h2 class="email">hello@drake.design</h2>
	<h2 class="address">Base in Los Angeles, CA</h2>
	<p class="copyright">&copy; <?php echo date('Y'); ?> Drake. All Rights Reserved</p>

	<ul class="social-profile d-flex align-items-center flex-wrap justify-content-center">
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
	<a href="#" class="modern-btn">
		<i class="las la-envelope"></i> Hire Me!
	</a>
</div>