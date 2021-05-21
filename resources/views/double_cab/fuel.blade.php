@extends('vehicle')
@section('vehicle')
                    <div class="row">
                    <div class="col-md-12">
                            <div>
                                <img id="img_doublecab_fuel" name="img_doublecab_fuel" src="/img/singlecab_fuelsystem.jpg" height="538px" width="988px" usemap="#map_doublecab_fuel_system">       
                            </div>
                            <map id="map_doublecab_fuel_system" name="map_doublecab_fuel_system">
                            
                            <area shape="poly" href="#" class="doublecab_fuel_system" coords="226,333,227,321,229,301,235,297,239,296,242,300,262,318,259,339,252,355,247,357,235,345,234,341,226,333" title="Fuel Tank Flap" id="FuelTankFlap"  data-picture_id="Fuel Tank Flap" group="fuel-tank-flap">
                            <area shape="poly" href="#" class="doublecab_fuel_system" coords="267,301,276,295,286,302,286,306,285,307,279,316,272,314,267,301" title="Fuel Filler Cap" id="FuelFillerCap" data-picture_id="Fuel Filler Cap" group="fuel-filler-cap">
                            <area shape="poly" href="#" class="doublecab_fuel_system" coords="293,283,300,279,305,282,311,278,321,284,323,299,315,305,315,311,311,314,296,305,293,300,293,283" title="Volve Fuel Cap" id="VolveFuelCap" data-picture_id="Volve Fuel Cap" group="volve-fuel-cap">
                            <area shape="poly" href="#" class="doublecab_fuel_system" coords="328,274,333,270,336,271,347,273,354,280,350,289,345,286,341,290,336,292,329,286,328,281,328,274" title="Volve/Filler Connector" id="VolveFillerConnector" data-picture_id="Volve/Filler Connector" group="volve-filler-connector">
                            <area shape="poly" href="#" class="doublecab_fuel_system" coords="363,281,370,273,376,275,392,274,404,286,410,313,427,313,436,307,454,297,462,304,464,307,436,326,411,328,399,323,391,290,377,290,370,294,363,281" title="Filler Pipe" id="FillerPipe" data-picture_id="Filler Pipe" group="filler-pipe">
                            <area shape="poly" href="#" class="doublecab_fuel_system" coords="470,290,495,277,507,286,500,294,494,289,476,299,470,298,470,290" title="Filler Pipe Guard" id="FillerPipeGuard" data-picture_id="Filler Pipe Guard" group="filler-pipe-guard">
                            <area shape="poly" href="#" class="doublecab_fuel_system" coords="346,89,350,86,353,88,354,87,358,88,358,92,378,104,387,111,399,140,401,147,512,217,517,219,518,201,524,198,536,205,546,201,546,200,550,197,554,204,551,205,542,209,532,210,523,204,522,220,515,226,401,152,394,146,389,131,380,113,357,97,354,98,352,96,351,94,346,89" title="Fuel Inject Pipe" id="FuelInjectPipe" data-picture_id="Fuel Inject Pipe" group="fuel-inject-pipe">
                            <area shape="poly" href="#" class="doublecab_fuel_system" coords="395,58,400,51,406,54,406,58,418,64,423,73,427,93,431,97,551,175,556,173,564,166,577,181,585,196,589,197,593,199,592,205,586,207,584,203,575,196,572,184,563,172,559,180,549,180,521,162,489,141,460,122,424,99,421,87,418,72,412,66,401,61,398,61,395,58" title="Fuel Inject Pipe" id="FuelInjectPipe" data-picture_id="Fuel Inject Pipe" group="fuel-inject-pipe">
                            <area shape="poly" href="#" class="doublecab_fuel_system" coords="635,210,642,204,644,206,653,201,653,192,656,190,664,195,670,188,669,174,680,161,683,165,683,170,678,174,676,171,673,174,673,188,667,196,670,198,670,221,664,224,653,217,653,205,646,209,645,212,639,216,635,215,635,210" title="Active Carbon Unit" id="ActiveCarbonUnit" data-picture_id="Active Carbon Unit" group="active-carbon-unit">
                            <area shape="poly" href="#" id="FuelPump" class="doublecab_fuel_system" coords="588,216,602,208,614,218,613,232,620,237,620,210,629,198,633,199,633,203,629,205,626,205,623,210,623,237,620,243,619,255,614,258,614,268,608,276,619,285,629,292,631,291,635,296,632,298,627,295,627,292,624,291,607,278,607,277,596,277,588,270,588,216" title="Fuel Pump" id="FuelPump" data-picture_id="Fuel Pump" group="fuel-pump">
                            <area shape="poly" href="#" class="doublecab_fuel_system" coords="481,375,489,369,489,365,498,356,510,347,516,324,513,321,515,318,512,316,515,307,507,302,508,297,513,291,521,297,526,291,528,294,532,293,537,296,540,297,556,288,557,285,556,282,559,279,55,271,555,262,559,262,563,276,567,274,571,278,585,274,617,274,631,262,637,254,652,253,659,249,683,242,710,257,740,278,740,299,733,309,701,331,685,331,675,335,671,351,666,354,663,353,657,358,657,361,606,394,602,395,600,397,592,402,575,404,551,419,536,420,490,391,490,386,481,381,481,375" title="Fuel Tank" id="FuelTank" data-picture_id="Fuel Tank" group="fuel-tank">
                            <area shape="poly" href="#" class="doublecab_fuel_system" coords="481,386,543,426,740,307,729,335,554,447,548,441,542,441,536,437,516,427,516,424,494,412,494,409,470,396,468,393,481,386" title="Fuel Tank Protection" id="FuelTankProtection" data-picture_id="Fuel Tank Protection" group="fuel-tank-protection">
                            <area shape="poly" href="#" class="doublecab_fuel_system" coords="" title="Part" data-picture_id="Part">
                            <area shape="poly" href="#" class="doublecab_fuel_system" coords="" title="Part" data-picture_id="Part">
                        
                        </map>
                    </div>
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