@extends('vehicle')
@section('vehicle')
                    <div class="row">
                    <div class="col-md-12">
                            <div>
                                <img id="img_doublecab_rearseat" name="img_doublecab_rearseat" src="/img/singlecab_rear_seat.jpg" height="538px" width="988px" usemap="#map_doublecab_rear_seat">       
                            </div>
                            <map id="map_doublecab_rear_seat" name="map_doublecab_rear_seat">
                            
                            <area shape="poly" href="#" class="doublecab_rear_seat" coords="517,215,519,198,524,178,530,168,542,161,584,189,586,195,586,230,585,234,561,247,558,245,558,240,517,215" title="Rear SQuab Pad" id="RearSQuabPad" data-picture_id="Rear SQuab Pad" group="rear-squab-pad">
                            <area shape="poly" href="#" class="doublecab_rear_seat" coords="430,296,440,281,449,288,453,295,453,298,457,302,460,308,453,314,446,306,430,296" title="Rear Seat Belt Lock" id="RearSeatBeltLock" data-picture_id="Rear Seat Belt Lock" group="rear-seat-belt-lock">
                            <area shape="poly" href="#" id="RearArmRest" class="doublecab_rear_seat" coords="388,282,394,264,420,246,424,245,440,256,442,268,405,291,388,282" title="Rear Arm Rest" id="RearArmRest" data-picture_id="Rear Arm Rest" group="rear-arm-rest">
                            <area shape="poly" href="#" class="doublecab_rear_seat" coords="406,387,436,368,458,382,464,383,472,390,471,393,471,404,471,406,452,319,444,421,435,420,406,404,406,387" title="Rear Cushion Pad" id="RearCushionPad" data-picture_id="Rear Cushion Pad" group="rear-cushion-pad">
                            <area shape="poly" href="#" class="doublecab_rear_seat" coords="402,400,376,379,375,374,375,360,379,357,394,346,430,324,438,325,448,335,461,343,486,360,489,361,496,364,498,365,501,369,501,386,475,402,472,390,464,383,458,382,436,368,407,388,402,400" title="Rear Seat Cushion Cover" id="RearSeatCushionCover" data-picture_id="Rear Seat Cushion Cover" group="rear-seat-cushion-cover">
                            <area shape="poly" href="#" class="doublecab_rear_seat" coords="471,410,508,435,509,448,499,455,499,460,459,487,450,489,442,486,423,473,376,442,372,421,383,415,403,405,435,420,444,421,452,419,471,410" title="Rear Seat Frame" id="RearSeatFrame" data-picture_id="Rear Seat Frame" group="rear-seat-frame">
                            <area shape="poly" href="#" class="doublecab_rear_seat" coords="403,252,396,247,394,244,382,210,404,118,406,109,417,95,426,90,432,89,538,159,527,166,519,182,514,201,517,215,564,218,558,245,561,247,585,234,586,238,585,274,579,321,573,335,550,346,491,309,484,308,457,291,455,286,438,275,442,268,440,256,424,245,403,252" title="Rear Backrest Cover" id="RearBackrestCover" data-picture_id="Rear Backrest Cover" group="rear-backrest-cover">
                            <area shape="poly" href="#" class="doublecab_rear_seat" coords="476,113,479,101,487,101,492,88,506,70,509,72,508,74,508,78,517,83,518,78,521,78,521,85,554,107,558,109,602,138,604,135,608,135,606,141,616,147,618,143,620,144,619,151,633,158,641,179,630,259,643,264,641,267,625,306,624,307,622,307,622,305,616,301,622,289,622,287,618,284,616,284,610,281,609,278,588,264,590,229,584,190,476,113" title="Rear Backrest Frame" id="RearBackrestFrame" data-picture_id="Rear Backrest Frame" group="rear-backrest-frame">
                            <area shape="poly" href="#" class="doublecab_rear_seat" coords="444,53,449,40,460,28,465,27,477,37,495,47,501,56,502,76,487,86,487,101,481,101,481,83,467,73,467,86,464,89,461,87,462,70,450,62,444,53" title="Rear Headrest" id="RearHeadrest" data-picture_id="Rear Headrest" group="rear-headrest">
                            <area shape="poly" href="#" class="doublecab_rear_seat" coords="" title="" data-picture_id="">
                            <area shape="poly" href="#" class="doublecab_rear_seat" coords="" title="" data-picture_id="">
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