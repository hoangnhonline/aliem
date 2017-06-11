@extends('layout.backend')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Phim    
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="{{ route('film.index') }}">Phim</a></li>
      <li class="active">Thêm mới</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <a class="btn btn-default btn-sm" href="{{ route('film.index') }}" style="margin-bottom:5px">Quay lại</a>
    <form role="form" method="POST" action="{{ route('film.store') }}" id="dataForm">
    <div class="row">
      <!-- left column -->

      <div class="col-md-8">
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Thêm mới</h3>
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
                  <label>Thể loại <span class="red-star">*</span></label>
                  <div class="col-md-12">
                     @foreach( $parentCate as $cate)
                      <label class="col-md-4"><input type="checkbox" name="category_id[]" class="cb" value="{{ $cate->id }}"
                        {{ ( (old('category_id') && in_array( $cate->id, old('category_id') ))) ? "checked" : "" }}
                        >{{ $cate->name }}</label>
                     @endforeach
                  </div>
                </div>  
                <div class="form-group">
                  <label>Quốc gia <span class="red-star">*</span></label>
                  <div class="col-md-12">
                     @foreach( $countryArr as $country)
                      <label class="col-md-4"><input type="checkbox" class="cb" name="country_id[]" value="{{ $country->id }}"
                        {{ ( ( old('country_id') && in_array( $country->id, old('country_id') )))? "checked" : "" }}
                        >{{ $country->name }}</label>
                     @endforeach
                  </div>
                </div>  
                <div class="form-group" >                  
                  <label>Tên phim <span class="red-star">*</span></label>
                  <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}">
                </div>
                <div class="form-group">                  
                  <label>Slug <span class="red-star">*</span></label>                  
                  <input type="text" class="form-control" name="slug" id="slug" value="{{ old('slug') }}">
                </div>
                <div class="form-group">
                  <label>Tóm tắt ngắn</label>
                  <textarea class="form-control" rows="4" name="description" id="description">{{ old('description') }}</textarea>
                </div>
                <div class="form-group">                 
                  <label>Đạo diễn</label>
                  <select class="form-control select2" name="director[]" id="director" multiple="multiple">                  
                    @if( !empty( $crewArr[2] ) )
                      @foreach( $crewArr[2] as $value )
                      <option value="{{ $value->id }}" {{ (old('director') && in_array($value->id, old('director'))) ? "selected" : "" }}>{{ $value->name }}</option>
                      @endforeach
                    @endif
                  </select>
                  <!--<span class="input-group-btn">
                    <button style="margin-top:24px" class="btn btn-primary btnNewCrew" type="button" data-value="2">
                      <span class="glyphicon glyphicon-plus"></span>
                    </button>
                  </span>-->
                </div>               
                <div class="form-group"> 
                  <label>Diễn viên</label>
                  <select class="form-control select2" name="actor[]" id="actor" multiple="multiple">                  
                    @if( !empty( $crewArr[1] ) )
                      @foreach( $crewArr[1] as $value )
                      <option value="{{ $value->id }}" {{ (old('actor') && in_array($value->id, old('actor'))) ? "selected" : "" }}>{{ $value->name }}</option>
                      @endforeach
                    @endif
                  </select>
                  <!--<span class="input-group-btn">
                    <button style="margin-top:24px" class="btn btn-primary btnNewCrew" type="button" data-value="1">
                      <span class="glyphicon glyphicon-plus"></span>
                    </button>
                  </span>-->
                </div>
                <div class="form-group"> 
                  <label>Nhà sản xuất</label>
                  <select class="form-control select2" name="producer[]" id="producer" multiple="multiple">                  
                    @if( !empty( $crewArr[3] ) )
                      @foreach( $crewArr[3] as $value )
                      <option value="{{ $value->id }}" {{ (old('producer') && in_array($value->id, old('producer'))) ? "selected" : "" }}>{{ $value->name }}</option>
                      @endforeach
                    @endif
                  </select>
                  <!--<span class="input-group-btn">
                    <button style="margin-top:24px" class="btn btn-primary btnNewCrew" type="button" data-value="3">
                      <span class="glyphicon glyphicon-plus"></span>
                    </button>
                  </span>-->
                </div>
                <div class="form-group" style="margin-top:10px;margin-bottom:10px">  
                  <label class="col-md-3 row">Ảnh Thumb </label>    
                  <div class="col-md-9">
                    <img id="thumbnail_image" src="{{ old('image_url') ? Helper::showImage(old('image_url')) : URL::asset('be/dist/img/img.png') }}" class="img-thumbnail" width="120">
                    
                    <input type="file" id="file-image" style="display:none" />
                 
                    <button class="btn btn-default" id="btnUploadImage" type="button"><span class="glyphicon glyphicon-upload" aria-hidden="true"></span> Upload</button>
                  </div>
                  <div style="clear:both"></div>
                </div>
                <div class="form-group" style="margin-top:10px;margin-bottom:10px">  
                  <label class="col-md-3 row">Ảnh Poster </label>    
                  <div class="col-md-9">
                    <img id="thumbnail_poster" src="{{ old('poster_url') ? Helper::showImage(old('poster_url')) : URL::asset('be/dist/img/img.png') }}" class="img-thumbnail" width="200">
                    
                    <input type="file" id="file-poster" style="display:none" />
                 
                    <button class="btn btn-default" id="btnUploadPoster" type="button"><span class="glyphicon glyphicon-upload" aria-hidden="true"></span> Upload</button>
                  </div>
                  <div style="clear:both"></div>
                </div>
                <div class="form-group" style="margin-top:10px;margin-bottom:10px;display:none" id="div_anh_slide">  
                  <label class="col-md-3 row">Ảnh Slide  </label>    
                  <div class="col-md-9">
                    <img id="thumbnail_slide" src="{{ old('slide_url') ? Helper::showImage(old('slide_url')) : URL::asset('be/dist/img/img.png') }}" class="img-thumbnail" width="200">
                    
                    <input type="file" id="file-slide" style="display:none" />
                 
                    <button class="btn btn-default" id="btnUploadSlide" type="button"><span class="glyphicon glyphicon-upload" aria-hidden="true"></span> Upload</button>
                  </div>
                  <div style="clear:both"></div>
                </div>
         <div class="input-group">
                  <label>Tags</label>
                  <select class="form-control select2" name="tags[]" id="tags" multiple="multiple">                  
                    @if( $tagArr->count() > 0)
                      @foreach( $tagArr as $value )
                      <option value="{{ $value->id }}" {{ (old('tags') && in_array($value->id, old('tags'))) ? "selected" : "" }}>{{ $value->name }}</option>
                      @endforeach
                    @endif
                  </select>
                  <span class="input-group-btn">
                    <button style="margin-top:24px" class="btn btn-primary" id="btnAddTag" type="button" data-value="3">
                      Tạo mới
                    </button>
                  </span>
                </div>
                <div class="clearfix" style="margin-bottom:10px"></div> 
                <div class="form-group">
                  <label>Nội dung phim</label>
                  <textarea class="form-control" rows="4" name="content" id="content">{{ old('content') }}</textarea>
                </div>
                  
            </div>          
            <input type="hidden" name="image_url" id="image_url" value="{{ old('image_url') }}"/>           
            <input type="hidden" name="poster_url" id="poster_url" value="{{ old('poster_url') }}"/> 
            <input type="hidden" name="slide_url" id="slide_url" value="{{ old('slide_url') }}"/>          
            <input type="hidden" name="image_name" id="image_name" value="{{ old('image_name') }}"/>
            <input type="hidden" name="poster_name" id="poster_name" value="{{ old('poster_name') }}"/>
            <input type="hidden" name="slide_name" id="slide_name" value="{{ old('slide_name') }}"/>
            <div class="box-footer">
              <button type="button" class="btn btn-default" id="btnLoading" style="display:none"><i class="fa fa-spin fa-spinner"></i></button>
              <button type="submit" class="btn btn-primary" id="btnSave">Lưu</button>
              <a class="btn btn-default" class="btn btn-primary" href="{{ route('film.index')}}">Hủy</a>
            </div>
            
        </div>
        <!-- /.box -->     

      </div>
      <div class="col-md-4">
         <div class="box box-primary" style="margin-bottom:10px">
          <div class="box-header with-border">
            <h3 class="box-title">Thông tin khác</h3>
          </div>
          <!-- /.box-header -->
            <div class="box-body">
              <div class="form-group">
                <label for="email" class="ltitle">Trạng thái </label>
                <label class="radio-inline"><input type="radio" {{ old('status')  == 1  ? "checked" : "" }} name="status" value="1">Active</label>
                <label class="radio-inline"><input type="radio" {{ old('status') == 2 || !old('status') ? "checked" : "" }} name="status" value="2">Pending</label>              
              </div>
              <!--<div class="form-group">
                <label for="email" class="ltitle">Control </label>
                <label class="radio-inline"><input type="radio" {{ old('top') || !old('top')== 1 ? "checked" : "" }} name="top" value="1">New</label>
                <label class="radio-inline"><input type="radio" {{ old('top') == 2 ? "checked" : "" }} name="top" value="2">Hot</label>
                <label class="radio-inline"><input type="radio" {{ old('top') == 4 ? "checked" : "" }} name="top" value="4">Comming soon</label>
                <label class="radio-inline" style="margin-left:84px"><input type="radio" {{ old('top') == 3 ? "checked" : "" }} name="top" value="3">Completed</label>
              </div>-->
              <div class="form-group">
                <label for="email" class="ltitle">Kiểu phim </label>
                <label class="radio-inline"><input type="radio" {{ !old('type') || old('type') == 1 ? "checked" : "" }} name="type" value="1">Phim lẻ</label>
                <label class="radio-inline"><input type="radio" {{ old('type') == 2 ? "checked" : "" }} name="type" value="2">Phim bộ</label>
                <!--<label class="radio-inline"><input type="radio" {{ old('type') == 3 ? "checked" : "" }} name="type" value="3">Phim chiếu rạp</label>
                <label class="radio-inline"><input type="radio" {{ old('type') == 4 ? "checked" : "" }} name="type" value="4">Games show</label>                -->
              </div>
               <div class="form-group">
                <label for="email" class="ltitle">Chất lượng </label>
                
                <label class="radio-inline"><input type="radio" {{ !old('quality') || old('quality') == 5 ? "checked" : "" }} name="quality" value="5">1080P</label>
                <label class="radio-inline"><input type="radio" {{ !old('quality') || old('quality') == 1 ? "checked" : "" }} name="quality" value="1">Full HD</label>
                <label class="radio-inline"><input type="radio" {{ old('quality') == 2 ? "checked" : "" }} name="quality" value="2">HD</label>
                <label class="radio-inline"><input type="radio" {{ old('quality') == 3 ? "checked" : "" }} name="quality" value="3">SD</label>
                <label class="radio-inline"><input type="radio" {{ old('quality') == 4 ? "checked" : "" }} name="quality" value="4">CAM</label>     
                <label class="radio-inline"><input type="radio" {{ old('quality') == 6 ? "checked" : "" }} name="quality" value="6">Trailer</label>            
              </div>
              <!--<div class="form-group">
                <label for="email" class="ltitle">Cinema </label>
                <label class="radio-inline"><input type="radio" {{ old('cinema') || !old('cinema') == 1 ? "checked" : "" }} name="cinema" value="1">Yes</label>
                <label class="radio-inline"><input type="radio" {{ old('cinema') == 0 ? "checked" : "" }} name="cinema" value="0">No</label>
              </div>
              <div class="form-group">
                <label for="email" class="ltitle">Push top </label>
                <label class="radio-inline"><input type="radio" {{ old('push_top') == 1 ? "checked" : "" }} name="push_top" value="1">Yes</label>
                <label class="radio-inline"><input type="radio" {{ old('push_top') == 0 ? "checked" : "" }} name="push_top" value="0">No</label>
              </div>-->

              <div class="form-group" >                  
                <label>Điểm IMDB</label>
                <input type="text" class="form-control" name="imdb" id="imdb" value="{{ old('imdb') }}">
              </div>
              <div class="form-group" >                  
                <label>Năm sản xuất</label>
                <input type="text" class="form-control" name="release_year" id="release_year" value="{{ old('release_year') }}">
              </div>
              <div class="form-group" >                  
                <label>Thời lượng / Số tập</label>
                <input type="text" class="form-control" name="duration" id="duration" value="{{ old('duration') }}">
              </div>
              <div class="form-group" >                  
                <label>Trailer</label>
                <input type="text" class="form-control" name="trailer" id="trailer" value="{{ old('trailer') }}">
              </div>
               <div class="form-group">
                <label for="email" class="ltitle">Slide </label>
                <label class="radio-inline"><input type="radio" {{  old('slide') == 1 ? "checked" : "" }} name="slide" value="1" id="slide_1">Yes</label>
                <label class="radio-inline"><input type="radio" {{ !old('slide') || old('slide') == 0 ? "checked" : "" }} name="slide" value="0" id="slide_2">No</label>                
              </div>
        </div>
        <div style="margin-bottom:10px; clear:both"></div>
        <!-- general form elements -->
        <div class="box box-primary" style="margin-top:10px !important; clear:both">
          <div class="box-header with-border">
            <h3 class="box-title">Thông tin SEO</h3>
          </div>
          <!-- /.box-header -->
            <div class="box-body">
              <div class="form-group">
                <label>Meta title </label>
                <input type="text" class="form-control" name="meta_title" id="meta_title" value="{{ old('meta_title') }}">
              </div>
              <!-- textarea -->
              <div class="form-group">
                <label>Meta desciption</label>
                <textarea class="form-control" rows="6" name="meta_description" id="meta_description">{{ old('meta_description') }}</textarea>
              </div>  

              <div class="form-group">
                <label>Meta keywords</label>
                <textarea class="form-control" rows="4" name="meta_keywords" id="meta_keywords">{{ old('meta_keywords') }}</textarea>
              </div>  
              <div class="form-group">
                <label>Custom text</label>
                <textarea class="form-control" rows="6" name="custom_text" id="custom_text">{{ old('custom_text') }}</textarea>
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
@include('backend.film.modal')
<input type="hidden" id="route_upload_tmp_image" value="{{ route('image.tmp-upload') }}">
<input type="hidden" id="route_get_film_external" value="{{ route('general.get-film-external') }}">

