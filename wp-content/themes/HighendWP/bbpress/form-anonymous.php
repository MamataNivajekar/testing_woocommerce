<?php

/**
 * Anonymous User
 *
 * @package bbPress
 * @subpackage Theme
 */

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

if ( bbp_current_user_can_access_anonymous_user_form() ) : ?>

	<?php do_action( 'bbp_theme_before_anonymous_form' ); ?>

	<fieldset class="bbp-form">
		<legend><?php ( bbp_is_topic_edit() || bbp_is_reply_edit() ) ? _e( 'Author Information', 'hbthemes' ) : _e( 'Your information:', 'hbthemes' ); ?></legend>

		<?php do_action( 'bbp_theme_anonymous_form_extras_top' ); ?>

		<p>
			<label for="bbp_anonymous_author"><?php _e( 'Name (required):', 'hbthemes' ); ?></label><br />
			<input type="text" id="bbp_anonymous_author"  value="<?php bbp_author_display_name(); ?>" size="40" maxlength="100" name="bbp_anonymous_name" autocomplete="off" />
		</p>

		<p>
			<label for="bbp_anonymous_email"><?php _e( 'Mail (will not be published) (required):', 'hbthemes' ); ?></label><br />
			<input type="text" id="bbp_anonymous_email"   value="<?php bbp_author_email(); ?>" size="40" maxlength="100" name="bbp_anonymous_email" />
		</p>

		<p>
			<label for="bbp_anonymous_website"><?php _e( 'Website:', 'hbthemes' ); ?></label><br />
			<input type="text" id="bbp_anonymous_website" value="<?php bbp_author_url(); ?>" size="40" maxlength="200" name="bbp_anonymous_website" />
		</p>

		<?php do_action( 'bbp_theme_anonymous_form_extras_bottom' ); ?>

	</fieldset>

	<?php do_action( 'bbp_theme_after_anonymous_form' ); ?>

<?php endif; ?>
