<?php
require_once 'vendor/autoload.php';

use App\{
    Redpacket,
    Common\Common
};
use Monolog\{
    Logger,
    Handler\StreamHandler
};

define('FILENAME', __DIR__ . '/.redpacket');

$money = 0.1;  // 红包总金额
$num = 3;  // 红包领取的人数
$common = new Common();
$redpacket = new Redpacket($money, $num);

echo "有{$num}个红包, {$money}块<br><pre>";
$redpacket->test();


