<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>PetShop Admin</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
<header>
  <h1>🐾 Sistema PetShop</h1>
</header>
<div class="container">
  <h2>Menu Principal</h2>
  <a class="btn" href="cliente/consulta_cliente.php">Gerenciar Clientes</a>
  <a class="btn" href="animal/consulta_animal.php">Gerenciar Animais</a>
  <a class="btn" href="agendamento/consulta_agenda.php">Gerenciar Agendamentos</a>
</div>
<div class="carousel-container">
  <div class="carousel">
    <img src="img/pet1.jpg" alt="Pet 1" class="carousel-slide active">
    <img src="img/pet2.jpg" alt="Pet 2" class="carousel-slide">
    <img src="img/pet3.jpg" alt="Pet 3" class="carousel-slide">
    <img src="img/pet4.jpg" alt="Pet 4" class="carousel-slide">
    <img src="img/pet5.jpg" alt="Pet 5" class="carousel-slide">
    <img src="img/pet6.jpg" alt="Pet 3" class="carousel-slide">
  </div>
  <button class="prev">&#10094;</button>
  <button class="next">&#10095;</button>
</div>
</body>
<script>
const slides = document.querySelectorAll('.carousel-slide');
const prev = document.querySelector('.prev');
const next = document.querySelector('.next');
let current = 0;

function showSlide(index) {
  slides.forEach((slide, i) => {
    slide.classList.remove('active');
    if (i === index) slide.classList.add('active');
  });
}

prev.addEventListener('click', () => {
  current = (current === 0) ? slides.length - 1 : current - 1;
  showSlide(current);
});

next.addEventListener('click', () => {
  current = (current === slides.length - 1) ? 0 : current + 1;
  showSlide(current);
});


setInterval(() => {
  current = (current + 1) % slides.length;
  showSlide(current);
}, 5000);
</script>
</html>