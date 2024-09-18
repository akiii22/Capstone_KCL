$(document).ready(()=>{

  
  let deleteP =  $('.delete');
  let confirmDel = $('.confirmDel');
  let delN = $('.delN');
  let delY = $('.delY');
  
  
  //   set get ID
  let getId;
  deleteP.each(function(){
    $(this).on('click',function(e){
        e.preventDefault();
        // if change make null
        getId = null;
        // get ID
       getId = $(this).parent().parent().find('#productId').val();
        
       // show del mess
        $('#pShowId').text('Are you sure you want to delete '+getId);
        confirmDel.css("left","50%");
  
            // if no hide
            delN.on('click',()=>{
                confirmDel.css("left","-100rem");
                getId = null;
            });
  
            // if yes
            delY.on('click',()=>{
                // if yes hide
                confirmDel.css("left","-100rem");
  
                $.ajax({
  
                    type: 'POST',
                    url: './dashboardActions/deleteP.php',
                    data: {getId: getId},
                    success: (deleteRespo)=>{
                      $('.mess').html(`<h2>${deleteRespo} <em>${getId}</em></h2>`).css("left","50%");
                      setTimeout(()=>{location.reload();},2500);
                    }
  
                });
  
  
            });
  
    });
  
  
  });
  
  

  
  
  
  
  
  
  
  // show and get the info of product
  let editProductForm = $('.editProductForm');
  let editP = $('.edit');
  
  //   set get ID
  let getIdEdit;
  
  const editResetFunc = ()=>{
  getIdEdit = null;
  let nameP = null;
  let priceP = null;
  let stocksP = null;
  let imageP = null;
  let product_infoP = null;
  let product_specsP = null;
  let product_brandP = null;
  }
  
  
  editP.each(function(){
  $(this).on('click',function(e){
  
      // reset
      editResetFunc();
  
      e.preventDefault();
      // if change make null
   
  
  
      // get ID
     getIdEdit = $(this).parent().parent().find('#productId').val();
      
     // show del mess
      editProductForm.css("left","50%");
  
  
    $.ajax({
      type: 'POST',
      url: './dashboardActions/editP.php',
      data: {getIdEdit: getIdEdit},
      success: (editResponse)=>{
        $('.editCon').html(editResponse);
      }
    });
  
    console.log(getIdEdit);
  
    // close form edit
    $('#closeEdit').on('click',()=>{
      editProductForm.css("left","-100rem");
      editResetFunc();
      $('.editCon').html('');
    });
  
    
  
  
  
  });
  
  });
  
   //end getEditFunc
  // run 
 
  
  // $('#updateProduct').on('click',()=>{
  
  //   // set value
  //   productId = $('#productId');
  //   nameP = $('#nameP');
  //   priceP = $('#priceP');
  //   stocksP = $('#stocksP');
  //   imageP = $('#imageP').val().split('\\').pop(); //n
  //   product_infoP = $('#product_infoP');
  //   product_specsP = $('#product_specsP'); //n
  //   product_brandP = $('#product_brandP'); //n
  
    
  
  
  //   if(nameP==""||nameP==null||
  //     priceP==""||priceP==null||
  //     stocksP==""||stocksP==null||
  //     product_infoP==""||product_infoP==null||
  //     product_specsP==""||product_specsP==null||
  //     product_brandP==""||product_brandP==null){
  //       $('.mess').html(`<h2>All input required</h2>`);
  //       setTimeout(()=>{location.reload();},2500);
  //     }else{
  
  //       $.ajax({
  //         type: 'POST',
  //         url: './dashboardActions/editP.php',
  //         data: {productId: productId.val(),
  //                nameP: nameP.val(),
  //                priceP:priceP.val(),
  //                stocksP: stocksP.val(),
  //                imageP: imageP,
  //                product_infoP:  product_infoP.val(),
  //                product_specsP:  product_specsP.val(),
  //                product_brandP:  product_brandP.val()},
  //         success: (updateResponse)=>{
  //           // $('.mess').html(`<h2>${updateResponse}</h2>`);
  //           console.log(updateResponse)
  //         }
  //       });
  
  //     }
  
  
  
  
  
  
  
  //     // reset after execute
  //     editResetFunc();
  
  //   });
  
  
  
  
  
  
  
  
  
  });