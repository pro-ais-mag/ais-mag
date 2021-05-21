@extends('singlecab')
@section('singlecab')
                    <div class="row">
                    <div class="col-md-12">
                            <div>
                                <img id="img_cab_engine" name="img_cab_engine" src="/img/cab_engine.jpg" height="538px" width="988px" usemap="#map_cab_engine">       
                            </div>
                            <map id="map_cab_engine" name="map_cab_engine">
                                 <area shape="poly" href="#" class="cab_engine" coords="522,317,529,314,535,317,535,333,529,336,522,334,522,317" title="Piston Cylinder" data-picture_id="Piston Cylinder" group="piston-cylinder" id="PistonCylinder">
                                 <area shape="poly" href="#" class="cab_engine" coords="524,350,528,350,528,342,526,340,530,339,532,342,531,343,531,352,534,355,534,364,533,364,524,358,524,350" title="Conrod Set" data-picture_id="Conrod Set" group="conrod-set" id="ConrodSet">
                                 <area shape="poly" href="#" class="cab_engine" coords="509,404,512,399,538,382,545,387,546,388,546,391,548,392,548,395,548,401,540,406,537,405,528,412,522,414,509,407,509,404" title="Lower Oil Pan" data-picture_id="Lower Oil Pan" group="lower-oil-pan" id="LowerOilPan">
                                 <area shape="poly" href="#" class="cab_engine" coords="580,347,584,344,590,347,591,349,593,341,596,343,590,360,589,400,588,400,588,358,590,352,588,349,582,349,580,347" title="Fuel Tube" data-picture_id="Fuel Tube" group="fuel-tube" id="FuelTube">
                                 <area shape="poly" href="#" class="cab_engine" coords="594,359,603,336,602,333,604,330,607,326,609,323,612,327,609,331,607,328,606,331,607,332,604,336,604,337,596,359,595,361,594,361,594,359" title="Fuel Outlet Pipe" data-picture_id="Fuel Outlet Pipe" group="fuel-outlet-pipe" id="FuelOutletPipe">
                                 <area shape="poly" href="#" class="cab_engine" coords="614,356,615,354,615,352,619,351,621,352,627,358,628,362,626,364,626,367,628,372,626,375,622,377,618,377,616,377,616,363,614,360,614,356" title="Spark" data-picture_id="Spark" group="spark" id="Spark">
                                 <area shape="poly" href="#" class="cab_engine" coords="619,386,620,383,630,380,632,383,632,386,632,395,634,395,634,399,627,403,623,401,621,390,619,386" title="Fuel Pump" data-picture_id="Fuel Pump" group="fuel-pump" id="FuelPump">
                                 <area shape="poly" href="#" class="cab_engine" coords="666,367,667,357,669,356,669,351,673,346,679,342,692,347,698,346,698,350,694,360,690,362,674,373,666,367" title="Fuel Pump" data-picture_id="Fuel Pump" group="fuel-pump" id="FuelPump">
                                 <area shape="poly" href="#" class="cab_engine" coords="683,328,686,327,686,325,687,324,689,324,691,324,693,325,692,327,692,329,689,331,688,330,684,330,683,328" title="Pressure Sensor" data-picture_id="Pressure Sensor" group="pressure-sensor" id="PressureSensor">
                                 <area shape="poly" href="#" class="cab_engine" coords="658,346,663,341,664,339,672,333,675,334,678,331,680,332,680,335,676,336,676,339,668,345,664,345,661,347,657,347,658,346" title="Thermostat" data-picture_id="Thermostat" group="thermostat" id="Thermostat">
                                 <area shape="poly" href="#" class="cab_engine" coords="653,327,653,318,656,316,656,313,663,309,668,310,674,315,674,318,675,319,675,321,671,326,670,326,661,332,653,327" title="Water Pump" data-picture_id="Water Pump" group="water-pump" id="WaterPump">
                                 <area shape="poly" href="#" class="cab_engine" coords="615,249,619,241,626,239,632,240,644,249,651,270,649,275,648,280,643,287,635,287,625,281,619,271,616,263,615,249" title="Fly Wheel" data-picture_id="Fly Wheel" group="fly-wheel" id="FlyWheel">
                                 <area shape="poly" href="#" class="cab_engine" coords="540,318,540,313,550,307,567,306,594,287,597,288,598,291,592,295,592,307,590,309,587,307,589,305,589,298,571,310,571,322,567,324,564,321,567,320,567,312,563,313,546,325,544,324,545,321,556,315,556,312,549,314,543,319,540,318" title="Fuel Distributor" data-picture_id="Fuel Distributor" group="fuel-distributor" id="FuelDistributor">
                                 <area shape="poly" href="#" class="cab_engine" coords="598,165,601,162,603,161,606,156,612,156,615,160,615,165,614,171,613,174,605,174,603,170,603,165,600,168,598,165" title="Solenoid Valve" data-picture_id="Solenoid Valve" group="solenoid-valve" id="SolenoidValve">
                                 <area shape="poly" href="#" class="cab_engine" coords="570,153,571,151,571,145,573,143,575,145,575,151,575,152,575,158,575,160,575,167,573,169,571,167,571,160,570,158,570,153" title="Spark Plug" data-picture_id="Spark Plug" group="spark-plug" id="SparkPlug">
                                 <area shape="poly" href="#" class="cab_engine" coords="554,133,558,130,565,134,567,135,567,137,562,140,562,148,560,152,557,149,557,141,556,139,558,137,555,135,554,133" title="Ignition Coil" data-picture_id="Ignition Coil" group="ignition-coil" id="IgnitionCoil">
                                 <area shape="poly" href="#" class="cab_engine" coords="465,146,469,146,466,153,469,152,475,158,476,163,480,166,538,129,536,126,533,124,537,123,542,128,542,130,538,132,536,134,532,135,528,137,525,142,521,142,515,146,513,149,509,151,504,154,501,155,498,159,495,161,490,162,485,167,480,168,473,164,473,159,469,154,465,155,464,152,461,150,461,148,465,146" title="Heid Cover Gasket" data-picture_id="Heid Cover Gasket" group="heid-cover-gasket" id="HeidCoverGasket">
                                 <area shape="poly" href="#" class="cab_engine" coords="498,89,499,88,500,85,502,86,510,89,510,93,503,97,498,94,498,89" title="Oil Cap" data-picture_id="Oil Cap" group="oil-cap" id="OilCap">
                                 <area shape="poly" href="#" class="cab_engine" coords="515,64,520,58,523,59,524,60,532,65,534,64,537,70,534,76,530,73,522,69,518,68,515,64" title="Turbo Intake Pipe" data-picture_id="Turbo Intake Pipe" group="turbo-intake-pipe" id="TurboIntakePipe">
                                 <area shape="poly" href="#" class="cab_engine" coords="482,53,486,51,488,53,497,46,501,45,509,50,513,51,513,58,509,61,507,61,504,58,501,54,498,56,498,59,493,60,491,59,489,61,486,64,482,60,482,53" title="Air Pipe Brkt" data-picture_id="Air Pipe Brkt" group="air-pipe-brkt" id="AirPipeBrkt">
                                 <area shape="poly" href="#" class="cab_engine" coords="530,126,528,128,523,129,515,133,514,136,509,139,503,142,502,144,499,144,498,148,495,149,488,152,487,154,481,156,475,151,472,150,470,144,464,144,464,138,461,137,461,135,467,132,468,129,471,126,488,115,490,110,518,91,520,91,538,102,538,106,539,107,539,110,544,113,544,117,537,121,530,126" title="Motor Cover" data-picture_id="Motor Cover" group="motor-cover" id="MotorCover">
                                 <area shape="poly" href="#" class="cab_engine" coords="412,205,415,205,422,200,424,199,431,194,436,190,438,187,440,188,442,187,444,184,448,181,451,180,458,176,461,175,463,173,467,168,468,170,466,174,465,180,462,185,459,186,457,188,455,191,452,191,466,195,443,190,437,196,435,203,428,208,425,212,423,210,419,214,414,210,412,208,412,205" title="Head Gasket" data-picture_id="Head Gasket" group="head-gasket" id="HeadGasket">
                                 <area shape="poly" href="#" class="cab_engine" coords="410,205,408,205,402,199,401,194,401,187,402,183,438,158,445,158,451,161,452,160,455,161,458,158,461,161,458,165,458,169,455,175,431,191,429,190,427,194,410,205" title="Cylinder Hod" data-picture_id="Cylinder Hod" group="cylinder-hod" id="CylinderHod">
                                 <area shape="poly" href="#" class="cab_engine" coords="345,146,346,141,348,137,351,138,354,138,366,128,371,127,374,122,377,124,379,124,382,121,385,127,384,130,381,132,381,136,383,138,383,149,387,152,386,154,382,154,382,157,370,165,355,157,355,152,353,150,349,150,345,146,346,141" title="Air Cleaner CPL" data-picture_id="Air Cleaner CPL" group="air-cleaner-cpl" id="AirCleanerCPL">
                                 <area shape="poly" href="#" class="cab_engine" coords="304,152,308,149,309,147,312,144,317,146,319,143,337,130,342,131,343,139,340,140,338,144,320,156,318,156,314,160,308,158,305,159,304,152" title="Air Filter Int Tube" data-picture_id="Air Filter Int Tube" group="air-filter-int-tube" id="AirFilterIntTube">
                                 <area shape="poly" href="#" class="cab_engine" coords="324,184,329,178,335,175,341,175,342,172,343,170,345,170,346,171,353,167,356,175,351,179,352,181,354,185,354,194,349,199,340,201,329,198,324,194,324,184" title="Air Cleaner CPL Cap" data-picture_id="Air Cleaner CPL Cap" group="air-cleaner-cpl-cap" id="AirCleanerCPLCap">
                                 <area shape="poly" href="#" class="cab_engine" coords="332,201,345,202,349,206,347,209,347,216,349,218,345,224,339,226,332,224,329,219,329,217,330,210,329,207,330,203,332,201" title="Air Filter" data-picture_id="Air Filter" group="air-filter" id="AirFilter">
                                 <area shape="poly" href="#" class="cab_engine" coords="304,259,305,258,309,257,313,257,317,259,321,263,321,268,320,270,321,272,314,278,307,271,304,265,304,259" title="N/A" data-picture_id="N/A" group="n-a-1" id="NA1">
                                 <area shape="poly" href="#" class="cab_engine" coords="280,284,281,278,286,275,286,272,290,272,291,270,294,271,299,275,304,275,306,276,306,289,306,289,302,290,301,292,297,294,294,294,289,298,280,284" title="Oil Intake Pump" data-picture_id="Oil Intake Pump" group="oil-intake-pump" id="OilIntakePump">
                                 <area shape="poly" href="#" class="cab_engine" coords="255,307,260,301,261,295,267,291,271,289,274,292,279,292,278,295,278,301,276,305,269,309,267,310,261,305,257,309,255,310,255,307" title="N/A 2" data-picture_id="N/A 2" group="n-a-2" id="Part">
                                 <area shape="poly" href="#" class="cab_engine" coords="304,315,304,309,304,303,306,300,307,300,311,295,314,292,317,292,319,290,321,290,322,292,324,289,326,288,327,290,322,297,333,309,331,310,326,312,326,314,324,315,321,315,315,319,311,320,306,317,304,315" title="R1 Flange Gasket" data-picture_id="R1 Flange Gasket" group="r1-flange-gasket" id="R1FlangeGasket">
                                 <area shape="poly" href="#" class="cab_engine" coords="290,324,290,318,296,315,299,315,301,316,300,318,302,319,302,323,296,327,290,324" title="N/A 3" data-picture_id="N/A 3" group="n-a-3" id="NA3">
                                 <area shape="poly" href="#" class="cab_engine" coords="324,329,327,325,331,325,332,322,333,321,335,323,333,328,336,331,339,329,341,332,341,336,339,338,336,336,331,340,326,337,324,329" title="Oil Pump Cover" data-picture_id="Oil Pump Cover" group="oil-pump-cover" id="OilPumpCover">
                                 <area shape="poly" href="#" class="cab_engine" coords="329,359,331,355,336,354,341,354,342,358,342,360,342,366,347,375,339,381,335,370,330,366,329,359" title="Seal Flange Gasket" data-picture_id="Seal Flange Gasket" group="seal-flange-gasket" id="SealFlangeGasket">
                                 <area shape="poly" href="#" class="cab_engine" coords="272,498,281,490,288,495,291,505,290,510,285,514,278,512,274,505,272,498" title="Alternator Cover" data-picture_id="Alternator Cover" group="alternator-cover" id="AlternatorCover">
                                 <area shape="poly" href="#" class="cab_engine" coords="288,486,293,479,300,478,303,481,307,498,301,501,294,500,289,492,288,486" title="Alternator" data-picture_id="Alternator" group="alternator" id="Alternator">
                                 <area shape="poly" href="#" class="cab_engine" coords="300,464,302,456,308,449,311,448,316,450,322,468,316,474,311,475,304,471,300,464" title="Vibration Damp" data-picture_id="Vibration Damp" group="vibration-damp" id="VibrationDamp">
                                 <area shape="poly" href="#" class="cab_engine" coords="270,337,272,331,304,328,314,330,318,340,313,345,302,337,300,342,308,351,324,361,325,373,323,375,292,373,287,370,270,337" title="Oil Pump Drive Chain" data-picture_id="Oil Pump Drive Chain" group="oil-pump-drive-chain" id="OilPumpDriveChain">
                                 <area shape="poly" href="#" class="cab_engine" coords="326,465,329,462,331,458,337,462,339,469,337,475,330,475,326,465" title="Alternator Palley" data-picture_id="Alternator Palley" group="alternator-palley" id="AlternatorPalley">
                                 <area shape="poly" href="#" class="cab_engine" coords="308,425,313,422,316,414,324,414,338,424,350,450,348,453,327,456,323,454,322,445,310,437,308,425" title="Fan Belt Tensioner" data-picture_id="Fan Belt Tensioner" group="fan-belt-tensioner" id="FanBeltTensioner">
                                 <area shape="poly" href="#" class="cab_engine" coords="331,418,331,412,328,408,328,404,339,396,349,403,349,406,347,408,359,415,364,413,365,414,367,417,374,422,377,424,378,428,378,431,380,432,379,436,377,441,374,437,372,438,371,442,370,459,368,461,367,465,366,468,359,473,346,469,342,466,340,465,350,450,338,424,331,418" title="Oil Pump" data-picture_id="Oil Pump" group="oil-pump" id="OilPump">
                                 <area shape="poly" href="#" class="cab_engine" coords="379,353,382,345,391,346,404,355,408,361,405,371,398,385,397,416,399,434,392,437,387,430,388,382,384,370,379,353" title="Cam Belt" data-picture_id="Cam Belt" group="cam-belt" id="CamBelt">
                                 <area shape="poly" href="#" class="cab_engine" coords="367,379,370,375,378,381,382,385,380,389,377,388,374,386,372,387,369,384,369,380,367,379" title="N/A" data-picture_id="N/A" group="n-a-4" id="NA4">
                                 <area shape="poly" href="#" class="cab_engine" coords="402,384,404,382,407,382,411,384,412,393,412,396,410,398,410,411,410,412,410,416,409,416,409,418,404,422,403,417,402,394,404,392,404,388,402,385,402,384" title="N/A" data-picture_id="N/A" group="n-a-5" id="NA5">
                                 <area shape="poly" href="#" class="cab_engine" coords="421,399,424,400,427,403,429,405,429,409,429,411,428,412,428,414,427,415,426,414,424,415,420,414,417,410,417,406,421,399" title="N/A" data-picture_id="N/A" group="n-a-6" id="NA6">
                                 <area shape="poly" href="#" class="cab_engine" coords="426,399,427,393,434,389,441,392,445,397,447,407,446,410,441,413,437,414,432,409,426,399" title="N/A" data-picture_id="N/A" group="n-a-7" id="NA7">
                                 <area shape="poly" href="#" class="cab_engine" coords="444,318,444,313,446,309,449,307,455,311,458,314,457,322,452,326,448,324,444,318" title="Timing Belt Idles" data-picture_id="Timing Belt Idles" group="timing-belt-idles" id="TimingBeltIdles">
                                 <area shape="poly" href="#" class="cab_engine" coords="423,299,425,295,429,292,433,294,434,296,436,299,437,303,437,306,433,311,430,311,427,309,423,299" title="Camshaft Spraket" data-picture_id="Camshaft Spraket" group="camshaft-spraket" id="CamshaftSpraket">
                                 <area shape="poly" href="#" class="cab_engine" coords="472,257,482,261,487,257,487,254,488,253,492,255,496,253,496,249,499,249,501,260,501,263,483,274,480,273,466,263,466,261,472,257" title="Head Gasket" data-picture_id="Head Gasket" group="head-gasket" id="HeadGasket">
                                 <area shape="poly" href="#" class="cab_engine" coords="476,397,480,392,481,397,484,399,492,395,492,392,494,389,494,388,493,383,492,382,494,379,497,380,497,384,498,385,498,387,501,387,503,386,505,388,503,390,505,392,503,398,500,399,498,400,494,398,484,402,480,401,478,403,475,403,476,397" title="Water Pipe" data-picture_id="Water Pipe" group="water-pipe" id="WaterPipe">
                                 <area shape="poly" href="#" class="cab_engine" coords="475,405,468,395,464,394,464,387,460,385,460,379,468,372,483,381,492,375,519,358,533,364,534,364,563,340,543,351,548,347,550,349,550,364,546,368,543,374,542,378,494,409,489,411,479,405,494,398,498,400,503,398,506,393,505,388,503,386,497,380,494,379,480,392,476,397,475,405" title="Upper Oil Pan" data-picture_id="Upper Oil Pan" group="upper-oil-pan" id="UpperOilPan">
                                 <area shape="poly" href="#" class="cab_engine" coords="" title="Part" data-picture_id="Part" group="part" id="Part">
                                 <area shape="poly" href="#" class="cab_engine" coords="" title="Part" data-picture_id="Part" group="part" id="Part">
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