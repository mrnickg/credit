<?php

get_header();

get_template_part( 'templates/big_title' );

?>
</header>

<div id="content" class="site-content">

	<?php

	get_template_part('templates/agent/use-cases');

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
	endif; ?>

	</div>

	<?php
	get_footer();
	?>
