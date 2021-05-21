@extends('hatchback')
@section('hatchback')
<div class="row">
       <div class="col-md-12">
            <div>
                <div>
                     <img src="/img/suspension rear-01.jpg" id="img_rearsuspension" usemap="#map_rear_suspension" height="538px" width="988px">
                </div>
            </div>

            <map name="map_rear_suspension" id="map_rear_suspension">
                    <area shape="poly" coords="637,163,675,138,720,146,738,174,735,201,728,233,693,246,676,246,652,237" class="rear_suspension_auto" href="#" title="Spare Rim" data-picture_id="Spare Rim" id="SpareRim" group="spare-rim">
                    <area shape="poly" coords="596,345,597,340,604,336,608,337,618,330,628,330,655,315,638,311,625,319,625,321,617,326,614,323,616,319,625,314,626,316,637,308,657,312,670,305,672,301,678,303,675,307,671,308,632,332,633,338,631,343,622,351,614,356,610,353,611,349,618,345,621,345,631,339,628,334,618,333,606,340,607,343,601,347,596,345" class="rear_suspension_auto" href="#" title="Rear ABS Sensor Cables" data-picture_id="Rear ABS Sensor Cables" id="RearABSSensorCables" group="rear-abs-sensor-cables">
                    <area shape="poly" coords="600,406,603,393,610,382,628,367,638,367,642,369,649,385,647,406,642,415,632,426,625,432,616,436,608,434,601,424,600,406" class="rear_suspension_auto" href="#" title="Rear Brake Disc" data-picture_id="Rear Brake Disc" id="RearBrakeDisc" group="rear-brake-disc">
                    <area shape="poly" coords="672,370,693,360,705,358,720,362,755,383,759,388,748,406,739,410,735,407,725,405,716,407,703,416,697,413,697,410,701,405,700,405,700,401,685,410,682,410,678,399,672,392,672,372,672,370" class="rear_suspension_auto" href="#" title="Rear Tyre" data-picture_id="Rear Tyre" id="RearTyre" group="rear-type">
                    <area shape="poly" coords="740,458,750,451,748,463,756,454,761,464,753,470,753,474,758,477,750,488,745,484,741,496,733,490,738,481,738,480,729,483,733,469,740,469,741,467,740,458 " class="rear_suspension_auto" href="#" title="Wheel Cap" data-picture_id="Wheel Cap" id="WheelCap" group="wheel-cap">
                    <area shape="poly" coords="575,418,575,414,579,413,583,417,581,418,580,418,580,421,581,421,581,429,587,426,589,422,594,421,594,425,592,428,592,439,594,444,594,446,593,447,592,450,588,450,582,450,580,443,579,441,570,442,569,440,569,435,567,435,568,421,575,418" class="rear_suspension_auto" href="#" title="Rear Brake Pads" data-picture_id="Rear Brake Pads" id="RearBrakePads" group="rear-brake-pads">
                    <area shape="poly" coords="559,449,559,446,562,444,569,447,573,444,577,445,577,448,574,452,574,458,577,458,576,463,569,472,559,465,560,461,565,462,570,463,570,455,559,449" class="rear_suspension_auto" href="#" title="Rear Brake Carrier" data-picture_id="Rear Brake Carrier" id="RearBrakeCarrier" group="rear-brake-carrier">
                    <area shape="poly" coords="455,447,458,447,469,460,470,463,459,478,456,475,453,472,453,469,457,465,455,464,455,454,457,454,455,453,455,447" class="rear_suspension_auto" href="#" title="Control Motor" data-picture_id="Control Motor" id="ControlMotor" group="control-motor">
                    <area shape="poly" coords="505,370,509,350,521,329,541,318,559,325,562,341,560,357,548,382,536,394,520,399,510,394,504,385,521,372,521,371,517,363,518,375,519,356,519,354,511,360,509,367,505,370" class="rear_suspension_auto" href="#" title="Rear Splash Sheild" data-picture_id="Rear Splash Sheild" id="RearSplashSheild" group="rear-splash-shield">
                    <area shape="poly" coords="552,379,554,368,560,362,563,361,569,363,578,360,585,366,584,384,577,394,566,400,558,395,556,385,553,383,552,379" class="rear_suspension_auto" href="#" title="Rear Hub & Bearing" data-picture_id="Rear Hub & Bearing" id="RearHubBearing" group="rear-hub-bearing">
                    <area shape="poly" coords="564,283,564,296,557,304,554,304,549,297,549,287,553,286,558,290,559,290,560,278,567,281,576,291,578,294,577,297,575,297,574,294,564,283,564,296,564,283" class="rear_suspension_auto" href="#" title="Rear Level Sensor" data-picture_id="Rear Level Sensor" id="RearLevelSensor" group="rear-level-sensor">
                    <area shape="poly" coords="524,265,525,215,528,212,528,201,531,199,533,210,536,214,536,267,539,271,539,277,537,280,532,280,521,273,521,268,524,265" class="rear_suspension_auto" href="#" title="Shock" data-picture_id="Shock" id="Shock" group="shock">
                    <area shape="poly" coords="525,186,526,161,528,159,528,151,526,149,530,145,535,149,533,152,533,160,536,162,536,188,530,190,525,186" class="rear_suspension_auto" href="#" title="Shock Puffer" data-picture_id="Shock Puffer" id="ShockPuffer" group="shock-puffer">
                    <area shape="poly" coords="515,137,522,130,531,124,534,125,537,123,544,129,544,130,540,132,540,139,532,142,529,139,524,143,515,137" class="rear_suspension_auto" href="#" title="Upper Shock Mounting" data-picture_id="Upper Shock Mounting" id="UpperShockMounting" group="upper-shock-mounting">
                    <area shape="poly" coords="468,244,471,238,471,235,472,220,472,206,470,204,470,194,477,186,485,184,487,185,487,189,478,191,475,198,483,194,493,194,502,199,502,243,489,250,474,242,471,247,468,246" class="rear_suspension_auto" href="#" title="Coil Spring" data-picture_id="Coil Spring" id="CoilSpring" group="coil-spring">
                    <area shape="poly" coords="277,61,284,45,298,37,306,37,313,41,316,37,316,32,323,35,323,47,326,49,332,48,338,45,345,48,406,86,430,101,440,117,448,126,453,123,453,117,458,121,458,133,465,137,467,143,461,148,454,154,449,161,445,168,442,165,447,153,457,144,453,141,448,141,444,134,445,131,438,127,428,108,409,95,343,53,332,53,322,54,322,57,311,53,310,46,296,44,287,52,280,63,277,61" class="rear_suspension_auto" href="#" title="Rear Stabilizer" data-picture_id="Rear Stabilizer" id="RearStabilizer" group="rear-stabilizer">
                    <area shape="poly" coords="161,148,160,140,173,133,196,148,196,143,194,142,194,133,196,131,211,141,211,133,210,132,210,123,212,122,229,136,266,122,278,116,287,103,293,85,302,85,305,87,294,114,292,118,335,154,354,158,372,177,421,200,435,207,445,205,467,203,468,212,459,213,432,221,422,230,399,257,399,270,395,273,403,278,403,286,392,293,380,287,379,292,369,291,361,273,356,270,337,272,315,270,242,224,231,216,211,189,201,185,198,171,161,148,160,140,173,133,196,148" class="rear_suspension_auto" href="#" title="Rear Axe" data-picture_id="Rear Axe" id="RearAxe" group="rear-axe">
                    <area shape="poly" coords="354,329,353,325,355,322,355,319,361,317,366,319,369,321,368,325,370,328,387,350,406,371,410,371,412,374,411,377,411,379,407,383,405,383,404,385,397,383,396,377,382,356,359,332,356,330,354,329" class="rear_suspension_auto" href="#" title="Rear Tierod" data-picture_id="Rear Tierod" id="RearTierod" group="rear-tierod">
                    <area shape="poly" coords="323,386,325,381,335,373,343,379,344,378,351,382,351,386,328,400,323,401,319,400,314,396,314,392,319,388,323,386" class="rear_suspension_auto" href="#" title="Rear Axle Support" data-picture_id="Rear Axle Support" id="RearAxleSupport" group="rear-axle-support">
                    <area shape="poly" coords="330,417,359,390,369,380,374,379,376,385,374,388,372,397,372,407,366,412,353,419,335,430,321,439,315,432,312,419,311,416,316,410,321,408,327,414,330,417" class="rear_suspension_auto" href="#" title="Rear Control Arm" data-picture_id="Rear Control Arm" id="RearControlArm" group="rear-control-arm">
                    <area shape="poly" coords="421,416,432,423,426,426,426,430,411,438,411,429,415,427,415,420" class="rear_suspension_auto" href="#" title="Brake Corner Plate" data-picture_id="Brake Corner Plate" id="BrakeCornerPlate" group="brake-corner-plate">
                    <area shape="poly" coords="428,384,430,382,433,358,430,356,430,353,432,351,437,353,463,335,459,332,457,329,461,326,463,324,463,320,462,317,465,312,469,317,468,319,468,321,475,326,479,326,489,332,489,335,490,336,491,340,495,343,498,346,500,350,497,354,495,358,485,360,481,354,468,361,469,364,471,367,467,367,459,373,455,366,451,373,457,378,452,384,447,376,441,376,441,394,435,397,428,393,428,384" class="rear_suspension_auto" href="#" title="Rear Wheel Bearing Housing" data-picture_id="Rear Wheel Bearing Housing" id="RearWheelBearingHousing" group="rear-wheel-bearing-housing">
                    <area shape="poly" coords="418,271,420,272,423,270,425,274,423,276,427,286,439,294,446,290,449,291,456,295,460,297,462,295,464,297,462,299,462,300,457,306,452,307,449,300,444,297,438,304,436,304,435,302,424,295,418,290,416,283,412,282,411,278,412,275,418,271" class="rear_suspension_auto" href="#" title="23" data-picture_id="Lower Control Arm" id="LowerControlArm" group="lower-control-arm">
                    <area shape="poly" coords="498,274,502,281,513,295,519,296,520,304,512,309,509,309,506,305,502,303,491,300,473,295,469,291,465,282,446,266,444,265,438,265,436,258,444,251,448,251,452,257,451,258,467,265,470,265" class="rear_suspension_auto" href="#" title="24" data-picture_id="Lower Control Arm Support" id="LowerControlArmSupport" group="lower-control-arm-support">
                    <area shape="poly" coords="479,251,479,254,475,256,472,263,475,269,486,273,496,270,502,262,500,256,496,252,479,251 " class="rear_suspension_auto" href="#" title="25" data-picture_id="Coil Spring Washer" id="CoilSpringWasher" group="coil-spring-washer">
                    <area shape="poly" coords="612,212,611,190,613,159,628,162,636,167,638,181,655,194,657,200,652,202,649,201,646,205,660,214,655,222,655,227,649,234,638,239,612,212" class="rear_suspension_auto" href="#" title="Spare Tyre" data-picture_id="Spare Tyre" id="SpareTyre" group="spare-tyre">
                    <area shape="poly" coords="" class="rear_suspension_auto" href="#" title="Spare Wheel Valve" data-picture_id="Spare Wheel Valve" id="SpareWheelValve" group="spare-wheel-valve">
                    <area shape="poly" coords="" class="rear_suspension_auto" href="#" title="Rear Rim" data-picture_id="Rear Rim" id="RearRim" group="rear-rim">
                    <area shape="poly" coords="" class="rear_suspension_auto" href="#" title="Rear Wheel Hub Screw" data-picture_id="Rear Wheel Hub Screw" id="RearWheelHubScrew" group="rear-wheel-hub-screw">
                    <area shape="poly" coords="" class="rear_suspension_auto" href="#" title="Rear Rim Valve" data-picture_id="Rear Rim Valve" id="RearRimValve" group="rear-rim-valve">
                    <area shape="poly" coords="" class="rear_suspension_auto" href="#" title="Rear Caliper Housing" data-picture_id="Rear Caliper Housing" id="RearCaliperHousing" group="rear-caliper-housing">
                    <area shape="poly" coords="437,425,439,425,441,411,447,406,454,410,458,423,460,436,461,435,462,437,462,441,460,441,460,444,457,444,457,442,454,441,454,437,456,436,455,427,451,415,444,414,442,425,443,424,445,426,445,430,442,431,443,433,439,433,439,431,437,430,437,425" class="rear_suspension_auto" href="#" title="Brake Hose" data-picture_id="Brake Hose" id="BrakeHose" group="brake-hose">
                    <area shape="poly" coords="485,409,498,399,503,403,502,404,502,408,498,411,500,416,500,419,498,420,494,421,491,419,486,415,484,415,485,409" class="rear_suspension_auto" href="#" title="Speed Sensor" data-picture_id="Speed Sensor" id="SpeedSensor" group="speed-sensor">
                    <area shape="poly" coords="437,176,440,174,443,175,445,177,445,181,452,185,449,189,444,184,444,188,445,188,445,191,444,192,444,196,440,197,435,196,434,196," class="rear_suspension_auto" href="#" title="34" data-picture_id="Stabilizer Joiner" id="StabilizerJoiner" group="stabilizer-joiner">
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