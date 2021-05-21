<?php $__env->startSection('content'); ?>
<?php if(Session::has('message')): ?>
    <div class="alert alert-info"><?php echo e(Session::get('message')); ?></div>
<?php endif; ?>


<div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-primary">Security Photos - <?php echo e($key); ?></h4>
                
            </div>
            <div class="card-body">
            <form action="/upload-quoted-photos" class="form-image-upload" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>

            <input type="hidden" name="ref" id="ref" value="<?php echo e($key); ?>">
            <div class="row">
            <div class="col-md-5">
                <strong>Title:</strong>
                <input type="text" name="title" class="form-control form-control-sm" placeholder="Title">
            </div>
            <div class="col-md-5">
                <strong>Image:</strong>
                <input type="file" name="image[]"  class="form-control-file" multiple required>
            </div>
            <div class="col-md-2">
                <br/>
                <button type="submit" class="btn btn-success btn-sm">Upload</button>
            </div>
        </div>
            </form>
            <br>
            <div class="row">
            <div class="row text-center text-lg-left">
            <?php if($images->count()): ?>
            <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php 
             $file_name="";  
             $path = '/images/mag_security/'.$image->Key_Ref.'/'.$image->url;
             $path2 = 'http://192.168.0.185:8080/mag_qoutation/mag_snapshot/security_images/'.$image->Key_Ref.'/'.$image->url;
             if (file_exists($path)) {
             $file_name =asset('/images/mag_security/'.$image->Key_Ref.'/'.$image->url);
             } else {
                $file_name = $path2;
             }
            ?>

                <div class='col-sm-2'>
                    <a class="thumbnail fancybox" rel="ligthbox" href="<?php echo e($file_name); ?>" target="_blank">
                        <img class="img-fluid img-thumbnail" src="<?php echo e($file_name); ?>" target="_blank">
                        <div class='text-center'>
                            <small class='text-muted'></small>
                        </div> <!-- text-center / end -->
                    </a>
                     <a class="btn btn-danger" href="/line-manager-delete/<?php echo e($image->id); ?>"><span class="fa fa-trash" ></span></a>
                     
                </div> <!-- col-6 / end -->
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>   
            <?php endif; ?>
            
        </div> <!-- list-group / end -->
    </div> <!-- row / end -->
    
</div>

            </div>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('quotations', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>