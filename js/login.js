$(document).ready(() => {

    // eye of registration and login
    let eye = $('#eye');
    let passLogin = $('#passLogin');
    eye.on('click', () => {
        if (passLogin.attr('type') === "password") {
            passLogin.attr("type", "text");
            eye.text('visibility');
        } else {
            passLogin.attr("type", "password");
            eye.text('visibility_off');
        }
    });
    let eyeReg = $('#eyeReg');
    let passReg = $('#passRegister');
    eyeReg.on('click', () => {
        if (passReg.attr('type') === "password") {
            passReg.attr("type", "text");
            eyeReg.text('visibility');
        } else {
            passReg.attr("type", "password");
            eyeReg.text('visibility_off');
        }
    });



    let signupForm = $('.register');
    let signinForm = $('.login');


    // Sign up & Sign in form
    $('.signup').on('click', () => {
        signinForm.css("left", "-100%");
        signupForm.css("left", "50%");
    });
    $('.signin').on('click', () => {
        signinForm.css("left", "50%");
        signupForm.css("left", "150%");
    });


});



// login action

$('.submitLogin').on('click', () => {
    let usernameLogin = $('#usernameLogin');
    let passLogin = $('#passLogin');
    let selectLogin = $('#selectLogin');

    let loginErr = $('#loginErr');

    if (usernameLogin.val() === "" || passLogin.val() === "") {
        loginErr.text('All input is required.');
        setTimeout(() => {
            loginErr.text('');
        }, 4000);
    } else if (selectLogin.val() !== "User") {
        loginErr.text('Sorry, we are encountering an error...');
        setTimeout(() => {
            location.reload();
        }, 3000);
    } else {
        // ajax
        $.ajax({
            method: 'POST',
            url: './actions/loginAction.php',
            data: {
                usernameLogin: usernameLogin.val(),
                passLogin: passLogin.val(),
                selectLogin: selectLogin.val()
            },
            success: (loginRespo) => {
                console.log(loginRespo)
                if (loginRespo === "Invalid username or password or account type.") {
                    loginErr.text(loginRespo);
                    setTimeout(() => {
                        loginErr.text('');
                    }, 3000);
                } else {
                    $('body').append(loginRespo);
                }
            },
            complete: (response) => {
                console.log(response)
            }


        });

    }


});