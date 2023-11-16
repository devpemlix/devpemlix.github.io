 var link = $('link[href="css/style.css"]');
    
    if($.cookie("css")) {
      link.attr("href",'css/skin-' + $.cookie("css") + '.css');
    }
    
    $(function(){
      $("#color-switcher .toggle").click(function(){
        var s = $(this).parent();
        if(s.hasClass("open")){
          s.animate({'margin-right':'-109px'},400).toggleClass("open");
        }else{
          s.animate({'margin-right':'0'},400).toggleClass("open");
        }
      });
      
      $("#color-switcher .color").click(function(){
        var color = $(this).data("color");
        $("body").fadeOut(function(){
          //link.attr('href','css/skin-' + color + '.css');
          $.cookie("css", color, {expires: 365, path: '/'});
          window.location.href = "";
          $(this).fadeIn("slow");
        });
      });
    });

  
   