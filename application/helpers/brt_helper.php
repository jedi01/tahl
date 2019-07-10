<?php

/**
 * Author S Brinta<brrinta@gmail.com>
 * Email: brrinta@gmail.com
 * Web: https://brinta.me
 * Do not edit file without permission of author
 * All right reserved by S Brinta<brrinta@gmail.com>
 * Created on : Apr 30, 2018, 3:40:29 PM
 */
function getEncryptedText($id) {
    $CI = & get_instance();
    return $CI->encrypt->encode($id);
}

function getDecodedText($id) {
    $CI = & get_instance();
    return $CI->encrypt->decode($id);
}

function dnd($data) {
    echo "<pre>";
    var_dump($data);
    echo "</pre>";
    echo "<br>";
    echo "<br>";
}

function dnp($data) {
    echo "<pre>";
    print_r($data);
    echo "</pre>";
    echo "<br>";
    echo "<br>";
}

function changeDateFormat($date, $format = "Y-m-d") {
    return date($format, strtotime(str_replace(",", " ", $date)));
}

/**
 * 120x120 logo
 * @return logo url
 */
function logoSrc($size = 120) {
    return property_url("images/logo.svg");
}

function property_url($uri = "") {
    return base_url("property/" . $uri);
}

function login_url($getParameter = "") {
    return base_url("login" . ($getParameter ? "?" . $getParameter : ""));
}

function signup_url($getParameter = "") {
    return base_url("signup" . ($getParameter ? "?" . $getParameter : ""));
}

function recover_url($uri = "") {
    return base_url("recover/" . $uri);
}

function home_url($uri = "") {
    return base_url("site/" . $uri);
}

function dashboard_url($uri = "") {
    return base_url("dashboard/" . $uri);
}

function user_url($uri = "/") {
    return base_url("user/" . $uri);
}

function settings_url($uri = "/") {
    return base_url("settings/" . $uri);
}

function tmtsub_url($uri = "") {
    return base_url("dashboard/" . $uri);
}
