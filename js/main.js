let topNav = document.getElementById("top-navigation");
let currentPosition = 0;
let mainPosition = window.scrollY;
let navHeight = topNav.offsetHeight;

function init(){
  adaptiveMenu();
  initSlider();
  scrollNavbar();
}

// funcion para inicializar el slider de swiper
function initSlider(){
  var swiper = new Swiper('.swiper', {
    loop: true,
    autoplay: true,

    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
    
    pagination: {
      el: '.swiper-pagination',
      clickable: true,
    },
    
    slidesPerView: 1,
    spaceBetween: 40,
  
    breakpoints: {
      620: {
        slidesPerView: 1,
        spaceBetween: 20,
      },
      680: {
        slidesPerView: 2,
        spaceBetween: 40,
      },
      920: {
        slidesPerView: 3,
        spaceBetween: 40,
      },
      1240: {
        slidesPerView: 3,
        spaceBetween: 50,
      },
    } 
    });
}

// funcion para adaptar el menu en las diferentes pantallas de movil
function adaptiveMenu(){
  
  let navList = document.getElementById("navigation-list");
  let mobileCheck = document.getElementById("mobile-check");

  mobileCheck.addEventListener("click",function(){
    if(this.checked){
      navList.style.top = navHeight + "px";
    }
  });
}

function scrollNavbar(){
  window.addEventListener("scroll", function(){
    currentPosition = this.scrollY;
    
    if(mainPosition >=currentPosition){
      topNav.style.top = 0 + "px";
    }
    else{
      topNav.style.top = (navHeight*-1) + "px";
    }
    topNav.style.transition = "ease 0.5s";
    mainPosition = currentPosition;
  })
}



document.addEventListener("DOMContentLoaded", function(){
    init()
});