let popup_container = document.getElementById("popup");
let clickable_icon = document.getElementById("file-icon");

let state = true;
clickable_icon.addEventListener("click",(e)=>{
    
    if(state){
        clickable_icon.classList.add("active");
        popup_container.style.display = "block";
        state= false;
    }
    else{
        clickable_icon.classList.remove("active");
        popup_container.style.display = "none";
        state = true;

    }
    
})