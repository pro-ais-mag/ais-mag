@extends('2door')
@section('2door')

                   
                    <div class="row">
                        <div class="col-md-12">
                                <div>
                                    <img src="/img/3door_fuel_system.jpg" id="img_exterior" width="988px" height="538px" name="img_exterior" usemap="#map_3door_fuel_system">
                                <!--<img id="exterior_car" name="exterior_car" usemap="exterior_car">-->  
                                            
                                </div>
                        </div>
                    </div>   
                    <map name="map_3door_fuel_system" id="map_3door_fuel_system">
                    <area shape="poly" href="#" class="door3_fuel" coords="343,230,348,217,357,211,368,212,377,222,378,237,384,238,402,266,410,292,409,347,412,352,461,367,493,347,498,349,502,354,506,352,508,356,502,359,502,364,468,385,456,387,409,372,387,348,385,290,363,250,354,250,345,241,343,230" title="Filler Pipe" data-picture_id="Filler Pipe" group="filler-pipe" id="FillerPipe">
                            <area shape="poly" href="#" class="door3_fuel" coords="280,196,280,146,287,141,319,159,326,158,343,171,351,199,345,211,340,222,319,229,300,220,280,196" title="Filler Neck Insert" data-picture_id="Filler Neck Insert" group="filler-neck-insert" id="FillerNeckInsert">
                            <area shape="poly" href="#" class="door3_fuel" coords="191,282,198,268,212,271,222,283,224,290,231,298,228,303,218,311,205,309,194,296,191,282" title="Fuel Filler Cap" data-picture_id="Fuel Filler Cap" group="fuel-filler-cap" id="FuelFillerCap">
                            <area shape="poly" href="#" class="door3_fuel" coords="319,341,325,336,329,336,340,343,346,348,349,349,353,346,357,345,363,350,364,356,370,359,375,358,382,361,382,385,387,391,387,420,384,422,381,421,377,424,344,428,374,430,362,421,354,419,355,391,352,387,352,378,343,370,340,370,327,372,319,356" title="Filler Pipe Gaurd" data-picture_id="Filler Pipe Guard" group="filler-pipe-guard" id="FillerPipeGuard">
                            <area shape="poly" href="#" class="door3_fuel" coords="595,338,604,312,604,307,619,271,638,253,646,257,715,206,720,197,766,189,787,202,800,203,813,214,813,268,811,281,812,292,797,317,718,367,648,380,629,375,606,360,595,338" title="Fuel Tank" data-picture_id="Fuel Tank" group="fuel-tank" id="FuelTank">
                            <area shape="poly" href="#" class="door3_fuel" coords="256,223,257,213,262,207,271,201,296,221,294,252,284,257,265,247,260,238,256,223" title="Nozzle Neck" data-picture_id="Nozzle Neck" group="nozzle-neck" id="NozzleNeck">
                            <area shape="poly" href="#" class="door3_fuel" coords="229,249,244,244,249,244,254,261,250,271,239,275,229,271,229,261,229,249" title="Volve Fuel Cap" data-picture_id="Volve Fuel Cap" group="volve-fuel-cap" id="VolveFuelCap">
                            <area shape="poly" href="#" class="door3_fuel" coords="555,68,568,57,566,55,569,51,577,56,591,68,591,79,583,87,583,112,572,119,560,110,560,83,555,76,555,68" title="Fuel Pump" data-picture_id="Fuel Pump" group="fuel-pump" id="FuelPump">                   
                    </map>
                    </div>

<!--Highlight Saved Parts-->
@php
$count=0;
$id=array();
foreach($quote_info as $quote){
$selected_part="";
$q_descript=$quote->Description;
$new_descript= str_replace(" ","",$q_descript);
$description=str_replace("/",".",$new_descript);
$highlight="$('#".$description."').mapster('select');";
array_push($id,$highlight);
$selected_part.=$highlight;
//echo $highlight;
//echo $selected_part;
$count=$count+1;

}

@endphp



<!--Fuel -->
<script type="text/javascript">

$(document).ready(function() {
	@php 
  for($i=0;$i<count($id);$i++){
  echo $id[$i];
  
}
  @endphp
});

	function state_change(data) {
		//alert(data.state+":"+data.selected);
	}
	$('img').mapster({
		noHrefIsMask: false,
		onStateChange: state_change,
		fillColor: '0a7a0a',
		fillOpacity: 0.7,
		mapKey: "group",
		strokeWidth: 5,
		stroke:true,
		strokeColor: '4141ff',
		render_select: {
			fillColor: 'adadad',
			fillOpacity: 0.5

		},
		areas: [
			{
				key: 'blue-circle',
				includeKeys: 'rectangle',
				stroke:false
			},
			{
				key: 'rectangle',
				stroke: true,
				strokeWidth: 3
			},
			{
				key: 'outer-circle',
				includeKeys: 'inner-circle-mask,outer-circle-mask',
				stroke: true
			},
			{
			    key: 'outer-circle-mask',
			    isMask: true,
			    fillColorMask: 'ff002a'
			},
			{
			    key: 'inner-circle-mask',
			    fillColor: '8bf058',
			    isMask: true
			},
            {
			    key: 'fuel-tank-flap',
			    fillColor: '8bf058',
			    isMask: true
            },
            {
			    key: 'fuel-filler-cap',
			    fillColor: '8bf058',
			    isMask: true
            },
            {
			    key: 'volve-filler-connector',
			    fillColor: '8bf058',
			    isMask: true
            },
            {
			    key: 'filler-pipe-guard',
			    fillColor: '8bf058',
			    isMask: true
            },
            {
			    key: 'fuel-inject-pipe',
			    fillColor: '8bf058',
			    isMask: true
            },
            {
			    key: 'active-carbon-unit',
			    fillColor: '8bf058',
			    isMask: true
            },
            {
			    key: 'fuel-pump',
			    fillColor: '8bf058',
			    isMask: true
            },
            {
			    key: 'fuel-tank',
			    fillColor: '8bf058',
			    isMask: true
            },
            {
			    key: 'fuel-tank-protection',
			    fillColor: '8bf058',
			    isMask: true
            },
            {
			    key: 'filler-pipe',
			    fillColor: '8bf058',
			    isMask: true
            },
            {
			    key: 'volve-fuel-cap',
			    fillColor: '8bf058',
			    isMask: true
            }
        ]
	});



</script>
@endsection