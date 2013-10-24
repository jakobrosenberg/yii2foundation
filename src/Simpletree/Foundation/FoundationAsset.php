<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */
namespace vendor\simpletree\yii2foundation;


//\Yii::$classMap['vendor\simpletree\yii2foundation\Html'] = __DIR__.'/Html.php';
//\Yii::$classMap['yii\helpers\Html'] = __DIR__.'/Html.php';


use yii\base\InvalidConfigException;
use yii\base\View;
use yii\helpers\ArrayHelper;
use yii\web\AssetBundle;
use Yii;
use yii\base\ErrorException;


/**
 * @author Jakob Rosenberg <jakobrosenberg@gmail.com>
 */
class FoundationAsset extends AssetBundle
{
    //force overwrite of assets
    public $publishOptions = array(
        'forceCopy'=>false
    );

    const COMPILE_NEVER = 0;
    const COMPILE_AUTO = 1;
    const COMPILE_FORCE = 2;

    public $compile = self::COMPILE_AUTO;

    public $compassPath = 'Z:\wamp\bin\Ruby193\bin\compass.bat';
    public $rubyDir = 'Z:\wamp\bin\Ruby193\bin\\';
    public $foundationProjectDir = __DIR__;
    public $compileExtention = 'scss';

	public $sourcePath = '@vendor/simpletree/yii2foundation/assets';

    public $js = array(
        'js/vendor/custom.modernizr.js',
    );
	public $css = array(
		'css/app.css',
//		'css/test.scss',
//		'css/normalize.css',
	);
    public $jsOptions = array(
        'position'=>View::POS_HEAD
    );

    public function init()
    {
        Yii::trace('Loading Foundation extension');
        if($this->compile >= self::COMPILE_AUTO)
            $this->compassCompile();

        parent::init();
    }

    public function compassCompile()
    {

        $compassConfigFile = str_replace('#', ';', file_get_contents($this->foundationProjectDir.'/config.rb'));
        $compassConfig = parse_ini_string($compassConfigFile);

        $dir = $this->foundationProjectDir.DIRECTORY_SEPARATOR.$compassConfig['sass_dir'];

        $timeSignature = $this->getTimeSignature($dir);


        if($this->compile===self::COMPILE_FORCE || Yii::$app->getCache()->get('compassTimeSignature') !== $timeSignature)
        {
            $this->publishOptions['forceCopy'] = true;
            Yii::beginProfile('Compass Compile');

            $command = 'cd ' . escapeshellarg($this->rubyDir) . ' && ' .
                escapeshellarg($this->compassPath). ' compile '. escapeshellarg($this->foundationProjectDir);

            exec($command, $output, $error);

            if($error){
                Yii::warning("An error was encountered while trying to execute the following command: \n".$command. "\n Check Apache logs or disable Compiling in FoundationAsset.php");
//                throw new ErrorException("An error was encountered while trying to execute the following command: \n".$command. "\n Check Apache logs or disable Compiling in FoundationAsset.php", 500);
            }
            else
                Yii::trace("Compass finished compiling successfully: \n". $command . "\n " . implode("\n ", $output));

            Yii::$app->cache->set('compassTimeSignature', $timeSignature);
            Yii::endProfile('Compass Compile');
        }


    }

    public function getTimeSignature($dir)
    {


        $timeSignature = '';
        foreach(scandir($dir) AS $file)
        {
            $path = $dir.DIRECTORY_SEPARATOR.$file;

            if(is_file($path) && preg_match('/\.'.$this->compileExtention.'$/', $path)){
                $timeSignature .= '['.$file.filemtime($path).']';
            }elseif(is_dir($path) && !in_array($file, array('.', '..'))){
                $timeSignature .= $this->getTimeSignature($path);
            }

        }
        return $timeSignature;
    }

}
