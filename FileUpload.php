<?php
namespace common\widgets\file_upload;

use Yii;
use yii\widgets\InputWidget;
use yii\helpers\Html;
use yii\web\View;
use common\widgets\file_upload\assets\FileUploadAsset;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

class FileUpload extends InputWidget
{
    public $config = [];
	public $value = '';
    
    public function init()
    {
        $_config = [
            'serverUrl' => Url::to(['upload','action'=>'uploadimage']),  //上传服务器地址
            'fileName' => 'upfile',                                      //提交的图片表单名称 
            'domain_url' => '',                                          //图片域名 不填为当前域名
        ];
        $this->config = ArrayHelper::merge($_config, $this->config);

    }
    
    public function run()
    {
        $this->registerClientScript();        
        if ($this->hasModel()) {
            $inputName = Html::getInputName($this->model, $this->attribute);
            $inputValue = Html::getAttributeValue($this->model, $this->attribute);
            return $this->render('index',[
                'config'=>$this->config,
                'inputName' => $inputName,
                'inputValue' => $inputValue,
            ]);
        } else {
            return $this->render('index',[
                'config'=>$this->config,
                'inputName' => 'file-upload',
				'inputValue' => $value,
            ]);
        }
    }
    
    public function registerClientScript()
    {
        FileUploadAsset::register($this->view);
        //$script = "FormFileUpload.init();";
        //$this->view->registerJs($script, View::POS_READY);
    }
}