<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace vendor\simpletree\yii2foundation;

use yii\web\AssetBundle;

/**
 *
 * @author Jakob Rosenberg <jakobrosenberg@gmail.com>
 */
class FoundationPluginAsset extends AssetBundle
{
	public $sourcePath = '@vendor/simpletree/yii2foundation/assets';
	public $js = array(
		'js/foundation/foundation.js',
		'js/foundation/foundation.forms.js',
	);
	public $depends = array(
		'yii\web\JqueryAsset',
		'vendor\simpletree\yii2foundation\FoundationAsset',
	);

    public function registerAssets($view){
        parent::registerAssets($view);
        $view->registerJs('$(document).foundation();', $view::POS_END);

    }
}
