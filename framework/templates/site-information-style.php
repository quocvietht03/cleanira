<?php $site_infor = get_field('site_information', 'options') ?: ''; ?>

<?php if (!empty($site_infor) && isset($site_infor) && !empty($args['data']) && isset($args['data'])) : ?>
    <?php foreach ($args['data'] as $item) { ?>
        <?php if ($item == 'phone' && !empty($site_infor['site_phone'])) { ?>
            <div class="bt-elwg-site-infor--item phone">
                <a href="<?php echo esc_url('tel:' . preg_replace('/[^0-9]+/', '', $site_infor['site_phone'])); ?>">

                    <?php if ($args['layout'] == 'style-1') : ?>
                        <div class="bt-elwg-site-infor--item-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25" fill="none">
                                <path d="M15.275 1.80528C15.3004 1.71004 15.3443 1.62074 15.4043 1.54249C15.4642 1.46423 15.5389 1.39856 15.6243 1.34922C15.7096 1.29988 15.8038 1.26784 15.9015 1.25494C15.9993 1.24204 16.0986 1.24853 16.1938 1.27403C18.0053 1.74656 19.658 2.69348 20.9818 4.01726C22.3056 5.34103 23.2525 6.99379 23.725 8.80528C23.7505 8.90049 23.757 8.99979 23.7441 9.09751C23.7312 9.19523 23.6992 9.28945 23.6498 9.37477C23.6005 9.4601 23.5348 9.53487 23.4566 9.5948C23.3783 9.65473 23.289 9.69864 23.1938 9.72403C23.1306 9.74086 23.0654 9.74927 23 9.74903C22.8348 9.74913 22.6741 9.69466 22.543 9.59407C22.4119 9.49348 22.3177 9.35242 22.275 9.19278C21.8693 7.63677 21.0561 6.21708 19.919 5.08003C18.782 3.94298 17.3623 3.12971 15.8063 2.72403C15.711 2.69864 15.6217 2.65473 15.5435 2.5948C15.4652 2.53487 15.3995 2.4601 15.3502 2.37478C15.3009 2.28945 15.2688 2.19523 15.2559 2.09751C15.243 1.99979 15.2495 1.90049 15.275 1.80528ZM14.8063 6.72403C16.625 7.20903 17.79 8.37403 18.275 10.1928C18.3177 10.3524 18.4119 10.4935 18.543 10.5941C18.6741 10.6947 18.8348 10.7491 19 10.749C19.0654 10.7493 19.1306 10.7409 19.1938 10.724C19.289 10.6986 19.3783 10.6547 19.4566 10.5948C19.5348 10.5349 19.6005 10.4601 19.6498 10.3748C19.6992 10.2894 19.7312 10.1952 19.7441 10.0975C19.757 9.99979 19.7505 9.90049 19.725 9.80528C19.1 7.46653 17.5325 5.89903 15.1938 5.27403C15.0986 5.24859 14.9993 5.24215 14.9016 5.25507C14.8039 5.268 14.7097 5.30005 14.6244 5.34938C14.4521 5.44901 14.3264 5.613 14.275 5.80528C14.2236 5.99756 14.2507 6.20238 14.3504 6.37468C14.45 6.54698 14.614 6.67265 14.8063 6.72403ZM24.7363 18.849C24.5221 20.4831 23.7202 21.9832 22.4805 23.069C21.2408 24.1549 19.648 24.7521 18 24.749C8.21251 24.749 0.250012 16.7865 0.250012 6.99903C0.246855 5.35159 0.843537 3.75933 1.9286 2.51968C3.01367 1.28003 4.5129 0.477784 6.14626 0.262783C6.52226 0.21709 6.90293 0.294619 7.23111 0.483727C7.55929 0.672834 7.81725 0.963312 7.96626 1.31153L10.6038 7.19903C10.7202 7.46557 10.7684 7.75692 10.744 8.04676C10.7195 8.3366 10.6232 8.61577 10.4638 8.85903C10.4477 8.88379 10.4302 8.90759 10.4113 8.93028L7.77751 12.0628C7.76152 12.0953 7.75321 12.131 7.75321 12.1672C7.75321 12.2034 7.76152 12.2391 7.77751 12.2715C8.73501 14.2315 10.79 16.2715 12.7775 17.2278C12.8107 17.2429 12.8469 17.2501 12.8834 17.2488C12.9198 17.2475 12.9555 17.2377 12.9875 17.2203L16.0738 14.5953C16.0958 14.5761 16.1192 14.5586 16.1438 14.5428C16.3859 14.3813 16.6646 14.2828 16.9544 14.2562C17.2443 14.2296 17.5362 14.2756 17.8038 14.3903L23.7088 17.0365C24.0524 17.1888 24.3378 17.4477 24.5228 17.7748C24.7079 18.1019 24.7827 18.4798 24.7363 18.8528V18.849ZM23.25 18.664C23.2542 18.6118 23.2419 18.5595 23.2147 18.5146C23.1876 18.4698 23.147 18.4346 23.0988 18.414L17.1925 15.7678C17.1602 15.7553 17.1257 15.75 17.0911 15.7522C17.0566 15.7543 17.023 15.7639 16.9925 15.7803L13.9075 18.4053C13.885 18.424 13.8613 18.4415 13.8375 18.4578C13.5859 18.6256 13.295 18.7253 12.9934 18.7472C12.6917 18.7691 12.3895 18.7125 12.1163 18.5828C9.82126 17.474 7.53376 15.2078 6.42501 12.934C6.29461 12.6624 6.23656 12.3616 6.25648 12.061C6.27641 11.7603 6.37364 11.4699 6.53876 11.2178C6.55486 11.1927 6.57283 11.1689 6.59251 11.1465L9.22501 8.01403C9.24006 7.98129 9.24784 7.94569 9.24784 7.90966C9.24784 7.87363 9.24006 7.83802 9.22501 7.80528L6.59251 1.91278C6.57514 1.86549 6.54388 1.82455 6.50284 1.79533C6.4618 1.76611 6.41289 1.74997 6.36251 1.74903H6.33376C5.06244 1.91815 3.89613 2.54421 3.05263 3.51032C2.20913 4.47642 1.7461 5.71652 1.75001 6.99903C1.75001 15.959 9.04001 23.249 18 23.249C19.2827 23.2529 20.523 22.7897 21.4891 21.9459C22.4552 21.1022 23.0812 19.9356 23.25 18.664Z" fill="#212121" />
                            </svg>
                        </div>
                        <div class="bt-elwg-site-infor--item-content">
                            <h4><?php echo esc_html__('Have any Question?', 'cleanira') ?></h4>
                            <span> <?php echo esc_html($site_infor['site_phone']); ?> </span>
                        </div>
                    <?php else : ?>
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                            <g clip-path="url(#clip0_10935_2493)">
                                <path d="M11.875 3.75C12.9262 4.02681 13.8851 4.57767 14.6537 5.34631C15.4223 6.11494 15.9732 7.07382 16.25 8.125" stroke="#212121" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M11.25 6.25C12.5406 6.59531 13.4047 7.45937 13.75 8.75" stroke="#212121" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M12.218 11.9794C12.3045 11.9218 12.4041 11.8867 12.5076 11.8773C12.6112 11.8679 12.7154 11.8844 12.8109 11.9255L16.4953 13.5762C16.6195 13.6293 16.7231 13.7212 16.7907 13.8381C16.8583 13.9549 16.8862 14.0906 16.8703 14.2247C16.7489 15.1317 16.3023 15.9639 15.6133 16.5663C14.9244 17.1687 14.0402 17.5004 13.125 17.4997C10.3071 17.4997 7.60457 16.3803 5.61199 14.3877C3.61942 12.3951 2.5 9.6926 2.5 6.87468C2.4993 5.95952 2.831 5.07526 3.43341 4.38634C4.03582 3.69742 4.86793 3.25074 5.775 3.12936C5.90909 3.11344 6.04473 3.14136 6.16162 3.20896C6.27851 3.27656 6.37037 3.3802 6.42344 3.50436L8.07422 7.19186C8.11478 7.28657 8.1313 7.38984 8.1223 7.49248C8.1133 7.59512 8.07908 7.69394 8.02266 7.78015L6.35313 9.7653C6.2939 9.85466 6.25888 9.95786 6.25149 10.0648C6.2441 10.1718 6.26458 10.2788 6.31094 10.3755C6.95703 11.6981 8.32422 13.0489 9.65078 13.6887C9.74796 13.7349 9.85548 13.7549 9.96276 13.7468C10.07 13.7388 10.1733 13.7028 10.2625 13.6426L12.218 11.9794Z" stroke="#212121" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </g>
                            <defs>
                                <clipPath id="clip0_10935_2493">
                                    <rect width="20" height="20" fill="white" />
                                </clipPath>
                            </defs>
                        </svg>
                        <span> <?php echo esc_html($site_infor['site_phone']); ?> </span>
                    <?php endif; ?>



                </a>
            </div>
        <?php } ?>

        <?php if ($item == 'email' && !empty($site_infor['site_email'])) { ?>
            <div class="bt-elwg-site-infor--item email">
                <a href="<?php echo esc_url('mailto:' . $site_infor['site_email']); ?>">

                    <?php if ($args['layout'] == 'style-1') : ?>
                        <div class="bt-elwg-site-infor--item-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M22.5 14.0625C18.8784 14.0625 15.9375 17.0034 15.9375 20.625C15.9375 24.2466 18.8784 27.1875 22.5 27.1875C26.1216 27.1875 29.0625 24.2466 29.0625 20.625C29.0625 17.0034 26.1216 14.0625 22.5 14.0625ZM22.5 15.9375C25.0875 15.9375 27.1875 18.0375 27.1875 20.625C27.1875 23.2125 25.0875 25.3125 22.5 25.3125C19.9125 25.3125 17.8125 23.2125 17.8125 20.625C17.8125 18.0375 19.9125 15.9375 22.5 15.9375ZM2.8125 5.87063L14.4281 14.8059C14.7656 15.0647 15.2344 15.0647 15.5719 14.8059L27.1875 5.87063V13.125C27.1875 13.6425 27.6075 14.0625 28.125 14.0625C28.6425 14.0625 29.0625 13.6425 29.0625 13.125V5.625C29.0625 4.0725 27.8025 2.8125 26.25 2.8125H3.75C2.1975 2.8125 0.9375 4.0725 0.9375 5.625V20.625C0.9375 22.1775 2.1975 23.4375 3.75 23.4375H14.0625C14.58 23.4375 15 23.0175 15 22.5C15 21.9825 14.58 21.5625 14.0625 21.5625H3.75C3.2325 21.5625 2.8125 21.1425 2.8125 20.625V5.87063ZM19.4934 21.2878L21.3684 23.1628C21.7341 23.5294 22.3284 23.5294 22.6941 23.1628L25.5066 20.3503C25.8722 19.9847 25.8722 19.3903 25.5066 19.0247C25.1409 18.6591 24.5466 18.6591 24.1809 19.0247L22.0312 21.1744L20.8191 19.9622C20.4534 19.5966 19.8591 19.5966 19.4934 19.9622C19.1278 20.3278 19.1278 20.9222 19.4934 21.2878ZM25.65 4.6875H4.35L15 12.8794L25.65 4.6875Z" fill="#212121" />
                            </svg>
                        </div>
                        <div class="bt-elwg-site-infor--item-content">
                            <h4><?php echo esc_html__('Email:', 'cleanira') ?></h4>
                            <span> <?php echo esc_html($site_infor['site_email']); ?> </span>
                        </div>
                    <?php else : ?>
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26" fill="none">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M19.5 12.1875C16.3613 12.1875 13.8125 14.7363 13.8125 17.875C13.8125 21.0137 16.3613 23.5625 19.5 23.5625C22.6387 23.5625 25.1875 21.0137 25.1875 17.875C25.1875 14.7363 22.6387 12.1875 19.5 12.1875ZM19.5 13.8125C21.7425 13.8125 23.5625 15.6325 23.5625 17.875C23.5625 20.1175 21.7425 21.9375 19.5 21.9375C17.2575 21.9375 15.4375 20.1175 15.4375 17.875C15.4375 15.6325 17.2575 13.8125 19.5 13.8125ZM2.4375 5.08788L12.5044 12.8318C12.7969 13.0561 13.2031 13.0561 13.4956 12.8318L23.5625 5.08788V11.375C23.5625 11.8235 23.9265 12.1875 24.375 12.1875C24.8235 12.1875 25.1875 11.8235 25.1875 11.375V4.875C25.1875 3.5295 24.0955 2.4375 22.75 2.4375H3.25C1.9045 2.4375 0.8125 3.5295 0.8125 4.875V17.875C0.8125 19.2205 1.9045 20.3125 3.25 20.3125H12.1875C12.636 20.3125 13 19.9485 13 19.5C13 19.0515 12.636 18.6875 12.1875 18.6875H3.25C2.8015 18.6875 2.4375 18.3235 2.4375 17.875V5.08788ZM16.8943 18.4494L18.5193 20.0744C18.8362 20.3921 19.3513 20.3921 19.6682 20.0744L22.1057 17.6369C22.4226 17.3201 22.4226 16.8049 22.1057 16.4881C21.7888 16.1712 21.2737 16.1712 20.9568 16.4881L19.0938 18.3511L18.0432 17.3006C17.7263 16.9837 17.2112 16.9837 16.8943 17.3006C16.5774 17.6174 16.5774 18.1326 16.8943 18.4494ZM22.23 4.0625H3.77L13 11.1621L22.23 4.0625Z" fill="#C2A74E" />
                        </svg>
                        <span> <?php echo esc_html($site_infor['site_email']); ?> </span>
                    <?php endif; ?>
                </a>
            </div>
        <?php } ?>

        <?php if ($item == 'address' && !empty($site_infor['site_address'])) { ?>
            <div class="bt-elwg-site-infor--item address">

                <?php if ($args['layout'] == 'style-1') : ?>
                    <div class="bt-elwg-site-infor--item-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none">
                            <path d="M2.34375 12.3438V12.0117C2.34375 6.68083 6.6808 2.34378 12.0117 2.34378C17.0204 2.34378 21.1514 6.17247 21.6325 11.0568L23.9817 13.1998C24.0087 12.9107 24.0234 12.6251 24.0234 12.3438V12.0117C24.0234 5.38849 18.635 2.86102e-05 12.0117 2.86102e-05C5.38846 2.86102e-05 0 5.38849 0 12.0117V12.3438C0 15.6935 1.92047 19.5969 5.70809 23.9455C8.45391 27.098 11.1613 29.2961 11.2753 29.3882L12.0117 29.9832V26.9373C9.63686 24.8564 2.34375 18.0042 2.34375 12.3438Z" fill="#212121" />
                            <path d="M22.7344 25.2539H19.2188V21.7383H22.7344V25.2539Z" fill="#212121" />
                            <path d="M8.20312 12.0117C8.20312 9.90832 9.90832 8.20313 12.0117 8.20313C14.1151 8.20313 15.8203 9.90832 15.8203 12.0117C15.8203 14.1151 14.1151 15.8203 12.0117 15.8203C9.90832 15.8203 8.20312 14.1151 8.20312 12.0117Z" stroke="#212121" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M26.6622 20.449V26.8226C26.6622 27.9302 25.7643 28.8281 24.6566 28.8281H17.236C16.1284 28.8281 15.2305 27.9302 15.2305 26.8226V20.449" stroke="#212121" stroke-width="2" stroke-miterlimit="10" />
                            <path d="M28.418 22.0059L20.9473 15.1905L13.4766 22.0059" stroke="#212121" stroke-width="2" stroke-miterlimit="10" stroke-linecap="square" />
                        </svg>
                    </div>
                    <div class="bt-elwg-site-infor--item-content">
                        <h4><?php echo esc_html__('Address:', 'cleanira') ?></h4>
                        <span> <?php echo esc_html($site_infor['site_address']); ?> </span>
                    </div>
                <?php else : ?>
                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 30 30" fill="none">
                        <path d="M2.34375 12.3438V12.0117C2.34375 6.68083 6.6808 2.34378 12.0117 2.34378C17.0204 2.34378 21.1514 6.17247 21.6325 11.0568L23.9817 13.1998C24.0087 12.9107 24.0234 12.6251 24.0234 12.3438V12.0117C24.0234 5.38849 18.635 2.86102e-05 12.0117 2.86102e-05C5.38846 2.86102e-05 0 5.38849 0 12.0117V12.3438C0 15.6935 1.92047 19.5969 5.70809 23.9455C8.45391 27.098 11.1613 29.2961 11.2753 29.3882L12.0117 29.9832V26.9373C9.63686 24.8564 2.34375 18.0042 2.34375 12.3438Z" fill="white" />
                        <path d="M22.7344 25.2539H19.2188V21.7383H22.7344V25.2539Z" fill="white" />
                        <path d="M8.20312 12.0117C8.20312 9.90832 9.90832 8.20313 12.0117 8.20313C14.1151 8.20313 15.8203 9.90832 15.8203 12.0117C15.8203 14.1151 14.1151 15.8203 12.0117 15.8203C9.90832 15.8203 8.20312 14.1151 8.20312 12.0117Z" stroke="white" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M26.6622 20.449V26.8226C26.6622 27.9302 25.7643 28.8281 24.6566 28.8281H17.236C16.1284 28.8281 15.2305 27.9302 15.2305 26.8226V20.449" stroke="white" stroke-width="2" stroke-miterlimit="10" />
                        <path d="M28.418 22.0059L20.9473 15.1905L13.4766 22.0059" stroke="white" stroke-width="2" stroke-miterlimit="10" stroke-linecap="square" />
                    </svg>
                    <span> <?php echo esc_html($site_infor['site_address']); ?> </span>
                <?php endif; ?>


            </div>
        <?php } ?>
        <?php if ($item == 'time' && !empty($site_infor['site_time'])) { ?>
            <div class="bt-elwg-site-infor--item time">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                    <g clip-path="url(#clip0_10935_2500)">
                        <path d="M10 17.5C13.797 17.5 16.875 14.422 16.875 10.625C16.875 6.82804 13.797 3.75 10 3.75C6.20304 3.75 3.125 6.82804 3.125 10.625C3.125 14.422 6.20304 17.5 10 17.5Z" stroke="#212121" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M4.375 2.5L1.875 5" stroke="#212121" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M15.625 2.5L18.125 5" stroke="#212121" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M10 6.25V10.625H14.375" stroke="#212121" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </g>
                    <defs>
                        <clipPath id="clip0_10935_2500">
                            <rect width="20" height="20" fill="white" />
                        </clipPath>
                    </defs>
                </svg>
                <span> <?php echo esc_html($site_infor['site_time']); ?> </span>
            </div>
        <?php } ?>
    <?php } ?>
<?php endif; ?>