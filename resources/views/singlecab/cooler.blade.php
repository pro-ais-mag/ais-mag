@extends('singlecab')
@section('singlecab')
                    <div class="row">
                    <div class="col-md-12">
                            <div>
                                <img id="img_cab_cooler" name="img_cab_cooler" src="/img/cab_cooler.jpg" height="538px" width="988px" usemap="#map_cab_cooler">       
                            </div>
                            <map id="map_cab_cooler" name="map_cab_cooler">
                                 <area shape="poly" href="#" class="cab_cooler" coords="267,198,378,271,389,266,396,277,389,285,390,403,376,414,371,411,365,414,360,413,244,336,240,324,240,220,248,212,267,198" title="Radiator" data-picture_id="Radiator" id="Radiator" group="radiator">
                                 <area shape="poly" href="#" class="cab_cooler" coords="466,201,483,204,476,237,465,248,448,251,448,251,409,273,404,273,399,270,396,262,397,255,426,238,435,234,449,232,457,230,462,223,466,201" title="Upper Radiator Hose" data-picture_id="Upper Radiator Hose" id="UpperRadiatorHose" group="upper-radiator-hose">
                                 <area shape="poly" href="#" class="cab_cooler" coords="507,203,525,217,528,226,529,239,522,295,515,306,498,318,467,348,424,381,417,380,413,375,441,367,414,361,443,343,468,314,480,304,500,292,507,275,511,228,504,222,497,218,497,208,507,203" title="Lower Radiator Hose" data-picture_id="Lower Radiator Hose" id="LowerRadiatorHose" group="lower-radiator-hose">
                                 <area shape="poly" href="#" class="cab_cooler" coords="573,292,580,294,582,298,580,302,577,303,577,310,573,312,569,311,569,304,566,301,565,298,566,295,573,292" title="Radiator Bottle Cap" data-picture_id="Radiator Bottle Cap" id="RadiatorBottleCap" group="radiator-bottle-cap">
                                 <area shape="poly" href="#" class="cab_cooler" coords="565,425,567,416,564,408,564,353,566,351,566,345,569,341,568,335,566,333,565,327,567,325,573,323,578,325,581,328,581,334,580,336,579,341,584,345,610,361,615,370,616,375,615,425,614,430,606,436,601,437,589,431,581,438,573,438,568,434,565,425" title="Radiator Bottle" data-picture_id="Radiator Bottle" id="RadiatorBottle" group="radiator-bottle">
                                 <area shape="poly" href="#" class="cab_cooler" coords="583,111,580,149,587,155,592,164,617,164,619,171,616,180,610,184,599,184,599,190,623,210,620,218,612,225,584,205,589,231,579,237,573,238,564,205,555,196,542,201,538,201,536,196,550,188,545,170,525,162,524,154,526,154,544,161,550,149,527,121,551,140,554,145,566,139,573,142,575,127,581,111,583,111" title="Fan" data-picture_id="Fan" id="Fan" group="fan">
                                 <area shape="poly" href="#" class="cab_cooler" coords="549,129,551,52,565,38,567,46,582,58,623,62,649,83,665,107,671,108,680,114,680,124,677,133,680,147,682,156,681,177,678,195,671,215,672,244,658,254,618,228,627,216,627,207,610,193,615,189,652,210,662,205,663,143,652,133,652,122,649,115,586,73,578,105,570,130,556,140,549,129" title="Fan Shroud" data-picture_id="Fan Shroud" id="FanShoud" group="fan-shoud">
                                 <area shape="poly" href="#" class="cab_cooler" coords="697,59,706,63,714,63,720,68,727,88,725,97,724,105,720,111,709,117,697,113,688,106,682,96,680,83,685,68,697,59" title="Compressor" data-picture_id="Compressor" id="Compressor" group="compressor">
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