<div class="dashboard">
    <?php get_template_part( 'template-parts/page/aside-page' ); ?>

    <article class="dashboard__article add-position">
        <div class="add-candidate__content">
            <div class="add-candidate__content__form">
                <div class="add-candidate__content__form-title"><?php esc_html_e( 'Add a new position', 'hello' ); ?></div>

                <div class="add-candidate__content__form-items">
                    <div class="add-candidate__content__form-items__item forms">
                        <div class="forms__item">
                            <div class="forms__item-title"><?php esc_html_e( 'Basic information', 'hello' ); ?></div>
                            <!-- <div class="forms__item-item">
                                <label for="parameter"><?php //esc_html_e( 'Основной параметр запроса', 'hello' ); ?> <span class="color-red">*</span></label>
                                <input id="parameter" type="text" name="parameter" value="">
                            </div> -->

                            <div class="forms__item-item">
                                <label for="name"><?php esc_html_e( 'Job Title', 'hello' ); ?> <span class="color-red">*</span></label>
                                <input id="name" type="text" name="name" value="">
                            </div>
                            <div class="forms__item-item">
                                <label for="candidates_position"><?php esc_html_e( 'Position', 'hello' ); ?></label>
                                <div class="forms__item-item__select">
                                    <span class="forms__item-item__select__text"></span>
                                    <span class="forms__item-item__select__icon">
                                        <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <g clip-path="url(#clip0_1_159)">
                                            <path d="M2.58954 3.80523C2.83455 3.68273 3.13045 3.73075 3.32415 3.92444L5.2927 5.89299C5.68322 6.28351 6.31639 6.28351 6.70691 5.89299L8.67546 3.92444C8.86916 3.73075 9.16506 3.68273 9.41007 3.80523C9.79859 3.99949 9.88261 4.51729 9.57546 4.82444L6.70691 7.69299C6.31639 8.08351 5.68322 8.08351 5.2927 7.69299L2.42415 4.82444C2.117 4.51729 2.20102 3.99949 2.58954 3.80523Z" fill="#EEEEEE"/>
                                            </g>
                                            <defs>
                                            <clipPath id="clip0_1_159">
                                            <rect width="12" height="12" fill="white"/>
                                            </clipPath>
                                            </defs>
                                        </svg>
                                    </span>
                                    <div class="options-items">
                                        <span><?php esc_html_e( 'Java', 'hello' ); ?></span>
                                        <span><?php esc_html_e( 'Python', 'hello' ); ?></span>
                                        <span><?php esc_html_e( 'Javascript', 'hello' ); ?></span>
                                        <span><?php esc_html_e( 'PHP', 'hello' ); ?></span>
                                        <span><?php esc_html_e( 'Go', 'hello' ); ?></span>
                                        <span><?php esc_html_e( 'Product Manager', 'hello' ); ?></span>
                                        <span><?php esc_html_e( 'Engineering Manager', 'hello' ); ?></span>
                                        <span><?php esc_html_e( 'QA Engineer', 'hello' ); ?></span>
                                    </div>
                                    <input id="candidates_position" type="hidden" name="candidates_position" value="">
                                </div>
                            </div>
                            <div class="forms__item-item">
                                <label for="level"><?php esc_html_e( 'Level', 'hello' ); ?></label>
                                <div class="forms__item-item__select">
                                    <span class="forms__item-item__select__text"></span>
                                    <span class="forms__item-item__select__icon">
                                        <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <g clip-path="url(#clip0_1_159)">
                                            <path d="M2.58954 3.80523C2.83455 3.68273 3.13045 3.73075 3.32415 3.92444L5.2927 5.89299C5.68322 6.28351 6.31639 6.28351 6.70691 5.89299L8.67546 3.92444C8.86916 3.73075 9.16506 3.68273 9.41007 3.80523C9.79859 3.99949 9.88261 4.51729 9.57546 4.82444L6.70691 7.69299C6.31639 8.08351 5.68322 8.08351 5.2927 7.69299L2.42415 4.82444C2.117 4.51729 2.20102 3.99949 2.58954 3.80523Z" fill="#EEEEEE"/>
                                            </g>
                                            <defs>
                                            <clipPath id="clip0_1_159">
                                            <rect width="12" height="12" fill="white"/>
                                            </clipPath>
                                            </defs>
                                        </svg>
                                    </span>
                                    <div class="options-items">
                                        <span><?php esc_html_e( 'Associate', 'hello' ); ?></span>
                                        <span><?php esc_html_e( 'Junior', 'hello' ); ?></span>
                                        <span><?php esc_html_e( 'Middle', 'hello' ); ?></span>
                                        <span><?php esc_html_e( 'Senior', 'hello' ); ?></span>
                                        <span><?php esc_html_e( 'Principal', 'hello' ); ?></span>
                                    </div>
                                    <input id="level" type="hidden" name="level" value="">
                                </div>
                            </div>
                            <div class="forms__item-item">
                                <label for="key_words"><?php esc_html_e( 'Key Words', 'hello' ); ?></label>
                                <input id="key_words" type="text" name="key_words" value="">
                            </div>

                            <div class="forms__item-item">
                                <label for="about_company"><?php esc_html_e( 'About the Company', 'hello' ); ?></label>
                                <input id="about_company" type="text" name="about_company" value="">
                            </div>
                            <div class="forms__item-item">
                                <label for="offer"><?php esc_html_e( 'What We Offer', 'hello' ); ?></label>
                                <input id="offer" type="text" name="offer" value="">
                            </div>
                            <div class="forms__item-item">
                                <label for="additional_info"><?php esc_html_e( 'Additional Info', 'hello' ); ?></label>
                                <input id="additional_info" type="text" name="additional_info" value="">
                            </div>
                        </div>
                        <div class="forms__item"></div>
                        <div class="forms__item"></div>
                    </div>
                    <div class="add-candidate__content__form-items__item questions active">
                        <div class="questions__block-form position">
                            <div class="questions__block-form__title"><?php esc_html_e( 'Open Position', 'hello' ); ?></div>
                            <div class="questions__block-form__content">
                                <span class="questions__block-form__content-title"><?php esc_html_e( 'Open Position:', 'hello' ); ?></span>
                                <!-- <span class="questions__block-form__content-text to-copy"></span> -->
                                <textarea id="position_text" class="questions__block-form__content-text to-copy" name="position_text" rows="14" cols="80"></textarea>
                            </div>
                            <div class="questions__block-form__button">
                                <button id="generate-position" type="button" name="button"><?php esc_html_e( 'Generate', 'hello' ); ?></button>
                                <button id="copy-position" type="button" name="button"><?php esc_html_e( 'Copy', 'hello' ); ?></button>
                            </div>
                        </div>
                        <div id="js-loader" class="loader-wrapper no-active">
            				<div class="loader"><?php esc_html_e( 'loading', 'hello' ); ?></div>
            			</div>
                    </div>
                    <!-- <div class="add-candidate__content__form-items__item answers">
                        <div class="questions__brancher">
                            <div class="questions__brancher__title"><?php //esc_html_e( 'Evaluation of responses', 'hello' ); ?></div>
                            <button id="questions-brancher-btn" type="button" name="button"><?php esc_html_e( 'Add', 'hello' ); ?></button>
                        </div>
                        <div class="questions__block-form">
                            <div class="questions__block-form__title"><?php //esc_html_e( 'Evaluation of responses', 'hello' ); ?></div>
                            <div class="questions__block-form__content">
                                <span class="questions__block-form__content-title"><?php //esc_html_e( 'Candidate Responses:', 'hello' ); ?></span>
                                <textarea id="answer" class="questions__block-form__content-text" name="answer" rows="4" cols="80"></textarea>
                                <span class="answer-count-label"><?php //esc_html_e( 'Number of characters:', 'hello' ); ?> <span id="answer-count">0</span></span>
                            </div>
                            <div class="questions__block-form__button">
                                <button id="grade-questions" type="button" name="button"><?php //esc_html_e( 'Send for evaluation', 'hello' ); ?></button>
                            </div>
                        </div>
                        <div id="js-loader" class="loader-wrapper no-active">
            				<div class="loader"><?php //esc_html_e( 'loading', 'hello' ); ?></div>
            			</div>
                    </div> -->

                    <!-- <div class="add-candidate__content__form-items__item result">
                        <div class="result__content">
                            <div class="result__content__title"><?php //esc_html_e( 'Result', 'hello' ); ?></div>
                            <div id="result" class="result__content__res"></div>
                        </div>
                    </div>

                    <div class="add-candidate__content__form-items__item dop-info">
                        <div class="dop-info__content">
                            <div class="dop-info__content__title"><?php //_e( 'Additional<br>information', 'hello' ); ?></div>
                            <div id="dop-info" class="dop-info__content__res"></div>
                        </div>
                    </div> -->
                </div>

                <div class="add-candidate__content__form__buttons">
                    <div class="field-group field-checkbox">
                        <input class="field-checkbox__input" type="checkbox" name="refusals_auto" id="refusals_auto" value="yes" />
                        <label for="refusals_auto" class="field-checkbox__label">
                            <span class="field-checkbox__label__icon icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M20 6L9 17L4 12" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </span>
                            <span class="field-checkbox__label__text text">Send refusals automatically</span>
                        </label>
                    </div>
                    <div class="field-group field-checkbox">
                        <input class="field-checkbox__input" type="checkbox" name="paid_response" id="paid_response" value="yes" />
                        <label for="paid_response" class="field-checkbox__label">
                            <span class="field-checkbox__label__icon icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M20 6L9 17L4 12" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </span>
                            <span class="field-checkbox__label__text text">Paid response</span>
                        </label>
                    </div>
                    <button type="button" name="button" onclick="window.location='/manage-positions'"><?php esc_html_e( 'Cancel', 'hello' ); ?></button>
                    <button id="add-position-submit" type="button" name="button"><?php esc_html_e( 'Save', 'hello' ); ?></button>
                </div>

            </div>
        </div>

    </article>
    <div class="dashboard__warning"></div>
</div>
