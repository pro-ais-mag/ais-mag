<?php $__env->startSection('maps'); ?>
<!-- Google Maps JS Scripts -->
<script type='text/javascript'>
            var centreGot = false;
</script>
<?php echo $map['js']; ?>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php if(Session::has('message')): ?>
    <div class="alert alert-info"><?php echo e(Session::get('message')); ?></div>
<?php endif; ?>
<div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-primary">Driver Current Locations.</h4>
                
            </div>
            <div class="card-body">
              <div class="row">
                <table class="table table-dark">
                    <thead style="font-size:12px;">
                        <tr>
                            <th>#</th>
                            <th>Driver Username</th>
                            <th>Current Latitude</th>
                            <th>Current Longitude</th>
                            <th>Current Location</th>
                            <th>Status</th>
                            <th>Task</th>
                            <th>&nbsp</th>
                        </tr>
                    </thead>
                    <tbody style="font-size:10px;">
                       <?php echo $table;?>
                    </tbody>
                </table>
                
                    <h4 class="text text-primary" style="text-align:center;font-weight:bold;">Driver Location.</h4>
                        
               <?php echo $map['html']; ?>

                                    
              </div>  
            </div>
</div>


<!-- Driver Destinstion Interface-->
<div class="modal fade" id="driver_destination" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
    <div class="modal-dialog modal-dialog-centered modal-dialog-lg" role="document">
      <div class="modal-content" >
        <div class="modal-header bg-success">
          <h6 class="modal-title" id="exampleModalLabel" style="color:white;text-align:center;">Driver Destination.</h6>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body" >
        <form action="/driver-destination" method="POST">
			<div class="row">
                <div class="col-12">
                    <label for="driver_name">Driver Name:</label>
                    <input type="text" id="driver_name" name="driver_name" class="form-control form-control-sm">
                 
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <label for="pac-input">Set Destinstion:</label>
                    <input type="text" placeholder="Enter Location" id="pac-input" class="controls form-control-sm" type="text">
                </div>
            </div>
            <div class="row">
                <div id="map"></div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger btn-sm" data-dismiss="modal">Close </button>  
                <input type="submit" class="btn btn-success btn-sm" value="Send Request"> 
      </form>          
            </div>
        </div>
        
      </div>
    </div>
</div>
<!-- End Of Driver Destination -->

<!-- Driver Destinstion Cancellation Interface-->
<div class="modal fade" id="driver_trip_cancellation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
    <div class="modal-dialog modal-dialog-centered modal-dialog-lg" role="document">
      <div class="modal-content" >
        <div class="modal-header bg-danger">
          <h6 class="modal-title" id="exampleModalLabel" style="color:white;text-align:center;">Driver Trip Cancel.</h6>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body" >
        <form action="/driver-trip-cancel" method="GET">
			<div class="row">
                <div class="col-12">
                    <label for="driver_cancel">Driver Name:</label>
                    <input type="text" id="driver_cancel" name="driver_cancel" class="form-control form-control-sm">
                 
                </div>
            </div>
            
            <div class="modal-footer">
                <button class="btn btn-secondary btn-sm" data-dismiss="modal">Close </button>  
                <input type="submit" class="btn btn-danger btn-sm" value="Cancel Request"> 
      </form>          
            </div>
        </div>
        
      </div>
    </div>
</div>
<!--End Of Driver Destinstion Cancellation Interface-->

<?php $__env->stopSection(); ?>

<?php echo $__env->make((Auth::user()->position == 'Administrator') ? 'administrator' : 'alluser', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>