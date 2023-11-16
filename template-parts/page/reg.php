<div class="auth-page">
        <div class="auth-page__warning"></div>
    <div class="auth-page__brand">
        <div class="auth-page__brand__title"><?php esc_html_e( 'HELLO', 'hello' ); ?></div>
        <div class="auth-page__brand__description">
            <?php esc_html_e( 'AI Copilot for Hiring', 'hello' ); ?>
        </div>
    </div>
    <div class="auth-page__form">
        <div class="auth-page__form__title"><?php _e( 'Registration<br>account', 'hello' ); ?></div>

        <form name="regform" id="regform" class="auth-page__form__form">
            <div class="form-item">
				<label for="user_name"><?php esc_html_e( 'First and last name:', 'hello' ); ?></label>
				<input type="text" name="user_name" id="user_name" required autocomplete="off"/>
			</div>

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
                <button name="reg-submit" id="reg-submit"><?php esc_html_e( 'Sign up', 'hello' ); ?></button>
                <a href="/auth"><?php esc_html_e( 'Sign in', 'hello' ); ?></a>
            </div>
		</form>

    </div>
</div>
