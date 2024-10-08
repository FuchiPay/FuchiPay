// cambiar a modo oscuro 
const body = document.querySelector('body'),
      sidebar = body.querySelector ('nav'),
      toggle = body.querySelector(".toggle"),
      searchBtn = body.querySelector (".search-box"),
      modeSwitch = body.querySelector (" .toggle-switch"),
      modeText = body.querySelector (".mode-text");
toggle.addEventListener("click", () =>{
    sidebar.classList.toggle("close");
})

searchBtn.addEventListener("click", () =>{
    sidebar.classList.remove("close");
})

modeSwitch.addEventListener("click", () =>{

    body.classList.toggle("dark");
    if (body.classList.contains("dark")){
        modeText.innerText = "Light mode"

    } else{
        modeText.innerText = "Dark mode"
    }

})

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