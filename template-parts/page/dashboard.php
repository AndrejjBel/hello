<?php
$cur_user = get_current_user_id();

if ( !$cur_user ) {
    echo '<script> window.location.href = "/auth"</script>';
} else {
?>

<div class="dashboard">
    <?php get_template_part( 'template-parts/page/aside-page' ); ?>

    <article class="dashboard__article">
        <div class="dashboard__article__content">
            <div class="dashboard__article__content__table">

                <div class="dashboard__article__content__table-title"><?php esc_html_e( 'Evaluated', 'hello' ); ?></div>
                <div class="dashboard__article__content__table-items table-items new">
                    <div class="table-items__head">
                        <div class="table-items__head-item w-g"><?php esc_html_e( 'Date', 'hello' ); ?></div>
                        <div class="table-items__head-item w-g"><?php esc_html_e( 'Full Name', 'hello' ); ?></div>
                        <div class="table-items__head-item w-g"><?php esc_html_e( 'Position', 'hello' ); ?></div>
                        <div class="table-items__head-item"><?php esc_html_e( 'Level', 'hello' ); ?></div>
                        <div class="table-items__head-item"><?php esc_html_e( 'Appraisal', 'hello' ); ?></div>
                        <div class="table-items__head-item"><?php esc_html_e( 'More', 'hello' ); ?></div>
                    </div>

                    <?php foreach( hello_render_table_grade($cur_user) as $post ) { setup_postdata( $post ); ?>
                        <div class="table-items__items">
                            <a href="<?php echo get_permalink(); ?>" title="<?php esc_html_e( 'Read more', 'hello' ); ?>"></a>
                            <div class="table-items__items__item w-g"><?php echo get_the_date('d.m.Y H:i'); ?></div>
                            <div class="table-items__items__item w-g"><?php the_title(); ?></div>
                            <div class="table-items__items__item w-g"><?php echo $post->position; ?></div>
                            <div class="table-items__items__item"><?php echo $post->level; ?></div>
                            <div class="table-items__items__item"><?php hello_dashboard_score($post->result); ?></div>
                            <div class="table-items__items__item r-icon">
                                <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_1_437)">
                                    <path d="M4.5 16.5C3.67157 16.5 3 15.8284 3 15C3 14.1716 3.67157 13.5 4.5 13.5H16.1716C17.9534 13.5 18.8457 11.3457 17.5858 10.0858L15.8109 8.31085C15.3266 7.82662 15.2066 7.08686 15.5128 6.47434C15.9985 5.50305 17.293 5.29298 18.0609 6.06085L25.5858 13.5858C26.3668 14.3668 26.3668 15.6332 25.5858 16.4142L18.0609 23.9391C17.293 24.707 15.9985 24.497 15.5128 23.5257C15.2066 22.9131 15.3266 22.1734 15.8109 21.6891L17.5858 19.9142C18.8457 18.6543 17.9534 16.5 16.1716 16.5H4.5Z" fill="#BFBFBF"/>
                                    </g>
                                    <defs>
                                    <clipPath id="clip0_1_437">
                                    <rect width="30" height="30" fill="white"/>
                                    </clipPath>
                                    </defs>
                                </svg>
                            </div>
                        </div>
                    <?php }
                        wp_reset_postdata();
                    ?>
                </div>

                <div class="dashboard__article__content__table-title"><?php esc_html_e( 'New', 'hello' ); ?></div>
                <div class="dashboard__article__content__table-items table-items grade">
                    <div class="table-items__head">
                        <div class="table-items__head-item w-g"><?php esc_html_e( 'Date', 'hello' ); ?></div>
                        <div class="table-items__head-item w-g"><?php esc_html_e( 'Full Name', 'hello' ); ?></div>
                        <div class="table-items__head-item w-g"><?php esc_html_e( 'Position', 'hello' ); ?></div>
                        <div class="table-items__head-item w-s"><?php esc_html_e( 'Level', 'hello' ); ?></div>
                        <div class="table-items__head-item w-g"><?php esc_html_e( 'Evaluation status', 'hello' ); ?></div>
                    </div>

                    <?php foreach( hello_render_table_new($cur_user) as $post ) { setup_postdata( $post ); ?>
                        <div class="table-items__items">
                            <a href="<?php echo get_permalink(); ?>" title="<?php esc_html_e( 'Read more', 'hello' ); ?>"></a>
                            <div class="table-items__items__item w-g"><?php echo get_the_date('d.m.Y H:i'); ?></div>
                            <div class="table-items__items__item w-g"><?php the_title(); ?></div>
                            <div class="table-items__items__item w-g"><?php echo $post->position; ?></div>
                            <div class="table-items__items__item w-s"><?php echo $post->level; ?></div>
                            <div class="table-items__items__item w-g">
                                <div class="dop-info__content__res forms__item-item__select" data-post="<?php echo $post->ID;?>">
                                    <span class="forms__item-item__select__text"><?php echo $post->evaluated;?></span>
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
                                        <span><?php esc_html_e( 'Not assessed', 'hello' ); ?></span>
                                        <span><?php esc_html_e( 'Evaluated', 'hello' ); ?></span>
                                    </div>
                                    <input id="status" type="hidden" name="status" value="<?php echo $post->status;?>">
                                </div>
                            </div>
                        </div>
                    <?php }
                        wp_reset_postdata();
                    ?>
                </div>

                <div class="dashboard__article__content__table-title"><?php esc_html_e( 'Archive', 'hello' ); ?></div>
                <div class="dashboard__article__content__table-items table-items archive">
                    <div class="table-items__head">
                        <div class="table-items__head-item w-g"><?php esc_html_e( 'Date', 'hello' ); ?></div>
                        <div class="table-items__head-item w-g"><?php esc_html_e( 'Full Name', 'hello' ); ?></div>
                        <div class="table-items__head-item w-g"><?php esc_html_e( 'Position', 'hello' ); ?></div>
                        <div class="table-items__head-item"><?php esc_html_e( 'Level', 'hello' ); ?></div>
                        <div class="table-items__head-item"><?php esc_html_e( 'Appraisal', 'hello' ); ?></div>
                        <div class="table-items__head-item"><?php esc_html_e( 'More', 'hello' ); ?></div>
                    </div>

                    <?php foreach( hello_render_table_archive($cur_user) as $post ) { setup_postdata( $post ); ?>
                        <div class="table-items__items">
                            <a href="<?php echo get_permalink(); ?>" title="<?php esc_html_e( 'Read more', 'hello' ); ?>"></a>
                            <div class="table-items__items__item w-g"><?php echo get_the_date('d.m.Y H:i'); ?></div>
                            <div class="table-items__items__item w-g"><?php the_title(); ?></div>
                            <div class="table-items__items__item w-g"><?php echo $post->position; ?></div>
                            <div class="table-items__items__item"><?php echo $post->level; ?></div>
                            <div class="table-items__items__item"><?php hello_dashboard_score($post->result); ?></div>
                            <div class="table-items__items__item r-icon">
                                <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_1_437)">
                                    <path d="M4.5 16.5C3.67157 16.5 3 15.8284 3 15C3 14.1716 3.67157 13.5 4.5 13.5H16.1716C17.9534 13.5 18.8457 11.3457 17.5858 10.0858L15.8109 8.31085C15.3266 7.82662 15.2066 7.08686 15.5128 6.47434C15.9985 5.50305 17.293 5.29298 18.0609 6.06085L25.5858 13.5858C26.3668 14.3668 26.3668 15.6332 25.5858 16.4142L18.0609 23.9391C17.293 24.707 15.9985 24.497 15.5128 23.5257C15.2066 22.9131 15.3266 22.1734 15.8109 21.6891L17.5858 19.9142C18.8457 18.6543 17.9534 16.5 16.1716 16.5H4.5Z" fill="#BFBFBF"/>
                                    </g>
                                    <defs>
                                    <clipPath id="clip0_1_437">
                                    <rect width="30" height="30" fill="white"/>
                                    </clipPath>
                                    </defs>
                                </svg>
                            </div>
                        </div>
                    <?php }
                        wp_reset_postdata();
                    ?>
                </div>

            </div>
        </div>

    </article>
</div>

<?php } ?>
