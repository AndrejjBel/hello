<aside class="dashboard__aside">
    <div class="dashboard__aside__content">
        <div class="dashboard__aside__content__item">
            <a href="/manage-positions"<?php echo hello_aside_nav('manage-positions')['style_link'];?>>
                <svg width="28" height="28" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#BFBFBF">
                    <path d="M15.5,12C18,12 20,14 20,16.5C20,17.38 19.75,18.21 19.31,18.9L22.39,22L21,23.39L17.88,20.32C17.19,20.75 16.37,21 15.5,21C13,21 11,19 11,16.5C11,14 13,12 15.5,12M15.5,14A2.5,2.5 0 0,0 13,16.5A2.5,2.5 0 0,0 15.5,19A2.5,2.5 0 0,0 18,16.5A2.5,2.5 0 0,0 15.5,14M10,4A4,4 0 0,1 14,8C14,8.91 13.69,9.75 13.18,10.43C12.32,10.75 11.55,11.26 10.91,11.9L10,12A4,4 0 0,1 6,8A4,4 0 0,1 10,4M2,20V18C2,15.88 5.31,14.14 9.5,14C9.18,14.78 9,15.62 9,16.5C9,17.79 9.38,19 10,20H2Z" />
                </svg>
                <div class="dashboard__aside__content__item-tooltip">
                    <span class="tooltip-text"><?php esc_html_e( 'Manage Positions', 'hello' ); ?></span>
                </div>
                <div class="dashboard__aside__content__item-active<?php echo hello_aside_nav('manage-positions')['style_item'];?>"></div>
            </a>
        </div>

        <div class="dashboard__aside__content__item">
            <a href="#"<?php //echo hello_aside_nav('candidates')['style_link'];?>>
                <svg width="22" height="25" viewBox="0 0 22 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M11 10.875C7.7468 10.875 6.97192 6.16477 6.90931 5.74485C6.90601 5.72272 6.90332 5.70397 6.9001 5.68183C6.51017 3.00511 7.74329 0 10.955 0C14.1703 0 15.4061 2.98397 15.029 5.65352C15.0232 5.69456 15.0177 5.73494 15.0118 5.77597C14.9296 6.35576 14.1866 10.875 11 10.875ZM8.79579 13.3215C10.1348 14.1772 11.8533 14.159 13.174 13.2753L14.0704 12.6756C14.7286 12.2351 15.5116 11.9631 16.2857 12.1306C19.3514 12.7936 21.86 15.8709 21.86 18.795V19.5811C21.86 21.3345 20.7179 22.882 19.0054 23.2587C16.9168 23.7181 13.945 24.225 11 24.225C8.0128 24.225 5.05238 23.7204 2.97877 23.2619C1.27348 22.8847 0.140015 21.3421 0.140015 19.5956V18.795C0.140015 15.7741 2.47147 12.7772 5.68218 12.1816C6.43266 12.0424 7.18678 12.2934 7.82996 12.7044L8.79579 13.3215Z" fill="#BFBFBF"/>
                </svg>
                <div class="dashboard__aside__content__item-tooltip">
                    <span class="tooltip-text"><?php esc_html_e( 'Candidate', 'hello' ); ?></span>
                </div>
                <div class="dashboard__aside__content__item-active<?php //echo hello_aside_nav('candidates')['style_item'];?>"></div>
            </a>
        </div>
        <div class="dashboard__aside__content__item">
            <a href="<?php echo hello_aside_dl();?>">
                <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12.2111 4.07771C12.9482 2.60361 15.0518 2.60361 15.7889 4.07771L18.0213 8.54263C18.3204 9.14074 18.8986 9.54982 19.5621 9.63276L23.7199 10.1525C25.3193 10.3524 26.0373 12.2652 24.9645 13.4682L21.9594 16.838C21.5552 17.2912 21.3789 17.9035 21.48 18.5023L22.344 23.6168C22.6166 25.2305 20.9413 26.4707 19.4775 25.7388L14.8944 23.4472C14.3314 23.1657 13.6686 23.1657 13.1056 23.4472L8.52888 25.7356C7.06386 26.4681 5.38769 25.2253 5.66289 23.6107L6.53304 18.5053C6.63538 17.9048 6.4585 17.2904 6.05254 16.8363L3.04262 13.4693C1.96766 12.2668 2.68516 10.3519 4.28562 10.1518L8.4379 9.63276C9.10144 9.54982 9.67963 9.14074 9.97868 8.54263L12.2111 4.07771Z" fill="#BFBFBF"/>
                </svg>
                <div class="dashboard__aside__content__item-tooltip">
                    <span class="tooltip-text"><?php esc_html_e( 'Evaluated', 'hello' ); ?></span>
                </div>
                <div class="dashboard__aside__content__item-active"></div>
            </a>
        </div>
        <div class="dashboard__aside__content__item">
            <a href="<?php echo hello_aside_dl();?>">
                <svg width="19" height="24" viewBox="0 0 19 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M14.015 3C14.5673 3 15.015 3.44772 15.015 4V11C15.015 11.5523 15.4627 12 16.015 12H17.015C17.5673 12 18.015 11.5523 18.015 11V1C18.015 0.447715 17.5673 0 17.015 0H1C0.447715 0 0 0.447715 0 1V11C0 11.5523 0.447715 12 1 12H2.015C2.56729 12 3.015 11.5523 3.015 11V4C3.015 3.44772 3.46272 3 4.015 3H14.015ZM11.015 6C11.5673 6 12.015 6.44771 12.015 7V14C12.015 14.5523 12.4627 15 13.015 15H14.38C15.2278 15 15.691 15.9889 15.1482 16.6402L9.78322 23.0781C9.38343 23.5579 8.64658 23.5579 8.24678 23.0781L2.88182 16.6402C2.33905 15.9889 2.8022 15 3.65004 15H5.015C5.56729 15 6.015 14.5523 6.015 14V7C6.015 6.44772 6.46272 6 7.015 6H11.015Z" fill="#BFBFBF"/>
                </svg>
                <div class="dashboard__aside__content__item-tooltip">
                    <span class="tooltip-text"><?php esc_html_e( 'New', 'hello' ); ?></span>
                </div>
                <div class="dashboard__aside__content__item-active"></div>
            </a>
        </div>
        <div class="dashboard__aside__content__item">
            <a href="<?php echo hello_aside_dl();?>">
                <svg width="21" height="23" viewBox="0 0 21 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M18 4C18 3.30964 18.5596 2.75 19.25 2.75C19.9404 2.75 20.5 3.30964 20.5 4V20.75C20.5 21.8546 19.6046 22.75 18.5 22.75H4.25C2.175 22.75 0.5 21.075 0.5 19V4C0.5 1.925 2.175 0.25 4.25 0.25H13.5C14.6046 0.25 15.5 1.14543 15.5 2.25V15.75C15.5 16.8546 14.6046 17.75 13.5 17.75H4.25C3.5625 17.75 3 18.3125 3 19C3 19.6875 3.5625 20.25 4.25 20.25H16C17.1046 20.25 18 19.3546 18 18.25V4Z" fill="#BFBFBF"/>
                </svg>
                <div class="dashboard__aside__content__item-tooltip">
                    <span class="tooltip-text"><?php esc_html_e( 'Archive', 'hello' ); ?></span>
                </div>
                <div class="dashboard__aside__content__item-active"></div>
            </a>
        </div>
        <div class="dashboard__aside__content__item plus">
            <a href="<?php echo hello_aside_add()['link'];?>"<?php echo hello_aside_nav('add-candidates')['style_link'] . hello_aside_nav('add-position')['style_link'];?>>
                <svg width="26" height="26" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect y="11" width="26" height="4" rx="2" fill="white"/>
                    <rect x="15" width="26" height="4" rx="2" transform="rotate(90 15 0)" fill="white"/>
                </svg>
                <div class="dashboard__aside__content__item-tooltip">
                    <span class="tooltip-text"><?php echo hello_aside_add()['tooltip'];?></span>
                </div>
                <div class="dashboard__aside__content__item-active<?php echo hello_aside_nav('add-candidates')['style_item'] . hello_aside_nav('add-position')['style_item'];?>"></div>
            </a>
        </div>
    </div>
</aside>
