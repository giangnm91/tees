$(function() {
    "use strict";

    $('#LoginForm').submit(function(e) {
    	var $block = $(this);
    	$block.block({
            message: '<div id="loader"></div>', 
            css: { border: '0px', 'background-color' : 'transparent' } 
        });    	
    	$.ajax({
    	   	type: 'POST',
	    	dataType: 'json',
	    	data: $block.serialize(),
	    })
	    .done(function(json, status) {
	    	if(json.code == 'success') {
	    		swal({
				  title: "Tuyệt vời!",
				  type: "success",
				  text: 'Bạn đã truy cập thành công.',
				  timer: 2000,
				  showConfirmButton: false
				});
				window.location.href = json.comeback;
	    	}
	    	else {
	    		swal({
				  title: "Không ổn rồi!",
				  type: "warning",
				  text: json.message,
				  timer: 2000,
				  html: true,
				  showConfirmButton: false
				});
	    	}
	    })
	    .fail(function(xhr) {
	    	swal({
			  title: xhr.status == 422 ? "Không ổn rồi!" : "Thật tệ!",
			  type: "warning",
			  text: xhr.status == 422 ? xhr.responseJSON.message : 'Có vẻ như server đang quá tải.',
			  timer: 2000,
			  html: true,
			  showConfirmButton: false
			});
	    })
	    .always(function() {
	    	$block.unblock();
	    });
	    e.preventDefault();
    });   

});