@stop
@section('javascript_page')
<script src="{{ URL::asset('be/dist/js/ckeditor/ckeditor.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function(){
      if( $('#slide_1').prop('checked') == true ){
        $('#div_anh_slide').show();
      }else{
        $('#div_anh_slide').hide();
      }
      $('#slide_1').click(function(){
        $('#div_anh_slide').show();
      });
      $('#slide_2').click(function(){
        $('#div_anh_slide').hide();
      });
      $('.btnNewCrew').click(function(){
          $('#crewModal').modal('show');
      });
      $('#btnAddTag').click(function(){
          $('#tagModal').modal('show');
      });
      
      $(".select2").select2();
      $('#dataForm').submit(function(){
        var no_cate = $('input[name="category_id[]"]:checked').length;
        if( no_cate == 0){
          swal("Lỗi!", "Chọn ít nhất 1 thể loại!", "error");
          return false;
        }
        var no_country = $('input[name="country_id[]"]:checked').length;
        if( no_country == 0){
          swal("Lỗi!", "Chọn ít nhất 1 quốc gia!", "error");
          return false;
        }        
        
        $('#btnSave').hide();
        $('#btnLoading').show();
      });
      var editor = CKEDITOR.replace( 'content',{
          language : 'vi',
          filebrowserBrowseUrl: "{{ URL::asset('/be/dist/js/kcfinder/browse.php?type=files') }}",
          filebrowserImageBrowseUrl: "{{ URL::asset('/be/dist/js/kcfinder/browse.php?type=images') }}",
          filebrowserFlashBrowseUrl: '../dist/js/kcfinder/browse.php?type=flash',
          filebrowserUploadUrl: "{{ URL::asset('/be/dist/js/kcfinder/upload.php?type=files') }}",
          filebrowserImageUploadUrl: "{{ URL::asset('/be/dist/js/kcfinder/upload.php?type=images') }}",
          filebrowserFlashUploadUrl: "{{ URL::asset('/be/dist/js/kcfinder/upload.php?type=flash') }}"
      });
      $('#btnUploadImage').click(function(){        
        $('#file-image').click();
      }); 
      $('#btnUploadPoster').click(function(){        
        $('#file-poster').click();
      });  
      $('#btnUploadSlide').click(function(){        
        $('#file-slide').click();
      });    
      var files = "";
      $('#file-image').change(function(e){
         files = e.target.files;
         
         if(files != ''){
           var dataForm = new FormData();        
          $.each(files, function(key, value) {
             dataForm.append('file', value);
          });   
          
          dataForm.append('date_dir', 0);
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
      
      var files = "";
      $('#file-poster').change(function(e){
         files = e.target.files;
         
         if(files != ''){
           var dataForm = new FormData();        
          $.each(files, function(key, value) {
             dataForm.append('file', value);
          });   
          
          dataForm.append('date_dir', 0);
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
                $('#thumbnail_poster').attr('src',$('#upload_url').val() + response.image_path);
                $( '#poster_url' ).val( response.image_path );
                $( '#poster_name' ).val( response.image_name );
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

      var files = "";
      $('#file-slide').change(function(e){
         files = e.target.files;
         
         if(files != ''){
           var dataForm = new FormData();        
          $.each(files, function(key, value) {
             dataForm.append('file', value);
          });   
          
          dataForm.append('date_dir', 0);
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
                $('#thumbnail_slide').attr('src',$('#upload_url').val() + response.image_path);
                $( '#slide_url' ).val( response.image_path );
                $( '#slide_name' ).val( response.image_name );
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

      $('#title').change(function(){
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
   $(document).on('click', '#btnSaveTagAjax', function(){
      $.ajax({
        url : $('#formAjaxTag').attr('action'),
        data: $('#formAjaxTag').serialize(),
        type : "post", 
        success : function(str_id){          
          $('#btnCloseModalTag').click();
          $.ajax({
            url : "{{ route('tag.ajax-list') }}",
            data: { 
              type : 1 ,
              tagSelected : $('#tags').val(),
              str_id : str_id
            },
            type : "get", 
            success : function(data){
                $('#tags').html(data);
                $('#tags').select2('refresh');
                
            }
          });
        }
      });
   }); 
   $('#contentTag #name').change(function(){
         var name = $.trim( $(this).val() );
         if( name != '' && $('#contentTag #slug').val() == ''){
            $.ajax({
              url: $('#route_get_slug').val(),
              type: "POST",
              async: false,      
              data: {
                str : name
              },              
              success: function (response) {
                if( response.str ){                  
                  $('#contentTag #slug').val( response.str );
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
</script>
@stop
