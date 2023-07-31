<?php

/*
* Create by Rickychuong 2022/11/01
*/

// require get_template_directory() . '/awss3/amazon-s3-and-cloudfront-tweaks.php';
require_once('amazon-s3-and-cloudfront-tweaks.php');
//Rickychuong add to load amazon-s3: 2022/11/01 BEGIN{

//define('AS3CF_SETTINGS', serialize(array(
function setBucketRunningEnv()
{
    define('AS3CF_SETTINGS', (array(
        'provider' => 'aws',
        'access-key-id' => ACCESS_KEY_ID,
        'secret-access-key' => ACCESS_ACCESS_KEY,
        'minio_url_domain' => MINIO_URL_DOMAIN,
        'minio_endpoint' => MINIO_ENDPOINT,
        'bucket_url' => BUCKET_URL
    )));
}
setBucketRunningEnv();

function awss3_trigger_replaceToS3Url($url, $themes = null)
{
    if (!defined('AS3CF_SETTINGS')) {
        return $url;
    }

    $domain = str_replace("http://", "", site_url());
    $domain = str_replace("https://", "", $domain);


    $newUrl = str_replace("http://", "", $url);
    $newUrl = str_replace("https://", "", $newUrl);

    $newUrl = str_replace($domain . "/wp-content/uploads", AS3CF_SETTINGS["minio_url_domain"] . AS3CF_SETTINGS["bucket_url"], $newUrl);

    return $newUrl;
}

function awss3_getThumbNone()
{
    if (!defined('AS3CF_SETTINGS')) {
        return get_bloginfo('template_url') . '/assets/images/no-image-thumb.png';
    }

    return AS3CF_SETTINGS["minio_url_domain"] . AS3CF_SETTINGS["bucket_url"] . "/no-image-thumb.png";
}

if (defined('AS3CF_SETTINGS')) {
    add_filter('wp_get_attachment_url', 'clrs_get_attachment_url', 10, 2);
    add_filter('wp_get_attachment_image_url', 'clrs_get_attachment_url', 10, 2);
    function clrs_get_attachment_url($url, $post_id)
    {
        return awss3_trigger_replaceToS3Url($url);
    }
}