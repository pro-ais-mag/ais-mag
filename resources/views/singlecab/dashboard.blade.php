@extends('singlecab')
@section('singlecab')
                    <div class="row">
                    <div class="col-md-12">
                            <div>
                                <img id="img_cab_dashboard" name="img_cab_dashboard" src="/img/cab_dashboard.jpg" height="538px" width="988px" usemap="#map_cab_dashboard">       
                            </div>
                            <map id="map_cab_dashboard" name="map_cab_dashboard">
                                 <area shape="poly" href="#" class="cab_dashboard" coords="261,81,262,78,284,60,317,39,342,27,370,16,375,19,376,22,361,30,339,62,339,72,318,84,305,79,276,79,270,85,264,86,261,81" title="Upper Air Dact" data-picture_id="Upper Air Dact" group="upper-air-dact" id="UpperAirDact">
                                 <area shape="poly" href="#" class="cab_dashboard" coords="257,149,261,144,269,136,272,130,282,119,289,112,298,106,300,102,309,108,309,121,307,122,303,122,297,125,297,128,292,132,282,140,277,147,276,152,276,164,268,169,266,168,266,166,257,158,257,149" title="Air Distrib Housing" data-picture_id="Air Distrib Housing" group="air-distrib-housing" id="AirDistribHousing">
                                 <area shape="poly" href="#" class="cab_dashboard" coords="320,98,323,90,344,77,374,79,348,81,353,84,360,84,361,87,361,100,355,104,350,105,343,98,336,103,336,114,329,121,323,120,323,109,320,107,320,98" title="Heat Exchanger" data-picture_id="Heat Exchanger" group="heat-exchanger" id="HeatExchanger">
                                 <area shape="poly" href="#" class="cab_dashboard" coords="380,70,382,68,410,59,413,60,413,63,419,68,419,77,417,80,419,85,415,90,412,92,404,96,398,96,396,99,391,104,385,99,389,96,389,88,380,84,380,70" title="Filter House Heater" data-picture_id="Filter House Heater" group="filter-house-heater" id="FilterHouseHeater">
                                 <area shape="poly" href="#" class="cab_dashboard" coords="307,174,308,153,313,149,313,134,361,105,366,109,366,116,375,122,375,125,377,130,381,135,381,138,377,148,379,163,380,167,377,169,377,174,339,197,336,199,311,183,307,174" title="Distiibutor Box" data-picture_id="Distributor Box" group="distributor-box" id="DistributorBox">
                                 <area shape="poly" href="#" class="cab_dashboard" coords="277,195,284,192,293,178,300,173,307,186,306,188,301,189,301,194,298,202,298,211,299,215,297,218,293,216,292,219,289,223,280,216,284,210,284,206,277,204,277,195" title="Heat Exchange Cover" data-picture_id="Heat Exchange Cover" group="heat-exchange-cover" id="HeatExchangeCover">
                                 <area shape="poly" href="#" class="cab_dashboard" coords="377,121,382,122,384,115,384,110,386,107,417,95,420,95,430,116,430,124,431,137,426,147,412,154,397,152,382,142,384,139,377,121" title="Upper Intake Channel" data-picture_id="Upper Intake Channel" group="upper-intake-channel" id="UpperIntakeChannel">
                                 <area shape="poly" href="#" class="cab_dashboard" coords="434,96,454,84,471,98,452,111,436,100,434,96" title="Pollution Filter" data-picture_id="Pollution Filter" group="pollution-filter" id="PollutionFilter">
                                 <area shape="poly" href="#" class="cab_dashboard" coords="439,123,443,120,443,116,454,121,454,134,451,135,449,133,445,134,441,132,441,130,439,128,439,123" title="Blower Regulator" data-picture_id="Blower Regulator" group="blower-regulator" id="BlowerRegulator">
                                 <area shape="poly" href="#" class="cab_dashboard" coords="390,171,394,167,393,165,393,160,395,154,418,154,422,157,422,162,422,170,423,174,425,179,425,182,422,185,416,185,410,187,410,190,408,191,405,187,396,184,392,175,390,174,390,171" title="Heater Blower" data-picture_id="Heater Blower" group="heater-blower" id="HeaterBlower">
                                 <area shape="poly" href="#" class="cab_dashboard" coords="469,218,458,211,435,224,434,231,430,239,425,238,425,233,427,230,422,214,419,210,420,204,422,202,431,207,434,211,471,186,469,178,470,175,475,175,479,181,600,101,596,96,597,92,604,92,609,91,610,92,618,111,622,120,623,125,618,127,573,153,507,194,469,218" title="Dash Reinforce" data-picture_id="Dash Reinforce" group="dash-reinforce" id="DashReinforce">
                                 <area shape="poly" href="#" class="cab_dashboard" coords="625,152,627,143,624,140,626,139,671,116,674,117,686,127,692,138,690,141,683,146,681,151,649,171,644,174,625,152" title="Passenger Airbag" data-picture_id="Passenger Airbag" group="passenger-airbag" id="PassengerAirbag">
                                 <area shape="poly" href="#" class="cab_dashboard" coords="690,128,700,123,709,130,711,143,702,149,696,145,696,143,693,142,692,138,690,128" title="Airduct" data-picture_id="Airduct" group="airduct" id="Airduct">
                                 <area shape="poly" href="#" class="cab_dashboard" coords="606,259,605,256,637,235,647,238,650,252,618,271,614,268,606,263,606,259" title="Heat Regulator" data-picture_id="Heat Regulator" group="heat-regulator" id="HeatRegulator">
                                 <area shape="poly" href="#" class="cab_dashboard" coords="661,284,664,282,665,284,667,289,673,288,677,290,680,293,685,294,688,299,686,303,683,305,680,301,675,298,675,293,673,290,668,291,663,289,661,284" title="Cigg Lighter" data-picture_id="Cigg Lighter" group="cigg-lighter" id="CiggLighter">
                                 <area shape="poly" href="#" class="cab_dashboard" coords="671,238,675,231,713,210,718,210,730,218,733,217,735,223,731,236,717,253,676,276,672,275,675,269,671,238" title="Glovebox" data-picture_id="Glovebox" group="glovebox" id="Glovebox">
                                 <area shape="poly" href="#" class="cab_dashboard" coords="632,305,647,296,650,294,669,305,667,314,652,323,649,323,635,314,632,305" title="Center Console Control" data-picture_id="Center Console Control" group="center-console-control" id="CenterConsoleControl">
                                 <area shape="poly" href="#" class="cab_dashboard" coords="679,318,682,312,686,311,692,309,710,298,710,292,711,289,727,287,728,289,727,299,731,316,734,316,741,309,746,315,745,322,748,334,760,343,761,348,737,363,717,353,699,346,679,318" title="Center Console Trim" data-picture_id="Center Console Trim" group="center-console-trim" id="CenterConsoleTrim">
                                 <area shape="poly" href="#" class="cab_dashboard" coords="623,362,638,355,644,355,650,359,650,364,651,366,651,369,652,377,652,385,648,383,646,375,643,373,643,368,638,366,630,367,625,367,623,367,623,362" title="Ignition" data-picture_id="Ignition" group="ignition" id="Ignition">
                                 <area shape="poly" href="#" class="cab_dashboard" coords="569,374,580,363,596,358,613,368,611,376,600,371,598,369,592,376,593,385,591,388,585,389,581,386,578,381,578,386,573,387,568,383,569,374" title="Upper Steering Column" data-picture_id="Upper Steering Column" group="upper-steering-column" id="UpperSteeringColumn">
                                 <area shape="poly" href="#" class="cab_dashboard" coords="577,404,576,393,593,391,595,381,603,381,603,387,606,387,606,381,615,380,616,391,612,399,602,405,584,406,577,404" title="Lower Steering Column" data-picture_id="Lower Steering Column" group="lower-steering-column" id="LowerSteeringColumn">
                                 <area shape="poly" href="#" class="cab_dashboard" coords="535,354,548,345,551,348,566,338,566,324,577,319,581,321,581,324,580,328,581,331,581,339,577,351,567,365,532,385,529,383,535,354" title="Steering Column Trim" data-picture_id="Steering Column Trim" group="steering-column-trim" id="SteeringColumnTrim">
                                 <area shape="poly" href="#" class="cab_dashboard" coords="673,421,678,415,686,404,709,402,713,411,712,418,712,432,709,435,697,441,696,441,690,434,683,432,678,430,679,428,677,422,673,421,673,421" title="Driver Airbag" data-picture_id="Driver Airbag" group="driver-airbag" id="DriverAirbag">
                                 <area shape="poly" href="#" class="cab_dashboard" coords="693,444,686,450,678,452,668,451,660,446,653,437,650,426,651,414,653,405,657,396,663,387,671,380,679,377,686,376,694,379,700,384,700,396,690,397,665,425,693,444" title="Steering Wheel" data-picture_id="Steering Wheel" group="steering-wheel" id="SteeringWheel">
                                 <area shape="poly" href="#" class="cab_dashboard" coords="755,360,756,354,769,346,774,345,787,354,790,364,777,373,773,372,755,360" title="Armres tPad" data-picture_id="Armrest Pad" group="armrest-pad" id="ArmrestPad">
                                 <area shape="poly" href="#" class="cab_dashboard" coords="679,322,691,340,706,354,730,362,751,371,759,368,776,376,786,371,788,372,788,383,796,404,796,411,777,422,765,415,728,390,682,370,670,362,653,335,653,331,661,327,679,322" title="Center Console" data-picture_id="Center Console" group="center-console" id="CenterConsole">
                                 <area shape="poly" href="#" class="cab_dashboard" coords="463,445,472,440,478,441,480,447,478,449,480,452,480,458,482,470,483,477,482,484,485,486,489,489,490,493,485,497,478,494,478,489,479,487,480,482,480,468,478,462,478,457,463,456,463,445" title="Clutch Pedal" data-picture_id="Clutch Pedal" group="clutch-pedal" id="ClutchPedal">
                                 <area shape="poly" href="#" class="cab_dashboard" coords="487,434,496,428,501,427,506,434,503,437,505,440,505,458,503,473,507,473,510,477,510,482,505,486,499,481,499,478,500,475,503,461,499,449,499,444,487,444,487,434" title="Brake Pedal" data-picture_id="Brake Pedal" group="brake-pedal" id="BrakePedal">
                                 <area shape="poly" href="#" class="cab_dashboard" coords="515,415,517,414,518,415,519,417,527,424,527,429,528,432,525,436,528,439,528,442,530,445,531,460,533,462,535,462,541,468,542,473,539,475,532,468,532,463,530,461,529,445,522,446,518,443,515,442,515,420,515,415" title="Accelerator Pedal" data-picture_id="Accelerator Pedal" group="accelerator-pedal" id="AcceleratorPedal">
                                 <area shape="poly" href="#" class="cab_dashboard" coords="" title="Part" data-picture_id="Part" group="" id="">
                            </map>
                    </div>
                    </div>   


