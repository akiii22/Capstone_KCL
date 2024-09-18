$(document).ready(()=>{
    

$("#filterProduct").on("change",()=>{
    

    if($('#filterProduct').val()!='Filter All By:'){
        $.ajax({
            type: 'POST',
            url: './actions/filterProductAction.php',
            data: {filterVal: $("#filterProduct").val()},
            success: (filterRespo)=>{
                $('.box-container').html(filterRespo);
            }
        });
    }
       
    
});


});