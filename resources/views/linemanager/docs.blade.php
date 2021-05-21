@extends((Auth::user()->position == 'Administrator') ? 'administrator' : 'alluser')
@section('content')
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif


<div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-primary">Uploaded Documents - {{$id}}</h4>
                
            </div>
            <div class="card-body">
            <form action="/line-manager-upload-doc" class="form-image-upload" method="POST" enctype="multipart/form-data">
            {!! csrf_field() !!}
            <input type="hidden" name="ref" id="ref" value="{{$id}}">
            <div class="row">
            <div class="col-md-5">
                <strong>Doc Description:</strong>
                <select name="description" id="description" class="form-control" required>
                <option value="">Choose Document Type</option>
                 @foreach($doc_types as $docs)
                    <option value="{{$docs->description}}">{{$docs->description}}</option>
                 @endforeach   
                </select>
            </div>
            <div class="col-md-5">
                <strong>Image:</strong>
                <input type="file" name="image" id="image" class="form-control" required>
            </div>
            <div class="col-md-2">
                <br/>
                <button type="submit" class="btn btn-success">Upload Document</button>
            </div>
        </div>
            </form><br><br>
            <div class="row">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="font-size:12px;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Filename</th>
                                    <th>Description</th>
                                    <th>Date Modified</th>
                                    <th>Time</th>
                                    <th>Modified By</th>
                                    <th></th>
                                </tr>
                            </thead>
                            @php $count=1;@endphp
                            <tbody>
                                @foreach($documents as $document)
                                @php 
                                     $file_name="";  
                                     $path = 'docs/uploaded/'.$key.'/'.$doc->url;
                                     $path2 = 'http://192.168.0.185:8080/MAG_System/models/UploadedDocs/'.$key.'/'.$doc->url;
                                    
                                     if (file_exists($path)) {
                                       $file_name =asset('/docs/uploaded/'.$key.'/'.$doc->url);
                                     } else {
                                       $file_name = $path2;
                                     }
                                 @endphp
                                 <tr>                 
                                    <td>{{$count}}</td>                            
                                    <td>{{$document->url}}</td>
                                    <td>{{$document->Description}}</td>
                                    <td>{{$document->date}}</td>
                                    <td>{{$document->time}}</td>
                                    <td>{{$document->user}}</td>
                                    <td>
                                        <a href="{{$file_name}}" target="_blank" class="btn btn-primary"><span class="fa fa-search"></span></a>
                                        
                                    </td>    
                                 </tr>
                                 @php $count++;@endphp
                                @endforeach    
                            </tbody>

                        </table>
                    </div>
                </div>

            </div>

</div>
@endsection            