<?php

namespace Radpack\Common;

class Common
{
    public $file, $time;

    public function __construct($filename = '')
    {
        $this->file = new File($filename);
        $this->time = new Time();
    }

    /**
     * 简单格式化输出信息
     * @param array $array
     */
    public function dump($array = [])
    {
        echo '<pre>' . print_r($array, TRUE) . '</pre>';
    }

    /**
     * 求一个数的平方
     * @param $n
     * @return mixed
     */
    public function sqr($n)
    {
        return $n * $n;
    }

    /**
     * 生成min和max之间的随机数，但是概率不是平均的，从min到max方向概率逐渐加大。
     * 先平方，然后产生一个平方值范围内的随机数，再开方，这样就产生了一种“膨胀”再“收缩”的效果。
     * @param $bonus_min
     * @param $bonus_max
     * @return int
     */
    public function xRandom($bonus_min, $bonus_max)
    {
        $sqr = intval($this->sqr($bonus_max - $bonus_min));
        $rand_num = rand(0, ($sqr - 1));
        return intval(sqrt($rand_num));
    }
}