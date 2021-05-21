@extends('singlecab')
@section('singlecab')
                    <div class="row">
                    <div class="col-md-12">
                            <div>
                                <img id="img_cab_transmission" name="img_cab_transmission" src="/img/cab_gearbox.jpg" height="538px" width="988px" usemap="#map_cab_transmission">       
                            </div>
                            <map id="map_cab_transmission" name="map_cab_transmission">
                                 <area shape="poly" href="#" class="cab_transmission" coords="248,429,254,417,263,417,263,415,267,412,270,415,270,423,271,427,271,433,268,436,267,441,260,444,251,438,248,429" title="Release Bearing" data-picture_id="Release Bearing" group="release-bearing" id="ReleaseBearing">
                                 <area shape="poly" href="#" class="cab_transmission" coords="263,342,268,342,269,334,279,311,282,308,290,307,295,309,297,303,302,300,305,299,314,306,335,306,357,317,362,317,368,325,375,333,383,338,388,357,386,363,391,368,392,383,391,392,394,398,388,404,388,419,370,433,370,436,364,440,360,442,353,441,352,449,344,454,339,449,333,449,307,436,303,437,297,434,296,428,290,420,284,418,282,406,277,393,269,387,271,380,268,357,263,348,263,342" title="Flange Shaft" data-picture_id="Flange Shaft" group="flange-shaft" id="FlangeShaft">
                                 <area shape="poly" href="#" class="cab_transmission" coords="309,483,311,477,315,476,324,469,327,467,333,470,332,474,358,488,367,488,373,496,371,501,363,503,358,509,354,513,350,512,345,503,339,495,318,485,315,487,309,483" title="Trans Support" data-picture_id="Trans Support" group="trans-support" id="TransSupport">
                                 <area shape="poly" href="#" class="cab_transmission" coords="387,324,398,316,401,310,401,302,407,297,414,287,430,298,434,315,432,321,433,341,429,345,429,354,425,360,419,357,413,360,400,347,401,338,401,329,394,334,386,331,387,324" title="Gear Cover" data-picture_id="Gear Cover" group="gear-cover" id="GearCover">
                                 <area shape="poly" href="#" class="cab_transmission" coords="417,284,417,275,419,266,428,258,441,260,451,254,457,252,460,247,466,242,472,232,480,228,510,248,512,255,520,270,523,281,522,290,524,298,524,308,514,322,501,325,454,353,432,347,436,331,437,308,429,293,417,284" title="Gearbox Housing" data-picture_id="Gearbox Housing" group="gearbox-housing" id="GearboxHousing">
                                 <area shape="poly" href="#" class="cab_transmission" coords="504,239,504,223,502,219,506,214,519,205,522,201,529,200,542,193,551,199,560,192,558,180,559,174,574,180,591,171,595,174,595,180,600,182,609,178,618,194,612,200,605,212,593,227,598,232,586,250,583,249,576,261,576,264,568,276,550,288,543,290,526,281,522,268,513,249,510,243,504,239" title="CPL Gear Shift Lever" data-picture_id="CPL Gear Shift Lever" group="cpl-gear-shift-lever" id="CPLGearShiftLever">
                                 <area shape="poly" href="#" class="cab_transmission" coords="438,394,439,389,446,384,446,377,454,372,459,375,462,380,467,389,475,394,484,391,486,391,486,393,481,397,484,405,486,403,487,405,470,416,462,416,454,412,445,405,438,394" title="Gearbox Carrier" data-picture_id="Gearbox Carrier" group="gearbox-carrier" id="GearboxCarrier">
                                 <area shape="poly" href="#" class="cab_transmission" coords="512,139,519,135,521,131,532,118,534,107,537,103,542,103,544,110,552,121,555,130,558,136,558,141,538,154,533,156,512,142,512,139" title="Gear Lever Boot" data-picture_id="Gear Lever Boot" group="gear-lever-boot" id="GearLeverBoot">
                                 <area shape="poly" href="#" class="cab_transmission" coords="566,118,570,115,570,103,574,94,589,48,592,50,592,56,575,105,575,115,579,118,573,129,573,132,574,134,574,137,572,140,571,138,570,127,566,118" title="Gear Lever" data-picture_id="Gear Lever" group="gear-lever" id="GearLever">
                                 <area shape="poly" href="#" class="cab_transmission" coords="588,44,591,31,591,25,597,18,604,26,598,39,596,45,593,47,588,44" title="Gear Lever Top" data-picture_id="Gear Lever Top" group="gear-lever-top" id="GearLeverTop">
                                 <area shape="poly" href="#" class="cab_transmission" coords="497,400,494,395,493,389,497,382,503,373,506,373,508,378,510,375,510,370,518,366,521,369,519,374,528,388,525,400,521,398,523,397,523,388,516,377,511,378,511,388,515,400,511,407,509,406,510,404,510,396,502,385,499,385,498,391,499,397,499,398,497,400" title="Shift Fork Unit" data-picture_id="Shift Fork Unit" group="shift-fork-unit" id="ShiftForkUnit">
                                 <area shape="poly" href="#" class="cab_transmission" coords="494,425,496,421,507,413,514,416,516,415,523,420,521,422,523,426,526,425,526,432,522,436,521,440,514,447,508,448,503,445,498,440,495,433,494,425" title="Synchr Ring Gear" data-picture_id="Synchr Ring Gear" group="synchr-ring-gear" id="SynchrRingGear">
                                 <area shape="poly" href="#" class="cab_transmission" coords="528,408,529,401,533,396,539,395,543,398,549,405,551,411,551,420,548,425,541,426,535,422,532,418,528,408" title="Shift Wheel" data-picture_id="Shift Wheel" group="shift-wheel" id="ShiftWheel">
                                 <area shape="poly" href="#" class="cab_transmission" coords="560,398,559,392,565,387,572,390,572,396,565,400,560,398" title="Driveshaft Bearing" data-picture_id="Driveshaft Bearing" group="driveshaft-bearing" id="DriveshaftBearing">
                                 <area shape="poly" href="#" class="cab_transmission" coords="513,470,514,464,518,462,518,459,528,453,533,451,533,448,550,437,551,432,557,429,561,433,563,432,564,427,569,424,574,426,593,414,598,406,600,405,606,405,622,394,624,394,628,392,631,394,631,397,628,399,628,402,626,405,610,414,608,418,602,423,598,421,578,433,578,437,570,442,567,440,566,441,566,448,562,451,559,452,556,450,541,460,537,460,536,463,526,470,522,470,519,472,513,470" title="Output Shaft" data-picture_id="Output Shaft" group="output-shaft" id="OutputShaft">
                                 <area shape="poly" href="#" class="cab_transmission" coords="" title="Part" data-picture_id="Part" group="" id="">
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
			    key: 'front-gear-lever',
			    fillColor: '8bf058',
			    isMask: true
			},
      		{
			    key: 'release-bearing',
			    fillColor: '8bf058',
			    isMask: true
			},
      		{
			    key: 'part3',
			    fillColor: '8bf058',
			    isMask: true
            },
            {
			    key: 'gearbox-carrier',
			    fillColor: '8bf058',
			    isMask: true
            },
            {
			    key: 'clutch-housing',
			    fillColor: '8bf058',
			    isMask: true
            },
            {
			    key: 'part10',
			    fillColor: '8bf058',
			    isMask: true
            }, 
            {
			    key: 'drive-bearing',
			    fillColor: '8bf058',
			    isMask: true
            },
            {
			    key: 'shift-wheel',
			    fillColor: '8bf058',
			    isMask: true
            },
            {
			    key: 'output-shaft',
			    fillColor: '8bf058',
			    isMask: true
            },
            {
			    key: 'part14',
			    fillColor: '8bf058',
			    isMask: true
            },
            {
			    key: 'part15',
			    fillColor: '8bf058',
			    isMask: true
            },
            {
			    key: 'shift-fork-unit',
			    fillColor: '8bf058',
			    isMask: true
            },
            {
			    key: 'gearbox-housing',
			    fillColor: '8bf058',
			    isMask: true
            },
            {
			    key: 'part7',
			    fillColor: '8bf058',
			    isMask: true
            },
            {
			    key: 'synchr-ring-gear',
			    fillColor: '8bf058',
			    isMask: true
            },
            {
			    key: 'gear-lever-boot-cover',
			    fillColor: '8bf058',
			    isMask: true
            },
            {
			    key: 'cpl-gear-shift-lever',
			    fillColor: '8bf058',
			    isMask: true
            },
            {
			    key: 'shift-lever-handle',
			    fillColor: '8bf058',
			    isMask: true
			},
			{
			    key: 'flange-shaft',
			    fillColor: '8bf058',
			    isMask: true
			}
                

            
		]

	});


</script>                       
@endsection                    