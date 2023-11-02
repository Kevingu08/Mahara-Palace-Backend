let loginContainer = document.getElementById("login-container");
let signinContainer = document.getElementById("signin-container");

let inputLoginUsername = document.getElementById("login-username");
let inputLoginPassword = document.getElementById("login-password");
let inputLoginBtn = document.getElementById("login-btn");
let linkPassword = document.getElementById("link-password");
let inputSigninUsername = document.getElementById("signin-username");
let inputSigninEmail = document.getElementById("signin-email");
let inputSigninPassword = document.getElementById("signin-password");
let inputSigninBtn = document.getElementById("signin-btn");

loginContainer.setAttribute("activated", 0);
signinContainer.setAttribute("activated", 0);

    // loginContainer.classList.add("")
    // loginContainer.classList.remove("")
    // loginContainer.classList.toggle("")

function activateLogin(){
    loginContainer.addEventListener("mouseenter", function() {
        if(this.getAttribute("activated") == 0){
            if(signinContainer.getAttribute("activated") == 0){
                this.style.width = 55 + "%";
                signinContainer.style.width = 45 + "%";
            }
            else{
                this.style.width = 20 + "%";
                signinContainer.style.width = 80 + "%";
            }
            this.style.transition = "ease 0.1s";
            signinContainer.style.transition = "ease 0.1s";
        }
    });

    loginContainer.addEventListener("mouseleave", function() {
        if(this.getAttribute("activated") == 0){
            if(signinContainer.getAttribute("activated") == 0){
                this.style.width = 50 + "%";
                signinContainer.style.width = 50 + "%";
            }
            else{
                this.style.width = 15 + "%";
                signinContainer.style.width = 85 + "%";
            }
            this.style.transition = "ease 0.1s";
            signinContainer.style.transition = "ease 0.1s";
        }
    });

    loginContainer.addEventListener("click", function(){
        if(this.getAttribute("activated") == 0){
            if(signinContainer.getAttribute("activated") == 1){
                signinContainer.setAttribute("activated", 0)
                inputSigninEmail.style.display = "none";
                inputSigninPassword.style.display = "none";
                inputSigninUsername.style.display = "none";
                inputSigninBtn.style.display = "none";
            }
            this.setAttribute("activated", 1);
            activatedContainer = true;
            this.style.width = 85 + "%";
            signinContainer.style.width = 15 + "%";
            inputLoginUsername.style.display = "block";
            inputLoginPassword.style.display = "block";
            inputLoginBtn.style.display = "block";
            linkPassword.style.display = "block";
            this.style.transition = "ease .5s";
            signinContainer.style.transition = "ease 0.5s";
            
        } 
    });
}

function activateSignin(){
    signinContainer.addEventListener("mouseenter", function() {
        if(this.getAttribute("activated") == 0){
            if(loginContainer.getAttribute("activated") == 0){
                this.style.width = 55 + "%";
                loginContainer.style.width = 45 + "%";
            }
            else{
                this.style.width = 20 + "%";
                loginContainer.style.width = 80 + "%";
            }
            this.style.transition = "ease 0.1s";
            loginContainer.style.transition = "ease 0.1s";
        }
    });

    signinContainer.addEventListener("mouseleave", function() {
        if(this.getAttribute("activated") == 0 ){
            if(loginContainer.getAttribute("activated") == 0){
                this.style.width = 50 + "%";
                loginContainer.style.width = 50 + "%";
            }
            else{
                loginContainer.style.width = 85 + "%";
                this.style.width = 15 + "%";
            }
            this.style.transition = "ease 0.1s";
            loginContainer.style.transition = "ease 0.1s";
        }
    });

    signinContainer.addEventListener("click", function(){
        if(this.getAttribute("activated") == 0){
            if(loginContainer.getAttribute("activated") == 1){
                loginContainer.setAttribute("activated", 0);
                inputLoginUsername.style.display = "none";
                inputLoginPassword.style.display = "none";
                inputLoginBtn.style.display = "none";
                linkPassword.style.display = "none";
            }
            this.style.width = 85 + "%";
            loginContainer.style.width = 15 + "%";
            this.setAttribute("activated", 1);
            inputSigninUsername.style.display = "block";
            inputSigninEmail.style.display = "block";
            inputSigninPassword.style.display = "block";
            inputSigninBtn.style.display = "block";
            this.style.transition = "ease 0.5s";
            loginContainer.style.transition = "ease 0.5s";
        }    
    });
}

function init(){
    activateLogin();
    activateSignin();
}


document.addEventListener("DOMContentLoaded", function(){
    init();
});