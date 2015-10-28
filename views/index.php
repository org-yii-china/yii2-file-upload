<?php
use yii\helpers\Html;
?>
<div class="per_upload_con" data-url="<?=$config['serverUrl']?>">
    <div class="per_real_img" domain-url = "<?=$config['domain_url']?>"></div>
    <div class="per_upload_img">图片上传</div>
    <div class="per_upload_text">
        <p class="upbtn"><a href="javascript:;" class="btn btn-success green choose_btn">选择图片</a></p>
        <p class="rule">仅支持文件格式为jpg、jpeg、png以及gif<br>大小在1MB以下的文件</p>
    </div>
    <input type="hidden" name="<?=$inputName?>" upname='<?=$config['fileName']?>' value="<?=isset($inputValue)?$inputValue:''?>" filetype="img" />
</div>