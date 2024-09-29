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

  //Conecxion con la Base de Datos
  const formularioBusqueda = document.getElementById("form-buscar-usuario");
  const resultadoDiv = document.getElementById('resultado');
  
  formularioBusqueda.addEventListener("submit", consultar_en_tiempo_real);
  
  function consultar_en_tiempo_real(evento) {
      
      // Evita que se recargue la página
      evento.preventDefault();
  
      // Obtener el ultimo valor del input
      const nombre_usuario = document.getElementById("usuario").value;
  
      //se crea un objeto para tomar los valores del formulario
      const formData = new FormData();
      formData.append('usuario', nombre_usuario);
      formData.append('envio', true);
  
      // se le pasa al fetch el endpoint que genera la consulta de busqueda
      fetch('RF_buscar_user.php', {
          method: 'POST',
          body: formData
      })
  
      //se toma la respuesta y se devuelve en formato json
      .then(response => response.json())
      //la variable data se usa para recorrer el array asociativo del endpoint...
      .then(data => {
          
          resultadoDiv.innerHTML = ''; // Limpia el contenido previo
  
          //si el enpoint devuelve 1...
          if (data.status === 1) {
              data.usuarios.forEach(user => {
                  // se agrega html dentro del div que contiene el mensaje de respuesta
                  resultadoDiv.innerHTML += `<p>ID: ${user.id} - Nombre: ${user.nombre} - Email: ${user.email}</p><hr>`;
              });
          } else {
              resultadoDiv.innerHTML = `<p>${data.mensaje}</p>`;
          }
      })
      .catch(error => {
          console.error('Error:', error);
      });
  }

//Complejos
// let preveiwDeposito = document.querySelector('.complejos-preview');
// let previewBox = preveiwDeposito.querySelectorAll('.preview');

// document.querySelectorAll('.complejos-deposito .complejo').forEach(complejo => {
//   complejo.onclick = () => {
//     preveiwDeposito.style.display = 'flex';
//     let name = complejo.getAttribute('data-name');
//     previewBox.forEach(preview => {
//       let target = preview.getAttribute('data-target');
//       if (name == target) {
//         preview.classList.add('active');
//       }
//     });
//   };
// });

// previewBox.forEach(close => {
//   close.querySelector('.fa-times').onclick = () => {
//     close.classList.remove('active');
//     preveiwDeposito.style.display = 'none';
//   };
// });




