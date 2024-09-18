 $(document).ready(()=>{
   
    let forgotUname = $('#forgotUname');
    let forgotKey = $('#forgotKey');
    let forgotAccType = $('#forgotAccType');
    let forgotNewPassword = $('#forgotNewPassword');
    let mess = $('.mess');
    let loader = $('#loader');
    
    $('#forgotSubmit').on('click',()=>{

        // show
        loader.css("left","50%");

       setTimeout(()=>{
        
        // hide
        loader.css("left" ,"-50rem");

             // validate
        if(forgotUname.val()==""||forgotKey.val()==""||forgotNewPassword.val()==""){
            mess.html(`<p>All input required</p>`).css("right","1rem");
            setTimeout(()=>{
                mess.css("right","-50rem");
            },2500);
        }else if(forgotAccType.val()!=="Admin"&&forgotAccType.val()!="User"){
            alert("error")
            location.reload();
        }else{
            $.ajax({

                type: 'POST',
                url: './actions/forgotAction.php',
                data: {
                    forgotUname: forgotUname.val(),
                    forgotKey: forgotKey.val(),
                    forgotAccType: forgotAccType.val(),
                    forgotNewPassword: forgotNewPassword.val()
                },
                success: (forgotRespo)=>{
                    if(forgotRespo == "Invalid data"){
                        mess.html(`<p>Invalid data</p>`).css("right","1rem");
                        setTimeout(()=>{
                            mess.css("right","-50rem");
                        },2500);
                    }else{
                        mess.html(`<p>${forgotRespo}</p>`).css("right","1rem");
                        setTimeout(()=>{
                            window.location.href='./index.php';
                        },2500);
                    }
                }


            });
        }
       },3000);
       

    }); //forgotsubmit click end





    
 }); //document ready end