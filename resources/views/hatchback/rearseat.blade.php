@extends('hatchback')
@section('hatchback')
<div class="row">
       <div class="col-md-12">
            <div>
                <div>
                     <img src="/img/Rear back seat interface-01 (1).jpg" usemap="#map_backseat" id="img_backseat" width="988px" height="538px">
                </div>
            </div>

            <map name="map_backseat" id="map_backseat">
                    <area shape="poly" coords="664,130,667,97,671,96,740,141,735,191,729,193,721,273,717,273,697,261,703,160,664,130" href="#" title="Rear Back Rest Cover" class="backseat_auto" data-picture_id="Rear Back Rest Cover" id="RearBackRestCover" group="rear-back-rest-cover">
                    <area shape="poly" coords="606,171,639,195,638,215,635,216,635,218,637,218,637,222,630,243,617,248,584,225,587,184,594,178,603,178,606,171" href="#" title="Rear SQuab Pad" class="backseat_auto" data-picture_id="Rear SQuab Pad" id="RearSQuabPad" group="rear-squab-pad">
                    <area shape="poly" coords="543,158,563,145,575,154,583,181,579,228,616,253,629,247,630,249,626,293,623,322,626,332,603,343,533,298,530,292,543,158" href="#" title="Rear Backrest Cover" class="backseat_auto" data-picture_id="Rear Backrest Cover" id="RearBackrestCover" group="rear-backrest-cover">
                    <area shape="poly" coords="483,391,523,365,548,382,559,384,569,393,569,411,514,435,483,415,483,391" href="#" title="Rear Cushion Pad" class="backseat_auto" data-picture_id="Rear Cushion Pad" id="RearCushionPad" group="rear-cushion-pad">
                    <area shape="poly" coords="366,346,522,440,535,438,576,465,578,473,573,477,520,502,505,504,485,499,332,401,328,395,326,389,328,379,366,346" href="#" title="Rear Seat Frame" class="backseat_auto" data-picture_id="Rear Seat Frame" id="RearSeatFrame" group="rear-seat-frame">
                    <area shape="poly" coords="313,296,320,270,339,253,369,245,379,240,387,239,392,240,395,245,403,247,451,277,452,282,459,284,519,322,520,326,527,327,576,358,579,363,587,365,591,376,587,389,581,395,574,405,569,384,549,377,523,360,478,390,477,413,326,316,313,296" href="#" title="Rear Seat Cushion Cover" class="backseat_auto" data-picture_id="Rear Seat Cushion Cover" id="RearSeatCushionCover" group="rear-seat-cushion-cover">
                    <area shape="poly" coords="569,117,576,101,587,96,616,113,623,133,612,157,605,157,601,176,598,175,596,173,601,154,586,144,582,163,580,163,578,160,582,142,570,132,569,117" href="#" title="Rear Headrest" class="backseat_auto" data-picture_id="Rear Headrest" id="RearHeadrest" group="rear-headrest">
                    <area shape="poly" coords="498,291,508,275,514,280,519,293,527,302,527,311,521,314,516,305,512,300,503,296,498,291" href="#" title="Rear Seat Belt Lock" class="backseat_auto" data-picture_id="Rear Seat Belt Lock" id="RearSeatBeltLock" group="rear-seat-belt-lock">
                    <area shape="poly" coords="708,180,715,172,719,172,717,190,717,192,717,197,710,201,708,201,708,180" href="#" title="Rear SQuab Cover" class="backseat_auto" data-picture_id="Rear SQuab Cover" id="RearSQuabCover" group="rear-squab-cover">
                    <area shape="poly" coords="624,114,628,112,703,160,690,286,686,288,685,298,681,299,677,297,673,305,674,306,674,306,676,306,678,307,679,313,674,316,671,315,671,312,668,312,666,309,630,287,639,195,618,176,620,159,624,119" href="#" title="Rear Backrest Frame" class="backseat_auto" data-picture_id="Rear Backrest Frame" id="RearBackrestFrame" group="rear-backrest-frame">
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