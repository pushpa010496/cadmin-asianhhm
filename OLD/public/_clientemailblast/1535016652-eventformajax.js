 "use strict" 
  $('.submit-btn').on('click',function(e) {  
     
            // if (grecaptcha.getResponse() == ""){

            //     $('#basic_getlist').find('.verifi').html("We can't proceed request with out captcha verification!");
            //     return false;
            // }
  
       var dataString = $(this).closest('.modal-body').find('form').serialize();
       $.ajax({
            type: 'POST',
            url: eventnl_url,
           headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          data: dataString,       
            success:function(data){
             var url = window.location.href.toString().split(window.location.host)[1];
            window.history.pushState("object or string", "Title",url+"/news-letter-success");
              $('#myModal').modal('hide');             
                $(".error").empty();
              $('#modalSuccess').modal('show');             
               $('form')[0].reset();         
            },
              error: function (data) {
                $(".error").empty();
                  $.each( data.responseJSON.errors, function( key, value ) {
                      $(".error").append('<li class="text-danger">'+value+'</li>');
                    });
                }
        });
    });