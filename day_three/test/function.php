<?php
namespace test;

//this is a test


class GoodsController
{
    public function actionIndex()
    {
        $addr = 'addr';
        $addr = strtr($addr,'abcd','efgh');

        $test = 'abcdefghijk';
        $demo = 'abcdedfghijk';
        var_dump(strncmp($test,$demo,4));
//echo $addr;



    }

}
