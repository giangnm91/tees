$(document).ready(function(){
	$('#formSearchData').livequery('submit',function(){
		var elem = $(this);
		var data = elem.serialize();
		console.log(data);
		$.ajax({
			url: 'product',
			type: 'POST',
			dataType: 'json',
			data: data,
		})
		.done(function() {
			console.log("success");
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});
		
		return false;
	});
});