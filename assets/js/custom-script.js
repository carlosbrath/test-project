// ------------Documents Ready--------------------------------
// ###########################################################
$(document).ready(function() {
    $('select').formSelect();
});
// ------------------Check isEmpty-------------
function isEmpty(val) {
    return (val === undefined || val == null || val.length <= 0) ? true : false;
}
$('.logout').on('click', function(){
    console.log('logout');
    Swal.fire({
        position: 'top-end',
        icon: 'info',
        title: 'logout',
        showConfirmButton: false,
        timer: 1500
    })
    setTimeout(function () {
        location.href = '' + base_link + 'logout';
    }, 500)
})
// --------------Manage Login--------------------------------
// ----------------------------------------------------------
$('#login-form').submit(function (e) {
    e.preventDefault()
    $('#login-form button[type="button"]').attr('disabled', true).html('Logging in...');
    if ($(this).find('.alert-danger').length > 0)
        $(this).find('.alert-danger').remove();
    $.ajax({
        url: '' + base_link + 'ApiController/login',
        method: 'POST',
        data: $(this).serialize(),
        error: err => {
            console.log(err)
            $('#login-form button[type="button"]').removeAttr('disabled').html('Login');

        },
        success: function (resp) {
                if (resp == 1) {
                    console.log(resp);
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Logged in',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    setTimeout(function () {
                        location.href = '' + base_link + 'dashboard';
                    }, 500)
                } else {
                    $('#login-form').prepend('<div class="alert alert-danger">Username or password is incorrect.</div>')
                    $('#login-form button[type="button"]').removeAttr('disabled').html('Login');
                }
        }
    })
})
// ------------Manage SignUp Form-----------------------------
// ###############################################################
$.validator.addMethod("lettersonly", function (value, element) {
    return this.optional(element) || /^[a-z\s-a-záéíóúý]+$/i.test(value);
}, "Solo letras por favor");

$('#signup-form').validate({
    rules: {
        fname: {
            required: true,
            lettersonly: true,
        },
        lname: {
            required: true,
            lettersonly: true,
        },
        username: {
            required: true,
            lettersonly: true,
        },
        email: {
            required: true,
            email: true,
        },
    },
    messages: {
        fname: {
            required: "<p style='color:#d9534f; font-style: italic'>First name required'",
            lettersonly: "<p style='color:#d9534f'>Name must contain only alphabets'",
        },
        lname: {
            required: "<p style='color:#d9534f; font-style: italic'>First name required'",
            lettersonly: "<p style='color:#d9534f'>Name must contain only alphabets'",
        },
        username: {
            required: "<p style='color:#d9534f; font-style: italic'>First name required'",
            lettersonly: "<p style='color:#d9534f'>Name must contain only alphabets'",
        },
        email: {
            required: "<p style='color:#d9534f; font-style: italic'>First name required'",
            email: "<p style='color:#d9534f'>Name must contain only alphabets'",
        },
    },
    submitHandler: function (form) {
        console.log('form submitted');
        $.ajax({
            url: "" + base_link + "ApiController/sign_up",
            type: "POST",
            data: {
                fname: $('#fname').val(),
                lname: $('#lname').val(),
                username: $('#username').val(),
                email: $('#email').val(),
            },
            dataType: "json",
            success: function (resp) {
                if (resp['status'] == 1) {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Registered Successfully',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    setTimeout(function () {
                        window.location = base_link;
                    }, 1500)
                } else {
                    $('#regis-form').prepend('<div class="alert alert-danger">Registration Fail, Please Try again.</div>')
                }
            }
        });
    }
});

// --------------------------- Manage Category Form ---------------------------
// ############################################################################
$('#category-form').validate({
    rules: {
        model: {
            required: true,
            // lettersonly: true,
        },
        color: {
            required: true,
            // lettersonly: true,
        },
        model: {
            required: true,
            // lettersonly: true,
        },
    },
    messages: {
        model: {
            required: "<p style='color:#d9534f; font-style: italic'>First name required'",
            // lettersonly: "<p style='color:#d9534f'>Name must contain only alphabets'",
        },
    },
    submitHandler: function (form) {
        var ops= 'creat'
        if(!isEmpty($('#category_id').val()))
        {
            ops= 'update'
        }
        $.ajax({
            url: "" + base_link + "ApiController/crud_operations",
            type: "POST",
            data: {
                crud: {
                    ops: ops,
                    condition: {
                        category_id: $('#category_id').val(),
                    },
                    entity: 'category_table',
                    data: {
                        category_title: $('#category_title').val(),
                        vehical_type: $('#vehical_type').val(),
                        horsepower: $('#horsepower').val(),
                    },
                }
            },
            dataType: "json",
            success: function (resp) {
                if (resp == 1) {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Updated',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    setTimeout(function () {
                        window.location = base_link + 'categories';
                    }, 1500)
                } else {
                }
            }
        });
    }
});
// -------------Delete Category--------------------------------------
// ##################################################################
$('.catagory-deletebtn').on('click', function(){
    $.ajax({
        url: "" + base_link + "ApiController/crud_operations",
        type: "POST",
        data: {
            crud: {
                ops: 'delete',
                condition: {
                    category_id: $(this).data('id'),
                },
                entity: 'category_table',
            }
        },
        dataType: "json",
        success: function (resp) {
            if (resp == 1) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Deleted',
                    showConfirmButton: false,
                    timer: 1500
                })
                setTimeout(function () {
                    window.location = base_link + 'categories';
                }, 1500)
            }
        }
    });
})
// --------------------------- Manage Vehical  Form ---------------------------
// ############################################################################
$('#vehical-form').validate({
    rules: {
        model: {
            required: true,
            // lettersonly: true,
        },
    },
    category_title: {
        fname: {
            required: "<p style='color:#d9534f; font-style: italic'>First name required'",
            // lettersonly: "<p style='color:#d9534f'>Name must contain only alphabets'",
        },
    },
    submitHandler: function (form) {
        var ops= 'creat'
        if(!isEmpty($('#id').val()))
        {
            ops= 'update'
        }
        $.ajax({
            url: "" + base_link + "ApiController/crud_operations",
            type: "POST",
            data: {
                crud: {
                    ops: ops,
                    condition: {
                        id: $('#id').val(),
                    },
                    entity: 'vehical_table',
                    data: {
                        model: $('#model').val(),
                        color: $('#color').val(),
                        category_id: $('#category').val(),
                        registration_no: $('#registration_no').val(),
                        make: $('#make').val(),
                    },
                }
            },
            dataType: "json",
            success: function (resp) {
                if (resp == 1) {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Updated',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    setTimeout(function () {
                        window.location = base_link + 'dashboard';
                    }, 1500)
                } else {
                    $('#regis-form').prepend('<div class="alert alert-danger">Registration Fail, Please Try again.</div>')
                }
            }
        });
    }
});

// -------------Delete Vehical--------------------------------------
// ##################################################################
$('.vehical-deletebtn').on('click', function(){
    $.ajax({
        url: "" + base_link + "ApiController/crud_operations",
        type: "POST",
        data: {
            crud: {
                ops: 'delete',
                condition: {
                    id: $(this).data('id'),
                },
                entity: 'vehical_table',
            }
        },
        dataType: "json",
        success: function (resp) {
            if (resp == 1) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Deleted',
                    showConfirmButton: false,
                    timer: 1500
                })
                setTimeout(function () {
                    window.location = base_link + 'dashboard';
                }, 1500)
            }
        }
    });
})