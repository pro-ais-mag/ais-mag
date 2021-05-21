@extends('singlecab')
@section('singlecab')
                    <div class="row">
                    <div class="col-md-12">
                            <div>
                                <img id="img_cab_exhaust" name="img_cab_exhaust" src="/img/cab_exhaust.jpg" height="538px" width="988px" usemap="#map_cab_exhaust">       
                            </div>
                            <map id="map_cab_exhaust" name="map_cab_exhaust">
                                 <area shape="poly" href="#" class="cab_exhaust" coords="169,512,166,491,179,493,185,499,217,496,244,480,252,462,274,446,293,448,304,437,313,418,329,406,325,402,310,410,307,407,320,398,331,403,339,388,388,354,396,353,410,350,423,342,435,323,445,309,460,297,458,290,460,286,471,283,475,284,488,297,489,303,481,309,470,308,453,320,444,335,434,350,417,362,415,364,405,382,402,385,362,413,362,425,349,435,347,431,359,423,359,415,353,418,335,418,324,427,317,442,308,454,298,461,291,478,271,494,252,493,237,502,213,512,189,513,187,521,169,512" title="Front Exhaust Pipe" data-picture_id="Front Exhaust Pipe" id="FrontExhaustPipe" group="front-exhaust-pipe">
                                 <area shape="poly" href="#" class="cab_exhaust" coords="260,432,260,424,263,420,263,407,268,401,276,395,276,391,273,386,273,377,275,376,280,376,282,377,282,385,281,386,278,391,277,397,269,402,265,407,265,421,269,424,269,432,266,434,266,439,262,439,262,434,260,432" title="Lambda Probe" data-picture_id="Lambda Probe" id="LambdaProbe" group="lambda-probe">
                                 <area shape="poly" href="#" class="cab_exhaust" coords="263,290,263,286,285,280,291,274,311,265,356,239,366,237,375,242,378,242,379,246,381,247,381,250,357,271,297,297,290,297,283,299,281,298,275,291,268,289,266,291,263,290" title="Tunnel Heat Shield" data-picture_id="Tunnel Heat Shield" id="TunnelHeatShield" group="tunnel-heat-shield">
                                 <area shape="poly" href="#" class="cab_exhaust" coords="398,299,405,302,412,308,413,313,408,326,399,330,391,317,391,304,398,299" title="Front Twin Clamp" data-picture_id="Front Twin Clamp" id="FrontTwinClamp" group="front-twin-clamp">
                                 <area shape="poly" href="#" class="cab_exhaust" coords="527,151,543,157,547,165,523,186,462,212,449,214,428,205,428,201,451,194,457,189,527,151" title="Tunnel Heat Shield" data-picture_id="Tunnel Heat Shield" id="TunnelHeatShield" group="tunnel-heat-shield">
                                 <area shape="poly" href="#" class="cab_exhaust" coords="479,282,477,279,491,272,497,273,566,227,580,205,583,204,582,194,597,180,601,180,657,142,674,148,684,129,682,115,691,115,703,125,707,132,705,136,697,136,683,159,687,175,685,187,616,239,588,218,577,230,568,242,507,283,509,293,497,298,492,297,479,282" title="Front Exhaust Muffler" data-picture_id="Front Exhaust Muffler" id="FrontExhaustMuffler" group="front-exhaust-muffler">
                                 <area shape="poly" href="#" class="cab_exhaust" coords="647,96,656,100,662,112,662,122,661,126,655,130,646,130,639,121,636,111,641,101,647,96" title="Exhaust Rubber" data-picture_id="Exhaust Rubber" group="exhaust-rubber">
                                 <area shape="poly" href="#" class="cab_exhaust" coords="720,76,775,96,795,95,812,84,861,47,887,31,900,32,904,34,905,41,899,46,888,46,870,58,805,106,787,112,728,92,715,93,710,109,714,115,713,120,698,119,688,105,691,100,700,99,711,78,720,76" title="Exhaust Pipe" data-picture_id="Exhaust Pipe" id="ExhaustPipe" group="exhaust-pipe">
                                 <area shape="poly" href="#" class="cab_exhaust" coords="818,35,820,30,826,28,831,28,837,33,841,39,838,49,834,55,828,58,822,53,819,44,818,35" title="Exhaust Rubber" data-picture_id="Exhaust Rubber" id="ExhaustRubber" group="exhaust-rubber" >
                                 <area shape="poly" href="#" class="cab_exhaust" coords="580,262,591,268,592,277,589,293,585,296,569,285,580,262" title="Front Twin Clamp" data-picture_id="Front Twin Clamp" id="FrontTwinClamp" group="front-twin-clamp">
                                 <area shape="poly" href="#" class="cab_exhaust" coords="" title="Part" data-picture_id="Part">
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
			    key: 'front-exhaust-pipe',
			    fillColor: '8bf058',
			    isMask: true
            },
            {
			    key: 'lambda-probe',
			    fillColor: '8bf058',
			    isMask: true
            },
            {
			    key: 'front-twin-clamp',
			    fillColor: '8bf058',
			    isMask: true
            },
            {
			    key: 'tunnel-heat-sheild',
			    fillColor: '8bf058',
			    isMask: true
            },
            {
			    key: 'tunnel-heat-sheild',
			    fillColor: '8bf058',
			    isMask: true
			},
            {
			    key: 'exhaust-rubber',
			    fillColor: '8bf058',
			    isMask: true
            },
            {
			    key: 'front-exhaust-muffler',
			    fillColor: '8bf058',
			    isMask: true
			},
            {
			    key: 'exhaust-pipe',
			    fillColor: '8bf058',
			    isMask: true
			}    
            
		]

	});


</script>                              
@endsection                     