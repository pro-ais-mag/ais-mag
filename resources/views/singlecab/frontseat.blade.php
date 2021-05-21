@extends('singlecab')
@section('singlecab')
                    <div class="row">
                    <div class="col-md-12">
                            <div>
                                <img id="img_cab_front_seat" name="img_cab_front_seat" src="/img/cab_seats_front.jpg" height="538px" width="988px" usemap="#map_cab_front_seat">       
                            </div>
                            <map id="map_cab_front_seat" name="map_cab_front_seat">
                                 <area shape="poly" href="#" class="cab_front_seat" coords="373,338,326,369,322,384,317,381,307,381,307,368,311,352,325,343,320,332,320,326,339,315,345,320,345,330,364,316,373,338" title="Inner Seat Trim" data-picture_id="Inner Seat Trim" id="Inner Seat Trim" group="inner-seat-trim">
                                 <area shape="poly" href="#" class="cab_front_seat" coords="518,351,535,361,536,367,539,371,539,384,534,389,517,399,510,401,464,422,438,420,431,418,424,414,377,381,373,375,371,368,371,358,373,353,380,346,439,383,467,383,518,351" title="Seat Frame" data-picture_id="Seat Frame" id="SeatFrame" group="seat-frame">
                                 <area shape="poly" href="#" class="cab_front_seat" coords="642,402,652,405,651,437,646,450,642,458,558,510,554,507,555,486,569,477,571,469,619,436,631,412,642,402" title="Outter Seat Trim Cover" data-picture_id="Outter Seat Trim Cover" id="OutterSeatTrimCover" group="outter-seat-trim-cover">
                                 <area shape="poly" href="#" class="cab_front_seat" coords="444,453,447,451,455,456,455,458,462,462,466,461,467,459,472,456,471,452,467,448,470,444,471,441,475,440,475,436,486,429,493,433,527,411,531,400,535,397,543,398,550,392,553,385,558,383,563,374,560,351,566,339,573,339,577,360,587,367,588,378,585,390,578,398,578,405,573,409,572,414,565,418,567,422,571,422,573,424,574,430,568,435,559,429,555,425,478,477,481,480,481,482,478,486,478,490,475,491,465,484,465,475,473,470,473,467,470,463,466,466,461,466,444,458,444,453" title="Outter Seat Trim" data-picture_id="Outter Seat Trim" id="OutterSeatTrim" group="outter-seat-trim">
                                 <area shape="poly" href="#" class="cab_front_seat" coords="363,286,330,308,330,314,320,320,292,322,285,328,279,344,254,355,246,371,259,371,276,363,286" title="Part5" data-picture_id="Part5">
                                 <area shape="poly" href="#" class="cab_front_seat" coords="478,248,458,252,533,283,542,296,542,313,536,321,527,334,500,355,495,350,489,333,479,324,468,325,454,321,437,324,423,334,419,341,419,357,412,360,376,333,365,307,365,295,381,274,406,261,439,256,465,248,478,248" title="Seat Cushion Cover" data-picture_id="Seat Cushion Cover" id="SeatCushionCover" group="seat-cushion-cover">
                                 <area shape="poly" href="#" class="cab_front_seat" coords="416,364,436,377,468,376,494,359,492,355,486,337,469,327,449,325,433,330,423,340,422,368,416,364" title="Seat Pad" data-picture_id="Seat Pad" id="SeatPad" group="seat-pad">
                                 <area shape="poly" href="#" class="cab_front_seat" coords="554,95,596,121,619,140,619,150,597,204,579,209,564,204,553,198,534,205,514,256,503,257,475,240,468,229,470,206,488,161,501,135,524,107,538,97,554,95" title="Backrest Cover" data-picture_id="Backrest Cover" id="BackrestCover" group="backrest-cover">
                                 <area shape="poly" href="#" class="cab_front_seat" coords="521,249,538,208,553,203,564,208,575,212,589,212,592,213,573,278,565,292,545,290,533,274,515,262,521,249" title="Backrest Pad" data-picture_id="Backrest Pad" id="BackrestPad" group="backrest-pad">
                                 <area shape="poly" href="#" class="cab_front_seat" coords="587,28,617,47,625,67,625,83,614,97,601,95,597,90,590,80,574,73,564,68,561,55,568,35,587,28" title="Headrest" data-picture_id="Headrest" id="Headrest" group="headrest">
                                 <area shape="poly" href="#" class="cab_front_seat" coords="604,114,660,150,662,161,646,226,633,273,629,282,617,301,609,300,608,292,618,277,585,256,623,151,620,134,604,114" title="Backrest Frame" data-picture_id="Backrest Frame" id="BackrestFrame" group="backrest-frame">
                                 <area shape="poly" href="#" class="cab_front_seat" coords="445,250,435,231,432,231,425,214,426,210,438,200,445,201,452,205,453,209,457,221,456,235,460,245,445,250" title="Safety Belt" data-picture_id="Safety Belt" id="SafetyBelt" group="safety-belt">
                                 <area shape="poly" href="#" class="cab_front_seat" coords="363,286,330,308,330,314,326,314,320,310,320,292,322,285,331,278,344,254,355,246,371,259,371,276,363,286" title="inner Seat Trim Cover" data-picture_id="Inner Seat Trim Cover" group="inner-seat-trim-cover">
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
			    key: 'radiator-bottle',
			    fillColor: '8bf058',
			    isMask: true
            },
            {
			    key: 'radiator-bottle-cap',
			    fillColor: '8bf058',
			    isMask: true
            },
            {
			    key: 'part3',
			    fillColor: '8bf058',
			    isMask: true
            },
            {
			    key: 'dryer',
			    fillColor: '8bf058',
			    isMask: true
            },
            {
			    key: 'lower-radiator-hose',
			    fillColor: '8bf058',
			    isMask: true
			},
            {
			    key: 'upper-radiator-hose',
			    fillColor: '8bf058',
			    isMask: true
            },
            {
			    key: 'lower-radiator-hose',
			    fillColor: '8bf058',
			    isMask: true
			},
            {
			    key: 'radiator',
			    fillColor: '8bf058',
			    isMask: true
			},    
            {
			    key: 'dryer',
			    fillColor: '8bf058',
			    isMask: true
            },
            {
			    key: 'condensor',
			    fillColor: '8bf058',
			    isMask: true
			},
            {
			    key: 'part13',
			    fillColor: '8bf058',
			    isMask: true
            },
            {
			    key: 'radiator-bottle-hose',
			    fillColor: '8bf058',
			    isMask: true
            },
            {
			    key: 'fan-shroud',
			    fillColor: '8bf058',
			    isMask: true
            },
            
            {
			    key: 'compressor',
			    fillColor: '8bf058',
			    isMask: true
            },
            {
			    key: 'radiator-hose',
			    fillColor: '8bf058',
			    isMask: true
            },
            {
			    key: 'fan',
			    fillColor: '8bf058',
			    isMask: true
            },
            {
			    key: 'fan-shroud',
			    fillColor: '8bf058',
			    isMask: true
            }
		]

	});


</script>                              
@endsection                    