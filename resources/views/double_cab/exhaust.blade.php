@extends('vehicle')
@section('vehicle')
                    <div class="row">
                    <div class="col-md-12">
                            <div>
                                <img id="img_doublecab_exhaust" name="img_doublecab_exhaust" src="/img/singlecab_exhaust.jpg" height="538px" width="988px" usemap="#map_doublecab_exhaust">       
                            </div>
                            <map id="map_doublecab_exhaust" name="map_doublecab_exhaust">
                            
                            <area shape="poly" href="#" class="doublecab_exhaust" coords="171,367,172,362,166,346,167,344,183,353,186,357,202,400,206,396,219,405,208,423,203,429,202,425,190,418,187,419,178,376,171,367" title="Rear Heat Sheild" id="RearHeatSheild" data-picture_id="Rear Heat Sheild" group="rear-heat-sheild">
                            <area shape="poly" href="#" id="TunnelHeatSheild" class="doublecab_exhaust" coords="243,373,238,377,237,376,232,365,219,357,214,360,211,359,210,356,214,355,224,347,261,325,262,323,267,320,269,321,284,310,289,304,297,299,300,299,328,281,329,277,342,269,346,269,365,256,369,256,369,253,377,248,381,248,402,232,419,244,412,264,321,323,319,321,311,327,311,329,281,347,255,363,243,373" title="Tunnel Heat Sheild" id="TunnelHeatSheild" data-picture_id="Tunnel Heat Sheild" group="tunnel-heat-sheild">
                            <area shape="poly" href="#" class="doublecab_exhaust" coords="411,232,411,229,415,224,426,202,434,190,468,167,470,166,479,172,476,175,494,185,501,192,479,207,436,238,425,240,411,232" title="Front Heat Sheild" id="FrontHeatSheild" data-picture_id="Front Heat Sheild" group="front-heat-sheild">
                            <area shape="poly" href="#" class="doublecab_exhaust" coords="485,163,505,151,506,152,513,147,529,136,541,122,560,108,568,110,568,113,570,115,571,112,575,115,575,119,577,119,578,118,589,130,587,131,574,139,565,146,558,154,554,158,548,165,546,165,538,172,533,175,527,178,510,189,505,191,502,180,485,169,485,163" title="Part 4" id="Part4" data-picture_id="N/A" group="part4">
                            <area shape="poly" href="#" class="doublecab_exhaust" coords="582,106,589,103,605,90,617,81,616,69,608,50,614,45,639,61,642,58,649,57,673,47,697,32,705,33,717,42,718,50,715,50,689,68,662,85,642,98,621,111,602,123,593,116,582,108,582,106" title="Rear Heat Sheild" id="RearHeatSheild" data-picture_id="Rear Heat Sheild" group="rear-heat-sheild">
                            <area shape="poly" href="#" class="doublecab_exhaust" coords="175,458,180,457,189,454,197,462,211,470,361,375,362,372,371,365,377,369,380,370,383,372,378,381,372,383,368,383,368,387,220,481,205,483,190,474,183,473,176,463,175,458" title="Front Exhaust Pipe" id="FrontExhaustPipe" data-picture_id="Front Exhaust Pipe" group="front-exhaust-pipe">
                            <area shape="poly" href="#" class="doublecab_exhaust" coords="380,360,388,354,392,354,416,339,417,335,421,335,468,303,481,286,498,270,516,246,589,199,590,196,591,191,603,182,605,184,598,190,609,192,618,202,628,177,638,154,671,132,684,128,688,129,743,94,744,91,748,88,747,71,753,67,749,72,749,88,767,78,776,77,785,82,785,91,777,92,771,90,754,101,753,105,748,104,686,144,677,141,649,160,640,177,626,213,632,218,637,218,647,212,649,215,638,222,632,222,632,225,634,236,628,254,621,256,544,305,533,314,500,283,493,288,484,302,479,309,459,324,428,344,431,347,439,352,444,351,444,354,438,355,429,349,421,349,401,362,393,370,384,365,380,360" title="Front Exhaust Muffler" id="FrontExhaustMuffler" data-picture_id="Front Exhaust Muffler" group="front-exhaust-muffler">
                            <area shape="poly" href="#" class="doublecab_exhaust" coords="748,57,745,49,746,41,760,44,761,58,754,63,748,57" title="Exhausr Rubber" id="ExhaustRubber" data-picture_id="Exhaust Rubber" group="exhaust-rubber">
                            <area shape="poly" href="#" class="doublecab_exhaust" coords="577,174,576,166,578,161,585,157,595,163,598,174,590,184,580,181,577,174" title="Exhaust Rubber" id="Exhaust Rubber" data-picture_id="Exhaust Rubber" group="exhaust-rubber-2">
                            <area shape="poly" href="#" class="doublecab_exhaust" coords="347,356,344,345,342,345,341,344,350,336,357,341,360,351,359,357,357,360,352,361,347,356" title="Front Twin Clamp" id="FrontTwinClamp" data-picture_id="Front Twin Clamp" group="front-twin-clamp">
                            <area shape="poly" href="#" class="doublecab_exhaust" coords="236,415,240,412,241,398,245,388,249,380,250,376,247,376,247,371,251,367,254,368,253,376,252,377,246,390,243,399,243,411,246,414,246,421,244,422,243,424,241,426,239,425,238,422,236,421,236,415" title="Lambda Probe" id="LambdaProbe" data-picture_id="Lambda Probe" group="lambda-probe">
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