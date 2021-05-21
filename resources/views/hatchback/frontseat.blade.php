@extends('hatchback')
@section('hatchback')
<div class="row">
       <div class="col-md-12">
            <div>
                <div>
                     <img src="/img/Front seat interface-01 (1).jpg" id="img_frontseat" usemap="#map_frontseat" height="538px" width="988px">
                </div>
            </div>

            <map name="map_frontseat" id="map_frontseat">
                    <area shape="poly" coords="616,138,624,102,648,69,659,65,666,71,703,95,715,133,713,161,710,166,696,272,696,277,696,282,690,291,688,293,682,298,674,306,671,302,670,295,665,287,676,280,676,273,645,254,649,222,634,152,616,138" class="frontseat_auto" href="#" title="Backrest Frame" data-picture_id="Backrest Frame" id="BackrestFrame" group="backrest-frame">
                    <area shape="poly" coords="691,60,705,57,737,73,765,97,774,120,772,139,769,142,762,209,760,255,753,264,747,265,726,251,726,248,726,239,740,231,739,220,731,216,707,228,710,193,722,138,718,121,714,106,696,84,695,85" class="frontseat_auto" href="#" title="Backrest Cover" data-picture_id="Backrest Cover" id="BackrestCover" group="backrest-cover">
                    <area shape="poly" coords="" class="frontseat_auto" href="#" title="N/A" data-picture_id="Not A Part">
                    <area shape="poly" coords="618,224,633,217,645,224,641,252,634,255,632,270,618,279,608,277,618,224" class="frontseat_auto" href="#" title="Side Airbag" data-picture_id="Side Airbag" id="SideAirbag" group="side-airbag">
                    <area shape="poly" coords="593,392,612,370,645,350,650,354,648,373,642,385,635,388,629,385,627,378,614,386,599,396,593,392" class="frontseat_auto" href="#" title="Seat ADJ Handle" data-picture_id="Seat ADJ Handle" id="SeatADJHandle" group="seat-adj-handle">
                    <area shape="poly" coords="517,471,529,473,537,469,604,426,618,408,634,399,639,411,628,447,550,498,537,503,525,501,517,495,517,471" class="frontseat_auto" href="#" title="Outer Seat Trim" data-picture_id="Outer Seat Trim" id="OuterSeatTrim" group="outer-seat-trim" >
                    <area shape="poly" coords="416,435,416,427,421,423,418,418,421,402,431,392,439,387,442,387,462,399,491,420,504,421,512,420,538,403,577,379,577,373,587,380,586,401,577,409,578,419,584,416,584,422,588,419,591,420,591,427,539,464,532,467,516,467,513,483,501,490,494,487,498,479,516,465,503,453,492,459,468,456,435,432,423,440,416,435" class="frontseat_auto" href="#" title="Seat Frame" data-picture_id="Seat Frame" id="SeatFrame" group="seat-frame">
                    <area shape="poly" coords="416,339,437,312,502,275,515,269,529,287,571,314,585,315,590,329,590,348,580,364,578,338,555,324,532,306,470,348,455,362,449,387,419,364,416,339" class="frontseat_auto" href="#" title="Seat Cush Cover" data-picture_id="Seat Cush Cover" id="SeatCushCover" group="seat-cush-cover">
                    <area shape="poly" coords="432,264,438,257,442,249,444,220,450,209,459,204,464,206,465,215,465,231,468,231,468,258,455,257,444,266,451,272,444,276,437,270,432,272,432,264" class="frontseat_auto" href="#" title="Inner Seat Trim" data-picture_id="Inner Seat Trim" id="InnerSeatTrim" group="inner-seat-trim">
                    <area shape="poly" coords="471,235,487,224,494,229,494,247,489,253,497,271,487,275,478,256,470,252,471,235" class="frontseat_auto" href="#" title="Safety Belt" data-picture_id="Safety Belt" id="SafetyBelt" group="safety-belt">
                    <area shape="poly" coords="574,28,581,29,622,56,624,92,611,103,605,101,599,128,594,129,592,125,599,96,582,85,576,111,570,113,569,107,575,80,562,72,563,50,574,28" class="frontseat_auto" href="#" title="Headrest" data-picture_id="Headrest" id="Headrest" group="headrest">
                    <area shape="poly" coords="514,186,521,143,534,107,546,100,555,103,563,109,602,135,629,155,629,179,604,191,587,177,573,164,565,293,535,278,532,274,520,266,514,239,514,186" class="frontseat_auto" href="#" title="Backrest Cover" data-picture_id="Backrest Cover" id="BackrestCover" group="backrest-cover">
                    <area shape="poly" coords="579,176,602,196,625,186,619,217,608,277,614,286,612,309,600,320,577,307,569,297,569,295,579,176" class="frontseat_auto" href="#" title="Backrest Pad" data-picture_id="Backrest Pad" id="BackrestPad" group="backrest-pad">
                    <area shape="poly" coords="707,234,714,229,721,224,733,221,735,229,722,237,721,266,714,267,713,242,707,236,707,234" class="frontseat_auto" href="#" title="Belt Guide" data-picture_id="Belt Guide" id="BeltGuide" group="belt-guide">
                    <area shape="poly" coords="455,369,461,363,484,347,520,322,532,313,552,329,568,333,575,345,575,369,566,381,561,384,533,401,516,413,503,417,493,414,457,392,455,382,455,369" class="frontseat_auto" href="#" title="Seat Pad" data-picture_id="Seat Pad" id="SeatPad" group="seat-pad">    
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