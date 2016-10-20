$(document).ready(function(){
	var menuObj = $('#initMenu').val();
	function buildItem(item) {
	    var html = "<li class='dd-item' data-slug='" + item.Slug + "' data-title='" + item.CategoryName + "' data-id='" + item.CategoryID + "' id='" + item.CategoryID + "'>";
	    html += "<a href='javascript:;'' class='pull-right delete-category' data-id='" + item.CategoryID + "'><i class='fa fa-trash'></i></a><div class='dd-handle'>" + item.CategoryName + "</div>";
	    if (item.children) {
	        html += "<ol class='dd-list'>";
	        $.each(item.children, function (index, sub) {

	            html += buildItem(sub);
	        });
	        html += "</ol>";
	    }
	    html += "</li>";
	    return html;
	}

	$.each(JSON.parse(menuObj), function (index, item) {
    	$('#nestable_list_menu #list-menu').append(buildItem(item));
 	});

	$('.dd').nestable({});

	$('.icon-picker').iconpicker();

	$('#formAddMenu').livequery('submit', function(e){
		e.preventDefault();
		var data = $(this).serialize();
		$.ajax({
			url: 'system/menu',
			type: 'POST',
			dataType: 'json',
			data: data,
		})
		.done(function(data) {
			if(data.code == 'success'){
				$('#list-menu').append(data.html);
			}
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});		
	});

	$('.btn-save-menu').livequery('click',function(){
		var elem = $(this);
		var data = $('.dd').nestable('serialize');	
		//console.log(data);return false;
		data = 'obj='+ JSON.stringify(data);
		$.ajax({
			url: 'system/menu',
			type: 'PUT',
			dataType: 'json',
			data: data,
			headers: {
			    'X-CSRF-TOKEN': $('meta[name="__public_token"]').attr('content')
      		},
		})
		.done(function(data) {
			toastr.success(data.message);
		})
		.fail(function(data) {
			toastr.error(data.message);
		})
		.always(function() {
			console.log("complete");
		});
		
	});

	$('.delete-category').livequery('click',function(){
		var elem = $(this);
		var category_id = elem.attr('data-id');
		swal({
		  title: "Bạn có chắc chắn?",
		  text: "Tất cả category con của category này sẽ bị xoá cùng!",
		  type: "warning",
		  showCancelButton: true,
		  confirmButtonColor: "#DD6B55",
		  confirmButtonText: "Xoá",
		  closeOnConfirm: false
		},
		function(){
			$.ajax({
				url: 'system/menu/' + category_id,
				type: 'DELETE',
				dataType: 'json',
				data: {},
				headers: {
			    	'X-CSRF-TOKEN': $('meta[name="__public_token"]').attr('content')
      			},
			})
			.done(function(data) {
				if (data.code == 200){
					toastr.success(data.message);
					return false;
				}
				swal("Opps!", "Xoá chưa thành công", "error");
			})
			.fail(function() {
				toastr.error(data.message);
			})
			.always(function() {
				console.log("complete");
			});
		});
	});
});	