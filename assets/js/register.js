//javascript - jquery library to hide login or register
$(document).ready(function(){
  //when this element is clicked, hide the loginForm and show the registerForm
  $("#hideLogin").click(function(){
    $("#loginForm").hide();
    $("#registerForm").show();
  });
  //when this element is clicked, show the loginForm and hide the registerForm
  $("#hideRegister").click(function(){
    $("#loginForm").show();
    $("#registerForm").hide();
  });
});
