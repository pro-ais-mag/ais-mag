@extends('hatchback')
@section('hatchback')
<div class="row">
       <div class="col-md-12">
            <div>
                <div>
                     <img src="/img/fuel system final-01.jpg" id="img_fuel" usemap="#map_fuel" width="988px" height="538px">
                </div>
            </div>

            <map name="map_fuel" id="map_fuel">
                    <area shape="poly" class="fuel" coords="738,88,738,86,740,87,773,114,774,128,773,131,770,130,757,120,750,113,746,111,743,106,742,100,741,91,738,88" href="#" title="Fuel Tank Flap" data-picture_id="Fuel Tank Flap" id="FuelTankFlap" group="fuel-tank-flap">
                    <area shape="poly" class="fuel" coords="727,118,734,114,737,115,740,114,747,117,747,127,748,136,746,140,741,142,737,140,733,139,730,137,728,132,727,118" href="#" title="Fuel Filler Cap" data-picture_id="Fuel Filler Cap" id="FuelFillerCap" group="fuel-filler-cap">
                    <area shape="poly" class="fuel" coords="742,162,745,159,748,161,749,163,756,167,757,163,760,162,765,165,765,168,769,171,768,182,774,186,772,188,767,186,764,187,759,184,759,179,756,179,755,173,753,172,752,170,750,168,748,166,746,166,742,162 " href="#" title="Valve Fuel Cop" data-picture_id="Valve Fuel Cop" id="ValveFuelCop" group="valve-fuel-cop">
                    <area shape="poly" class="fuel" coords="714,230,717,225,721,225,727,230,729,227,737,231,737,234,742,238,742,240,743,242,742,244,742,297,738,300,730,300,730,307,729,307,720,300,720,294,719,294,718,291,721,286,718,288,714,281,714,259,714,230" href="#" title="Active Carbon Unit" data-picture_id="Active Carbon Unit" id="ActiveCarbonUnit" group="active-carbon-unit">
                    <area shape="poly" class="fuel" coords="326,380,327,378,334,373,339,362,343,360,355,348,363,339,378,322,380,324,391,316,391,314,430,296,440,295,443,291,445,276,462,263,471,269,476,266,505,264,521,273,538,287,545,282,547,283,547,296,552,299,557,308,574,316,617,301,640,262,653,220,669,204,669,200,677,193,679,193,686,183,690,183,699,193,692,206,692,209,685,219,677,225,674,229,671,229,670,231,633,306,604,323,565,330,562,335,562,335,562,355,520,381,506,372,418,429,413,429,376,408,360,414,349,416,326,398,326,380" href="#" title="Fuel Tank" data-picture_id="Fuel Tank" id="Fuel Tank" group="fuel-tank">
                    <area shape="poly" class="fuel" coords="357,339,288,294,229,253,209,211,208,199,207,198,207,181,212,179,221,172,225,170,229,172,229,189,227,190,232,214,241,233,254,247,366,319,366,327,362,333,357,339" href="#" title="Fuel Inject Pipe Set" data-picture_id="Fuel Inject Pipe Set" id="FuelInjectPipeSet" group="fuel-inject-pipe-set">
                    <area shape="poly" class="fuel" coords="471,206,476,196,489,194,501,197,504,203,503,217,506,218,507,220,508,220,510,222,511,227,513,230,511,240,517,242,517,246,512,250,503,244,503,254,498,261,488,263,476,261,471,255,471,206" href="#" title="Fuel Pump" data-picture_id="Fuel Pump" id="FuelPump" group="fuel-pump">
                    <area shape="poly" class="fuel" coords="690,131,692,130,699,114,717,103,729,104,729,111,727,118,723,132,716,137,726,144,734,155,734,173,731,179,715,179,699,169,690,158,690,131" href="#" title="Filler Neck Insert" data-picture_id="Filler Neck Insert" id="FillerNeckInsert" group="filler-neck-insert">
                    <area shape="poly" class="fuel" coords="646,294,702,195,706,193,707,201,713,203,709,207,704,222,704,224,699,222,693,230,689,232,687,258,686,264,687,269,684,267,679,273,654,305,653,305,653,303,653,297,645,297,646,294" href="#" title="Filler Pipe Guard" data-picture_id="Filler Pipe Guard" id="FillerPipeGuard" group="filler-pipe-guard">
                    <area shape="poly" class="fuel" coords="451,415,459,408,471,416,476,398,491,387,495,392,488,397,485,397,478,420,468,425,451,415" href="#" title="Fuel Tank Strap" data-picture_id="Fuel Tank Strap" id="FuelTankStrap" group="fuel-tank-strap">
                    <area shape="poly" class="fuel" coords="281,392,301,375,304,378,333,360,335,353,353,342,324,385,305,396,323,402,350,422,333,430,281,397,281,392" href="#" title="Fuel Tank Protection" data-picture_id="Fuel Tank Protection" id="FuelTankProtection" group="fuel-tank-protection">
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
			    key: 'fuel-tank-flap',
			    fillColor: '8bf058',
			    isMask: true
            },
            {
			    key: 'fuel-filler-cap',
			    fillColor: '8bf058',
			    isMask: true
            },
            {
			    key: 'valve-fuel-cop',
			    fillColor: '8bf058',
			    isMask: true
            },
            {
			    key: 'active-carbon-unit',
			    fillColor: '8bf058',
			    isMask: true
            },
            {
			    key: 'fuel-tank',
			    fillColor: '8bf058',
			    isMask: true
            },
            {
			    key: 'fuel-inject-pipe-set',
			    fillColor: '8bf058',
			    isMask: true
            },
            {
			    key: 'fuel-pump',
			    fillColor: '8bf058',
			    isMask: true
            },
            {
			    key: 'filler-neck-insert',
			    fillColor: '8bf058',
			    isMask: true
            },
            {
			    key: 'filler-pipe-guard',
			    fillColor: '8bf058',
			    isMask: true
            },
            {
			    key: 'fuel-tank-strap',
			    fillColor: '8bf058',
			    isMask: true
            },
            {
			    key: 'fuel-tank-protection',
			    fillColor: '8bf058',
			    isMask: true
            }
            
		]

	});

</script>       
@endsection