<?php defined('BASEPATH') OR exit('No direct script access allowed.');

// 'smtp_user' => 'noreply.3e@gmail.com',
// 'smtp_pass' => 'wzmdvqtjrpyvgktk',
// 'smtp_user' => '3efordev@gmail.com',
// 'smtp_pass' => 'ddldxucakpubxbef',

$config = array(
    'protocol'      => 'smtp', // 'mail', 'sendmail', or 'smtp'
    'smtp_host'     => 'smtp.gmail.com',
    'smtp_port'     => 465,
    'smtp_user'     => 'noreply.3e@gmail.com',
    'smtp_pass'     => 'wzmdvqtjrpyvgktk',
    'smtp_crypto'   => 'ssl', //can be 'ssl' or 'tls' for example
    'mailtype'      => 'html', //plaintext 'text' mails or 'html'
    'smtp_timeout'  => '4', //in seconds
    'charset'       => 'utf-8',
    'wordwrap'      => TRUE
);

// $config = array(
//     'protocol'      => 'smtp', // 'mail', 'sendmail', or 'smtp'
//     'smtp_host'     => 'smtp.gmail.com',
//     'smtp_port'     => 465,
//     'smtp_user'     => 'local.ccfo@gmail.com',
//     'smtp_pass'     => 'tmqmizznjncbmiwt',
//     'smtp_crypto'   => 'ssl', //can be 'ssl' or 'tls' for example
//     'mailtype'      => 'html', //plaintext 'text' mails or 'html'
//     'smtp_timeout'  => '4', //in seconds
//     'charset'       => 'utf-8',
//     'wordwrap'      => TRUE
// );


