@extends('layout.backend')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Crew  
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="{{ route('crew.index') }}">Crew</a></li>
      <li class="active">Tạo mới</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <a class="btn btn-default btn-sm " href="{{ route('crew.index') }}" style="margin-bottom:5px">Quay lại</a>
    <form role="form" method="POST" action="{{ route('crew.store') }}">
    <div class="row">
      <!-- left column -->

      <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Tạo mới</h3>
          </div>
          <!-- /.box-header -->               
            {!! csrf_field() !!}

            <div class="box-body">
              @if (count($errors) > 0)
                  <div class="alert alert-danger">
                      <ul>
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
              @endif
               <div class="form-group">
                  <label for="email">Type </label>
                  <select class="form-control select2" name="type" id="type">                    
                    <option value="1" {{ old('type') == 1 ? "selected" : "" }}>Actor</option>
                    <option value="2" {{ old('type') == 2 ? "selected" : "" }}>Director</option>
                    <option value="3" {{ old('type') == 3 ? "selected" : "" }}>Producer</option>
                  </select>
                </div>    
                 <!-- text input -->
                <div class="form-group">
                  <label>Name<span class="red-star">*</span></label>
                  <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}">
                </div>
                <div class="form-group">
                  <label>Slug <span class="red-star">*</span></label>
                  <input type="text" class="form-control" name="slug" id="slug" value="{{ old('slug') }}">
                </div>
                 <div class="form-group" style="margin-top:10px;margin-bottom:10px">  
                  <label class="col-md-3 row">Image </label>    
                  <div class="col-md-9">
                    <img id="thumbnail_image" src="{{ old('image_url') ? Helper::showImage(old('image_url')) : URL::asset('be/dist/img/img.png') }}" class="img-thumbnail" width="145" height="85">
                    
                    <input type="file" id="file-image" style="display:none" />
                 
                    <button class="btn btn-default" id="btnUploadImage" type="button"><span class="glyphicon glyphicon-upload" aria-hidden="true"></span> Upload</button>
                  </div>
                  <div style="clear:both"></div>
                </div>               
                <!-- textarea -->
                <div class="form-group">
                  <label>Giới thiệu</label>
                  <textarea class="form-control" rows="4" name="description" id="description">{{ old('description') }}</textarea>
                </div>  
                <input type="hidden" name="image_url" id="image_url" value="{{ old('image_url') }}"/>          
            <input type="hidden" name="image_name" id="image_name" value="{{ old('image_name') }}"/>
                              
            </div>                        
            <div class="box-footer">
              <button type="submit" class="btn btn-primary">Lưu</button>
              <a class="btn btn-default" class="btn btn-primary" href="{{ route('crew.index')}}">Hủy</a>
            </div>
            
        </div>
        <!-- /.box -->     

      </div>
     
      <!--/.col (left) -->      
    </div>
    </form>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<input type="hidden" id="route_upload_tmp_image" value="{{ route('image.tmp-upload') }}">
@stop
@section('javascript_page')
<script src="{{ URL::asset('be/dist/js/ckeditor/ckeditor.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function(){
      $(".select2").select2();
      var editor = CKEDITOR.replace( 'description',{
          language : 'vi',
          filebrowserBrowseUrl: '../dist/js/kcfinder/browse.php?type=files',
          filebrowserImageBrowseUrl: '../dist/js/kcfinder/browse.php?type=images',
          filebrowserFlashBrowseUrl: '../dist/js/kcfinder/browse.php?type=flash',
          filebrowserUploadUrl: '../dist/js/kcfinder/upload.php?type=files',
          filebrowserImageUploadUrl: '../dist/js/kcfinder/upload.php?type=images',
          filebrowserFlashUploadUrl: '../dist/js/kcfinder/upload.php?type=flash'
      });
      $('#btnUploadImage').click(function(){        
        $('#file-image').click();
      });      
      var files = "";
      $('#file-image').change(function(e){
         files = e.target.files;
         
         if(files != ''){
           var dataForm = new FormData();        
          $.each(files, function(key, value) {
             dataForm.append('file', value);
          });   
          
          dataForm.append('date_dir', 1);
          dataForm.append('folder', 'tmp');

          $.ajax({
            url: $('#route_upload_tmp_image').val(),
            type: "POST",
            async: false,      
            data: dataForm,
            processData: false,
            contentType: false,
            success: function (response) {
              if(response.image_path){
                $('#thumbnail_image').attr('src',$('#upload_url').val() + response.image_path);
                $( '#image_url' ).val( response.image_path );
                $( '#image_name' ).val( response.image_name );
              }
              console.log(response.image_path);
                //window.location.reload();
            },
            error: function(response){                             
                var errors = response.responseJSON;
                for (var key in errors) {
                  
                }
                //$('#btnLoading').hide();
                //$('#btnSave').show();
            }
          });
        }
      });
      
      
      $('#name').change(function(){
         var name = $.trim( $(this).val() );
         if( name != '' && $('#slug').val() == ''){
            $.ajax({
              url: $('#route_get_slug').val(),
              type: "POST",
              async: false,      
              data: {
                str : name
              },              
              success: function (response) {
                if( response.str ){                  
                  $('#slug').val( response.str );
                }                
              },
              error: function(response){                             
                  var errors = response.responseJSON;
                  for (var key in errors) {
                    
                  }
                  //$('#btnLoading').hide();
                  //$('#btnSave').show();
              }
            });
         }
      });
     
    });
    
</script>
@stop