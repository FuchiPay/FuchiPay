let nextBtn = document.querySelector('.next')
let prevBtn = document.querySelector('.prev')

let slider = document.querySelector('.slider')
let sliderList = slider.querySelector('.slider .list')
let thumbnail = document.querySelector('.slider .thumbnail')
let thumbnailItems = thumbnail.querySelectorAll('.item')

thumbnail.appendChild(thumbnailItems[0])

// Function for next button 
nextBtn.onclick = function() {
    moveSlider('next')
}


// Function for prev button 
prevBtn.onclick = function() {
    moveSlider('prev')
}


function moveSlider(direction) {
    let sliderItems = sliderList.querySelectorAll('.item')
    let thumbnailItems = document.querySelectorAll('.thumbnail .item')
    
    if(direction === 'next'){
        sliderList.appendChild(sliderItems[0])
        thumbnail.appendChild(thumbnailItems[0])
        slider.classList.add('next')
    } else {
        sliderList.prepend(sliderItems[sliderItems.length - 1])
        thumbnail.prepend(thumbnailItems[thumbnailItems.length - 1])
        slider.classList.add('prev')
    }


    slider.addEventListener('animationend', function() {
        if(direction === 'next'){
            slider.classList.remove('next')
        } else {
            slider.classList.remove('prev')
        }
    }, {once: true}) // Remove the event listener after it's triggered once
}

// Abre el modal al hacer clic en "Reservar"
function showReservationForm() {
    document.getElementById('reservationModal').style.display = 'block';
}

function closeModal() {
    document.getElementById('reservationModal').style.display = 'none';
}


// Cierra el modal al hacer clic en la 'X'
function closeModal() {
    document.getElementById('reservationModal').style.display = 'none';
}

// Cierra el modal al hacer clic fuera de él
window.onclick = function(event) {
    if (event.target == document.getElementById('reservationModal')) {
        closeModal();
    }
}

function showInfoModal() {
    document.getElementById("infoModal").style.display = "block";
}

function closeInfoModal() {
    document.getElementById("infoModal").style.display = "none";
}

// Cerrar el modal al hacer clic fuera de él
window.onclick = function(event) {
    let modal = document.getElementById("infoModal");
    if (event.target === modal) {
        modal.style.display = "none";
    }
};

