let btn_admin = document.querySelector(".btn-admin");
let btn_agent = document.querySelector(".btn-agent");
let button_box = document.querySelector(".button-link");


let agent_login_input = document.querySelector(".agent-login-input");
let admin_login_input = document.querySelector(".admin-login-input");

btn_agent.style.backgroundColor = "#04BF8A";

btn_admin.addEventListener("click",function(){
    admin_login_input.style.display = "block";
    agent_login_input.style.display = "none";
    btn_admin.style.backgroundColor = "#04BF8A";
    btn_agent.style.backgroundColor = "#0099ff";
   

})

btn_agent.addEventListener("click",function(){
    agent_login_input.style.display = "block";
    admin_login_input.style.display = "none";
    btn_admin.style.backgroundColor = "#0099ff";
    btn_agent.style.backgroundColor = "#04BF8A"
   

})





