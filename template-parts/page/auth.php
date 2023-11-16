<div class="auth-page">
    <?php if ( $_REQUEST ) {
        if ( $_REQUEST['login'] == 'failed' ) {
    ?>
        <div class="auth-page__warning"><?php esc_html_e( 'You have entered an incorrect username or password', 'hello' ); ?></div>
    <?php } } ?>
    <div class="auth-page__brand">
        <div class="auth-page__brand__title"><?php esc_html_e( 'HELLO', 'hello' ); ?></div>
        <div class="auth-page__brand__description">
            <?php esc_html_e( 'AI Copilot for Hiring', 'hello' ); ?>
        </div>
    </div>
    <div class="auth-page__form">
        <div class="auth-page__form__title"><?php esc_html_e( 'Login', 'hello' ); ?></div>

        <form name="loginform" id="loginform" action="/wp-login.php" method="post"  class="auth-page__form__form">
			<div class="form-item">
				<label for="user_login"><?php esc_html_e( 'Email:', 'hello' ); ?></label>
				<input type="text" name="log" id="user_login" required autocomplete="off"/>
			</div>

			<div class="form-item">
				<label for="user_pass"><?php esc_html_e( 'Password:', 'hello' ); ?></label>
				<input type="password" name="pwd" id="user_pass" required autocomplete="new-password"/>
			</div>

            <!-- <div class="checkbox">
  				<input type="checkbox" name="rememberme" id="rememberme" value="forever"/>
  				<label for="rememberme"><span class="checkbox-icon"></span> Запомнить меня</label>
  			</div> -->

            <!-- <div class="input-with-icon-left">
  				<a href="/forgot-password" class="forgot-password">Забыли пароль?</a>
            </div> -->

            <div class="form-button">
                <a href="/reg"><?php esc_html_e( 'Sign up', 'hello' ); ?></a>
                <!-- <button type="submit" form="loginform" name="wp-submit" id="wp-submit" disabled>Зарегистрироваться</button> -->
                <button type="submit" form="loginform" name="wp-submit" id="wp-submit"><?php esc_html_e( 'Sign in', 'hello' ); ?></button>
            </div>
		</form>

    </div>
</div>
