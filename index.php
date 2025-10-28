
  <header>
    <h1>Red de Investigación</h1>
    <section>
      <div id="carouselExample" class="carousel slide">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="images/parasitos.png" class="d-block img-fluid" alt="Imagen 1">
          </div>
          <div class="carousel-item">
            <img src="images/tortuga-marina.png" class="d-block img-fluid" alt="Imagen 2">
          </div>
          <div class="carousel-item">
            <img src="images/celulas.png" class="d-block img-fluid" alt="Imagen 3">
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
          <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
          <span class="carousel-control-next-icon"></span>
        </button>
      </div>
    </section>
  </header>

  <?php
include_once("./views/header.php");
?>

  <main class="container my-5">
    <h2 class="text-center text-primary mb-4">Últimas Publicaciones</h2>
    <div class="row g-4">
      <div class="col-md-4">
        <div class="card">
          <img src="images/noticias/3.jpg" class="card-img-top" alt="Noticia 1">
          <div class="card-body">
            <h5 class="card-title text-primary">Estudio sobre Parásitos</h5>
            <p class="card-text">
              Un avance importante en la investigación de organismos que afectan la vida marina y terrestre.
            </p>
            <a href="#" class="btn btn-outline-primary">Leer más</a>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card">
          <img src="images/noticias/noticia1.jpg" class="card-img-top" alt="Noticia 2">
          <div class="card-body">
            <h5 class="card-title text-primary">Conservación de Tortugas</h5>
            <p class="card-text">
              Investigaciones actuales para preservar y proteger especies en peligro de extinción.
            </p>
            <a href="#" class="btn btn-outline-primary">Leer más</a>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card">
          <img src="images/noticias/2.jpg" class="card-img-top" alt="Noticia 3">
          <div class="card-body">
            <h5 class="card-title text-primary">Innovaciones Moleculares</h5>
            <p class="card-text">
              Descubrimientos recientes en biología molecular con aplicaciones médicas y ambientales.
            </p>
            <a href="#" class="btn btn-outline-primary">Leer más</a>
          </div>
        </div>
      </div>
    </div>
  </main>

  <?php
include_once("./views/footer.php");
?>
