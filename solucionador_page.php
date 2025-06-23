<?php
/*
 * Template Name: Solucionador
 */
get_header();
?>

<div class="container">
   <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
      <ol class="breadcrumb">
         <li class="breadcrumb-item"><a href="<?php echo home_url('/'); ?>">Home</a></li>
         <li class="breadcrumb-item active" aria-current="page">Simuladores</li>
      </ol>
   </nav>
   <div class="row row-cols-auto">
      <div class="col" style="width: 250px; height: 350px;">
         <a href="https://phet.colorado.edu/pt_BR/simulations/forces-and-motion-basics" class="text-decoration-none text-reset" target="_blank">
            <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative bg-body-secondary">
               <div class="col p-2">
                  <h6 class="mb-0 text-center">Forças e Movimento</h6>
               </div>
               <div class="ratio ratio-4x3">
                  <img class="thumbnail" src="https://phet.colorado.edu/sims/html/forces-and-motion-basics/latest/forces-and-motion-basics-420.png" alt="">
               </div>
            </div>
         </a>
      </div>
      <div class="col" style="width: 250px; height: 350px;">
         <a href="https://phet.colorado.eduhref/pt_BR/simulations/projectile-motion" class="text-decoration-none text-reset" target="_blank">
            <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative bg-body-secondary">
               <div class="col p-2">
                  <h6 class="mb-0 text-center">Movimento de Projétil</h6>
               </div>
               <div class="ratio ratio-4x3">
                  <img class="thumbnail" src="https://phet.colorado.edu/sims/html/projectile-motion/latest/projectile-motion-420.png" alt="">
               </div>
            </div>
         </a>
      </div>
      <div class="col" style="width: 250px; height: 350px;">
         <a href="https://phet.colorado.edu/pt_BR/simulations/friction" class="text-decoration-none text-reset" target="_blank">
            <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative bg-body-secondary">
               <div class="col p-2">
                  <h6 class="mb-0 text-center">Atrito</h6>
               </div>
               <div class="ratio ratio-4x3">
                  <img class="thumbnail" src="https://phet.colorado.edu/sims/html/friction/latest/friction-420.png" alt="">
               </div>
            </div>
         </a>
      </div>
   </div>
   <!-- Footer -->
   <footer class="text-center mt-5 py-3 bg-light">
      <p class="mb-0">As simulações apresentados nesta página pertencem ao projeto <a href="https://phet.colorado.edu" target="_blank">PhET Interactive Simulations</a>. Todos os direitos reservados.</p>
   </footer>
</div>
