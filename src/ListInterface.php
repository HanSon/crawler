<?php
/**
 * Created by PhpStorm.
 * User: hanson
 * Date: 16-5-19
 * Time: 上午2:08
 */

namespace Hanccc;


interface ListInterface
{

    /**
     * @param $page int
     * @return string
     */
    public function getEachPageUrl($page);
    
    public function setMaxPage();
}