<!--Highlight The Image Map-->
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
			    key: 'release-bearing',
			    fillColor: '8bf058',
			    isMask: true
            },
            {
			    key: 'differential-gearbox',
			    fillColor: '8bf058',
			    isMask: true
            },
            {
			    key: 'cpl-gear-shift-lever',
			    fillColor: '8bf058',
			    isMask: true
            },
            {
			    key: 'driveshaft-bearing',
			    fillColor: '8bf058',
			    isMask: true
            },
            {
			    key: 'shift-fork-unit',
			    fillColor: '8bf058',
			    isMask: true
            },
            {
			    key: 'synchr-ring-gear',
			    fillColor: '8bf058',
			    isMask: true
            },
            {
			    key: 'shift-fork-gear-5-6',
			    fillColor: '8bf058',
			    isMask: true
            },
            {
			    key: 'output-shaft',
			    fillColor: '8bf058',
			    isMask: true
            },
            {
			    key: 'gearbox-carrier',
			    fillColor: '8bf058',
			    isMask: true
            },
            {
			    key: 'flange-shaft',
			    fillColor: '8bf058',
			    isMask: true
            },
            {
			    key: 'gear-lever-boot',
			    fillColor: '8bf058',
			    isMask: true
            },
            {
			    key: 'clutch-housing',
			    fillColor: '8bf058',
			    isMask: true
            },
            {
			    key: 'gear-cover',
			    fillColor: '8bf058',
			    isMask: true
            },
            {
			    key: 'shift-wheel',
			    fillColor: '8bf058',
			    isMask: true
            },
            {
			    key: 'gearbox-housing',
			    fillColor: '8bf058',
			    isMask: true
            },
            {
			    key: 'gearbox-cover',
			    fillColor: '8bf058',
			    isMask: true
            },
            {
			    key: 'front-gear-lever',
			    fillColor: '8bf058',
			    isMask: true
            },
            {
			    key: 'trans-support',
			    fillColor: '8bf058',
			    isMask: true
            }
            
		]

	});

</script>                      
@endsection                    