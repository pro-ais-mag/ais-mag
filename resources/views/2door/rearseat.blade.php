@extends('2door')
@section('2door')

                   
                    <div class="row">
                        <div class="col-md-12">
                                <div>
                                    <img src="/img/3door_rear_seat.jpg" id="img_exterior" width="988px" height="538px" name="img_exterior" usemap="#map_3door_rear_seat">
                                <!--<img id="exterior_car" name="exterior_car" usemap="exterior_car">-->  
                                            
                                </div>
                        </div>
                    </div>   
                    <map name="map_3door_rear_seat" id="map_3door_rear_seat">
                    <area shape="poly" href="#" class="door3_rear_seat" coords="595,67,606,40,622,36,650,53,662,65,664,83,663,104,659,112,653,112,645,111,639,108,631,133,626,134,623,129,631,104,611,91,604,117,599,118,594,114,604,86,597,81,595,67" title="Rear Headrest" data-picture_id="Rear Headrest" group="rear-headrest" id="RearHeadrest">
                            <area shape="poly" href="#" class="door3_rear_seat" coords="487,225,527,136,553,128,656,193,662,206,656,224,644,231,615,294,605,296,598,314,580,324,487,264,486,255,494,230,487,225" title="Rear Backrest Cover" data-picture_id="Rear Backrest Cover" group="rear-backrest-cover" id="RearBackrestCover">
                            <area shape="poly" href="#" class="door3_rear_seat" coords="421,231,438,221,444,227,447,244,445,252,451,264,460,272,461,277,461,285,454,288,451,287,450,280,436,269,432,258,421,246,421,231" title="Rear Seat Belt Lock" data-picture_id="Rear Seat Belt Lock" group="rear-seat-belt-lock" id="RearSeatBeltLock">
                            <area shape="poly" href="#" class="door3_rear_seat" coords="351,361,353,351,362,339,388,321,440,292,452,296,545,357,546,363,546,377,537,388,536,397,530,405,481,437,452,435,433,423,382,389,353,370,351,361" title="Rear Cushion Pad" data-picture_id="Rear Cushion Pad" group="rear-cushion-pad" id="RearCushionPad">
                            <area shape="poly" href="#" class="door3_rear_seat" coords="383,398,460,443,484,440,535,407,541,411,543,410,543,402,545,395,556,384,560,387,560,430,556,437,545,450,545,464,537,473,527,479,482,487,440,463,427,455,412,439,400,429,381,416,383,398" title="Rear Seat Frame" data-picture_id="Rear Seat Frame" group="rear-seat-frame" id="RearSeatFrame">
                            <area shape="poly" href="#" class="door3_rear_seat" coords="584,140,598,135,675,184,682,204,673,230,645,306,643,319,640,329,636,323,633,320,631,323,624,330,619,326,621,308,611,301,625,283,663,218,662,206,663,191,584,140" title="Rear Backrest Frame" data-picture_id="Rear Backrest Seat" group="rear-backrest-seat" id="RearBackrestSeat">                 
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
			    key: 'rear-squab-pad',
			    fillColor: '8bf058',
			    isMask: true
            },
            {
			    key: 'rear-seat-belt-lock',
			    fillColor: '8bf058',
			    isMask: true
            },
            {
			    key: 'rear-arm-rest',
			    fillColor: '8bf058',
			    isMask: true
            },
            {
			    key: 'rear-cushion-pad',
			    fillColor: '8bf058',
			    isMask: true
            },
            {
			    key: 'rear-seat-cushion-cover',
			    fillColor: '8bf058',
			    isMask: true
            },
            {
			    key: 'rear-seat-frame',
			    fillColor: '8bf058',
			    isMask: true
            },
            {
			    key: 'rear-backrest-cover',
			    fillColor: '8bf058',
			    isMask: true
            },
            {
			    key: 'rear-squab-pad',
			    fillColor: '8bf058',
			    isMask: true
            }
        ]
	});



</script>
@endsection