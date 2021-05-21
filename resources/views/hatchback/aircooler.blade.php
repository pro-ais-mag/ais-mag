@extends('hatchback')
@section('hatchback')
<div class="row">
       <div class="col-md-12">
            <div>
                <div>
                     <img src="/img/Air cooler-01 new-01 (1).jpg" id="img_conditioner" usemap="#map_air_condition" width="988px" height="538px">
                </div>
            </div>

            <map name="map_air_condition" id="map_air_condition">
                    <area shape="poly" coords="648,53,650,50,656,53,658,51,668,50,672,47,685,35,703,24,719,26,754,50,757,50,776,73,778,76,778,78,775,79,775,91,770,93,766,95,761,88,759,67,753,57,751,57,750,54,716,31,704,30,688,40,677,51,676,61,670,70,662,75,656,73,654,77,650,76,652,72,651,67,651,59,648,53" href="#" title="Evaporator Hose" class="air_condition_auto" data-picture_id="Evaporator Hose" id="EvaporatorHose" group="evaporator-hose">
                    <area shape="poly" coords="629,92,636,84,649,99,661,90,667,89,673,91,673,94,668,99,664,96,667,93,650,102,649,123,648,124,650,152,652,153,652,156,650,159,650,162,648,163,647,162,647,159,645,156,645,153,647,151,645,124,644,107,632,115,629,111,629,92" href="#" title="Evap/Compressor Hose" class="air_condition_auto" data-picture_id="Evap/Compressor Hose" id="EvapCompressorHose" group="compressor-hose">
                    <area shape="poly" coords="622,172,635,161,646,168,648,166,651,167,651,171,655,175,655,172,658,171,659,172,659,178,664,182,655,195,652,206,622,187,622,172" href="#" title="Compressor" class="air_condition_auto" data-picture_id="Compressor" id="Compressor" group="compressor">
                    <area shape="poly" coords="480,194,494,183,594,250,597,257,597,264,603,270,603,278,599,279,597,280,597,329,603,337,603,342,595,345,590,350,558,328,597,280,486,207,510,297,489,282,487,272,480,265,481,259,487,256,486,207,480,200,480,194" href="#" title="Fan Shroud" class="air_condition_auto" data-picture_id="Fan Shroud" id="FanShroud" group="fan-shroud">
                    <area shape="poly" coords="606,303,609,300,611,303,613,303,620,309,620,311,629,319,628,330,631,333,644,348,641,351,639,350,639,348,624,331,625,322,617,313,615,313,609,308,608,306,606,303" href="#" title="Additional Pump Hose" class="air_condition_auto" data-picture_id="Additional Pump Hose" id="AdditionalPumpHose" group="additional-pump-hose">
                    <area shape="poly" coords="644,364,647,352,655,347,659,350,659,355,661,357,662,361,660,367,658,368,656,368,652,367,646,367,644,364" href="#" title="Aux Water Pump" class="air_condition_auto" data-picture_id="Aux Water Pump" id="AuxWaterPump" group="aux-water-pump">
                    <area shape="poly" coords="437,454,446,448,451,451,451,457,443,461,437,458,437,454" href="#" title="Lower Radiator Bracket" class="air_condition_auto" data-picture_id="Lower Radiator Bracket" id="LowerRadiatorBracket" group="lower-radiator-bracket"> 
                    <area shape="poly" coords="273,416,276,413,284,417,284,420,285,420,285,389,280,381,285,381,285,372,292,372,296,369,378,424,380,423,383,424,383,426,386,430,386,509,380,511,373,507,292,454,288,454,285,453,285,448,275,440,275,421,273,419,273,416" href="#" title="Condensor And Dryer" class="air_condition_auto" data-picture_id="Condensor And Dryer" id="CondensorAndDryer" group="condensor-dryer">
                    <area shape="poly" coords="355,291,361,284,361,273,368,269,372,272,375,270,376,272,465,331,466,332,468,331,469,335,473,337,479,333,481,340,472,345,472,359,479,359,478,366,473,371,473,409,475,406,480,408,479,413,473,420,473,425,467,429,457,426,456,425,424,404,422,390,414,361,361,324,361,294,359,294,357,395,355,291" href="#" title="Radiator" class="air_condition_auto" data-picture_id="Radiator" id="Radiator" group="radiator">
                    <area shape="poly" coords="376,252,378,253,380,253,463,307,464,308,462,312,456,312,375,258,374,257,377,255,376,252" href="#" title="Upper Radiator Seal" class="air_condition_auto" data-picture_id="Upper Radiator Seal" id="UpperRadiatorSeal" group="upper-radiator-seal">
                    <area shape="poly" coords="470,178,472,173,483,165,484,161,482,160,481,158,483,156,487,158,489,161,488,165,486,169,476,175,474,178,476,179,476,180,478,186,473,189,471,184,470,178" href="#" title="Radiator Bottle Hose" class="air_condition_auto" data-picture_id="Radiator Bottle Hose" id="RadiatorBottleHose" group="radiator-bottle-hose">
                    <area shape="poly" coords="444,126,445,125,446,117,450,112,455,105,464,101,474,108,479,118,480,119,481,121,476,131,469,139,468,140,476,145,472,147,464,140,453,136,445,129,444,126" href="#" title="Radiator Bottle" class="air_condition_auto" data-picture_id="Radiator Bottle" id="RadiatorBottle" group="radiator-bottle">
                    <area shape="poly" coords="460,93,462,90,463,88,463,88,465,90,463,90,470,91,470,98,465,99,460,97,460,93" href="#" title="Radiator Bottle Cap" class="air_condition_auto" data-picture_id="Radiator Bottle Cap" id="RadiatorBottleCap" group="radiator-bottle-cap">
                    <area shape="poly" coords="579,100,582,95,603,60,624,44,631,40,640,43,624,42,644,45,646,48,644,51,641,51,640,49,640,46,633,43,630,45,606,61,585,95,581,98,591,105,586,115,584,132,584,148,587,151,589,158,588,169,579,189,578,190,566,216,569,224,572,221,573,226,577,228,578,230,575,231,572,230,571,232,568,226,564,223,563,216,576,185,585,165,581,152,581,120,586,110,586,105,579,100" href="#" title="Evap/Condenser Hose" class="air_condition_auto" data-picture_id="Evap/Condenser Hose" id="EvapCondenserHose" group="evap-hose">
                    <area shape="poly" coords="538,204,540,196,562,166,566,150,569,126,579,104,583,107,573,127,569,150,566,168,541,200,543,204,564,202,548,206,549,209,547,211,543,213,541,206,538,204" href="#" title="15" class="air_condition_auto" data-picture_id="Comps/Condenser Hose" id="CompsCondenserHose" group="comps-hose">
                    <area shape="poly" coords="479,368,488,361,492,364,492,373,483,377,479,376,479,368" href="#" title="16" class="air_condition_auto" data-picture_id="Upper Radiator Bracket" id="UpperRadiatorBracket" group="upper-radiator-bracket">
                    <area shape="poly" coords="520,285,518,274,519,262,523,253,532,246,543,245,552,251,558,258,564,266,569,275,573,284,575,291,576,302,571,315,564,322,554,325,544,321,535,313,540,292,537,287,531,278,520,285" href="#" title="17" class="air_condition_auto" data-picture_id="Radiator Fan" id="RadiatorFan" group="radiator-fan">
                    <area shape="poly" coords="502,368,511,373,519,373,521,374,521,386,519,390,515,395,513,396,507,391,507,385,505,379,504,379,502,377,502,368" href="#" title="18" class="air_condition_auto" data-picture_id="Upper Lever Radiator Hose" id="UpperLeverRadiatorHose" group="upper-lever-radiator-hose">
                    <area shape="poly" coords="495,360,501,365,501,373,501,397,501,415,499,432,499,442,493,447,493,437,492,426,492,413,492,388,492,383,494,369,495,360" href="#" title="19" class="air_condition_auto" data-picture_id="Radiator Air Guide" id="RadiatorAirGuide" group="radiator-air-guide">
                    <area shape="poly" coords="313,378,313,370,313,356,313,349,314,328,321,323,323,322,332,323,336,329,336,332,334,334,413,387,418,386,422,390,422,416,426,425,423,431,422,445,421,459,433,476,424,482,414,478,406,475,406,471,383,424,313,378" href="#" title="20" class="air_condition_auto" data-picture_id="Aux Water Radiator" id="AuxWaterRadiator" group="aux-water-radiator">
                    <area shape="poly" coords="397,489,411,499,411,502,412,505,410,505,406,505,397,498,397,489" href="#" title="21" class="air_condition_auto" data-picture_id="Lower Radiator Seal" id="LowerRadiatorSeal" group="lower-radiator-seal">
                    <area shape="poly" coords="390,456,391,450,393,448,395,450,395,456,395,460,395,471,395,518,393,520,390,518,390,473,390,460,390,456" href="#" title="22" class="air_condition_auto" data-picture_id="Dryer Bottle" id="DryerBottle" group="dryer-bottle">
                    <area shape="poly" coords="326,305,330,306,414,361,414,364,410,365,407,365,325,311,326,305" href="#" title="23" class="air_condition_auto" data-picture_id="Front Radiator Gasket" id="FrontRadiatorGasket" group="front-radiator-gasket">
                    <area shape="poly" coords="343,312,359,308,358,317,354,319,343,312" href="#" title="24" class="air_condition_auto" data-picture_id="ADD Cooler Hose" id="ADDCoolerHose" group="add-cooler-hose">
                </map>
            </div>
        </div>    
<!--Hightlight Parts-->
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
			    key: 'backrest-frame',
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