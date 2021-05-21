@extends('vehicle')
@section('vehicle')
                    <div class="row">
                    <div class="col-md-12">
                            <div>
                                <img id="img_doublecab_frontseat" name="img_doublecab_frontseat" src="/img/singlecab_front_seat.jpg" height="538px" width="988px" usemap="#map_doublecab_front_seat">       
                            </div>
                            <map id="map_doublecab_front_seat" name="map_doublecab_front_seat">
                             <area shape="poly" href="#" class="doublecab_front_seat" coords="321,293,321,282,323,274,325,269,334,264,337,262,346,243,357,234,366,239,367,243,367,270,364,271,360,269,329,289,329,295,321,293" title="Inner Seat Trim" id="InnerSeatTrim" data-picture_id="Inner Seat Trim" group="inner-seat-trim">
                             <area shape="poly" href="#" class="doublecab_front_seat" coords="401,248,411,235,420,243,423,251,421,254,425,259,428,267,423,272,416,269,412,259,407,257,401,248" title="Safety Belt" id="SafetyBelt" data-picture_id="Safety Belt" group="safety-belt">
                             <area shape="poly" href="#" id="SeatPad" class="doublecab_front_seat" coords="399,355,423,333,430,335,453,351,457,350,465,345,470,358,470,380,448,391,437,389,401,368,399,355" title="Seat Pad" id="SeatPad" data-picture_id="Seat Pad" group="seat-pad">
                             <area shape="poly" href="#" class="doublecab_front_seat" coords="509,480,519,474,529,462,571,436,589,410,597,418,597,432,591,449,512,497,509,497,509,480" title="Outter Seat Trim" id="OutterSeatTrim" data-picture_id="Outter Seat Trim" group="outter-seat-trim">
                             <area shape="poly" href="#" class="doublecab_front_seat" coords="395,365,369,347,360,335,360,319,386,290,419,281,442,272,457,278,467,287,508,312,521,319,520,321,520,338,503,352,474,375,475,357,471,344,423,325,455,346,425,327,400,345,394,354,395,365" title="Seat Cushion Cover" id="SeatCushionCover" data-picture_id="Seat Cushion Cover" group="seat-cushion-cover">
                             <area shape="poly" href="#" class="doublecab_front_seat" coords="499,181,500,176,506,151,512,141,521,136,547,153,550,166,550,195,532,203,526,200,518,192,499,181" title="Backrest Pad" id="Backrest Pad" data-picture_id="Backrest Pad" group="backrest-pad">
                             <area shape="poly" href="#" id="BackrestCover" class="doublecab_front_seat" coords="550,200,547,238,538,275,524,287,513,290,508,289,463,261,453,248,449,235,451,198,466,149,482,125,494,119,516,133,508,138,501,151,499,181,518,192,527,201,532,203,550,200" title="Backrest Cover" id="BackrestCover" data-picture_id="Backrest Cover" group="backrest-cover">
                             <area shape="poly" href="#" class="doublecab_front_seat" coords="635,179,638,175,642,176,644,164,646,160,647,152,652,149,657,152,657,159,659,163,651,213,641,215,636,212,641,182,635,179" title="Side Airbag" id="SideAirbag" data-picture_id="Side Airbag" group="side-airbag">
                             <area shape="poly" href="#" class="doublecab_front_seat" coords="545,78,552,64,559,62,577,72,619,98,629,117,626,139,625,147,619,180,609,236,609,239,607,251,610,266,600,281,600,297,596,305,587,307,579,297,571,300,566,293,575,280,580,270,581,255,552,238,554,156,540,142,524,132,527,124,539,99,545,78" title="Backrest Frame" id="BackrestFrame" data-picture_id="Backrest Frame" group="backrest-frame">
                             <area shape="poly" href="#" class="doublecab_front_seat" coords="499,82,501,69,503,61,513,56,519,59,537,71,540,77,539,99,530,104,528,118,526,119,524,117,526,102,512,94,510,108,506,107,508,92,499,82" title="Headrest" id="Headrest" data-picture_id="Headrest" group="headrest">
                             <area shape="poly" href="#" class="doublecab_front_seat" coords="335,441,338,436,336,433,338,430,338,428,336,428,336,424,346,419,346,411,354,406,344,406,344,397,342,395,342,381,349,378,347,375,347,374,365,363,369,363,377,357,443,395,472,383,490,369,511,382,522,379,533,388,519,403,513,409,507,420,522,410,524,410,524,414,530,416,530,420,509,433,518,439,512,444,502,438,427,485,427,487,430,490,427,492,427,497,425,497,424,496,420,498,416,494,420,491,421,489,419,486,419,477,427,472,428,471,428,462,434,458,431,452,423,449,423,445,417,444,413,446,384,430,366,419,345,432,345,436,348,438,344,442,344,445,341,445,340,446,335,446,335,441" title="Seat Frame" id="SeatFrame" data-picture_id="Seat Frame" group="seat-frame">
                             <area shape="poly" href="#" class="doublecab_front_seat" coords="" title="" data-picture_id="">
                             <area shape="poly" href="#" class="doublecab_front_seat" coords="" title="" data-picture_id="">

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
			    key: 'inner-seat-trim',
			    fillColor: '8bf058',
			    isMask: true
            },
            {
			    key: 'safety-belt',
			    fillColor: '8bf058',
			    isMask: true
            },
            {
			    key: 'seat-pad',
			    fillColor: '8bf058',
			    isMask: true
            },
            {
			    key: 'outter-seat-trim',
			    fillColor: '8bf058',
			    isMask: true
            },
            {
			    key: 'seat-cushion-cover',
			    fillColor: '8bf058',
			    isMask: true
            },
            {
			    key: 'backrest-pad',
			    fillColor: '8bf058',
			    isMask: true
            },
            {
			    key: 'backrest-cover',
			    fillColor: '8bf058',
			    isMask: true
            },
            {
			    key: 'side-airbag',
			    fillColor: '8bf058',
			    isMask: true
            },
            {
			    key: 'backrest-frame',
			    fillColor: '8bf058',
			    isMask: true
            },
            {
			    key: 'headrest',
			    fillColor: '8bf058',
			    isMask: true
            },
            {
			    key: 'seat-frame',
			    fillColor: '8bf058',
			    isMask: true
            }
        ]
	});



</script>

@endsection      