yii2-foundation ALPHA
=====================

Foundation extension for Yii 2 (ALPHA - do not use on a production server)

The extension was developed for personal use, but since sharing is caring, here it is.
It is ported from Bootstrap to ensure to maintain the highest level of compatibility.


Installation
------------

Edit your config/AppAsset.php so it looks like this
```php
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $depends = array(
        'yii\web\YiiAsset',
        'Simpletree\Foundation\FoundationAsset'
    );
}
```

Configuration
-------------

To compile SASS on page load set FoundationAsset::compile to self::COMPILE_AUTO or self::COMPILE_FORCE
and  FoundationAsset::publishOptions['forceCopy'] to true.
