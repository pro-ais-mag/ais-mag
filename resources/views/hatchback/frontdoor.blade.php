@extends('hatchback')
@section('hatchback')
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif
                    <div class="row">
                            <div class="col-md-12">
                                    <div>
                                        <img src="/img/body center interface final-01.jpg" id="img_frontdoor" width="988px" height="538px" usemap="#map_front_door">
                                               
                                    </div>
                                    <map name="map_front_door" id="map_front_door">
                                    <!--<area shape="poly" coords="91,457,138,457,138,489,91,489,91,457" href="#NeoTestingPart" id="testHover" class="front_door" title="NeoTesting Test Coords" data-picture_id="Neo Test Pic">-->
                                    <area shape="poly" coords="443,272,428,280,422,249,425,237,476,131,559,47,569,101,443,272" href="#" class="front_door" title="Window" data-picture_id="Window" id="Window" group="window">
                                    <!--<area shape="poly" coords="501,312,496,310,485,263,473,297472,317,463,317,464,295,511,183,532,146,572,104,613,74,620,82,628,112,611,91,578,112,541,152,519,186,495,240,494,258,504,305,501,312" href="#" class="front_door" title="Window Rubber" data-picture_id="Window Rubber">-->
                                    <area shape="poly" coords=""  href="#" class="front_door" title="Door" data-picture_id="Door" id="Door" group="door">
                                    <area shape="poly" coords="723,137,732,132,745,189,754,230,746,237,741,233,739,229,735,195,723,137" href="#" class="front_door" title="Blockout" data-picture_id="Blockout" id="Blockout" group="blockout">
                                    <area shape="poly" coords="754,198,754,194,758,192,764,196,767,195,780,204,780,216,776,218,775,221,780,224,780,233,773,239,768,243,765,241,764,229,757,228,756,221,763,216,762,207,764,207,764,205,762,204,762,198,760,197,759,196,757,196,758,198,754,198" href="#" class="front_door" title="Door Lock" data-picture_id="Door Lock" id="Door Lock" group="door-lock">
                                    <area shape="poly" coords="802,192,802,179,807,174,816,182,818,191,819,192,819,199,818,199,818,206,814,209,806,203,802,192" href="#" class="front_door" title="Striker Cover" data-picture_id="Striker Cover" id="StrikerCover" group="striker-cover">
                                    <area shape="poly" coords="783,215,783,207,787,205,787,195,794,190,799,195,802,201,802,222,795,227,789,221,789,219,783,215,783,207" href="#" class="front_door" title="Door Lock Striker" data-picture_id="Door Lock Striker" id="DoorLockStriker" group="door-lock-striker">
                                    <area shape="poly" coords="794,298,789,300,789,288,784,286,797,277,800,281,802,286,794,298" href="#" class="front_door" title="Handle Ext" data-picture_id="Handle Ext" id="HandleExt" group="handle-ext">
                                    <area shape="poly" coords="797,298,798,294,801,292,803,294,804,297,807,299,809,297,816,300,821,301,821,303,827,307,826,315,817,131,813,313,812,310,805,306,806,301,802,299,800,301,797,298" href="#" class="front_door" title="Door Lock Cylinder" data-picture_id="Door Lock Cylinder" id="DoorLockCylinder" group="door-lock-cylinder">
                                    <area shape="poly" coords="729,328,731,326,737,322,739,322,740,321,751,315,770,301,770,300,767,297,770,292,774,292,776,294,782,294,785,301,784,302,753,326,740,329,739,326,736,329,732,332,729,328" href="#" class="front_door" title="Door Handle" data-picture_id="Door Handle" id="DoorHandle" group="door-handle">
                                    <area shape="poly" coords="611,374,617,360,627,349,633,349,665,369,665,376,645,385,626,386,611,380,611,374" href="#" class="front_door" title="Mirror Cover" data-picture_id="Mirror Cover" id="MirrorCover" group="mirror-cover">
                                    <area shape="poly" coords="458,510,474,501,474,506,482,511,482,515,485,516,486,521,480,522,476,519,465,515,460,519,458,519,458,510" href="#" class="front_door" title="Door Hinge Half Lever" data-picture_id="Door Hinge Half Lever" id="DoorHingeHalfLever" group="door-hinge-half-lever">
                                    <area shape="poly" coords="480,483,480,469,483,469,499,478,499,491,498,492,496,492,491,496,488,497,488,507,486,508,483,507,483,499,481,498,481,486,482,483,480,483  " href="#" class="front_door" title="Door Hinge LWR" data-picture_id="Door Hinge LWR" id="DoorHingeLWR" group="door-hinge-lwr">
                                    <area shape="poly" coords="411,513,411,502,425,493,425,491,430,494,430,507,428,506,416,516,411,513" href="#" class="front_door" title="Door Cabon Trim" data-picture_id="Door Cabon Trim" id="DoorCabonTrim" group="door-carbon-trim">
                                    <area shape="poly" coords="542,445,515,462,508,457,509,351,505,318,553,205,576,168,622,122,661,95,679,110,685,141,676,147,666,106,608,149,578,183,520,307,513,327,519,352,519,379,521,414,522,443,540,432,542,445" href="#" class="front_door" title="Door Rubber" data-picture_id="Door Rubber" id="DoorRubber" group="door-rubber">
                                    <area shape="poly" coords="307,491,307,451,303,450,303,440,306,439,296,431,298,428,307,434,307,423,312,413,321,404,337,397,346,387,353,379,359,372,363,371,367,369,371,372,371,454,355,452,355,440,360,438,353,408,339,402,327,420,325,428,325,436,326,444,327,448,332,451,336,461,331,473,320,481,314,490,314,492,311,494,307,491" href="#" class="front_door" title="Window Mechanism" data-picture_id="Window Mechanism" id="WindowMechanism" group="window-mechanism">
                                    <area shape="poly" coords="366,293,371,289,384,298,384,302,383,303,383,307,384,307,384,320,382,321,382,327,377,329,366,323,366,293" href="#" class="front_door" title="Door Reflector" data-picture_id="Door Reflector" id="DoorReflector" group="door-reflector">
                                    <area shape="poly" coords="126,324,134,319,154,318,176,305,241,261,256,267,260,279,258,278,242,293,206,317,203,315,194,310,188,306,152,327,126,324,126,324" href="#" class="front_door" title="Door Armrest" data-picture_id="Door Armrest" id="DoorArmrest" group="door-armrest">
                                    <area shape="poly" coords="377,232,390,196,431,106,482,43,517,16,527,67,514,79,508,43,505,35,476,58,443,97,407,171,399,197,402,217,377,232" href="#" class="front_door" title="Upper Door Trim" data-picture_id="Upper Door Trim" id="UpperDoorTrim" group="upper-door-trim">
                                    <area shape="poly" coords="179,271,240,231,242,232,242,244,186,283,179,279,179,271" href="#" class="front_door" title="Door Trim" data-picture_id="Door Trim" id="DoorTrim" group="door-trim">
                                    <area shape="poly" coords="141,294,144,288,172,273,175,277,172,285,162,293,150,301,141,294,141,294" href="#" class="front_door" title="Door Inner Handle" data-picture_id="Door Inner Handle" id="DoorInnerHandle" group="door-inner-handle">
                                    <area shape="poly" coords="124,340,137,340,150,338,165,331,189,316,193,318,196,317,196,313,200,314,201,320,198,322,207,329,203,331,203,336,187,346,179,350,165,341,143,348,139,348,137,350,126,347,124,340" href="#" class="front_door" title="Switch Housing" data-picture_id="Switch Housing" id="SwitchHousing" group="switch-housing">
                                    <area shape="poly" coords="303,468,284,480,275,473,233,297,207,508,189,496,184,488,182,467,184,451,188,441,188,382,210,366,351,260,359,261,360,267,354,316,353,321,360,328,360,361,365,365,367,369,363,371,359,372,353,379,346,387,337,397,321,404,312,413,307,423,307,434,298,428,296,431,306,439,303,440,303,450,307,451,303,468" href="#" class="front_door" title="Door Inner Pal" data-picture_id="Door Inner Pal" id="DoorInnerPal" group="door-inner-pnl">
                                    <area shape="poly" coords="263,494,279,484,289,485,292,494,267,510,265,510,256,504,256,501,258,498,259,496,263,494" href="#" class="front_door" title="Door Lamp" data-picture_id="Door Lamp" id="DoorLamp" group="door-lamp">
                                    <area shape="poly" coords="" href="#" class="front_door" title="Window Mechanism" data-picture_id="Window Mechanism" id="WindowMechanism" group="window-mechanism">
                                    <area shape="poly" coords="348,457,357,457,360,452,365,455,367,458,367,461,371,461,375,467,366,472,362,478,360,485,353,484,343,480,343,475,344,472,344,468,348,457" href="#" class="front_door" title="Window Lifter Motor" data-picture_id="Window Lifter Motor" id="WindowLifterMotor" group="window-lifter-motor">
                                    <area shape="poly" coords="432,213,394,243,388,236,437,201,432,213" href="#" class="front_door" title="Inner Chanel Seal" data-picture_id="Inner Chanel Seal" id="InnerChanelSeal" group="inner-chanel-seal">
                                    <area shape="poly" coords="303,468,284,480,279,477,278,450,272,440,247,445,237,446,237,441,237,436,231,439,228,437,228,423,232,420,232,405,240,400,242,394,353,321,360,328,360,361," href="#" class="front_door" title="Door Insolation" data-picture_id="Door Insolation" id="DoorInsolation" group="door-insolation">
                                    <area shape="poly" coords="219,457,226,455,232,457,236,462,238,469,237,478,237,486,228,493,224,497,217,499,210,496,206,490,206,478,211,465,219,457" href="#" class="front_door" title="Door Speaker" data-picture_id="Door Speaker" id="DoorSpeaker" group="door-speaker">
                                    <area shape="poly" coords="437,447,452,437,452,442,461,448,461,451,465,453,463,459,455,458,454,455,445,451,437,457,437,447" href="#" class="front_door" title="Door Hinge Half Upp." data-picture_id="Door Hinge Half Upp." id="DoorHingeHalfUpp" group="door-hinge-half-upp">
                                    <area shape="poly" coords="435,491,438,491,447,486,447,481,451,477,455,480,456,477,460,475,460,471,464,472,465,472,468,472,467,476,465,476,465,481,464,482,462,481,460,484,455,487,454,493,450,494,448,493,448,490,438,496,434,496,435,491" href="#" class="front_door" title="Door Stop" data-picture_id="Door Stop" id="DoorStop" group="door-stop">
                                    <area shape="poly" coords="455,400,459,401,475,412,475,424,473,425,472,425,463,431,463,441,461,442,459,441,459,432,458,432,456,432,456,419,457,416,455,416,455,400" href="#" class="front_door" title="Door Hinge Upp." data-picture_id="Door Hinge Upp." id="DoorHingeUpp" group="door-hinge-upp">
                                    <area shape="poly" coords="612,390,624,393,646,390,666,380,668,380,669,387,647,396,623,401,612,399,612,390" href="#" class="front_door" title="Mirror Indicator" data-picture_id="Mirror Indicator" id="MirrorIndicator" group="mirror-indicator">
                                    <area shape="poly" coords="637,346,645,333,652,328,670,334,687,349,690,355,686,362,671,368,637,346" href="#" class="front_door" title="Mirror Support" data-picture_id="Mirror Support" id="MirrorSupport" group="mirror-support">
                                    <area shape="poly" coords="664,328,670,309,684,311,696,317,707,327,710,331,710,340,705,314,690,345,664,328" href="#" class="front_door" title="Mirror Frame" data-picture_id="Mirror Frame" id="MirrorFrame" group="mirror-frame">
                                    <area shape="poly" coords="687,307,692,291,709,296,723,305,729,313,731,319,727,324,722,325,710,323,687,307" href="#" class="front_door" title="Mirror Glass" data-picture_id="Mirror Glass" id="MirrorGlass" group="mirror-glass">
                                    <area shape="poly" coords="500,340,418,394,405,407,405,450,412,455,451,429,455,400,459,401,478,411,505,393,504,343,500,340" href="#" class="front_door" title="Sound Padding" data-picture_id="Sound Padding" id="SoundPadding" group="sound-padding">
                                    <area shape="poly" coords="202,349,210,337,212,332,223,322,240,333,237,335,222,346,209,349,202,349" href="#" class="front_door" title="Door Speaker Grill" data-picture_id="Door Speaker Grill" id="DoorSpeakerGrill" group="door-speaker-griller">
                                </map>      
                            </div>        
                    </div>        
                    </div>
             <br>

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
			    key: 'upper-door-trim',
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