@extends('singlecab')
@section('singlecab')
                    <div class="row">
                    <div class="col-md-12">
                            <div>
                                <img id="img_singlecab_fuel" name="img_doublecab_fuel" src="/img/cab_fuel.jpg" height="538px" width="988px" usemap="#map_singlecab_fuel">       
                            </div>
                            <map id="map_singlecab_fuel" name="map_singlecab_fuel">
                                 <area shape="poly" href="#" class="singlecab_fuel" coords="194,249,194,224,203,218,208,221,212,219,215,222,215,226,233,237,239,249,240,267,230,274,217,273,207,268,194,249" title="Fuel Tank Flap" data-picture_id="Fuel Tank Flap" group="fuel-tank-flap" id="FuelTankFlap">
								 <area shape="poly" href="#" class="singlecab_fuel" coords="228,228,225,216,227,209,231,206,236,203,242,205,247,206,251,210,255,219,252,224,251,230,248,233,242,237,228,228" title="Fuel Filler Cap" data-picture_id="Fuel Filler Cap" group="fuel-filler-cap" id="FuelFillerCap">
								 <area shape="poly" href="#" class="singlecab_fuel" coords="252,203,252,187,257,183,263,185,270,185,274,181,278,181,290,204,283,210,279,215,279,223,274,227,272,226,259,218,252,203" title="Valve Fuel Cap" data-picture_id="Valve Fuel Cap" group="valve-fuel-cap" id="ValveFuelCap">
								 <area shape="poly" href="#" class="singlecab_fuel" coords="288,177,289,168,293,164,300,162,304,164,320,165,339,184,340,192,337,197,327,202,320,195,315,196,308,201,299,199,290,187,288,177" title="Valve/Filler Connector" data-picture_id="Valve/Filler Connector" group="valve-filler-connector" id="ValveFillerConnector">
								 <area shape="poly" href="#" class="singlecab_fuel" coords="322,204,344,207,344,184,356,196,356,211,368,218,380,237,390,269,391,329,442,346,478,324,484,332,489,331,491,336,485,339,483,344,452,363,437,367,383,348,370,339,367,323,366,274,361,256,342,224,332,225,323,212,322,204" title="Filler Pipe" data-picture_id="Filler Pipe" group="filler-pipe" id="FillerPipe">
								 <area shape="poly" href="#" class="singlecab_fuel" coords="492,323,493,308,523,287,541,287,552,302,549,314,538,319,531,312,524,314,502,329,492,323" title="Filler Pipe Guard" data-picture_id="Filler Pipe Gaurd" group="filler-pipe-gaurd" id="FillerPipeGuard">
								 <area shape="poly" href="#" class="singlecab_fuel" coords="572,326,584,337,589,315,608,305,613,304,630,291,649,274,659,271,681,257,692,250,697,245,701,238,714,230,720,229,758,253,776,285,788,295,788,307,782,312,781,343,777,352,753,369,744,369,735,374,734,380,722,388,712,390,703,395,701,401,679,417,670,417,661,421,658,430,634,445,587,445,541,419,539,387,533,383,533,377,547,365,555,348,549,338,551,329,560,327,572,326" title="Fuel Tank" data-picture_id="Fuel Tank" group="fuel-tank" id="FuelTank"> 
								 <area shape="poly" href="#" class="singlecab_fuel" coords="537,421,600,455,634,445,658,430,777,352,781,343,782,312,788,307,791,304,811,314,819,323,819,328,810,336,810,356,809,360,792,380,782,389,631,489,618,496,603,496,593,491,538,454,538,443,534,439,524,434,524,429,537,421" title="Fuel Tank Protection" data-picture_id="Fuel Tank Protection" group="fuel-tank-protection" id="FuelTankProtection">
								 <area shape="poly" href="#" class="singlecab_fuel" coords="647,158,652,150,654,148,657,149,667,150,670,148,674,151,674,155,671,199,675,163,673,168,673,174,678,178,684,170,684,155,688,149,691,146,696,146,696,150,692,154,689,154,686,155,687,171,681,180,683,183,682,212,676,215,676,221,669,229,669,231,678,241,684,241,692,246,692,250,686,254,677,248,677,245,678,242,667,229,658,229,649,226,646,222,646,187,650,181,649,169,647,165,647,158" title="Fuel Pump" data-picture_id="Fuel Pump" group="fuel-pump" id="FuelPump">
								 <area shape="poly" href="#" class="singlecab_fuel" coords="688,197,690,195,697,190,700,192,714,185,714,176,719,174,729,180,734,172,734,158,739,149,743,147,748,149,748,154,742,157,740,155,737,160,737,172,733,182,734,185,734,205,734,213,729,215,714,206,713,188,703,196,704,200,696,206,691,206,688,203,688,197" title="Active Carbon Unit" data-picture_id="Active Carbon Unit" group="active-carbon-unit" id="ActiveCarbonUnit">
								 <area shape="poly" href="#" class="singlecab_fuel" coords="346,85,348,82,352,85,355,84,359,87,359,90,384,106,394,120,397,137,401,152,412,163,560,260,567,256,567,228,576,222,600,237,617,229,617,225,621,223,626,227,626,232,622,235,618,233,606,241,597,240,576,228,571,231,572,258,557,263,406,164,395,147,390,120,379,108,358,94,354,94,350,91,350,89,346,85" title="Fuel Inject Pipe" data-picture_id="Fuel Inject Pipe" group="fuel-inject-pipe" id="FuelInjectPipe">
								 <area shape="poly" href="#" class="singlecab_fuel" coords="409,35,414,29,417,31,418,35,430,42,436,50,436,83,442,95,515,143,575,182,582,182,594,165,604,162,619,171,624,180,624,199,625,204,637,211,641,209,641,221,636,214,624,207,620,201,620,181,618,176,604,166,599,166,586,184,572,185,446,102,432,86,431,50,429,46,416,39,412,39,409,35" title="Fuel Inject Pipe" data-picture_id="Fuel Inject Pipe" group="fuel-inject-pipe" id="FuelInjectPipe">
								 <area shape="poly" href="#" class="singlecab_fuel" coords="745,199,747,194,769,180,773,181,795,196,797,195,802,197,805,201,805,205,807,207,809,209,808,227,805,228,803,227,789,235,785,240,783,240,779,243,771,237,771,234,769,234,746,218,745,213,745,199" title="N/A" picture_id="N/A" group="n-a" id="N/A">	
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