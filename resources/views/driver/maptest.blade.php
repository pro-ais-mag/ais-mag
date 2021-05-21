@extends((Auth::user()->position == 'Administrator') ? 'administrator' : 'alluser')


@section('maps')
<!-- Google Maps JS Scripts -->
<script type='text/javascript'>
            var centreGot = false;
</script>
{!! $map['js'] !!}

@endsection

@section('content')
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif
<div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-primary">Driver Current Locations.</h4>
                
            </div>
            <div class="card-body">
               {!! $map['html'] !!}
            </div>
</div>

@endsection