@extends((Auth::user()->position == 'Administrator') ? 'administrator' : 'alluser')

<!-- Google Maps JS Scripts -->
@section('maps')
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
{!! $map['js'] !!}

@endsection

@section('content')
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-primary">Assign Driver New Location. - {{$driver}}</h4>
                
            </div>
            
            <div class="card-body">
            
              
              <div class="row">
              {!! $map['html'] !!}
            <div id="directionsDiv"></div>
              </div>
              <div class="row">
                <div class="btn-group" style="margin-top:10px;">
                    <a href="#" class="btn btn-success btn-sm float-right assign_new_location">Send New Location</a>
                </div>
               
              </div>    
            </div>
</div>


<div class="modal hide fade" id="map_modal">
<div class="modal-body">
    <button type="button" class="close" data-dismiss="modal">×</button>
    <div class="control-group">
        <label class="control-label" for="keyword">Enter Address:</label>
        <div class="controls">
            <input type="text" class="span6" name="keyword" id="keyword">
        </div>
    </div>
    <div id="map_canvas" style="width:530px; height:300px"></div>
</div>
<div class="modal-footer">
    <a href="#" class="btn" data-dismiss="modal">Close</a>
    <a href="#" class="btn btn-primary">Save changes</a>
</div>

<script type="text/javascript">
$("#map_modal").modal({
    show: false
}).on("shown", function()
{
    var map_options = {
        center: new google.maps.LatLng(-6.21, 106.84),
        zoom: 11,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    var map = new google.maps.Map(document.getElementById("map_canvas"), map_options);

    var defaultBounds = new google.maps.LatLngBounds(
        new google.maps.LatLng(-6, 106.6),
        new google.maps.LatLng(-6.3, 107)
    );

    var input = document.getElementById("keyword");
    var autocomplete = new google.maps.places.Autocomplete(input);
    autocomplete.bindTo("bounds", map);

    var marker = new google.maps.Marker({map: map});

    google.maps.event.addListener(autocomplete, "place_changed", function()
    {
        var place = autocomplete.getPlace();

        if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
        } else {
            map.setCenter(place.geometry.location);
            map.setZoom(15);
        }

        marker.setPosition(place.geometry.location);
    });

    google.maps.event.addListener(map, "click", function(event)
    {
        marker.setPosition(event.latLng);
    });
});
</script>

@endsection              