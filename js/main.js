function init(){
  adaptiveMenu();
  initSlider();
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
  let topNav = document.getElementById("top-navigation");
  let navList = document.getElementById("navigation-list");
  let mobileCheck = document.getElementById("mobile-check");
  let height = topNav.offsetHeight;

  mobileCheck.addEventListener("click",function(){
    if(this.checked){
      navList.style.top = height + "px";
    }
  });
}



document.addEventListener("DOMContentLoaded", function(){
    init()
    
});