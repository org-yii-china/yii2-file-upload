<?php
namespace common\widgets\file_upload;
/**
 * @see Yii中文网  http://www.yii-china.com
 * @author Xianan Huang <Xianan_huang@163.com>
 * 图片上传组件
 * 如何配置请到官网（Yii中文网）查看相关文章
 */
 
use Yii;
use yii\base\Action;
use yii\helpers\ArrayHelper;
use common\widgets\file_upload\Uploader;

class UploadAction extends Action
{
    /**
     * 配置文件
     * @var array
     */
    public $config = [];
    
    public function init()
    {
        //close csrf
        Yii::$app->request->enableCsrfValidation = false;
        //默认设置
        $_config = require(__DIR__ . '/config.php');
        //load config file
        $this->config = ArrayHelper::merge($_config, $this->config);
        parent::init();
    }
    
    public function run()
    {
        $action = Yii::$app->request->get('action');
        switch ($action) {
                /* 上传图片 */
            case 'uploadimage':
                /* 上传文件 */
            case 'uploadfile':
                $result = $this->ActUpload();
                break;
            default:
                $result = json_encode(array(
                    'state' => '请求地址出错'
                ));
                break;
        }
        echo $result;
    }
    
    /**
     * 上传
     * @return string
     */
    protected function ActUpload()
    {
        $base64 = "upload";
        switch (htmlspecialchars($_GET['action'])) {
            
            case 'uploadimage':
                $config = array(
                "pathFormat" => $this->config['imagePathFormat'],
                "maxSize" => $this->config['imageMaxSize'],
                "allowFiles" => $this->config['imageAllowFiles'],
                );
                $fieldName = $this->config['imageFieldName'];
                break;
                
            case 'uploadfile':
            default:
                $config = array(
                "pathFormat" => $this->config['filePathFormat'],
                "maxSize" => $this->config['fileMaxSize'],
                "allowFiles" => $this->config['fileAllowFiles']
                );
                $fieldName = $this->config['fileFieldName'];
                break;
        }
        $config['uploadFilePath'] = isset($this->config['uploadFilePath'])?$this->config['uploadFilePath']:'';
        /* 生成上传实例对象并完成上传 */
        $up = new Uploader($fieldName, $config, $base64);
        /**
         * 得到上传文件所对应的各个参数,数组结构
         * array(
         *     "state" => "",          //上传状态，上传成功时必须返回"SUCCESS"
         *     "url" => "",            //返回的地址
         *     "title" => "",          //新文件名
         *     "original" => "",       //原始文件名
         *     "type" => ""            //文件类型
         *     "size" => "",           //文件大小
         * )
        */
        /* 返回数据 */
        return json_encode($up->getFileInfo());
    }
}