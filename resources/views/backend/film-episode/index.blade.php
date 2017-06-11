@extends('layout.backend')
@section('content')
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Episode : 
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="{{ route( 'film-episode.index', ['film_id' => $film_id] ) }}">Episode</a></li>
    <li class="active">Danh sách</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      @if(Session::has('message'))
      <p class="alert alert-info" >{{ Session::get('message') }}</p>
      @endif
      <a href="{{ route( 'film-episode.index', [ 'film_id' => $film_id ]) }}#dataForm" class="btn btn-info" style="margin-bottom:5px">Tạo mới</a>
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Bộ lọc</h3>
        </div>    
        <div class="panel-body">

          <form class="form-inline" id="searchForm" role="form" method="GET" action="{{ route('film-episode.index', ['film_id' => $film_id ]) }}">          
            
             <div class="form-group">
              <label for="email">Name :</label>
              <input type="text" class="form-control" name="title" value="{{ $title }}">
            </div>           
            <button type="submit" style="margin-top:-10px" class="btn btn-primary">Lọc</button>
          </form>         
        </div>    
      </div>
      <div class="box">

        <div class="box-header with-border">
          <h3 class="box-title">Danh sách  ( <span class="value">{{ $items->total() }} episodes )</span></h3>
        </div>
        
        <!-- /.box-header -->
        <div class="box-body">
          <div style="text-align:center">
           {{ $items->appends( ['title' => $title] )->links() }}
          </div> 
          <form method="post" action="{{ route('update-order-episode')}}" name="form-list">
          <input type="hidden" name="film_id" value="{{ $film_id }}">
          {!! csrf_field() !!}

          @if( $items->count() > 0 )
          <div style="text-align:right;margin-bottom:10px"><button type="submit" class="btn btn-primary">Lưu thứ tự</button></div>
          @endif
          <table class="table table-bordered" id="table-list-data">
            <tr>
              <th style="width: 1%">#</th>
              <th style="width: 1%;white-space:nowrap">Thứ tự</th>
              <th width="100px">Thứ tự</th> 
              <th>Name</th>          
              <th style="width: 60%; white-space:nowrap">Source</th>          
              <th width="1%;white-space:nowrap">Thao tác</th>
            </tr>
            <tbody>
            
            @if( $items->count() > 0 )
              <?php $i = 0; ?>
              @foreach( $items as $item )
                <?php $i ++; ?>
              <tr id="row-{{ $item->id }}">
                <td><span class="order">{{ $i }}</span></td>
                <td style="vertical-align:middle;text-align:center;width:1%">
                  <img src="{{ URL::asset('be/dist/img/move.png')}}" class="move img-thumbnail" alt="Cập nhật thứ tự"/>
                </td>
                <td><input style="width:80px" type="text" class="form-control" name="display_order[{{$item->id}}]" value="{{ $item->display_order }}"></td>
                <td>                  
                  <a href="{{ route( 'film-episode.index', [ 'film_id' => $film_id ]) }}?id={{ $item->id }}#dataForm">{{ $item->name }}</a>                 
                </td>
                <td style="word-break: break-all;">
                  {{ $item->source }}
                </td>
                <td style="white-space:nowrap">                  
                  <a href="{{ route( 'film-episode.index', [ 'film_id' => $film_id ]) }}?id={{ $item->id }}#dataForm" class="btn-sm btn btn-warning">Chỉnh sửa</a>                 
                  
                  <a onclick="return callDelete('{{ $item->name }}','{{ route( 'film-episode.destroy', [ 'id' => $item->id ]) }}');" class="btn-sm btn btn-danger">Xóa</a>
                  
                </td>
              </tr> 
              @endforeach
              
            @else
            <tr>
              <td colspan="9">Không có dữ liệu.</td>
            </tr>
            @endif

          </tbody>
          
          </table>
          @if( $items->count() > 0 )
          <div style="text-align:right;margin-bottom:10px"><button type="submit" class="btn btn-primary">Lưu thứ tự</button></div>
          @endif
          </form>
          <div style="text-align:center">
           {{ $items->appends( ['title' => $title] )->links() }}
          </div> 
        </div>        
      </div>
      <!-- /.box -->     
    </div>
    <!-- /.col -->  
  </div> 
