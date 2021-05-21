@extends('2door')
@section('2door')

                   
                    <div class="row">
                        <div class="col-md-12">
                                <div>
                                    <img src="/img/3door_air_con.jpg" id="img_exterior" width="988px" height="538px" name="img_exterior" usemap="#map_3door_airconditioner">
                                <!--<img id="exterior_car" name="exterior_car" usemap="exterior_car">-->  
                                            
                                </div>
                        </div>
                    </div>   
                    <map id="map_3door_airconditioner" name="map_3door_airconditioner">
                        <area shape="poly" href="#" class="door3_airconditioner" coords="339,321,342,319,341,317,341,311,344,308,334,306,346,301,351,298,351,296,353,293,356,395,356,300,358,300,375,312,375,307,377,305,383,307,391,307,398,318,397,323,393,324,398,330,406,326,410,332,403,335,403,341,422,352,425,351,425,347,428,345,430,346,430,350,434,353,434,355,439,358,439,362,437,364,438,367,438,435,440,438,440,443,439,447,435,451,426,462,420,461,343,411,343,403,341,402,341,395,340,390,339,383,339,321" title="Condensor And Dryer" data-picture_id="Condensor And Dryer" group="condensor-and-dryer" id="CondensorAndDryer" >
                        <area shape="poly" href="#" class="door3_airconditioner" coords="470,260,478,249,481,260,489,266,489,255,488,253,491,245,500,250,502,255,500,259,500,267,506,272,514,273,517,283,512,290,506,288,506,300,507,307,498,314,497,306,497,299,492,296,484,300,477,295,473,284,480,285,481,283,481,278,470,260" title="Radiator Fan" data-picture_id="Radiator Fan" group="radiator-fan" id="RadiatorFan">
                        <area shape="poly" href="#" class="door3_airconditioner" coords="453,442,452,434,468,424,484,425,511,441,518,437,514,399,520,374,522,362,516,345,522,337,528,338,530,345,533,374,527,401,529,445,523,454,506,454,482,440,469,440,460,444,453,442" title="Radiator Air Guide" data-picture_id="Radiator Air Guide" group="radiator-air-guide" id="RadiatorAirGuide">
                        <area shape="poly" href="#" class="door3_airconditioner" coords="326,170,324,163,326,160,346,149,352,147,360,148,374,153,376,156,376,161,374,166,370,167,359,163,352,162,346,164,333,174,328,174,326,170" title="Radiator Bottle Hose" data-picture_id="Radiator Bottle Hose" group="radiator-bottle-hose" id="RadiatorBottleHose">
                        <area shape="poly" href="#" class="door3_airconditioner" coords="397,129,398,125,403,124,406,125,406,127,408,129,408,131,406,132,406,137,405,139,403,139,401,139,400,138,400,133,398,132,397,129" title="Radiator Bottle Cap" data-picture_id="Radiator Bottle Cap" group="radiator-bottle-cap" id="RadiatorBottleCap">
                        <area shape="poly" href="#" class="door3_airconditioner" coords="382,164,384,161,387,159,390,158,398,160,398,156,396,154,396,150,398,148,404,147,408,147,410,150,410,154,409,155,409,160,423,157,425,159,426,163,426,170,419,172,407,175,407,181,416,189,415,199,411,202,391,189,391,177,394,175,388,174,384,170,382,164" title="Radiator Bottle" data-picture_id="Radiator Bottle" group="radiator-bottle" id="RadiatorBottle">
                        <area shape="poly" href="#" class="door3_airconditioner" coords="583,224,584,222,586,219,589,211,597,206,598,202,598,197,602,196,608,197,613,200,620,206,620,219,618,223,616,225,617,231,615,233,612,234,604,228,598,232,594,231,591,231,587,231,584,227,583,224" title="Compressor" data-picture_id="Compressor" group="compressor" id="Compressor">
                        <area shape="poly" href="#" class="door3_airconditioner" coords="434,154,445,151,447,148,461,119,470,115,475,118,478,126,470,135,462,153,456,163,450,167,436,169,434,154" title="Evap/Condensor Hose" data-picture_id="Evap/Condensor Hose" group="evap-condensor-hose" id="EvapCondensorHose">
                        <area shape="poly" href="#" class="door3_airconditioner" coords="445,194,449,193,467,206,471,206,471,146,479,140,494,151,499,151,502,151,508,156,510,163,524,163,524,181,507,209,514,226,520,225,525,235,529,232,534,231,535,224,553,212,570,221,577,220,573,228,573,253,571,256,571,260,543,277,544,289,535,308,535,340,533,340,519,332,517,335,490,318,488,317,483,322,478,320,475,315,478,310,463,300,463,236,447,208,447,201,445,200,445,194" title="Fan Shroud" data-picture_id="Fan Shroud" group="fan-shroud" id="FanShroud">
                        <area shape="poly" href="#" class="door3_airconditioner" coords="482,99,483,97,483,38,490,34,506,45,510,46,512,42,520,49,521,56,533,56,535,57,535,73,521,98,519,103,519,110,515,111,499,102,495,102,490,105,488,105,482,102,482,99" title="Radiator Gasket" data-picture_id="Radiator Gasket" group="radiator-gasket" id="RadiatorGasket">
                        <area shape="poly" href="#" class="door3_airconditioner" coords="" title="" data-picture_id="">
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
			    key: 'radiator-air-guide',
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
			    key: 'evaporator',
			    fillColor: '8bf058',
			    isMask: true
            },
            {
			    key: 'part22',
			    fillColor: '8bf058',
			    isMask: true
            }
		]

	});


</script>     


@endsection