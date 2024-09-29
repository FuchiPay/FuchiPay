let preveiwDeposito = document.querySelector('.complejos-preview');
let previewBox = preveiwDeposito.querySelectorAll('.preview');

document.querySelectorAll('.complejos-deposito .complejo').forEach(complejo => {
  complejo.onclick = () => {
    preveiwDeposito.style.display = 'flex';
    let name = complejo.getAttribute('data-name');
    previewBox.forEach(preview => {
      let target = preview.getAttribute('data-target');
      if (name == target) {
        preview.classList.add('active');
      }
    });
  };
});

previewBox.forEach(close => {
  close.querySelector('.fa-times').onclick = () => {
    close.classList.remove('active');
    preveiwDeposito.style.display = 'none';
  };
});
