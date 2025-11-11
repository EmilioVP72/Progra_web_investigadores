<?php
include_once(__DIR__ . "/views/header.php");
?>

  <main class="container my-5">
    <div class="card shadow rounded">
      <div class="card-body p-5">

        <h1 class="text-center text-primary fw-bold">Descubren bacterias capaces de degradar plásticos en océanos</h1>
        <hr class="mx-auto mb-4">

        <section class="mb-4">
          <h2 class="text-secondary">Introducción</h2>
          <p>
            Un equipo internacional de científicos ha identificado nuevas cepas de bacterias capaces de descomponer 
            plásticos comunes en ambientes marinos. Este hallazgo representa un avance significativo en la lucha contra 
            la contaminación por residuos plásticos, uno de los mayores desafíos medioambientales actuales.
          </p>
          <div class="text-center mb-3">
            <img src="images/bacterias.png" class="img-fluid rounded shadow-sm" alt="Bacterias degradando plástico">
          </div>
        </section>

        <section class="mb-4">
          <h2 class="text-secondary">Objetivos del estudio</h2>
          <ul>
            <li>Analizar la capacidad de cepas bacterianas para degradar microplásticos en condiciones oceánicas.</li>
            <li>Comprender los mecanismos enzimáticos implicados en la descomposición de polímeros sintéticos.</li>
            <li>Evaluar el potencial de estas bacterias en programas de bioremediación a gran escala.</li>
          </ul>
        </section>

        <section class="mb-4">
          <h2 class="text-secondary">Metodología</h2>
          <p>
            Los investigadores recolectaron muestras de agua y sedimentos marinos en zonas altamente contaminadas. 
            Posteriormente, aislaron cepas bacterianas en laboratorio y realizaron ensayos de degradación de plásticos 
            como PET y polietileno. Además, aplicaron técnicas de secuenciación genética para identificar los genes 
            responsables de la producción de enzimas degradadoras.
          </p>
          <div class="row text-center mb-3">
            <div class="col-md-6 mb-3">
              <img src="images/analisis.jpg" 
                   class="img-fluid rounded shadow-sm" alt="Análisis en laboratorio">
            </div>
            <div class="col-md-6 mb-3">
              <img src="images/analisis2.jpg" 
                   class="img-fluid rounded shadow-sm" alt="Pruebas de degradación">
            </div>
          </div>
        </section>

        <section class="mb-4">
          <h2 class="text-secondary">Resultados</h2>
          <p>
            Los resultados mostraron que ciertas bacterias pueden reducir hasta un 40% la masa de plásticos en un 
            periodo de seis semanas. Las enzimas producidas por estas cepas demostraron alta eficacia en ambientes salinos, 
            lo que abre la posibilidad de emplearlas en programas de limpieza de océanos y costas.
          </p>
          <div class="text-center mb-3">
          </div>
        </section>

        <section>
          <h2 class="text-secondary">Conclusiones</h2>
          <p>
            Este descubrimiento resalta el potencial de las bacterias como aliadas en la lucha contra la contaminación 
            plástica. Sin embargo, los científicos advierten que aún se requiere más investigación para garantizar la 
            seguridad y eficiencia de su uso en ecosistemas naturales a gran escala.
          </p>
        </section>

      </div>
    </div>
  </main>

<?php
include_once(__DIR__ . "/views/footer.php");
?>