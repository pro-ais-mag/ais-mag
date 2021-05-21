<div class="card">

<div class="card-body">



<div class="tab-pane fade show" id="list-security-photos" role="tabpanel" aria-labelledby="list-home-list">

    <h5 class="text-primary" style="text-align:center;"><b>{{ $title }}</b></h5>
    <div class="row">
        <div>
        <form action="{{$action}}" class="form-control-sm" method="POST" enctype="multipart/form-data">
        {!! csrf_field() !!}
        <input type="hidden" name="ref" id="ref" value="{{$key}}">
        <div class="row">
        <!-- 
        <div class="col-md-5">
        -->
        <div class="col-md-2">
            <strong>Title:</strong>
            <input type="text" name="title" class="form-control form-control-sm" placeholder="Title">
        </div>
        <div class="col-md-2">
            <strong>Image:</strong>
            <input type="file" name="image" class="form-control form-control-sm" required>
        </div>
        <div class="col-md-2">
            <br/>
            <button type="submit" class="btn btn-success btn-sm">Upload</button>
        </div>

        <!-- # [ 26 MARCH 2021 ] ADDED -->
        <div class="col-md-3">
                <br/>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" id="checkall"/> Select/Deselect
                    </label>
                </div>

        </div>

        <div class="col-md-2">
                 <br/>
                 
                 <div id="hidden_email_input"></div>
        </div>

        <div class="col-md-1">
            <br/>
            <div id="hidden_send_email_btn"></div>
        </div>


        </div>
        </form>
        </div>
    </div><br><br>
    <div class="row">
        <div class="row text-center text-lg-left">
        @if($process_photos->count())
        @foreach($process_photos as $image)

            @php
                $photo = '';
                $file_location = '';
                if( $title == "Security Photos" ){  //SECURITY PHOTOS
                    $photo = $image->url;
                    $path = 'images/mag_security/'.$image->Key_Ref.'/'.$photo;
                    $path2 = 'http://192.168.0.185:8080/mag_qoutation/mag_snapshot/security_images/'.$image->Key_Ref.'/'.$photo;
                    $file_location =asset('/images/mag_security/'.$image->Key_Ref.'/'.$photo);

                    $original_path = realpath('C:\\xampp\htdocs\\ais\\public\\images\\mag_security\\'.$image->Key_Ref.'\\'.$photo);

                    $original_path2 = realpath('C:\\xampp\\htdocs\\mag_qoutation\\mag_snapshot\\security_images\\'.$image->Key_Ref.'\\'.$photo);

                }else{  //ADDITIONAL , WIP, FINAL STAGE PHOTOS

                    $photo = $image->picture_name;
                    $path = 'images/mag_photos/'.$image->Key_Ref.'/'.$photo;
                    $path2 = 'http://192.168.0.185:8080/mag_qoutation/photos/'.$image->Key_Ref.'/'.$photo;
                    $file_location =asset('/images/mag_photos/'.$image->Key_Ref.'/'.$photo);

                    $original_path = realpath('C:\\xampp\htdocs\\ais\\public\\images\\mag_photos\\'.$image->Key_Ref.'\\'.$photo);

                    $original_path2 = realpath('C:\\xampp\\htdocs\\mag_qoutation\\photos\\'.$image->Key_Ref.'\\'.$photo);

                }

                
                if (file_exists($path)) {
                    $file_name = $file_location;
                    $real_path = $original_path;

                } else {
                    $file_name = $path2;
                    $real_path = $original_path2;
                }

            @endphp
             <div class='col-sm-4 col-xs-6 col-md-3 col-lg-3'>
                <a class="thumbnail fancybox" rel="ligthbox" href="{{$file_name}}" target=z>
                    <img class="img-fluid img-thumbnail" alt="" src="{{$file_name}}">
                    <div class='text-center'>
                        <small class='text-muted'></small>
                    </div>
                </a>
                <a class="btn btn-danger" href="/line-manager-security-delete/{{$image->id}}"><span class="fa fa-trash" ></span></a>

                <input type="checkbox" class="checkitem" data-photo_id="{{$image->id}}" data-photo_path="{{$file_name}}" data-photo_name="{{$photo}}" data-photo_real_path="{{$real_path}}" />
                
            </div>

         
        @endforeach   
        
        @endif
        </div>
    </div> 

 
</div>



</div>

</div>




<script>

    //# CHECK IF ITS SELECTED
    $(document).on('click','.send-mail',function(){

        //photo_real_path
        var image_real_paths = $('.checkitem:checked').map(function(){
          return $(this).data('photo_real_path');
        });
        
        var real_paths = image_real_paths.get();   //USE THE IMAGE NAME
        var email_address = $('#photo_address').val();

        if( email_address == "" ){
            alert( "Please enter email address." ); return;
        }

        $.ajax({
          url:'/final-stage-email-photos',
          type:'GET',
          data:{real_paths:real_paths,email_address:email_address},
          //dataType:"text",
          success:function(data){
                if( data == 1 ){
                    //EMAILS SENT
                    alert("Email Sent Successful.");
                }else{
                    alert("Email Failed To Send, Please contact your manager.");
                }

          }

        });
        

    });

        
    $("#checkall").change(function(){
        $(".checkitem").prop("checked", $(this).prop("checked") );

        if( $(this).prop("checked") == true  ){

            $('#hidden_email_input').html('<input type="text" name="photo_address" id="photo_address" class="form-control form-control-sm" placeholder="Enter Email">');
            $('#hidden_send_email_btn').html('<button type="button" class="btn btn-info btn-sm send-mail" >Send</button>');

        }else if( $(this).prop("checked") == false ){
            $('#hidden_email_input').html('');
            $('#hidden_send_email_btn').html('');
        }


    })


    //# CHECK IF THE  [  checkbox ] IS SELECTED
    $(".checkitem").change(function(){
        
        if( $(this).prop("checked") == false ){
            $("#checkall").prop("checked", false)
        }

        if( $(".checkitem:checked").length == $(".checkitem").length ){
            $("#checkall").prop("checked", true)
        }
        
    })
    
</script>

