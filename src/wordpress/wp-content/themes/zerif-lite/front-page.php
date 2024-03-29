<?php get_header();

if ( get_option( 'show_on_front' ) == 'page' ) {
?>
<div class="clear"></div>

</header> <!-- / END HOME SECTION  -->

<div id="content" class="site-content">

	<div class="container">

		<div class="content-left-wrap col-md-9">

			<div id="primary" class="content-area">

				<main id="main" class="site-main" role="main">

					<?php if ( have_posts() ) :

						while ( have_posts() ) : the_post();

							/* Include the Post-Format-specific template for the content.
							 * If you want to override this in a child theme, then include a file
							 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
							 */

							get_template_part( 'content', get_post_format() );

						endwhile;

						zerif_paging_nav();

					else :

						get_template_part( 'content', 'none' );

					endif; ?>

				</main><!-- #main -->

			</div><!-- #primary -->

		</div><!-- .content-left-wrap -->

		<div class="sidebar-wrap col-md-3 content-left-wrap">

			<?php get_sidebar(); ?>

		</div><!-- .sidebar-wrap -->

	</div><!-- .container -->
	<?php
	}else {

	if(isset($_POST['submitted']) && !defined('PIRATE_FORMS_VERSION') && !shortcode_exists( 'pirate_forms' ) ) :

		/* recaptcha */

		$zerif_contactus_sitekey = get_theme_mod('zerif_contactus_sitekey');

		$zerif_contactus_secretkey = get_theme_mod('zerif_contactus_secretkey');

		$zerif_contactus_recaptcha_show = get_theme_mod('zerif_contactus_recaptcha_show');

		if( isset($zerif_contactus_recaptcha_show) && $zerif_contactus_recaptcha_show != 1 && !empty($zerif_contactus_sitekey) && !empty($zerif_contactus_secretkey) ) :

			$captcha;

			if( isset($_POST['g-recaptcha-response']) ){

				$captcha=$_POST['g-recaptcha-response'];

			}

			if( !$captcha ){

				$hasError = true;

			}

			$response = wp_remote_get( "https://www.google.com/recaptcha/api/siteverify?secret=".$zerif_contactus_secretkey."&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR'] );

			if($response['body'].success==false) {

				$hasError = true;

			}

		endif;

		/* name */

		if(trim($_POST['myname']) === ''):

			$nameError = __('* Please enter your name.','zerif-lite');

			$hasError = true;

		else:

			$name = trim($_POST['myname']);

		endif;

		/* email */

		if(trim($_POST['myemail']) === ''):

			$emailError = __('* Please enter your email address.','zerif-lite');

			$hasError = true;

		elseif (!preg_match("/^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$/i", trim($_POST['myemail']))) :

			$emailError = __('* You entered an invalid email address.','zerif-lite');

			$hasError = true;

		else:

			$email = trim($_POST['myemail']);

		endif;

		/* subject */

		if(trim($_POST['mysubject']) === ''):

			$subjectError = __('* Please enter a subject.','zerif-lite');

			$hasError = true;

		else:

			$subject = trim($_POST['mysubject']);

		endif;

		/* message */

		if(trim($_POST['mymessage']) === ''):

			$messageError = __('* Please enter a message.','zerif-lite');

			$hasError = true;

		else:

			$message = stripslashes(trim($_POST['mymessage']));

		endif;

		/* send the email */

		if(!isset($hasError)):

			$zerif_contactus_email = get_theme_mod('zerif_contactus_email');

			if( empty($zerif_contactus_email) ):

				$emailTo = get_theme_mod('zerif_email');

			else:

				$emailTo = $zerif_contactus_email;

			endif;

			if(isset($emailTo) && $emailTo != ""):

				if( empty($subject) ):
					$subject = 'From '.$name;
				endif;

				$body = "Name: $name \n\nEmail: $email \n\n Subject: $subject \n\n Message: $message";

				/* FIXED HEADERS FOR EMAIL NOT GOING TO SPAM */
				$zerif_admin_email = get_option( 'admin_email' );
				$zerif_sitename = strtolower( $_SERVER['SERVER_NAME'] );

				function zerif_is_localhost() {
					$zerif_server_name = strtolower( $_SERVER['SERVER_NAME'] );
					return in_array( $zerif_server_name, array( 'localhost', '127.0.0.1' ) );
				}

				if ( zerif_is_localhost() ) {

					$headers = 'From: '.$name.' <'.$zerif_admin_email.'>' . "\r\n" . 'Reply-To: ' . $email;

				} else {

					if ( substr( $zerif_sitename, 0, 4 ) == 'www.' ) {
						$zerif_sitename = substr( $zerif_sitename, 4 );
					}

					$headers = 'From: '.$name.' <wordpress@'.$zerif_sitename.'>' . "\r\n" . 'Reply-To: ' . $email;

				}

				wp_mail($emailTo, $subject, $body, $headers);

				$emailSent = true;

			else:

				$emailSent = false;

			endif;

		endif;

	endif;

	$zerif_bigtitle_show = get_theme_mod('zerif_bigtitle_show');

	if( isset($zerif_bigtitle_show) && $zerif_bigtitle_show != 1 ):

		get_template_part( 'templates/big_title' );

	endif;

	?>

	</header> <!-- / END HOME SECTION  -->

	<div id="content" class="site-content">

		<?php

		get_template_part( '/templates/agent/brief');

		//get_template_part( '/sections/use_case_intro');

		get_template_part('/templates/agent/how_it_works');

		//get_template_part( '/sections/product_intro');

		/* OUR FOCUS SECTION */

		$zerif_ourfocus_show = get_theme_mod('zerif_ourfocus_show');

		if( isset($zerif_ourfocus_show) && $zerif_ourfocus_show != 1 ):

			get_template_part( 'sections/our_focus' );

		endif;

		get_template_part( 'templates/agent//measures' );

		get_template_part( 'templates/agent/product_intro');

		/* RIBBON WITH BOTTOM BUTTON */

		get_template_part( 'sections/ribbon_with_bottom_button' );

		/* ABOUT US */

		$zerif_aboutus_show = get_theme_mod('zerif_aboutus_show');

		if( isset($zerif_aboutus_show) && $zerif_aboutus_show != 1 ):

			get_template_part( 'sections/about_us' );

		endif;

		/* OUR TEAM */

		$zerif_ourteam_show = get_theme_mod('zerif_ourteam_show');

		if( isset($zerif_ourteam_show) && $zerif_ourteam_show != 1 ):

			get_template_part( 'sections/our_team' );

		endif;

		/* TESTIMONIALS */

		$zerif_testimonials_show = get_theme_mod('zerif_testimonials_show');

		if( isset($zerif_testimonials_show) && $zerif_testimonials_show != 1 ):

			get_template_part( 'sections/testimonials' );

		endif;

		/* RIBBON WITH RIGHT SIDE BUTTON */

		get_template_part( 'sections/ribbon_with_right_button' );

		/* LATEST NEWS */
		$zerif_latestnews_show = get_theme_mod('zerif_latestnews_show');

		if( isset($zerif_latestnews_show) && $zerif_latestnews_show != 1 ):

			get_template_part( 'sections/latest_news' );

		endif;

		/* CONTACT US */
		$zerif_contactus_show = get_theme_mod('zerif_contactus_show');

		if( isset($zerif_contactus_show) && $zerif_contactus_show != 1 ):
			?>
			<section class="contact-us" id="contact">
				<div class="container">
					<!-- SECTION HEADER -->
					<div class="section-header">

						<?php

						$zerif_contactus_title = get_theme_mod('zerif_contactus_title',__('Get in touch','zerif-lite'));
						if ( !empty($zerif_contactus_title) ):
							echo '<h2 class="white-text">'.$zerif_contactus_title.'</h2>';
						endif;

						$zerif_contactus_subtitle = get_theme_mod('zerif_contactus_subtitle');
						if(isset($zerif_contactus_subtitle) && $zerif_contactus_subtitle != ""):
							echo '<div class="white-text section-legend">'.$zerif_contactus_subtitle.'</div>';
						endif;
						?>
					</div>
					<!-- / END SECTION HEADER -->

					<?php
					if ( defined('PIRATE_FORMS_VERSION') && shortcode_exists( 'pirate_forms' ) ):

						echo '<div class="row">';
						echo do_shortcode('[pirate_forms]');
						echo '</div>';

					else:
						?>
						<!-- CONTACT FORM-->
						<div class="row">

							<?php

							if(isset($emailSent) && $emailSent == true) :

								echo '<div class="notification success"><p>'.__('Thanks, your email was sent successfully!','zerif-lite').'</p></div>';

							elseif(isset($_POST['submitted'])):

								echo '<div class="notification error"><p>'.__('Sorry, an error occured.','zerif-lite').'</p></div>';

							endif;

							if(isset($nameError) && $nameError != '') :

								echo '<div class="notification error"><p>'.esc_html($nameError).'</p></div>';

							endif;

							if(isset($emailError) && $emailError != '') :

								echo '<div class="notification error"><p>'.esc_html($emailError).'</p></div>';

							endif;

							if(isset($subjectError) && $subjectError != '') :

								echo '<div class="notification error"><p>'.esc_html($subjectError).'</p></div>';

							endif;

							if(isset($messageError) && $messageError != '') :

								echo '<div class="notification error"><p>'.esc_html($messageError).'</p></div>';

							endif;

							?>

							<form role="form" method="POST" action="" onSubmit="this.scrollPosition.value=(document.body.scrollTop || document.documentElement.scrollTop)" class="contact-form">

								<input type="hidden" name="scrollPosition">

								<input type="hidden" name="submitted" id="submitted" value="true" />

								<div class="col-lg-4 col-sm-4 zerif-rtl-contact-name" data-scrollreveal="enter left after 0s over 1s">
									<label for="myname" class="screen-reader-text"><?php _e( 'Your Name', 'zerif-lite' ); ?></label>
									<input required="required" type="text" name="myname" id="myname" placeholder="<?php _e('Your Name','zerif-lite'); ?>" class="form-control input-box" value="<?php if(isset($_POST['myname'])) echo esc_attr($_POST['myname']);?>">
								</div>

								<div class="col-lg-4 col-sm-4 zerif-rtl-contact-email" data-scrollreveal="enter left after 0s over 1s">
									<label for="myemail" class="screen-reader-text"><?php _e( 'Your Email', 'zerif-lite' ); ?></label>
									<input required="required" type="email" name="myemail" id="myemail" placeholder="<?php _e('Your Email','zerif-lite'); ?>" class="form-control input-box" value="<?php if(isset($_POST['myemail'])) echo is_email($_POST['myemail']) ? $_POST['myemail'] : ""; ?>">
								</div>

								<div class="col-lg-4 col-sm-4 zerif-rtl-contact-subject" data-scrollreveal="enter left after 0s over 1s">
									<label for="mysubject" class="screen-reader-text"><?php _e( 'Subject', 'zerif-lite' ); ?></label>
									<input required="required" type="text" name="mysubject" id="mysubject" placeholder="<?php _e('Subject','zerif-lite'); ?>" class="form-control input-box" value="<?php if(isset($_POST['mysubject'])) echo esc_attr($_POST['mysubject']);?>">
								</div>

								<div class="col-lg-12 col-sm-12" data-scrollreveal="enter right after 0s over 1s">
									<label for="mymessage" class="screen-reader-text"><?php _e( 'Your Message', 'zerif-lite' ); ?></label>
									<textarea name="mymessage" id="mymessage" class="form-control textarea-box" placeholder="<?php _e('Your Message','zerif-lite'); ?>"><?php if(isset($_POST['mymessage'])) { echo esc_html($_POST['mymessage']); } ?></textarea>
								</div>

								<?php
								$zerif_contactus_button_label = get_theme_mod('zerif_contactus_button_label',__('Send Message','zerif-lite'));
								if( !empty($zerif_contactus_button_label) ):
									echo '<button class="btn btn-primary custom-button red-btn" type="submit" data-scrollreveal="enter left after 0s over 1s">'.$zerif_contactus_button_label.'</button>';
								endif;
								?>

								<?php

								$zerif_contactus_sitekey = get_theme_mod('zerif_contactus_sitekey');
								$zerif_contactus_secretkey = get_theme_mod('zerif_contactus_secretkey');
								$zerif_contactus_recaptcha_show = get_theme_mod('zerif_contactus_recaptcha_show');

								if( isset($zerif_contactus_recaptcha_show) && $zerif_contactus_recaptcha_show != 1 && !empty($zerif_contactus_sitekey) && !empty($zerif_contactus_secretkey) ) :

									echo '<div class="g-recaptcha zerif-g-recaptcha" data-sitekey="' . $zerif_contactus_sitekey . '"></div>';

								endif;

								?>

							</form>

						</div>

						<!-- / END CONTACT FORM-->
						<?php
					endif;
					?>

				</div> <!-- / END CONTAINER -->

			</section> <!-- / END CONTACT US SECTION-->
			<?php
		endif;

		}
		get_footer(); ?>
