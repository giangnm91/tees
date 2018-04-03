$(document).ready(function(){
	var menuObj = $('#initMenu').val();
	function buildItem(item) {
	    var html = "<li class='dd-item' data-title='" + item.name + "' data-id='" + item.id + "' id='" + item.id + "'>";
	    html += "<a href='javascript:;'' class='pull-right delete-category' data-id='" + item.id + "'><i class='fa fa-trash'></i></a><div class='dd-handle'>" + item.name + "</div>";
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

	$('#formAddCategory').livequery('submit', function(e){
		e.preventDefault();
		var data = $(this).serialize();
		$.ajax({
			url: 'category',
			type: 'POST',
			dataType: 'json',
			data: data,
		})
		.done(function(data) {
			if(data.code == 200){
				swal({
				  title: "Thành công!",
				  type: "success",
				  text: data['message'],
				  timer: 1000,
				  showConfirmButton: false
				});
				$('#list-menu').append(data.html);
			} else {
				swal({
				  title: "Thất bại!",
				  type: "error",
				  text: data['message'],
				  timer: 1000,
				  showConfirmButton: false
				});
				return false;
			}
		})
		.fail(function() {
			console.log("error");
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
				url: 'category/' + category_id,
				type: 'DELETE',
				dataType: 'json',
				data: {},
				headers: {
			    	'X-CSRF-TOKEN': $('meta[name="__public_token"]').attr('content')
      			},
			})
			.done(function(data) {
				if (data.code == 200){
					swal({
					  title: "Tuyệt vời!",
					  type: "success",
					  text: "Xoá thành công menu",
					  timer: 3000,
					  showConfirmButton: false
					});
				}
				window.location.reload();
			})
			.fail(function() {
				swal({
				  title: "Thất bại!",
				  type: "error",
				  text: data['message'],
				  timer: 1000,
				  showConfirmButton: false
				});
				return false;
			})
			.always(function() {
				console.log("complete");
			});
		});
	});
});	