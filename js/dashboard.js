let bars = document.querySelector('#bars');
let sideMenu = document.querySelector('.side-menu');
bars.addEventListener('click',()=>{
    if(bars.getAttribute("name") === "apps-outline"){
        sideMenu.style.left="0";
        bars.setAttribute("name","close-outline");
    }else{
        sideMenu.style.left="-50rem";
        bars.setAttribute("name","apps-outline");
    }
    
});


$(document).ready(()=>{


   $('#signout').on('click',()=>{
        $.ajax({
            method: 'POST',
            url: './actions/dashboardOut.php',
            data: {signout: $('#signoutBtn').val()},
            success: dashboardOutRespo=>$('body').append(dashboardOutRespo)
            
        })
   });

});