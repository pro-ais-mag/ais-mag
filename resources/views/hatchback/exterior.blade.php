@extends('hatchback')
@section('hatchback')

                   
                    <div class="row">
                        <div class="col-md-12">
                                <div>
                                    <img src="/img/full car illustration colour-01.jpg" id="img_exterior" width="988px" height="538px" name="img_exterior" usemap="#exterior_car">
                                <!--<img id="exterior_car" name="exterior_car" usemap="exterior_car">-->  
                                            
                                </div>
                        </div>
                    </div>   
                    <map name="exterior_car" id="exterior_car">
                                <area shape="poly" href="/hatchbackfrontbumper/{{$key}}" coords="243,383,245,323,257,302,272,279,325,231,345,214,343,234,356,254,384,276,418,296,460,310,481,313,494,312,497,330,498,401,482,412,484,396,480,379,472,374,459,377,445,387,432,405,416,444,415,460,393,469,354,471,341,467,337,463,303,447,272,428,256,411,251,406,243,383" title="Front Bumper" class="frontbumper">
                                <area shape="poly" href="/hatchbackfrontdoor/{{$key}}" coords="494,302,532,218,570,181,577,176,589,239,595,262,594,278,591,313,595,323,594,334,501,399,498,377,498,330,495,315,494,310,494,302" id="area_frontdoor" title="Front Door" class="frontdoor"> 
                                <area shape="poly" href="/hatchbackreardoor/{{$key}}" coords="596,235,583,173,633,143,664,178,680,196,680,203,667,243,646,288,638,303,595,330,596,321,591,312,597,244,596,235" title="Back Door" class="reardooroutter">    
                                <area shape="poly" href="/hatchbackrearbumper/{{$key}}" coords="633,143,672,117,628,85,591,62,565,48,588,45,617,54,643,65,690,94,720,121,726,136,735,162,739,188,736,222,728,240,726,228,722,219,715,214,707,215,695,222,685,231,678,239,669,254,664,250,678,214,680,196,670,183,656,168,633,149" title="Rear Bumper" class="rearbumper">
                                <area shape="poly" href="/hatchbackfrontsuspension/{{$key}}" coords="423,438,430,413,438,399,455,384,471,381,478,385,483,398,481,414,476,427,465,444,451,457,434,460,426,454,423,438" title="Front Wheel Suspension" class="frontwheel">
                                <area shape="poly" href="/hatchbackrearsuspension/{{$key}}" coords="671,288,667,273,673,250,681,238,697,224,713,221,720,225,725,238,723,253,719,264,709,279,695,291,689,293,687,294,679,294,671,288" title="Real Wheel Suspension" class="rearwheel">
                                </map>
                    </div>


@endsection