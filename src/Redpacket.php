<?php

namespace App;

use App\Common\Common;

class Redpacket
{
    public $min = 0.01;  // 最小领取金额
    public $number;
    public $money;

    public function __construct($money = 0, $number = 0, $min = 0.01)
    {
        $this->number = $number;
        $this->money = $money;
        $this->min = $min;
    }

    /**
     * @return array
     */
    public function fill_red()
    {
        $money_list = array_fill(0, $this->number, $this->min);
        $return_list = [];

        $this->money -= $this->min * $this->number;

        while ($this->money > 0) {
            $index = rand(0, $this->number - 1);  //随机找人
            $seek = rand($this->min * 100, round($this->money / $this->number, 4) * 100) / 100;  //随机种子
            $money_list[$index] += round(min($seek, $this->money), 2);  //把种子播某个人身上，红包金额累加
            $this->money -= $seek;
        }
        shuffle($money_list);
        $return_list['money'] = $money_list;
        $return_list['total'] = array_sum($money_list);
        return $return_list;
    }

    /**
     * @return array
     */
    public function red()
    {
        $money_list = [];
        $return_list = [];

        for ($i = 1; $i < $this->number; ++$i) {
            $max = round($this->money, 2) / ($this->number - $i);
            $random = 0.01 + mt_rand() / mt_getrandmax() * (0.99 - 0.01);
            $money = $random * $max;
            $money = $money <= $this->min ? 0.01 : $money;
            $money = floor($money * 100) / 100;
            $this->money -= $money;
            $money_list[$i] = round($money, 2);
        }
        $money_list[$i] = round($this->money, 2);
        shuffle($money_list);
        $return_list['money'] = $money_list;
        $return_list['total'] = array_sum($money_list);
        return $return_list;
    }

    /**
     * @param int $num
     */
    public function test($cycles = 2)
    {
        $common = new Common();
        $time_start = $common->time->microtime_float();
        for($i = 0; $i < $cycles; $i++) {
            $redpacket = new Redpacket($this->money, $this->number);
            $arr = $redpacket->red();
            //$common->dump($arr);
        }
        $time_end = $common->time->microtime_float();
        $time = $time_end - $time_start;
        echo 'Usage time: ' . ($time) . 's';
    }
}