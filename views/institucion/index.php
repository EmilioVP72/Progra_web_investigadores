<main class="container my-5">
    <h2 class="text-center text-primary mb-4">Instituciones</h2>
    <div class="row g-4">
        
    <?php foreach ($instituciones as $institucion): ?>
    <div class="col-md-4">
            <div class="card">
                <img src="images/institucion/<?php echo $institucion['logotipo'];?>" class="card-img-top" alt="Noticia 1">
                <div class="card-body">
                    <h5 class="card-title text-primary" style="text-align: center;"><?php echo $institucion['institucion'];?></h5>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</main>
