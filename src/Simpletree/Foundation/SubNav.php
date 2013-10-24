<?php
/**
 * Created by Jakob
 * Date: 18-09-13
 * Time: 08:18
 */

namespace vendor\simpletree\yii2foundation;

use Yii;
use vendor\simpletree\yii2foundation\Html;


class SubNav extends NavigationBaseWidget
{
    /**
     * Shifts the first item from the items list and renders it as the title
     * @var bool
     */
    public $firstItemIsTitle = true;

    public $options = array('tag'=>'dl','class'=>'sub-nav');

    public $itemOptions = array('tag'=>'dd');

} 