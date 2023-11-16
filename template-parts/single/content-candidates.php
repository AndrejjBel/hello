<div class="dashboard">
    <?php get_template_part( 'template-parts/page/aside-page' ); ?>

    <article class="dashboard__article add-candidate">
        <div class="add-candidate__content">
            <form id="add-candidate" class="add-candidate__content__form"  enctype="multipart/form-data">
                <div class="add-candidate__content__form-title"><?php esc_html_e( 'Candidate card', 'hello' ); ?></div>

                <div class="add-candidate__content__form-items">
                    <div class="add-candidate__content__form-items__item forms">
                        <div class="forms__item">
                            <div class="forms__item-title"><?php esc_html_e( 'Basic information', 'hello' ); ?></div>
                            <div class="forms__item-item">
                                <label for="name"><?php esc_html_e( 'Full Name', 'hello' ); ?> <span class="color-red">*</span></label>
                                <input id="name" type="text" name="name" value="<?php the_title();?>">
                            </div>
                            <div class="forms__item-item">
                                <label for="email"><?php esc_html_e( 'Email', 'hello' ); ?> <span class="color-red">*</span></label>
                                <input id="email" type="text" name="email" value="<?php echo $post->email;?>">
                            </div>
                            <div class="forms__item-item">
                                <label for=""><?php esc_html_e( 'Position', 'hello' ); ?> <span class="color-red">*</span></label>
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
                                    </div>
                                    <input id="candidates_position" type="hidden" name="candidates_position" value="<?php echo $post->position;?>">
                                </div>
                            </div>
                            <div class="forms__item-item">
                                <label for=""><?php esc_html_e( 'Level', 'hello' ); ?> <span class="color-red">*</span></label>
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
                                        <span><?php esc_html_e( 'Middle', 'hello' ); ?></span>
                                        <span><?php esc_html_e( 'Senior', 'hello' ); ?></span>
                                        <span><?php esc_html_e( 'Principal', 'hello' ); ?></span>
                                    </div>
                                    <input id="level" type="hidden" name="level" value="<?php echo $post->level;?>">
                                </div>
                            </div>

                            <div class="forms__item-item">
                                <label for=""><?php esc_html_e( 'Upload CV', 'hello' ); ?></label>
                                <label class="file" for="file_cv">
                                    <span><?php esc_html_e( 'Choose File', 'hello' ); ?></span>
                                    <span class="file-result">
                                        <?php if ($post->file_cv) {
                                            echo basename( get_attached_file( $post->file_cv ) );
                                        } else {
                                            esc_html_e( 'file not selected', 'hello' );
                                        }
                                        ?>
                                    </span>
                                    <input id="file_cv" type="file" name="file_cv">
                                </label>
                            </div>

                            <div class="forms__item-item">
                                <label for=""><?php esc_html_e( 'Positions', 'hello' ); ?></label>
                                <div class="forms__item-item__select positions-candidates-my">
                                    <span class="forms__item-item__select__text">
                                        <?php if ($post->position_candidat_id) {
                                            echo get_the_title($post->position_candidat_id) . ' #' . $post->position_candidat_id;
                                        } else {
                                            echo __( 'Select open position', 'hello' );
                                        }
                                        ?>
                                    </span>
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
                                        <?php hello_render_list_position(); ?>
                                    </div>
                                    <input id="position_candidat" type="hidden" name="position_candidat" value="">
                                    <input id="position_candidat_id" type="hidden" name="position_candidat_id" value="<?php echo $post->position_candidat_id;?>">
                                </div>
                            </div>

                            <div class="forms__item-item__group">
                                <div class="forms__item-item salary">
                                    <label for="salary"><?php esc_html_e( 'Salary expectations', 'hello' ); ?></label>
                                    <input id="salary" type="number" name="salary" value="<?php echo $post->salary;?>">
                                </div>
                                <div class="forms__item-item currency">
                                    <label for="candidates_position"><?php esc_html_e( 'Currency', 'hello' ); ?></label>
                                    <div class="forms__item-item__select">
                                        <span class="forms__item-item__select__text"><?php echo ($post->currency) ? $post->currency : 'RUB';?></span>
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
                                        <input id="currency" type="hidden" name="currency" value="<?php echo ($post->currency) ? $post->currency : 'RUB';?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="forms__item"></div>
                        <div class="forms__item"></div>
                    </div>
                    <div class="add-candidate__content__form-items__item questions active">
                        <!-- <div class="questions__brancher">
                            <div class="questions__brancher__title">Вопросы</div>
                            <button id="questions-brancher-btn" type="button" name="button">Добавить</button>
                        </div> -->
                        <div class="questions__block-form active">
                            <div class="questions__block-form__title"><?php esc_html_e( 'Questions', 'hello' ); ?></div>
                            <div class="questions__block-form__content">
                                <span class="questions__block-form__content-title"><?php esc_html_e( 'Questions for the candidate:', 'hello' ); ?></span>
                                <span class="questions__block-form__content-text to-copy">
                                    <?php if ( $post->questions ) {
                                        foreach ($post->questions as $key => $question) {
                    						echo '<p class="question-item">' . $question . '</p>';
                    					}
                                    }
                                    ?>
                                </span>
                            </div>
                            <div class="questions__block-form__button">
                                <button id="generate-questions" type="button" name="button"><?php esc_html_e( 'Generate', 'hello' ); ?></button>
                                <button id="copy-questions" type="button" name="button"><?php esc_html_e( 'Copy', 'hello' ); ?></button>
                            </div>
                        </div>
                    </div>
                    <div class="add-candidate__content__form-items__item answers active">
                        <!-- <div class="questions__brancher">
                            <div class="questions__brancher__title">Оценка ответов</div>
                            <button id="questions-brancher-btn" type="button" name="button">Добавить</button>
                        </div> -->
                        <div class="questions__block-form active">
                            <div class="questions__block-form__title"><?php esc_html_e( 'Evaluation of responses', 'hello' ); ?></div>
                            <div class="questions__block-form__content">
                                <span class="questions__block-form__content-title"><?php esc_html_e( 'Candidate Responses:', 'hello' ); ?></span>
                                <!-- <span class="questions__block-form__content-text"></span> -->
                                <!-- <textarea id="answer" class="questions__block-form__content-text" name="answer" rows="4" cols="80"></textarea> -->
                                <textarea name="answer" id="answer" class="questions__block-form__content-text" cols="30" rows="4" minlength="200" maxlength="8000" required><?php echo $post->answer; ?></textarea>
                                <span class="answer-count-label"><?php esc_html_e( 'Number of characters:', 'hello' ); ?> <span id="answer-count">0</span></span>
                            </div>
                            <div class="questions__block-form__button">
                                <button id="grade-questions" type="button" name="button" disabled><?php esc_html_e( 'Send for evaluation', 'hello' ); ?></button>
                            </div>
                        </div>
                        <div id="js-loader" class="loader-wrapper no-active">
            				<div class="loader"><?php esc_html_e( 'loading', 'hello' ); ?></div>
            			</div>
                    </div>

                    <div class="add-candidate__content__form-items__item result">
                        <div class="result__content">
                            <div class="result__content__title"><?php esc_html_e( 'Result', 'hello' ); ?></div>
                            <div id="result" class="result__content__res">
                                <?php hello_dashboard_score($post->result);?>
                            </div>
                        </div>
                    </div>

                    <div class="add-candidate__content__form-items__item dop-info">
                        <div class="dop-info__content">
                            <div class="dop-info__content__title"><?php _e( 'Additional<br>information', 'hello' ); ?></div>
                            <div id="dop-info" class="dop-info__content__res">
                                <?php echo preg_replace('/\d/','',$post->result); ?>
                            </div>
                        </div>
                    </div>

                    <div class="add-candidate__content__form-items__item dop-info">
                        <div class="dop-info__content">
                            <div class="dop-info__content__title"><?php _e( 'Generating<br>Questions', 'hello' ); ?></div>
                            <textarea class="dop-info__content__res" name="generating-questions" rows="8" cols="80"><?php echo $post->generating_questions; ?></textarea>
                        </div>
                    </div>

                    <div class="add-candidate__content__form-items__item dop-info status">
                        <div class="dop-info__content">
                            <div class="dop-info__content__title"><?php esc_html_e( 'Status', 'hello' ); ?></div>
                            <div id="status-text" class="dop-info__content__res forms__item-item__select">
                                <span class="forms__item-item__select__text"><?php echo $post->status;?></span>
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
                                    <span><?php esc_html_e( 'Scheduled', 'hello' ); ?></span>
                                    <span><?php esc_html_e( 'Rejected', 'hello' ); ?></span>
                                </div>
                                <input id="status" type="hidden" name="status" value="<?php echo $post->status;?>">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="add-candidate__content__form__buttons">
                    <button type="button" name="button"><?php esc_html_e( 'Cancel', 'hello' ); ?></button>
                    <button id="update-candidate-submit" type="button" name="button"><?php esc_html_e( 'Save', 'hello' ); ?></button>
                </div>

            </form>
        </div>

        <!-- <div class="text-pdf mt40"><?php //echo $post->file_cv_text;?></div> -->

    </article>
</div>
