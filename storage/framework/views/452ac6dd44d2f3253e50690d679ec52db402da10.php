<?php $__env->startSection('content'); ?>
<?php if(Session::has('message')): ?>
    <div class="alert alert-info"><?php echo e(Session::get('message')); ?></div>
<?php endif; ?>
<div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-primary">Client Documents - <?php echo e($key); ?></h4>
            </div>
            <div class="card-body">
           
            <form action="/line-manager-upload-doc" class="form-image-upload" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>

            <input type="hidden" name="ref" id="ref" value="<?php echo e($key); ?>">
            <div class="row">
            <div class="col-md-5">
                <strong>Doc Description:</strong>
                <select name="description" id="description" class="form-control form-control-sm" required>
                <option value="">Choose Document Type</option>
                 <?php $__currentLoopData = $descriptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $docs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($docs->description); ?>"><?php echo e($docs->description); ?></option>
                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>   
                </select>
            </div>
            <div class="col-md-5">
                <strong>Document:</strong>
                <input type="file" name="image" id="image" class="form-control-file form-control-file-sm" required>
            </div>
            <div class="col-md-2">
                <br/>
                <button type="submit" class="btn btn-success btn-sm">Upload Document</button>
            </div>
        </div>
            </form><br><br>
                <div class="row">
                    <div class="table-responsive">
                        <table class="table-sm table-bordered" style="font-size:10px;" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>File Name</th>
                                    <th>File Description</th>
                                    <th>Date Modified</th>
                                    <th>Time</th>
                                    <th>Modified By</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($doc->url); ?></td>
                                    <td><?php echo e($doc->Description); ?></td>
                                    <td><?php echo e($doc->date); ?></td>
                                    <td><?php echo e($doc->time); ?></td>
                                    <td><?php echo e($doc->user); ?></td>
                                    <td><a href="/docs/uploaded/<?php echo e($key); ?>/<?php echo e($doc->url); ?>" title="Open Document" target="_blank" class="btn btn-primary btn-sm"><span class="fa fa-search"></span></a></td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
</div>
<?php $__env->stopSection(); ?>            
<?php echo $__env->make('quotations', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>