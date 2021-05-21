<?php $__env->startSection('vehicle'); ?>

                   
                    <div class="row">
                    <div class="col-md-12">
                            <div>
                                <img id="img_singlecab_exterior" name="img_singlecab_exterior" src="/img/singlecab_full_car.jpg" height="438px" width="988px" usemap="#map_singlecab_exterior">       
                            </div>
                            
                         <map id="map_singlecab_exterior" name="map_singlecab_exterior">
                                <area shape="poly" href="/doublecabdoor/<?php echo e($key); ?>" coords="350,353,345,334,344,301,340,244,349,209,360,149,372,117,388,119,428,144,446,190,449,207,443,235,439,266,438,334,439,361,436,365,350,353" title="Front Door" class="doublecab_door">
                                <area shape="poly" href="/doublecabreardoor/<?php echo e($key); ?>" coords="290,345,278,321,273,288,265,236,269,210,274,195,284,149,297,126,321,116,372,117,360,149,349,209,340,244,344,301,345,334,349,353,290,345" title="Rear Door" class="doublecab_reardoor">
                                <area shape="poly" href="/doublecabfrontsuspension/<?php echo e($key); ?>" coords="443,401,450,362,465,337,494,320,512,317,532,367,532,375,536,388,544,395,568,407,591,411,586,433,557,466,492,467,452,429,443,401" title="Front Suspension" class="singlecab_front_suspension">
                                <area shape="poly" href="/doublecabrearsuspension/<?php echo e($key); ?>" coords="197,395,195,374,196,337,218,303,241,301,253,334,261,354,270,377,286,380,285,401,277,423,270,433,230,436,214,429,203,412,197,394" title="Rear Suspension" class="doublecab_rearsuspension">
                                <area shape="poly" href="/doublecabrearbumper/<?php echo e($key); ?>" coords="285,352,261,354,253,334,233,284,201,269,182,306,180,334,176,331,158,333,157,335,142,317,137,289,143,286,142,272,138,262,137,240,140,214,147,198,157,188,230,179,232,172,249,155,264,139,291,116,267,201,261,222,261,258,270,305,273,328,292,353" title="Rear Bumper" class="">
                                <area shape="poly" href="/doublecabfrontbumper/<?php echo e($key); ?>" coords="442,375,438,334,439,266,443,235,449,207,480,207,500,207,558,201,608,196,657,192,694,190,715,186,721,186,785,204,818,221,831,241,831,259,840,266,843,274,845,317,843,335,847,345,840,360,820,366,627,390,544,395,536,388,532,375,532,367,507,309,488,298,473,295,457,299,448,318,443,341,442,375" title="Front Bumper" class="doublecab_front_bumper">
                        </map>
                              
                                
                
                    </div> 
             </div> 
             </div>
<?php $__env->stopSection(); ?> 
<?php echo $__env->make('vehicle', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>