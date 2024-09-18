let theme = document.querySelector(".theme-switch__checkbox");


// check if have theme
if(localStorage.getItem("theme")===""||localStorage.getItem("theme")===null){
    localStorage.setItem("theme","#fff");
}else if(localStorage.getItem("theme")==="#fff"){
    document.body.style.background="#fff";
}else if(localStorage.getItem("theme")==="#000"){
    document.body.style.background="#000";
    theme.click();
}


theme.addEventListener('click',()=>{

    if(localStorage.getItem("theme")==="#fff"){
        localStorage.setItem("theme","#000");
        document.body.style.background="#000";
    }else if(localStorage.getItem("theme")==="#000"){
        
        localStorage.setItem("theme","#fff");
        document.body.style.background="#fff";
        
    }

});

