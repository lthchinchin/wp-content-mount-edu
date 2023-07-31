<?php 
    #$thumbnail_video = '';
?>

<div class="intro-video-wrap" style="background: url('<?= $thumbnail_video ? $thumbnail_video : $banner_main; ?>') no-repeat center top;background-size: cover;">
    <a class="popup-video" data-fancybox href="<?= $candidate_intro_video ?>">
        <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g filter="url(#filter0_b_69_22448)">
                <rect width="48" height="48" rx="24" fill="#050505" fill-opacity="0.3" />
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M24 5C34.4918 5 43 13.5063 43 24C43 34.4937 34.4918 43 24 43C13.5063 43 5 34.4937 5 24C5 13.5063 13.5063 5 24 5Z"
                    stroke="#FCFDFF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M30 23.9903C30 22.368 21.6851 17.1782 20.7418 18.1114C19.7986 19.0446 19.7079 28.8481 20.7418 29.8692C21.7758 30.8939 30 25.6125 30 23.9903Z"
                    stroke="#FCFDFF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            </g>
            <defs>
                <filter id="filter0_b_69_22448" x="-8" y="-8" width="64" height="64" filterUnits="userSpaceOnUse"
                    color-interpolation-filters="sRGB">
                    <feFlood flood-opacity="0" result="BackgroundImageFix" />
                    <feGaussianBlur in="BackgroundImageFix" stdDeviation="4" />
                    <feComposite in2="SourceAlpha" operator="in" result="effect1_backgroundBlur_69_22448" />
                    <feBlend mode="normal" in="SourceGraphic" in2="effect1_backgroundBlur_69_22448" result="shape" />
                </filter>
            </defs>
        </svg>
    </a>
</div>


