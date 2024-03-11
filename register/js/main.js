(function($) {

  $('#meal_preference').parent().append('<ul class="list-item" id="newmeal_preference" name="meal_preference"></ul>');
  $('#meal_preference option').each(function(){
      $('#newmeal_preference').append('<li value="' + $(this).val() + '">'+$(this).text()+'</li>');
  });
  $('#meal_preference').remove();
  $('#newmeal_preference').attr('id', 'meal_preference');
  $('#meal_preference li').first().addClass('init');
  $("#meal_preference").on("click", ".init", function() {
      $(this).closest("#meal_preference").children('li:not(.init)').toggle();
  });
  
  var allOptions = $("#meal_preference").children('li:not(.init)');
  $("#meal_preference").on("click", "li:not(.init)", function() {
      allOptions.removeClass('selected');
      $(this).addClass('selected');
      $("#meal_preference").children('.init').html($(this).html());
      allOptions.toggle();
  });

  var marginSlider = document.getElementById('slider-margin');
  if (marginSlider != undefined) {
      noUiSlider.create(marginSlider, {
            start: [500],
            step: 10,
            connect: [true, false],
            tooltips: [true],
            range: {
                'min': 0,
                'max': 10000
            },
            format: wNumb({
                decimals: 0,
                thousand: ',',
                prefix: '₱ ',
            })
    });
  }
  $('#reset').on('click', function(){
      $('#register-form').reset();
  });

  $('#register-form').validate({
    rules : {
        first_name : {
            required: true,
        },
        middle_name : {
            required: false,
        },
        last_name : {
            required: true,
        },
        company : {
            required: true
        },
        email : {
            required: true,
            email : true
        },
        phone_number : {
            required: true,
        }
    },
    onfocusout: function(element) {
        $(element).valid();
    },
});

    jQuery.extend(jQuery.validator.messages, {
        required: "",
        remote: "",
        email: "",
        url: "",
        date: "",
        dateISO: "",
        number: "",
        digits: "",
        creditcard: "",
        equalTo: ""
    });
})(jQuery);

$(document).ready(function(){
    $("#register-form").validate({
        rules: {
            username: "required",
            password: "required",
            confirm_password: {
                required: true,
                equalTo: "#password"
            },
            firstname: "required",
            lastname: "required",
            email: {
                required: true,
                email: true
            },
            phone_number: "required",
            birthdate: "required"
        },
        messages: {
            username: "Username is required",
            password: "Password is required",
            confirm_password: {
                required: "Confirm Password is required",
                equalTo: "Passwords do not match"
            },
            firstname: "First name is required",
            lastname: "Last name is required",
            email: {
                required: "Email is required",
                email: "Please enter a valid email address"
            },
            phone_number: "Phone number is required",
            birthdate: "Date of Birth is required"
        },
        submitHandler: function(form) {
            // Form submission using AJAX
            $.ajax({
                url: "register.php",
                method: "POST",
                data: $(form).serialize(),
                success: function(response){
                    alert(response); // Display server response in alert
                }
            });
        }
    });
});


$(document).ready(function(){
    $("#submit").click(function(){
        var username = $("#username").val();
        var password = $("#password").val();
        var confirm_password = $("#confirm_password").val();
        var firstname = $("#firstname").val();
        var middlename = $("#middlename").val();
        var lastname = $("#lastname").val();
        var email = $("#email").val();
        var phone_number = $("#phone_number").val();
        var birthdate = $("#birthdate").val();
        
        // Check if password and confirm password match
        if (password !== confirm_password) {
            $("#username-error-message").html("");
            $("#email-error-message").html("");
            $("#error-message").html("Error: Passwords do not match");
            return;
        }
        
        // Check if username already exists
        $.ajax({
            url: "check_username.php",
            method: "POST",
            data: {username: username},
            success: function(response){
                if(response !== "") {
                    $("#username-error-message").html(response);
                } else {
                    // Check if email already exists
                    $.ajax({
                        url: "check_email.php",
                        method: "POST",
                        data: {email: email},
                        success: function(response){
                            if(response !== "") {
                                $("#email-error-message").html(response);
                            } else {
                                // Submit the form data
                                $.ajax({
                                    url: "register.php",
                                    method: "POST",
                                    data: {
                                        username: username,
                                        password: password,
                                        confirm_password: confirm_password,
                                        firstname: firstname,
                                        middlename: middlename,
                                        lastname: lastname,
                                        email: email,
                                        phone_number: phone_number,
                                        birthdate: birthdate
                                    },
                                    success: function(response){
                                        $("#error-message").html(response);
                                    }
                                });
                            }
                        }
                    });
                }
            }
        });
    });
});
