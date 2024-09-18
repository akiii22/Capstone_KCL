$(document).ready(() => {


    $('.submitRegister').on('click', () => {

        let nameRegister = $('#nameRegister');
        let usernameRegister = $('#usernameRegister');
        let passRegister = $('#passRegister');
        let confirmPassRegister = $('#confirmPassRegister');
        let addressRegister = $('#addressRegister');
        let emailRegister = $('#emailRegister');
        let numberRegister = $('#numberRegister');
        let secretKey = $('#secretKey');
        let selectRegister = $('#selectRegister');


        // validate
        if (nameRegister.val() === "" || usernameRegister.val() === "" || passRegister.val() === "" || confirmPassRegister.val() == "" || addressRegister.val() == "" || numberRegister.val() == "" || emailRegister.val() == "" || secretKey.val() == "" || selectRegister.val() === "") {
            // blank
            $('.regErr').text("Error! Missing data");
            setTimeout(() => {
                $('.regErr').text("");
            }, 4000);
        } else if (nameRegister.val().length > 29 || nameRegister.val().length < 3) {
            $('.regErr').text("Name must between 3 to 29 digits.");
            setTimeout(() => {
                $('.regErr').text("");
            }, 4000);
        } else if (usernameRegister.val().length > 19 || usernameRegister.val().length < 4) {
            $('.regErr').text("Username must between 4 to 19 digits.");
            setTimeout(() => {
                $('.regErr').text("");
            }, 4000);
        } else if (passRegister.val().length > 26 || passRegister.val().length < 6) {
            $('.regErr').text("Password must between 6 to 26 digits.");
            setTimeout(() => {
                $('.regErr').text("");
            }, 4000);
        } else if (passRegister.val() != confirmPassRegister.val()) {
            $('.regErr').text("Password doesn't match in confirm password.");
            setTimeout(() => {
                $('.regErr').text("");
            }, 4000);
        } else if (addressRegister.val().length > 90 || addressRegister.val().length < 6) {
            $('.regErr').text("Address must between 6 to 90 digits.");
            setTimeout(() => {
                $('.regErr').text("");
            }, 4000);
        } else if (emailRegister.val().length > 30 || emailRegister.val().length < 4) {
            $('.regErr').text("Email must between 4 to 30 digits.");
            setTimeout(() => {
                $('.regErr').text("");
            }, 4000);
        } else if (numberRegister.val().length != 11) {
            $('.regErr').text("Number must have at least 11 digits.");
            setTimeout(() => {
                $('.regErr').text("");
            }, 4000);
        } else if (selectRegister.val() !== "User") {
            alert("Sorry, we have found an error.");
            location.reload();
        } else {
            // ajax
            $.ajax({
                method: 'POST',
                url: './actions/signupAction.php',
                data: {
                    nameRegister: nameRegister.val(),
                    usernameRegister: usernameRegister.val(),
                    passRegister: passRegister.val(),
                    addressRegister: addressRegister.val(),
                    emailRegister: emailRegister.val(),
                    numberRegister: numberRegister.val(),
                    secretKey: secretKey.val(),
                    selectRegister: selectRegister.val()
                },
                success: (regRespo) => {
                    if (regRespo === "9f3a57516524c7cdfece8b719693a01f") {
                        alert("Sorry, we have found an error.");
                        location.reload();
                    } else {
                        $('body').append(regRespo);
                    }
                }


            }); //ajax end
        } //else end




    });

});