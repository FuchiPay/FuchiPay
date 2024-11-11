const cloud = document .getElementById("cloud");
const barraLateral = document.querySelector(".barra-lateral");
const spans = document.querySelectorAll("span");
const palanca = document.querySelector(".switch");
const circulo = document.querySelector(".circulo");
const menu = document.querySelector(".menu");
const main = document.querySelector("main");

 
menu.addEventListener("click",()=>{
     barraLateral.classList.toggle("max-barra-lateral");
     if(barraLateral.classList.contains("max-barra-lateral")){
        menu.children[0].style.display = "none";
        menu.children[1].style.display = "block"; 
     }
     else{
        menu.children[0].style.display = "block";
        menu.children[1].style.display = "none"; 
     }
     if(window.innerWidth<=320){
        barraLateral.classList.add("mini-barra-lateral");
        main.classList.add("min-main");
        spans.forEach((span)=>{
           span.classList.add("oculto");
        });
     }

});


palanca.addEventListener("click",()=>{
    let body = document.body;
    body.classList.toggle("dark-mode"); 
    circulo.classList.toggle("prendido");
});



cloud .addEventListener("click",()=>{
    barraLateral.classList.toggle("mini-barra-lateral");
    main.classList.toggle("min-main");
    spans.forEach((span)=>{
       span.classList.toggle("oculto");
    })
});

// Pantalla de carga

document.addEventListener("DOMContentLoaded", function() {
   const splashScreen = document.getElementById('splash-screen');

   // Simulación de tiempo de carga
   setTimeout(function() {
       splashScreen.style.opacity = '0';
       splashScreen.style.transition = 'opacity 1s ease';

       // Ocultar el splash screen después de la transición
       setTimeout(function() {
           splashScreen.style.display = 'none';
       }, 1000);
   }, 2000); // Aquí defines el tiempo que durará la pantalla de carga (en milisegundos)
});

// Deslizamineto de las cartas

 new Swiper('.card-wrapper', {
    
   loop: true,
   spaceBetween: 30,
 
   //pagination
   pagination: {
     el: '.swiper-pagination',
   },
 
   // Navigation arrows
   navigation: {
     nextEl: '.swiper-button-next',
     prevEl: '.swiper-button-prev',
   },

   breakpoints: {
       0:{
           slidesPerView: 1
       },
       768: {
           slidesPerView: 2
       },
       1024: {
           slidesPerView: 3
       },
   }
 
 });

//Logout
function confirmLogout(event) {
 event.preventDefault(); // Evitar la navegación
 const confirmation = confirm("¿Estás seguro de que quieres cerrar sesión?");
 if (confirmation) {
     window.location.href = "login.html"; // Redirigir a la página de inicio si confirma
 }
}