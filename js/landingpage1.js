$(document).ready(() => {
    $('#landingpageOut1').on('click', () => {
        $.ajax({
            method: 'POST',
            url: './actions/landingPageOut.php',
            data: { landingpageOut1: $('#landingpageOut1').val() },
            success: function (response) {
                console.log(response)
                location.href = "./"
            }
        });
    });
});