</section>
<!-- /.content -->

 <!-- Main content -->
  <section class="content" id="divForm">       
    <form role="form" method="POST" action="{{ $id > 0 ? route('film-episode.update') : route('film-episode.store')  }}" id="dataForm">
    <div class="row">
      <!-- left column -->
      <input type="hidden" name="film_id" value="{{ $film_id }}">
      <input type="hidden" name="id" value="{{ $id }}">
      <input type="hidden" name="meta_id" value="{{ $detail ? $detail->meta_id : '0' }}">
      <div class="col-md-8">
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">{{  $id > 0 ? "Cập nhật" : "Thêm mới"}}</h3>
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
                  <label>Thứ tự</label>
                  <input type="text" class="form-control" name="display_order" id="display_order" value="{{ $detail ? $detail->display_order : old('display_order') }}">
                </div>
                <div class="form-group">
                  <label>Source URL</label>
                  <textarea class="form-control" rows="2" name="source" id="source">{{ $detail ? $detail->source : old('source') }}</textarea>
                </div>
                <div class="form-group">
                  <label>Streaming URL</label>
                  <textarea class="form-control" rows="2" name="streaming_url" id="streaming_url">{{ $detail ? $detail->streaming_url : old('streaming_url') }}</textarea>
                </div>
                <div class="form-group">
                  <label>Sub URL</label>
                  <textarea class="form-control" rows="2" name="sub_url" id="sub_url">{{ $detail ? $detail->sub_url : old('sub_url') }}</textarea>
                </div>
                <div class="form-group" >                  
                  <label>Name <span class="red-star">*</span></label>
                  <input type="text" class="form-control" name="name" id="name" value="{{ $detail ? $detail->name : old('name') }}">
                </div>
                <div class="form-group">                  
                  <label>Slug <span class="red-star">*</span></label>                  
                  <input type="text" class="form-control" name="slug" id="slug" value="{{ $detail ? $detail->slug : old('slug') }}">
                </div>
                <div class="form-group" style="margin-top:10px;margin-bottom:10px">  
                  <label class="col-md-3 row">Ảnh Poster </label>    
                  <div class="col-md-9">
                    <?php 
                    if( isset($detail->poster_url) ){
                      $src = Helper::showImage( $detail->poster_url ) ;
                    }else{
                      $src = old('poster_url') ? Helper::showImage(old('poster_url')) : URL::asset('be/dist/img/img.png');
                    }
                    ?>
                    <img id="thumbnail_poster" src="{{ $src }}" class="img-thumbnail" width="200">
                    
                    <input type="file" id="file-poster" style="display:none" />
                 
                    <button class="btn btn-default" id="btnUploadPoster" type="button"><span class="glyphicon glyphicon-upload" aria-hidden="true"></span> Upload</button>
                  </div>
                  <div style="clear:both"></div>
                </div>  
            </div>          
            <input type="hidden" name="poster_url" id="poster_url" value="{{ isset($detail->poster_url) ? $detail->poster_url : old('poster_url') }}"/>            
            <input type="hidden" name="poster_name" id="poster_name" value="{{ old('poster_name') }}"/>
            <div class="box-footer">
              <button type="button" class="btn btn-default" id="btnLoading" style="display:none"><i class="fa fa-spin fa-spinner"></i></button>
              <button type="submit" class="btn btn-primary" id="btnSave">Lưu</button>
              <a class="btn btn-default" class="btn btn-primary" href="{{ route('film-episode.index', ['film_id' => $film_id])}}">Hủy</a>
            </div>
            
        </div>
        <!-- /.box -->     

      </div>
      <input type="hidden" id="route_upload_tmp_image" value="{{ route('image.tmp-upload') }}">
      <div class="col-md-4">         
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Thông tin SEO</h3>
          </div>
          <!-- /.box-header -->
            <div class="box-body">
              <div class="form-group">
                <label>Meta title </label>
                <input type="text" class="form-control" name="meta_title" id="meta_title" value="{{ $metadata ? $metadata->meta_title : old('meta_title') }}">
              </div>
              <!-- textarea -->
              <div class="form-group">
                <label>Meta desciption</label>
                <textarea class="form-control" rows="3" name="meta_description" id="meta_description">{{ $metadata ? $metadata->meta_description : old('meta_description') }}</textarea>
              </div>  

              <div class="form-group">
                <label>Meta keywords</label>
                <textarea class="form-control" rows="3" name="meta_keywords" id="meta_keywords">{{ $metadata ? $metadata->meta_keywords : old('meta_keywords') }}</textarea>
              </div>  
              <div class="form-group">
                <label>Custom text</label>
                <textarea class="form-control" rows="3" name="custom_text" id="custom_text">{{ $metadata ? $metadata->custom_text : old('custom_text') }}</textarea>
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
@stop
@section('javascript_page')
<script type="text/javascript">
function callDelete(name, url){  
  swal({
    title: 'Bạn muốn xóa "' + name +'"?',
    text: "Dữ liệu sẽ không thể phục hồi.",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes'
  }).then(function() {
    location.href= url;
  })
  return flag;
}
$(document).ready(function(){
  $('#table-list-data tbody').sortable({
        placeholder: 'placeholder',
        handle: ".move",
        start: function (event, ui) {
                ui.item.toggleClass("highlight");
        },
        stop: function (event, ui) {
                ui.item.toggleClass("highlight");
        },          
        axis: "y",
        update: function() {
            var rows = $('#table-list-data tbody tr');
            var strOrder = '';
            var strTemp = '';
            for (var i=0; i<rows.length; i++) {
                strTemp = rows[i].id;
                strOrder += strTemp.replace('row-','') + ";";
            }     
            updateOrder("film_episode", strOrder);
        }
    });
  $('#btnUploadPoster').click(function(){        
    $('#file-poster').click();
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
function updateOrder(table, strOrder){
  $.ajax({
      url: $('#route_update_order').val(),
      type: "POST",
      async: false,
      data: {          
          str_order : strOrder,
          table : table
      },
      success: function(data){
          var countRow = $('#table-list-data tbody tr span.order').length;
          for(var i = 0 ; i < countRow ; i ++ ){
              $('span.order').eq(i).html(i+1);
          }                        
      }
  });
}

</script>
@stop