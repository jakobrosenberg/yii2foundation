<?php
/**
 * Created by Jakob
 * Date: 18-09-13
 * Time: 08:18
 */

namespace Simpletree\Foundation;

use Yii;
use Simpletree\Foundation\Html;


class SideNav extends NavigationBaseWidget
{

    public $emptyItemString = '<li class="divider"></li>';

    public $encodeLabels = false;

    public $options = array('tag'=>'ul','class'=>'side-nav');

    public $itemOptions = array('tag'=>'li');

} 