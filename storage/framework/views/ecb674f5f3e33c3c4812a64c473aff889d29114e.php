<?php $__env->startSection('content'); ?>
<div class="container" style="ocapacity=20px;">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default" style="opacity:.95;margin-top:100px;radius:25px;">
                <div class="panel-heading" style="text-align:center;color:red;">Register</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="<?php echo e(route('register')); ?>">
                        <?php echo e(csrf_field()); ?>


                        <div class="form-group<?php echo e($errors->has('username') ? ' has-error' : ''); ?>">
                            <label for="username" class="col-md-4 control-label">Userame</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control" name="username" value="<?php echo e(old('username')); ?>" required autofocus>

                                <?php if($errors->has('username')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('username')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group<?php echo e($errors->has('comp_code') ? ' has-error' : ''); ?>">
                            <label for="comp_code" class="col-md-4 control-label">Company Code</label>

                            <div class="col-md-6">
                                <select id="comp_code" class="form-control" name="comp_code" value="<?php echo e(old('comp_code')); ?>" required autofocus>
                                    <option value="MAG1001">MAG1001</option>
                                    <option Value="ML1001">ML1001</option>
                                    <option value="MG1001">MG1001</option>
                                    <option value="MC1001">MC1001</option>
                                </select>
                                <?php if($errors->has('comp_code')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('comp_code')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group<?php echo e($errors->has('position') ? ' has-error' : ''); ?>">
                            <label for="position" class="col-md-4 control-label">Position</label>

                            <div class="col-md-6">
                                <select id="position" class="form-control" name="position" value="<?php echo e(old('position')); ?>" required autofocus>
                                    <option value="Consumerables">Consumerables</option>
                                    <option Value="Line Manager">Line Manager</option>
                                    <option value="Reception">Reception</option>
                                    <option value="Estimator">Estimator</option>
                                    <option value="Administrator">Administrator</option>
                                </select>
                                <?php if($errors->has('comp_code')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('position')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="<?php echo e(old('email')); ?>" required>

                                <?php if($errors->has('email')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                <?php if($errors->has('password')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>