<?php $__env->startSection('singlecab'); ?>
                    <div class="row">
                    <div class="col-md-12">
                            <div>
                                <img id="img_cab_exterior" name="img_cab_exterior" src="/img/cab_full.jpg" height="538px" width="988px" usemap="#map_cab_full">       
                            </div>
                            <map id="map_cab_full" name="map_cab_full">
                                 <area shape="poly" href="#" class="cab_full" coords="" title="Part" data-picture_id="Part">
                                 <area shape="poly" href="/singlecabdoor/<?php echo e($key); ?>" coords="330,330,325,316,323,297,320,241,325,224,330,220,344,167,358,150,395,158,427,216,422,250,420,303,420,357,330,330" title="Front Door">
                                 <area shape="poly" href="#" coords="426,229,445,230,540,218,627,216,634,217,742,252,754,266,758,283,759,286,767,296,768,313,768,318,770,331,768,338,769,356,753,372,741,373,727,377,661,395,624,399,603,405,527,402,518,385,510,355,492,325,473,311,458,307,448,306,437,314,429,331,425,358,425,366,419,364,420,357,420,303,422,250,426,229 " title="Front Bumper">
                                 <area shape="poly" href="#" coords="222,296,203,280,194,235,201,203,330,199,325,220,320,241,323,297,325,316,332,334,289,320,269,309,239,256,224,279,224,279,222,296" title="Rear Canopy">
                                 <area shape="poly" href="#" coords="442,381,442,364,448,345,452,339,465,330,481,333,492,341,503,357,510,378,512,395,511,412,505,429,489,442,461,429,451,414,445,400,443,392,442,381" title="Front Suspension">
                                 <area shape="poly" href="/singlecabrearsuspension/<?php echo e($key); ?>" coords="233,311,234,302,236,293,239,287,241,284,246,281,252,283,256,288,260,295,262,300,264,309,266,319,266,331,263,350,254,359,246,356,241,348,237,339,234,322,233,311" title="Rear Suspension">
                            </map>
                    </div>
                    </div>     
<?php $__env->stopSection(); ?>                    
<?php echo $__env->make('singlecab', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>