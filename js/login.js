let loginContainer = document.getElementById("login-container");
let signinContainer = document.getElementById("signin-container");
let activatedContainer = false;
loginContainer.setAttribute("clicked", 0);
loginContainer.setAttribute("activated", 0);
signinContainer.setAttribute("clicked", 0);
signinContainer.setAttribute("activated", 0);

function activateLogin(){
    loginContainer.addEventListener("mouseenter", function() {
        if(this.getAttribute("activated") == 0){
            console.log(this.style.width);
            this.style.width = 55 + "%";
            signinContainer.style.width = 45 + "%";
            this.style.transition = "ease 0.1s";
            signinContainer.style.transition = "ease 0.1s";
        }
        
    });

    // loginContainer.classList.add("")
    // loginContainer.classList.remove("")
    // loginContainer.classList.toggle("")

    loginContainer.addEventListener("mouseleave", function() {
        if(this.getAttribute("activated") == 0){
            this.style.width = 50 + "%";
            signinContainer.style.width = 50 + "%";
            console.log("Salio");
        }
    });

    loginContainer.addEventListener("click", function(){
        if(this.getAttribute("activated") == 0){
            loginContainer.setAttribute("activated", 1);
            activatedContainer = true;
            this.style.background = "rebeccapurple";
            loginContainer.setAttribute("clicked", 1);
            this.style.width = 85 + "%";
            signinContainer.style.width = 15 + "%";
        }
        else{
            this.style.background = "blue";
            this.setAttribute("clicked", 0);
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
                this.style.width = 55 + "%";
                loginContainer.style.width = 45 + "%";
            }
            
            this.style.transition = "ease 0.1s";
            loginContainer.style.transition = "ease 0.1s";
        }
    });

    signinContainer.addEventListener("mouseleave", function() {
        if(this.getAttribute("activated") == 0 && loginContainer.getAttribute("activated") == 0){
            this.style.width = 50 + "%";
            loginContainer.style.width = 50 + "%";
            console.log("salio del 2");
        }
    });

    signinContainer.addEventListener("click", function(){
        if(this.getAttribute("activated") == 0){
            signinContainer.setAttribute("activated", 1);
            activatedContainer = true;
            this.style.background = "rebeccapurple";
            signinContainer.setAttribute("clicked", 1);
            this.style.width = 85 + "%";
            loginContainer.style.width = 15 + "%";
        }
        else{
            this.style.background = "blue";
            this.setAttribute("clicked", 0);
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