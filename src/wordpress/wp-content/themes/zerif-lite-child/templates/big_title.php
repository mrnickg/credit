<div class="home-header-wrap">

	<?php

	$zerif_parallax_img1 = get_theme_mod('zerif_parallax_img1',get_template_directory_uri() . '/images/background1.jpg');
	$zerif_parallax_img2 = get_theme_mod('zerif_parallax_img2',get_template_directory_uri() . '/images/background2.png');
	$zerif_parallax_use = get_theme_mod('zerif_parallax_show');

	if ( $zerif_parallax_use == 1 && (!empty($zerif_parallax_img1) || !empty($zerif_parallax_img2)) ) {
		echo '<ul id="parallax_move">';
		if( !empty($zerif_parallax_img1) ) {
			echo '<li class="layer layer1" data-depth="0.10" style="background-image: url(' . $zerif_parallax_img1 . ');"></li>';
		}
		if( !empty($zerif_parallax_img2) ) {
			echo '<li class="layer layer2" data-depth="0.20" style="background-image: url(' . $zerif_parallax_img2 . ');"></li>';
		}

		echo '</ul>';
	}

	?>

	<div class="header-content-wrap">

	<div class="container">

	<h1 class="main-title white"><?php echo apply_filters('page_main_title', __('Welcome to TAS', 'tas')); ?></h1>
	<h2 class="sub-title white"><?php echo apply_filters('page_sub_title', __('Credit Assessment for Estate Agents, Landlords and Mortgage Lenders', 'tas')); ?></h2>

	<?php
		if (apply_filters('page_show_nav_buttons', true)) {
			?>

				<div class="buttons">

					<a href="#briefagent" class="btn custom-button tas-orange-btn btn-agent"><?php _e('ESTATE AGENTS & LANDLORDS', 'tas'); ?></a>
					<a href="#brieflender" class="btn custom-button tas-yellow-btn btn-lender"><?php _e('MORTGAGE LENDERS', 'tas'); ?></a>
					<a href="#brieftenant" class="btn custom-button tas-blue-btn btn-tenant"><?php _e('TENANTS', 'tas'); ?></a>

				</div>

			<?php
		}
	?>


	<div class="clear">

</div>