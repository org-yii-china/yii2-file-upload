(function($) {

	var form_temp = [];
	var domainUrl = $('.per_upload_con .per_real_img').attr('domain-url');
	var up = $('.per_upload_con>input');
	var thisName = up.attr('upname'),
		fileType = up.attr('filetype'),
	toAppend = [
		'<form id="form_'+thisName+'" action="" method="post" enctype="multipart/form-data">',
            '<input id="'+thisName+'" class="file_upload hide" type="file" name="'+thisName+'" filetype="'+fileType+'">',
        '</form>'
	].join('');
	form_temp.push(toAppend);
    var thisType = up.attr('filetype');
    var thisVal = up.val();
    if(thisVal != ''){
    	up.parent().find('.per_real_img').append('<img src="'+domainUrl+thisVal+'" />').end()
            .find('.choose_btn').text('重新选择').end()
            .find('.per_upload_img').addClass('empty').empty();
    }

	if($('.form_temp').length < 1){
		$('body').append('<div class="form_temp hide"></div>');
	}
	$('.form_temp').append(form_temp.join(''));
 	$('.choose_btn, .per_upload_img, .per_real_img').click(function(){
 		//var thisName = $(this).parents('.per_upload_con:first').children('input').attr('name');
 		//$('#'+thisName).click();
 		$('#'+thisName).click();
 	});
 	$('.file_upload').on('change',function(){
        var thisType = $(this).attr('filetype'),
 			maxSize  = 1*1024*1024;
 		$(this).upload({
 			url     : $('.per_upload_con').attr('data-url'),
 			maxSize : maxSize,
 			fileType : {
				img : ['jpg','JPG','jpeg','JPEG','gif','GIF','png','PNG']
			},
 			sucFn   : function(json){
 				json = $.parseJSON(json);
 				if(json.state == 'SUCCESS'){
 						$('input[upname='+thisName+']').parent()
 							.find('.per_real_img').empty().append('<img src="'+domainUrl+json.url+'">').end()
                            .find('.per_upload_img').addClass('empty').empty().end()
                            .find('.choose_btn').text('重新选择');
                        $('input[upname='+thisName+']')[0].value = json.url;
 				}else{
                    alert(json.state);
 				}
 			}
 		});
 	});

})(jQuery)