<?php
/**
 * Created by PhpStorm.
 * User: wap58
 * Date: 21/12/18
 * Time: 10:16
 */

Abstract class Topping implements IMeal
{
    protected $IMeal;

    public function __construct(IMeal $IMeal)
    {
        $this->IMeal = $IMeal;
    }

}
