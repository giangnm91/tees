$(function(){"use strict";$("#LoginForm").submit(function(t){var e=$(this);e.block({message:'<div id="loader"></div>',css:{border:"0px","background-color":"transparent"}}),$.ajax({type:"POST",dataType:"json",data:e.serialize()}).done(function(t){"success"==t.code?(swal({title:"Tuyệt vời!",type:"success",text:"Bạn đã truy cập thành công.",timer:2e3,showConfirmButton:!1}),window.location.href=t.comeback):swal({title:"Không ổn rồi!",type:"warning",text:t.message,timer:2e3,html:!0,showConfirmButton:!1})}).fail(function(t){swal({title:422==t.status?"Không ổn rồi!":"Thật tệ!",type:"warning",text:422==t.status?t.responseJSON.message:"Có vẻ như server đang quá tải.",timer:2e3,html:!0,showConfirmButton:!1})}).always(function(){e.unblock()}),t.preventDefault()})});