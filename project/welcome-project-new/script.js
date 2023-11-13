let admin_btn = document.querySelector(".admin-btn");
let agent_btn = document.querySelector(".agent-btn");

let admin_container = document.querySelector(".container-admin");
let agent_container = document.querySelector(".container-agent");

admin_btn.addEventListener("click",()=>{
    admin_btn.style.display = "none";
    agent_btn.style.display = "block";
    admin_container.style.display = "block";
    agent_container.style.display = "none";
})

agent_btn.addEventListener("click",()=>{
    agent_btn.style.display = "none";
    admin_btn.style.display = "block";
    admin_container.style.display = "none";
    agent_container.style.display = "block";
    
    
    
})



