@extends('vehicle')
@section('vehicle')
                    <div class="row">
                    <div class="col-md-12">
                            <div>
                                <img id="img_doublecab_rear_bumper" name="img_doublecab_rear_bumper" src="/img/Body_rear_inner_singlecab.jpg" height="538px" width="988px" usemap="#map_doublecab_rear_bumper">       
                            </div>
							<map id="#map_doublecab_rear_bumper" name="#map_doublecab_rear_bumper">
							<area shape="poly" href="#" class="doublecab_rear_bumper" coords="312,213,314,210,314,210,333,223,339,218,358,232,359,236,362,238,366,239,370,242,372,242,374,244,404,264,406,261,408,262,413,257,414,258,414,266,413,268,428,274,443,285,446,287,446,294,464,305,464,308,462,308,443,297,436,300,424,292,420,288,416,284,405,277,400,273,370,253,368,253,366,250,361,249,359,246,356,244,351,246,331,233,331,225,318,218,314,215,312,213" title="Testing Part" data-picture_id="Testing Part">
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