$(document).ready(function() {
    if($('#input_type_personal').prop('checked'))
    {
      $('input[name="input_id_company"]').prop("readonly", true);
      $('input[name="input_cccd"]').prop("readonly", false);
    }
    else {
      $('input[name="input_id_company"]').prop("readonly", false);
      $('input[name="input_cccd"]').prop("readonly", true);
    }
    $(document).on('click','input[name="signupSubmit"]', function() {
        if($("input[name='input_email']").val()=='')
        {
          $("#empty_mail").removeClass("d-none");
          return false;
        }
        else {
          $("#empty_mail").addClass("d-none");
        }
     });  
   $(document).on('click','#input_type_personal',function() {
          $('input[name="input_id_company"]').prop("readonly", true);
          $('input[name="input_cccd"]').prop("readonly", false);
  })
   $(document).on('click','#input_type_company',function() {
          $('input[name="input_id_company"]').prop("readonly", false);
          $('input[name="input_cccd"]').prop("readonly", true);
    })
 
  });


