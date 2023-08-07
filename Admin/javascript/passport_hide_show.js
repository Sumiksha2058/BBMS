$(document).ready(function() {
  $("#click-eye").click(function(){
   $("#icon").toggleClass('fa-eye-slash');

   var input = $("#LoginPassword");
    if(input.attr("type")==="password"){
        input.attr("type", "text");
    }else{
        input.attr("type", "password");
    }
    

  });
});