 <main class="container my-4" id="miembros">
     <h1 class="fw-bold text-primary text-center">MIEMBROS INVESTIGADORES DE LA RED</h1>
     <hr class="mx-auto" style="width: 60%; border-top: 2px solid #00509e;">
     <div class="table-responsive shadow rounded">
         <table class="table custom-table align-middle mb-0">
             <thead>
                 <tr>
                     <th>nombre</th>
                     <th>Grado Académico</th>
                     <th>Email</th>
                     <th>Semblanza</th>
                     <th>Foto</th>
                 </tr>
             </thead>
             <tbody>
                <?php foreach($investigadores as $investigador):?>
                 <tr>
                     <td><?php echo $investigador['primer_apellido'].' '. $investigador['segundo_apellido'].' '. $investigador['nombre'];?></td>
                     <td>PhD en Biotecnología</td>
                     <td><a href="mailto:maria.gonzalez@uni.edu">maria.gonzalez@uni.edu</a></td>
                     <td>z<?php echo $investigador['semblanza'];?></td>
                     <td><img src="https://randomuser.me/api/portraits/women/44.jpg" class="img-fluid rounded-circle" width="60"></td>
                     <td></td>
                 </tr>
                 <?php endforeach?>
             </tbody>
         </table>
     </div>
 </main>