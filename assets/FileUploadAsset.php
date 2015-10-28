<?php
/**
 * @link http://www.yii-china.com/
 * @copyright Copyright (c) 2015 Yii中文网
 */

namespace common\widgets\file_upload\assets;

use Yii;
use yii\web\AssetBundle;

/**
 * @author Xianan Huang <xianan_huang@163.com>
 */
class FileUploadAsset extends AssetBundle
{
    public $css = [
        'css/upload.css',
        
    ];
    
    public $js = [
        'js/jquery.form.js',
        'js/upload.js',
        'js/upload-input.js',
    ];
    
    public $depends = [
        'yii\web\YiiAsset',
    ];
    
    /**
     * 初始化：sourcePath赋值
     * @see \yii\web\AssetBundle::init()
     */
    public function init()
    {
        $this->sourcePath = dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR . 'statics';
    }
}