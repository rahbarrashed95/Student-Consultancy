$(document).find('.amount').each(function() {
    let price=$(this).text();
    price=Number(price).toLocaleString('en');
    $(this).text(price);

});


$(document).on('click','.btn_modal', function(e){ 
    e.preventDefault();
    var url = $(this).attr('href');
    $.ajax({
       type:'GET',
       url:url,
       data:{},
       success:function(res){
          $('div#common_modal').html(res).modal('show');
       }
    });
});

$(document).on('submit','form#ajax_form', function(e) {
    e.preventDefault(); 
    $('span.textdanger').text('');
    var url=$(this).attr('action');
    var method=$(this).attr('method');
    var formData = new FormData($(this)[0]);
    $.ajax({
        type: method,
        url: url,
        data: formData,
        async: false,
        processData: false,
        contentType: false,
        success: function(res) {
            
            if(res.status==true){
                toastr.success(res.msg);
                if(res.url){
                    document.location.href = res.url;
                }else{
                    window.location.reload();
                }
            }else if(res.status==false){
                toastr.error(res.msg);
            }
            
        },
        error:function (response){
            $.each(response.responseJSON.errors,function(field_name,error){
                $(document).find('[name='+field_name+']').after('<span style="color:red">' +error+ '</span>')
                toastr.error(error);
            })
        }
    });
});

// ajax request for delete data
$(document).on('click','a.delete', function(e) {
    var form=$(this);
    e.preventDefault(); 
    swal({
      title: "Are you sure?",
      text: "You want To Delete!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#006400",
      confirmButtonText: "Yes, do it!",
      cancelButtonText: "No, cancel plz!",
      closeOnConfirm: false,
      closeOnCancel: false
    },
    function(isConfirm){
      if (isConfirm) {

        var url=$(form).attr('href');

        $.ajax({
            type: 'DELETE',
            url: url,
            data: {"_token": $('meta[name="csrf-token"]').attr('content')},
            success: function(res) {
                
                if(res.status==true){
                    toastr.success(res.msg);
                    if(res.url){
                        document.location.href = res.url;
                    }else{
                        window.location.reload();
                    }
                }else if(res.status==false){
                    toastr.error(res.msg);
                }
                
            },
            error:function (response){
                
            }
        });
      } else {
        swal("Cancelled", "Your imaginary file is safe :)", "error");
      }
    });
});
