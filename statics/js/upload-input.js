(function($) {
	var form_temp = [];		
	var toAppend = [
		'<form id="form_upfile" action="" method="post" enctype="multipart/form-data">',
            '<input id="upfile" class="file_upload hide" type="file" name="upfile" filetype="img">',
        '</form>'
	].join('');
	
	form_temp.push(toAppend);

	if($('.form_temp').length < 1){
		$('body').append('<div class="form_temp hide"></div>');
	}
	$('.form_temp').append(form_temp.join(''));
 	$('.choose_btn').click(function(){
 		var input= $('#upfile');	
 		input.attr('from', $(this).attr('id'));
 		input.click();
 	});
 	$('.file_upload').on('change',function(){
 		var from=$('#upfile').attr('from');
 		var thisUrl = $('.'+from).parent().attr('data-url');
        var thisType = $(this).attr('filetype'),        
 			maxSize  = 1*1024*1024;
 		$(this).upload({
 			url     : thisUrl,
 			maxSize : maxSize,
 			img : {
				img : ['jpg','JPG','jpeg','JPEG','gif','GIF','png','PNG']
			},
 			sucFn   : function(json){
 				var from=$('#upfile').attr('from');
 				var domainUrl = $('.'+from).attr('domain-url');
 				json = $.parseJSON(json);
 				if(json.state == 'SUCCESS'){
 					$('input[up-id='+ from+']').val(json.url);
 					$('.'+ from).html($('<img />').attr('src', domainUrl+json.url));
 				}else{
                    alert(json.state);
 				}
 			}
 		});
 	});

})(jQuery)