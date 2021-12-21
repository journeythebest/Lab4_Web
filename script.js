 let loginButton = document.getElementById("header_login_button");
 let loginFormToSignupFormToggle = document.getElementById('login-form-button-to-signup');
 let signupFormToLoginFormToggle = document.getElementById('signup-form-button-to-login');

 let loginForm = document.getElementById('login-form');
 let signupForm = document.getElementById('signup-form');

 let exitForm1 = document.getElementById('exit-form1');
 let exitForm2 = document.getElementById('exit-form2');

     loginButton.onclick = function () {
         loginForm.style.visibility = "visible";
     }

     loginFormToSignupFormToggle.onclick = function () {
         loginForm.style.visibility = "hidden";
         signupForm.style.visibility = "visible";
     }

     signupFormToLoginFormToggle.onclick = function () {
         signupForm.style.visibility = "hidden";
         loginForm.style.visibility = "visible";
     }

     exitForm1.onclick = function () {
         loginForm.style.visibility = "hidden";
         signupForm.style.visibility = "hidden";
     }

     exitForm2.onclick = function () {
         loginForm.style.visibility = "hidden";
         signupForm.style.visibility = "hidden";
     }