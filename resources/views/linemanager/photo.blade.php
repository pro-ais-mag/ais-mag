@extends((Auth::user()->position == 'Administrator') ? 'administrator' : 'alluser')
@section('content')
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif


<div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-primary">Additional Photos - {{$id}}</h4>
                
            </div>
            <div class="card-body">
            <form action="/line-manager-upload" class="form-image-upload" method="POST" enctype="multipart/form-data">
            {!! csrf_field() !!}
            <input type="hidden" name="ref" id="ref" value="{{$id}}">
            <div class="row">
            <div class="col-md-5">
                <strong>Title:</strong>
                <input type="text" name="title" class="form-control" placeholder="Title">
            </div>
            <div class="col-md-5">
                <strong>Image:</strong>
                <input type="file" name="image" class="form-control" required>
            </div>
            <div class="col-md-2">
                <br/>
                <button type="submit" class="btn btn-success">Upload</button>
            </div>
        </div>
            </form>
            <div class="row">
    
            <div class="row text-center text-lg-left">
            @if($images->count())
            @foreach($images as $image)
                <div class='col-sm-4 col-xs-6 col-md-3 col-lg-3'>
                    <a class="thumbnail fancybox" rel="ligthbox" href="">
                        <img class="img-fluid img-thumbnail" alt="" src="/images/mag_photos/{{$image->Key_Ref}}/{{$image->picture_name}}">
                        <div class='text-center'>
                            <small class='text-muted'></small>
                        </div> <!-- text-center / end -->
                    </a>
                     <a class="btn btn-danger" href="/line-manager-delete/{{$image->id}}"><span class="fa fa-trash" ></span></a>
                    
                </div> <!-- col-6 / end -->
            @endforeach 
            @else
                <h5 style="color:red;">No images avaible</h5>  
            @endif

        </div> <!-- list-group / end -->
    </div> <!-- row / end -->
</div>

            </div>

</div>
@endsection