let btn_admin = document.querySelector(".btn-admin");
let btn_agent = document.querySelector(".btn-agent");
let button_box = document.querySelector(".button-link");
let agent_box = document.querySelector(".agent-box");
let admin_box = document.querySelector(".admin-box");

let agent_login_input = document.querySelector(".agent-login-input");
let admin_login_input = document.querySelector(".admin-login-input");


btn_admin.addEventListener("click",function(){
    agent_box.style.display = "none";
    admin_box.style.display = "none";
    admin_login_input.style.display = "block";

})

btn_agent.addEventListener("click",function(){
    agent_box.style.display = "none";
    admin_box.style.display = "none";
    agent_login_input.style.display = "block";

})





