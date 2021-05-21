@extends('quotations')
@section('content')
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif
<div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-primary">Client Documents - {{$key}}</h4>
            </div>
            <div class="card-body">
           
            <form action="/line-manager-upload-doc" class="form-image-upload" method="POST" enctype="multipart/form-data">
            {!! csrf_field() !!}
            <input type="hidden" name="ref" id="ref" value="{{$key}}">
            <div class="row">
            <div class="col-md-5">
                <strong>Doc Description:</strong>
                <select name="description" id="description" class="form-control form-control-sm" required>
                <option value="">Choose Document Type</option>
                 @foreach($descriptions as $docs)
                    <option value="{{$docs->description}}">{{$docs->description}}</option>
                 @endforeach   
                </select>
            </div>
            <div class="col-md-5">
                <strong>Document:</strong>
                <input type="file" name="image" id="image" class="form-control-file form-control-file-sm" required>
            </div>
            <div class="col-md-2">
                <br/>
                <button type="submit" class="btn btn-success btn-sm">Upload Document</button>
            </div>
        </div>
            </form><br><br>
                <div class="row">
                    <div class="table-responsive">
                        <table class="table-sm table-bordered table-dark" style="font-size:10px;" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>File Name</th>
                                    <th>File Description</th>
                                    <th>Date Modified</th>
                                    <th>Time</th>
                                    <th>Modified By</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($documents as $doc)

                                 @php 
                                     $file_name="";
                                     $value = substr($doc->url,0, 3);
                                     $path = 'docs/uploaded/'.$key.'/'.$doc->url;
                                     $path2 = 'http://192.168.0.185:8080/MAG_System/models/UploadedDocs/'.$key.'/'.$doc->url;
                                    
                                     if (file_exists($path)) {
                                       $file_name =asset('/docs/uploaded/'.$key.'/'.$doc->url);
                                     } else if( $value == 'INV' ){
                                       $file_name = 'http://192.168.0.185:8080/mag_documentions/supplier_invoices/'.$doc->url;
                                     }else{
                                        $file_name = $path2;
                                     }
                                 @endphp

                                <tr>
                                    <td>{{$doc->url}}</td>
                                    <td>{{$doc->Description}}</td>
                                    <td>{{$doc->date}}</td>
                                    <td>{{$doc->time}}</td>
                                    <td>{{$doc->user}}</td>
                                    <td><a href="{{$file_name}}" title="Open Document" target="_blank" class="btn btn-primary btn-sm"><span class="fa fa-search"></span></a></td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
</div>
@endsection            