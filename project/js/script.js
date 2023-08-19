var section = document.getElementById("cookies-section");


var current_location = location.href;
var btn_item =document.querySelectorAll(".btn");
var btn_length = btn_item.length;
for(var i=0;i<btn_length;i++){
    if(btn_item[i].href === current_location){
        btn_item[i].className = "active";
    }
}

 

function hide(){
    section.style.display = "none";   
}


document.getElementById("cookies-button-1").onclick = function() {
    hide();
}
document.getElementById("cookies-button-2").onclick = function() {
    hide();
}
document.getElementById("cross").onclick = function() {
    hide(); 
}












