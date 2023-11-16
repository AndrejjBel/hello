<?php
global $user_ID;
if ( $post->post_author == $user_ID ) { // && !current_user_can('administrator')
?>
<div class="dashboard">
    <?php get_template_part( 'template-parts/page/aside-page' ); ?>

    <article class="dashboard__article  add-position">
        <div class="add-candidate__content">
            <div class="add-candidate__content__form">
                <div class="add-candidate__content__form-title">
                    <?php //esc_html_e( 'Position card', 'hello' ); ?>
                    <span><?php the_title();?><?php echo ' #' . $post->ID;?></span>
                </div>
                <div class="add-candidate__content__form-items">
                    <div class="add-candidate__content__form-items__item forms">
                        <div class="forms__item">
                            <div class="forms__item-title"><?php esc_html_e( 'Basic information', 'hello' ); ?></div>
                            <div class="forms__item-item">
                                <label for="name"><?php esc_html_e( 'Job Title', 'hello' ); ?> <span class="color-red">*</span></label>
                                <input id="name" type="text" name="name" value="<?php the_title();?>">
                            </div>
                            <div class="forms__item-item">
                                <label for="candidates_position"><?php esc_html_e( 'Position', 'hello' ); ?></label>
                                <div class="forms__item-item__select">
                                    <span class="forms__item-item__select__text"><?php echo $post->position;?></span>
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
                                    <input id="candidates_position" type="hidden" name="candidates_position" value="<?php echo $post->position;?>">
                                </div>
                            </div>
                            <div class="forms__item-item">
                                <label for="level"><?php esc_html_e( 'Level', 'hello' ); ?></label>
                                <div class="forms__item-item__select">
                                    <span class="forms__item-item__select__text"><?php echo $post->level;?></span>
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
                                    <input id="level" type="hidden" name="level" value="<?php echo $post->level;?>">
                                </div>
                            </div>
                            <div class="forms__item-item">
                                <label for="key_words"><?php esc_html_e( 'Key Words', 'hello' ); ?></label>
                                <input id="key_words" type="text" name="key_words" value="<?php echo $post->key_words;?>">
                            </div>

                            <div class="forms__item-item">
                                <label for="about_company"><?php esc_html_e( 'About the Company', 'hello' ); ?></label>
                                <input id="about_company" type="text" name="about_company" value="<?php echo $post->about_company;?>">
                            </div>
                            <div class="forms__item-item">
                                <label for="offer"><?php esc_html_e( 'What We Offer', 'hello' ); ?></label>
                                <input id="offer" type="text" name="offer" value="<?php echo $post->offer;?>">
                            </div>
                            <div class="forms__item-item">
                                <label for="additional-info"><?php esc_html_e( 'Additional Info', 'hello' ); ?></label>
                                <input id="additional-info" type="text" name="additional-info" value="<?php echo $post->additional_info;?>">
                            </div>
                        </div>
                        <!-- <div class="forms__item"></div>
                        <div class="forms__item"></div> -->
                    </div>
                    <div class="add-candidate__content__form-items__item questions active">
                        <div class="questions__block-form position">
                            <div class="questions__block-form__title"><?php esc_html_e( 'Open Position', 'hello' ); ?></div>
                            <div class="questions__block-form__content">
                                <span class="questions__block-form__content-title"><?php esc_html_e( 'Open Position:', 'hello' ); ?></span>
                                <!-- <span class="questions__block-form__content-text to-copy"></span> -->
                                <textarea id="position_text" class="questions__block-form__content-text to-copy" name="position_text" rows="14" cols="80"><?php echo $post->open_position;?></textarea>
                            </div>
                            <div class="questions__block-form__button">
                                <button id="generate-position" type="button" name="button"><?php esc_html_e( 'Generate', 'hello' ); ?></button>
                                <button id="copy-position" type="button" name="button"><?php esc_html_e( 'Copy', 'hello' ); ?></button>
                                <button id="copy-btn" data-url="<?php echo esc_url( get_permalink() );?>" type="button" name="button"><?php esc_html_e( 'Publish', 'hello' ); ?></button>
                                <div class="text-copy-result w100"></div>
                            </div>
                        </div>
                        <div id="js-loader" class="loader-wrapper no-active">
            				<div class="loader"><?php esc_html_e( 'loading', 'hello' ); ?></div>
            			</div>
                    </div>
                    <!-- <div class="add-candidate__content__form-items__item answers active">
                        <div class="questions__block-form active">
                            <div class="questions__block-form__title"><?php //esc_html_e( 'Evaluation of responses', 'hello' ); ?></div>
                            <div class="questions__block-form__content">
                                <span class="questions__block-form__content-title"><?php //esc_html_e( 'Candidate Responses:', 'hello' ); ?></span>
                                <textarea name="answer" id="answer" class="questions__block-form__content-text" cols="30" rows="4" minlength="200" maxlength="8000" required><?php echo $post->answer; ?></textarea>
                                <span class="answer-count-label"><?php //esc_html_e( 'Number of characters:', 'hello' ); ?> <span id="answer-count">0</span></span>
                            </div>
                            <div class="questions__block-form__button">
                                <button id="grade-questions" type="button" name="button" disabled><?php //esc_html_e( 'Send for evaluation', 'hello' ); ?></button>
                            </div>
                        </div>
                        <div id="js-loader" class="loader-wrapper no-active">
            				<div class="loader"><?php //esc_html_e( 'loading', 'hello' ); ?></div>
            			</div> -->
                    </div>

                <div class="add-candidate__content__form__buttons">
                    <div class="field-group field-checkbox">
                        <input class="field-checkbox__input" type="checkbox" name="refusals_auto" id="refusals_auto" <?php checked( $post->refusals_auto, 'on' ); ?> />
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
                        <input class="field-checkbox__input" type="checkbox" name="paid_response" id="paid_response" <?php checked( $post->paid_response, 'on' ); ?> />
                        <label for="paid_response" class="field-checkbox__label">
                            <span class="field-checkbox__label__icon icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M20 6L9 17L4 12" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </span>
                            <span class="field-checkbox__label__text text">Paid response</span>
                        </label>
                    </div>
                    <button type="button" name="button"><?php esc_html_e( 'Cancel', 'hello' ); ?></button>
                    <button id="update-position-submit" type="button" name="button"><?php esc_html_e( 'Save', 'hello' ); ?></button>
                </div>

                <!-- <div class="add-candidate__content__form__buttons">
                    <button id="copy-btn" data-url="<?php //echo esc_url( get_permalink() );?>" type="button" name="button"><?php //esc_html_e( 'Publish', 'hello' ); ?></button>
                    <div class="text-copy-result w100"></div>
                </div> -->

            </div>
        </div>

    </article>
</div>

<?php
} else {
?>

<div class="dashboard">
    <article class="dashboard__article no-login">
        <div class="no-login__title">
            <h1><?php the_title();?><?php echo ' #' . $post->ID;?></h1>
        </div>

        <div class="no-login__content">
            <?php the_content();?>
        </div>

        <div class="no-login__button">
            <button class="btn-generale btn-apply" type="button" name="button"><?php esc_html_e( 'Apply', 'hello' ); ?></button>
        </div>

        <div class="no-login__form">
            <div class="no-login__form__info">
                <?php esc_html_e( 'The job application requires additional time to respond.', 'hello' ); ?>
            </div>
            <form enctype="multipart/form-data">
                <div class="forms__item-item">
                    <label for="name"><?php esc_html_e( 'Full Name', 'hello' ); ?> <span class="color-red">*</span></label>
                    <input id="name" type="text" name="name">
                </div>
                <div class="forms__item-item">
                    <label for="email"><?php esc_html_e( 'Email', 'hello' ); ?> <span class="color-red">*</span></label>
                    <input id="email" type="text" name="email">
                </div>
                <div class="forms__item-item">
                    <label for=""><?php esc_html_e( 'Upload CV', 'hello' ); ?></label>
                    <label class="file" for="file_cv">
                        <span><?php esc_html_e( 'Choose File(pdf only)', 'hello' ); ?></span>
                        <span class="file-result">
                            <?php esc_html_e( 'file not selected', 'hello' );?>
                        </span>
                        <input id="file_cv" type="file" name="file_cv" accept="application/pdf">
                    </label>
                </div>
                <div class="forms__item-item">
                    <button class="btn-generale add-response w100" name="button" data-post="<?php echo $post->ID;?>">
                        <?php esc_html_e( 'Apply', 'hello' ); ?>
                    </button>
                    <div class="no-login__form_result-success"></div>
                </div>

                <div class="forms__item-item questions-answers">
                    <div class="questions-answers__questions">
                        <div class="questions-answers__questions__title">
                            <?php esc_html_e( 'Please provide as much details as possible in response to the following questions. By answering, you will be among the first responders and we will be able to contact you more instantly. The response should not take more than 15 minutes. We appreciate your collaboration.', 'hello' ); ?>
                        </div>
                        <div class="questions-answers__questions__result-generate"></div>
                    </div>
                    <div class="questions-answers__answers">
                        <div class="questions-answers__answers__text">
                            <textarea id="answers_text" class="questions-answers__answers__text__textarea" name="answers_text" rows="14" cols="80"></textarea>
                        </div>
                        <div class="questions-answers__answers__salary">
                            <div class="forms__item-item salary">
                                <label for="salary"><?php esc_html_e( 'Salary expectations', 'hello' ); ?></label>
                                <input id="salary" type="number" name="salary">
                            </div>
                            <div class="forms__item-item currency">
                                <label for="candidates_position"><?php esc_html_e( 'Currency', 'hello' ); ?></label>
                                <div class="forms__item-item__select">
                                    <span class="forms__item-item__select__text">RUB</span>
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
                                        <span><?php esc_html_e( 'RUB', 'hello' ); ?></span>
                                        <span><?php esc_html_e( 'EUR', 'hello' ); ?></span>
                                        <span><?php esc_html_e( 'USD', 'hello' ); ?></span>
                                        <span><?php esc_html_e( 'KZT', 'hello' ); ?></span>
                                        <span><?php esc_html_e( 'KGS', 'hello' ); ?></span>
                                    </div>
                                    <input id="currency" type="hidden" name="currency" value="RUB">
                                </div>
                            </div>
                        </div>
                        <div class="questions-answers__answers__button">
                            <button class="btn-generale update-response w100" name="button" data-post="<?php echo $post->ID;?>">
                                <?php esc_html_e( 'Send answers', 'hello' ); ?>
                            </button>
                        </div>
                    </div>

                </div>

                <div class="no-login__form_result-success-end ta-center"></div>
            </form>
        </div>
    </article>
</div>

<!-- <button class="btn-generale btn-qw-test">
    <?php //esc_html_e( 'TEST', 'hello' ); ?>
</button> -->

<?php
}

// var_dump(hello_render_questions('PHP', 1));
