var voice_file = document.querySelectorAll(".voice-row td");
for (let i=0;i<voice_file.length;i++){
    let voice_file_name = voice_file[i].innerText;
    let voice_file_name_nospace = voice_file_name.split(" ").join("");
    voice_file[i].addEventListener("click",function(){
        let audio = new Audio(`voice-file/${voice_file_name_nospace}.wav`);
        audio.pause();
        console.log("siku");
        audio.play();
       // audio.playbackRate = 1;
       // audio.controls =true;
       // audio.play();

    });

}





/*for (var i=0;i<voice_file.length;i++){
    
    voice_file[i].addEventListener("click",function(){
       
        const audio = new Audio(`voice-file/${voice_file_name}.wav`);
        audio.playbackRate = 2;
        audio.controls =true;
        audio.play();
    });
}*/
    
    
    



/*const audio = new Audio("freejazz.wav");
audio.playbackRate = 2;
audio.loop = true;
audio.play();*/