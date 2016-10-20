$(document).ready(function(){
	$('#category_multi_select').multiSelect();	
	CKEDITOR.replace( 'article-content-vn' );
	CKEDITOR.replace( 'article-content-us' );

	$('.btn-reset-data').livequery('click',function(){
		$(':input','#form-add-article')
		  .not(':button, :submit, :reset, :hidden')
		  .val('')
		  .removeAttr('checked')
		  .removeAttr('selected');
		CKEDITOR.instances['article-content-vn'].setData('');
	});

	Dropzone.autoDiscover = false;
	$(".dropzone").dropzone({
        url: "article/add",
        autoProcessQueue: false,
        headers: {
        	'X-CSRF-TOKEN': $('meta[name="__public_token"]').attr('content')
    	},
        uploadMultiple: true,
        parallelUploads: 100,
        maxFiles: 100,
        acceptedFiles: "image/*",
        clickable: [".fileinput-button", "#dropzone"],

        init: function () {
        	
            var submitButton = $('.btn-add-article');
            var wrapperThis = this;

            $('.btn-add-article').livequery("click", function (e) {
            	e.preventDefault();
            	e.stopPropagation();
                wrapperThis.processQueue();
            });

            this.on("addedfile", function (file) {
            	$('.dz-progress').css({
            		display: 'none'
            	});
            	if(file){
            		$('.dz-success-mark').css({opacity: '100'});
            	}
            	
                var removeButton = Dropzone.createElement("<button class='btn'>Remove File</button>");
                removeButton.addEventListener("click", function (e) {
                    e.preventDefault();
                    e.stopPropagation();
                    wrapperThis.removeFile(file);
                });
                file.previewElement.appendChild(removeButton);
            });

            this.on('sendingmultiple', function (data, xhr, formData) {
            	var content_vn = CKEDITOR.instances['article-content-vn'].getData();
    			var content_us = CKEDITOR.instances['article-content-us'].getData();
            	$("form#form-add-article :input").each(function(){
            		if (typeof($(this).attr('name')) !== "undefined"){
            			formData.append($(this).attr('name'), $(this).val());
            		}            		
            	});
            	formData.append('article[vn][content]', content_vn);
            	formData.append('article[us][content]', content_us);
            });
            this.on("successmultiple", function(files, response) {            	
            	if(response){
            		swal({
                      title: "Thông báo",
                      type: response.code,
                      text: response.message,
                      timer: 2000,
                      showConfirmButton: false
                    });
            	}
        	});
        }
    });
   	
});