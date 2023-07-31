<?php get_header(); ?>
<?php
$pageid = get_the_ID();
/*
* Create variable custome fields loop.
*
*/
$arr_metakey = array(
    'banner_main',
    'candidate_dob',
    'city',
    'candidate_job',
    'candidate_intro_video',
    'candidate_intro',
    'career',
    'awards',
    'achievements',
    'thumbnail_video',
    'company'
     );
foreach($arr_metakey as $key => $metakey):
    $$metakey = get_field($metakey,$pageid);
endforeach;
$thumb_url = get_the_post_thumbnail_url($pageid,'full');
!$thumb_url ? $thumb_url = TEMPLATE_DIR . '/assets/images/image_notfound.png' : '';
$indx_cand_rank = array_search($pageid, varsvote_db_get_rank_list());
$candidate_rank = $indx_cand_rank === false ? '--' : $indx_cand_rank+1;
$fans = varsvote_db_get_fan($pageid);

$candidateObj = array(
  "name" => get_the_title(),
  "id" => $pageid,
  "company" => $candidate_job,
  "votes" => $fans,
  "thumbnail" => $thumb_url,
  "permalink" => get_permalink(),
);
// Chuyển đổi đối tượng JSON sang chuỗi JSON
$candidateJSON = json_encode($candidateObj);
?>
<main class="candidate">
    <div class="candidate__banner"
        style="background: linear-gradient(to bottom, rgba(250, 251, 252, 0), rgba(2, 13, 34, 0.5)), url('<?= $banner_main ? $banner_main : $thumb_url; ?>')">
        <div class="content">
            <div class="container">
                <div class="content__top">
                    <div class="candidate-name">
                        <h1 class="">
                            <?php 
                                $name_splt = explode(" ", get_the_title());
                                foreach ($name_splt as $value) {
                                    echo array_search($value, $name_splt) == 0 ? "<span class='sub-co'>$value</span><br>" : $value;
                                    echo " ";
                                }
                            ?>
                        </h1>
                        <p><?= $company ?></p>
                    </div>
                    <?php if($city): ?>
                    <div class="candidate-location">
                        <img src="<?= TEMPLATE_DIR ?>/assets/images/icon/location.svg" alt="<?= $city ?>">
                        Khu vực : <?= $city ?>
                    </div>
                    <?php endif; ?>
                </div>
                <div class="content__bottom">
                    <div class="candidate-dob"><?= $candidate_dob ?></div>
                    <span class="mx-3 <?= !$candidate_dob || !$candidate_job ? 'd-none' : '' ?>">|</span>
                    <div class="candidate-company"><?= $candidate_job ?></div>
                </div>
            </div>
        </div>
    </div>
    <div class="candidate__content">
        <div class="container">
            <div class="candidate__content__vote">
                <div class="vote-date-wrapper ">
                    <div class="swiper-container swiper-vote-dates" data-autoplay="true" data-desktop="3"
                        data-tablet="3" data-mobile="1" data-swiper-class="swiper-vote-dates"
                        data-next-class="swiper-button-nextx" data-prev-class="swiper-button-prevx">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="date-item">
                                    <div class="date-item__top">
                                        <h4>Số lượt bình chọn</h4>
                                    </div>
                                    <div class="date-item__bottom">
                                        <div class="content">
                                            <?= varsvote_db_get_fan($pageid) ?> lượt bình chọn
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="date-item">
                                    <div class="date-item__top">
                                        <h4>STT</h4>
                                    </div>
                                    <div class="date-item__bottom">
                                        <div class="content">
                                            #<?= get_the_ID() ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="date-item">
                                    <div class="date-item__top">
                                        <h4>Xếp hạng hiện tại</h4>
                                    </div>
                                    <div class="date-item__bottom">
                                        <div class="content">
                                            <?= $candidate_rank ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="candidate__content__info">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="scroll-fixed">
                            <div class="candidate__info__img mb-24">
                                <img class="w-100" src="<?= $thumb_url ?>" loading="lazy" alt="<?= get_the_title() ?>">
                            </div>
                            <div id="" class="">
                                <a href="#" data-info='<?= $candidateJSON ?>'
                                    class="add-favorite btn btn-cus sub-bg border-white w-100">Thêm vào danh sách</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-9">
                        <div class="candidate__info__text">
                            <?php if($candidate_intro_video): ?>
                            <div class="candidate__info__video mb-48">
                            <?php include(locate_template('templates/pages/desktop/single/intro-video.php')); ?>
                            </div>
                            <?php endif; ?>
                            <?php if($candidate_intro): ?>
                            <div class="candidate__info__intro mb-48">
                                <h4 class="mb-16">TỰ GIỚI THIỆU</h4>
                                <p class="desc"><?= $candidate_intro ?></p>
                            </div>
                            <?php endif; ?>

                            <?php if($career): ?>
                            <div class="candidate__info__career mb-48">
                                <h4 class="mb-16">SỰ NGHIỆP</h4>
                                <div class="candidate__info__inner">
                                    <h5>Quá trình công tác</h5>
                                    <ul>
                                        <?php foreach($career as $key => $value): ?>
                                        <li><?= $value['job'] ?></li>
                                        <?php endforeach ?>
                                    </ul>
                                </div>
                            </div>
                            <?php endif; ?>

                            <?php if($awards || $achievements): ?>
                            <div class="candidate__info__career">
                                <h4 class="mb-16">GIẢI THƯỞNG & THÀNH TỰU</h4>
                                <div class="candidate__info__inner">
                                    <?php if($awards): ?>
                                    <h5>Giải thưởng</h5>
                                    <ul>
                                        <?php foreach($awards as $key => $value): ?>
                                        <li><?= $value['award'] ?></li>
                                        <?php endforeach ?>
                                    </ul>
                                    <?php endif; ?>
                                    <?php if($achievements): ?>
                                    <h5>Thành tựu</h5>
                                    <ul>
                                        <?php foreach($achievements as $key => $value): ?>
                                        <li><?= $value['achievement'] ?></li>
                                        <?php endforeach ?>
                                    </ul>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php get_template_part('templates/block/desktop/vote', 'panigation-blocks'); ?>
</main>
<script>


jQuery(document).ready(function($) {
  const myFavCandidates = localStorage.getItem("myFavCandidates")
    myFavItems = myFavCandidates ? JSON.parse(myFavCandidates) : [];
    const id = <?= $pageid ?>;
    const objWithId = myFavItems.find(obj => obj.id === id);
    if (objWithId) {
      let DefBtnAdd = $('.candidate__content__info .add-favorite')
      console.log('DefBtnAdd',DefBtnAdd);
      DefBtnAdd.toggleClass('add-favorite remove-favorite')
      DefBtnAdd.toggleClass('sub-bg sub-lighter-bg')
      DefBtnAdd.text('Xoá khỏi danh sách')
    }
  });

</script>
<?php get_footer('none'); ?>