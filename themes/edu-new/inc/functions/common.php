<?php
function get_client_ip()
{
    $ipaddress = null;
    if (isset($_SERVER['HTTP_CLIENT_IP'])) {
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        return $ipaddress;
    }
    if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        return $ipaddress;
    }
    if (isset($_SERVER['HTTP_X_FORWARDED'])) {
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        return $ipaddress;
    }
    if (isset($_SERVER['HTTP_FORWARDED_FOR'])) {
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        return $ipaddress;
    }
    if (isset($_SERVER['HTTP_FORWARDED'])) {
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
        return $ipaddress;
    }
    if (isset($_SERVER['REMOTE_ADDR'])) {
        $ipaddress = $_SERVER['REMOTE_ADDR'];
        return $ipaddress;
    }
    return $ipaddress;
}

/**
 * rand ip func
 */
function random_ip() {
    // tạo ra 4 số ngẫu nhiên từ 0 đến 255
    $octet1 = rand(0, 255);
    $octet2 = rand(0, 255);
    $octet3 = rand(0, 255);
    $octet4 = rand(0, 255);

    // kết hợp các số lại thành địa chỉ IP
    $ip = $octet1 . '.' . $octet2 . '.' . $octet3 . '.' . $octet4;

    return $ip;
}
