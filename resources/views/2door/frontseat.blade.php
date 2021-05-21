@extends('2door')
@section('2door')

                   
                    <div class="row">
                        <div class="col-md-12">
                                <div>
                                    <img src="/img/3door_front_seat.jpg" id="img_exterior" width="988px" height="538px" name="img_exterior" usemap="#map_3door_front_seat">
                                <!--<img id="exterior_car" name="exterior_car" usemap="exterior_car">-->  
                                            
                                </div>
                        </div>
                    </div>   
                    <map name="map_3door_front_seat" id="map_3door_front_seat">
                    <area shape="poly" href="#" class="door3_front_seat" coords="571,48,586,26,596,25,629,46,635,53,639,74,638,94,630,103,618,102,614,99,605,126,599,126,597,125,605,94,586,81,576,108,573,108,570,105,578,77,578,75,569,69,571,48" title="Headrest" data-picture_id="Headrest" group="headrest" id="Headrest" >
                            <area shape="poly" href="#" class="door3_front_seat" coords="469,203,482,170,494,150,502,134,529,112,549,112,593,142,610,159,608,182,589,239,579,282,557,297,545,286,543,273,502,244,496,250,483,249,467,233,469,203" title="Backrest Cover" data-picture_id="Backrest Cover" group="backrest-cover" id="BackrestCover">
                            <area shape="poly" href="#" class="door3_front_seat" coords="406,214,406,195,410,190,428,180,438,187,441,213,438,222,441,233,458,250,461,255,461,264,449,272,446,270,446,262,444,259,439,255,427,243,420,229,406,214" title="Safety Belt" data-picture_id="Safety Belt" group="safety-belt" id="SafetyBelt">
                            <area shape="poly" href="#" class="door3_front_seat" coords="351,321,350,319,350,296,358,285,363,281,379,253,390,249,398,253,403,262,403,283,389,289,351,321" title="Inner Seat Trim" data-picture_id="Inner Seat Trim" group="inner-seat-trim" id="InnerSeatTrim">
                            <area shape="poly" href="#" class="door3_front_seat" coords="354,331,357,323,389,295,444,277,458,273,471,277,525,313,530,315,538,326,535,348,514,377,467,409,449,415,431,413,378,378,374,377,361,354,354,331" title="Seat Pad" data-picture_id="Seat Pad" group="seat-pad" id="SeatPad">
                            <area shape="poly" href="#" class="door3_front_seat" coords="513,471,516,467,516,458,522,448,574,414,578,415,578,408,583,403,594,391,605,370,620,363,629,369,633,379,632,388,629,396,628,404,520,476,513,471" title="Outter Seat Trim" data-picture_id="Outter Seat Trim" group="outter-seat-trim" id="OutterSeatTrim">
                            <area shape="poly" href="#" class="door3_front_seat" coords="616,171,641,189,643,206,603,320,498,287,507,256,557,297,579,282,589,239,608,182,616,171" title="Backrest Frame" data-picture_id="Backrest Frame" group="backrest-frame" id="BackrestFrame">
                            <area shape="poly" href="#" class="door3_front_seat" coords="498,287,605,356,587,387,490,449,490,454,486,456,481,487,467,494,458,501,438,510,422,515,417,515,351,470,348,466,348,456,350,453,371,432,379,430,386,425,392,417,405,417,415,410,475,410,550,355,545,334,541,321,498,287" title="Seat Frame" data-picture_id="Seat Frame" group="seat-frame" id="SeatFrame">
                    
                    </map>
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