@extends('2door')
@section('2door')

                   
                    <div class="row">
                        <div class="col-md-12">
                                <div>
                                    <img src="/img/3door_exhaust.jpg" id="img_3door_exhaust" width="988px" height="538px" name="img_exterior" usemap="#map_3door_exhaust">
                                <!--<img id="exterior_car" name="exterior_car" usemap="exterior_car">-->  
                                            
                                </div>
                        </div>
                    </div>   
                    <map name="map_3door_exhaust" id="map_3door_exhaust">
                    <area shape="poly" href="#" class="door3_exhaust" coords="215,436,215,423,216,419,220,415,227,411,229,409,231,404,238,401,244,398,251,391,255,392,265,381,271,380,280,374,288,373,296,369,299,370,321,357,325,356,338,365,342,375,342,379,341,383,309,402,302,410,297,413,293,415,241,448,238,448,235,445,235,435,233,430,229,427,217,435,215,436" title="Tunnel Heat Shield" data-picture_id="Tunnel Heat Shield" group="tunnel-heat-shield" id="TunnelHeatShield">
                            <area shape="poly" href="#" class="door3_exhaust" coords="350,381,350,378,358,373,360,373,365,379,366,382,366,386,359,390,356,391,352,387,350,381" title="Exhaust Rubber" data-picture_id="Exhaust Rubber" group="exhaust-rubber" id="ExhaustRubber">
                            <area shape="poly" href="#" class="door3_exhaust" coords="386,316,385,312,391,305,433,279,447,276,455,271,460,271,469,286,467,293,458,298,456,301,451,307,446,310,411,332,409,331,405,320,397,311,387,316,385,316" title="Front Heat Shield" data-picture_id="Front Heat Shield" group="front-heat-sheild" id="FrontHeatShield">
                            <area shape="poly" href="#" class="door3_exhaust" coords="467,231,467,225,517,194,521,194,532,203,533,221,534,224,543,230,545,233,544,236,492,268,478,258,477,246,475,236,467,231" title="Rear Heat Shield" data-picture_id="Rear Heat Shield" group="rear-heat-shield" id="RearHeatShield">
                            <area shape="poly" href="#" class="door3_exhaust" coords="539,187,541,184,549,180,552,182,555,185,557,194,550,199,546,199,541,194,539,187" title="Exhaust Rubber" data-picture_id="Exhaust Rubber" group="exhaust-rubber" id="ExhaustRubber">
                            <area shape="poly" href="#" class="door3_exhaust" coords="648,91,648,86,650,83,653,79,657,78,664,82,665,86,663,91,659,95,656,97,648,91" title="Exhaust Rubber" data-picture_id="Exhaust Rubber" group="exhaust-rubber" id="ExhaustRubber">
                            <area shape="poly" href="#" class="door3_exhaust" coords="790,72,791,69,769,66,797,65,812,55,817,56,819,57,820,60,820,69,805,80,802,80,799,81,796,81,793,79,790,72" title="Exhaust Pipe Trim" data-picture_id="Exhaust Pipe Trim" group="exhaust-pipe-trim" id="ExhaustPipeTrim">
                            <area shape="poly" href="#" class="door3_exhaust" coords="190,388,190,385,193,379,193,375,200,364,206,361,210,355,217,352,222,352,226,348,239,330,260,321,261,319,268,315,270,315,275,318,274,323,266,325,261,323,240,332,228,349,223,355,217,354,212,355,208,364,207,368,199,381,197,381,193,387,190,388" title="Lambda Probe" data-picture_id="Lambda Probe" group="lamba-probe" id="LambdaProbe">
                            <area shape="poly" href="#" class="door3_exhaust" coords="251,294,254,292,261,294,268,300,273,301,297,310,300,313,301,321,303,323,305,330,307,332,310,339,308,342,308,346,307,348,304,346,302,344,301,342,300,336,300,332,298,325,301,322,298,314,296,311,272,303,267,302,259,303,251,301,251,294" title="Lambda Probe" data-picture_id="Lambda Probe" group="lamba-probe" id="LambdaProbe">
                            <area shape="poly" href="#" class="door3_exhaust" coords="609,146,617,145,626,114,628,110,633,106,641,104,673,109,673,102,668,99,668,96,671,94,677,99,679,104,677,110,699,112,697,100,697,92,700,87,706,81,739,63,752,69,754,70,761,65,764,68,763,69,760,68,756,73,764,87,782,76,784,74,787,75,788,81,785,91,767,102,765,113,734,134,724,138,705,124,674,121,672,123,668,121,647,117,636,119,627,149,631,157,631,162,614,159,609,152,609,146" title="Front Exhaust Muffler" data-picture_id="Front Exhaust Muffler" group="front-exhaust-muffler" id="FrontExhaustMuffler">
                            <area shape="poly" href="#" class="door3_exhaust" coords="181,438,190,434,202,432,209,439,210,443,247,464,254,466,263,464,386,387,388,378,391,374,454,336,464,337,509,309,517,304,560,298,562,297,562,295,535,266,534,260,535,254,538,248,564,229,566,225,565,214,567,213,578,216,585,222,587,230,584,231,580,231,576,231,569,239,559,248,547,257,546,261,559,274,574,293,573,300,571,305,564,310,546,312,517,317,469,347,464,360,403,398,396,399,369,409,384,416,382,413,387,410,392,406,392,403,387,400,349,425,264,475,256,477,249,477,198,449,192,450,182,443,181,438" title="Rear Exhaust Muffler" data-picture_id="Rear Exhaust Muffler" group="rear-exhaust-muffler" id="RearExhaustMuffler">
                            <area shape="poly" href="#" class="door3_exhaust" coords="" title="Part 12" data-picture_id="Part">         
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



<!--Exhaust Map-->
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
			    key: 'rear-heat-sheild',
			    fillColor: '8bf058',
			    isMask: true
            },
            {
			    key: 'tunnel-heat-sheild',
			    fillColor: '8bf058',
			    isMask: true
            },
            {
			    key: 'front-heat-sheild',
			    fillColor: '8bf058',
			    isMask: true
            },
            {
			    key: 'part4',
			    fillColor: '8bf058',
			    isMask: true
            },
            {
			    key: 'rear-heat-sheild2',
			    fillColor: '8bf058',
			    isMask: true
            },
            {
			    key: 'front-exhaust-pipe',
			    fillColor: '8bf058',
			    isMask: true
            },
            {
			    key: 'front-exhaust-muffler',
			    fillColor: '8bf058',
			    isMask: true
            },
            {
			    key: 'exhaust-rubber',
			    fillColor: '8bf058',
			    isMask: true
            },
            {
			    key: 'exhaust-rubber-2',
			    fillColor: '8bf058',
			    isMask: true
            },
            {
			    key: 'front-twin-clamp',
			    fillColor: '8bf058',
			    isMask: true
            },
            {
			    key: 'lambda-probe',
			    fillColor: '8bf058',
			    isMask: true
            }
        ]
	});



</script>
@endsection