$(document).ready(()=>{

    let searchProductPlumbing = $('.searchProductPlumbing');
    
    searchProductPlumbing.on('keyup',()=>{
        
    
            $.ajax({
    
                type: 'POST',
                url: './dashboardActions/searchP.php',
                data: {searchProductPlumbing: searchProductPlumbing.val()},
                success: (searchProductRespo1)=>{
                    $('.box-container').html(searchProductRespo1);
                }
    
    
            });
    
        
    
    });






    let searchProductCS = $('.searchProductCS');
    
    searchProductCS.on('keyup',()=>{
        
    
            $.ajax({
    
                type: 'POST',
                url: './dashboardActions/searchP.php',
                data: {searchProductCS: searchProductCS.val()},
                success: (searchProductRespo1)=>{
                    $('.box-container.CS').html(searchProductRespo1);
                }
    
    
            });
    
        
    
    });
    
    
   

    
    
    
    
    let searchProductES = $('.searchProductES');
    
    searchProductES.on('keyup',()=>{
        
    
            $.ajax({
    
                type: 'POST',
                url: './dashboardActions/searchP.php',
                data: {searchProductES: searchProductES.val()},
                success: (searchProductRespo2)=>{
                    $('.box-container.ES').html(searchProductRespo2);
                }
    
    
            });
    
        
    
    });











    });