@extends('2door')
@section('2door')

                   
                    <div class="row">
                        <div class="col-md-12">
                                <div>
                                    <img src="/img/full car-01.jpg" id="img_exterior" width="988px" height="538px" name="img_exterior" usemap="#map_3door_exterior">
                                <!--<img id="exterior_car" name="exterior_car" usemap="exterior_car">-->  
                                            
                                </div>
                        </div>
                    </div>   
                    <map name="map_3door_exterior" id="map_3door_exterior">
                                <area shape="poly" href="/2doorFrontBumper/{{$key}}" coords="176,302,184,288,188,279,203,251,232,227,237,226,251,218,271,206,274,210,294,221,341,234,394,244,435,251,468,253,481,245,532,263,536,282,538,386,524,418,527,398,519,343,456,356,424,431,416,443,328,441,254,423,191,393,178,373,175,353,175,336,176,302" title="Front Bumper" class="3door_frontbumper">
                                <area shape="poly" href="/2doorFrontDoor/{{$key}}" coords="525,209,526,202,533,187,572,145,630,120,634,127,646,162,654,207,656,212,664,234,664,268,658,310,659,329,656,345,585,370,538,386,536,325,536,282,532,263,528,227,525,209" title="Front Door" class="3door_front_door"> 
                                <area shape="poly" href="/2doorRearSuspension/{{$key}}" coords="744,266,766,271,774,276,779,289,780,303,778,320,775,329,770,341,760,354,747,359,722,351,729,313,744,266" title="Rear Suspension" class="3door_rear_suspension">    
                                <area shape="poly" href="" coords="122,385,120,377,126,321,157,289,150,313,137,331,134,358,132,361,122,385" title="Rear Bumper" class="3door_rearbumper">
                                <area shape="poly" href="/2doorRearBumper/{{$key}}" coords="634,90,719,109,740,135,767,177,779,189,779,221,787,241,787,271,783,298,784,284,771,251,742,177,721,135,696,115,634,90" title="Rear Bumper" class="3door_rearbumper">           
                    </map>
                    </div>


@endsection