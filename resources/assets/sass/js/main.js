$(document).ready(function(){
	$('.lang-changer').click(function(event) {
        if($(this).hasClass('active')) {return true;}
        var lang = $(this).attr('data-locale'); 
        $(this).parent().block();
        $.getJSON('/auth/change-language', {locale: lang}, function(json, textStatus) {
            if(json.code == 'success') {
                window.location.reload();
            }
        });
    });
    function swalert (type,msg,desc) 
    {
        switch (type)
        {
            case "success":
            {
                return swal({
                      title: msg,
                      type: "success",
                      text: desc,
                      timer: 2000,
                      showConfirmButton: false
                    });
                break;
            }
            case "error":
            {
                return swal({
                  title: msg,
                  type: "error",
                  text: desc,
                  timer: 2000,
                  showConfirmButton: false
                });
                break;
            }
            default:
            {
                return swal({
                      title: msg,
                      type: "success",
                      text: desc,
                      timer: 2000,
                      showConfirmButton: false
                    });
                break;
            }
        }
    }
});