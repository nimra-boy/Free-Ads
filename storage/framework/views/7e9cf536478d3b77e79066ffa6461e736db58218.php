<?php /* /home/armin/Documents/PHP/Piscine_MVC_Free_Ads/resources/views/index.blade.php */ ?>
<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center"><h1>BIENVENUE SUR FREEADS</h1></div>
                <div class="card-body text-center">
                    <h3>Pleins de petites annonces a perte de vue</h3>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>