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
    <li><a href="{{ route( 'film.index' ) }}">Phim</a></li>
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
      <a href="{{ route('film.create') }}" class="btn-sm btn btn-info" style="margin-bottom:5px">Tạo mới</a>
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Bộ lọc</h3>
        </div>
        <div class="panel-body">
          <form class="form-inline" id="searchForm" role="form" method="GET" action="{{ route('film.index') }}">
           
            <!--<div class="form-group">
              <label for="email">Danh mục </label>
              @foreach( $parentCate as $cate)
              <label class="checkbox-inline"><input type="checkbox" name="category_id[]" value="{{ $cate->id }}">{{ $cate->name }}</label>
              @endforeach
            </div>            
            <div class="form-group">
              <label for="email">Quốc gia </label>
              @foreach( $countryArr as $country)
              <label class="checkbox-inline"><input type="checkbox" name="country_id[]" value="{{ $country->id }}">{{ $country->name }}</label>
              @endforeach
            </div>  
            -->
             <div class="form-group">
              <label for="email">Tiêu đề :</label>
              <input type="text" class="form-control" name="title" value="{{ $title }}">
            </div>
            <div class="form-group">
              <label for="email">Status :</label>
              <label class="radio-inline"><input type="radio" {{ $status == 1 ? "checked" : "" }} name="status" value="1">Active</label>
              <label class="radio-inline"><input type="radio" {{ $status == 2 ? "checked" : "" }} name="status" value="2">Pending</label>              
            </div>
            <button type="submit" style="margin-top:-10px" class="btn btn-primary">Lọc</button>
          </form>         
        </div>
      </div>
      <div class="box">

        <div class="box-header with-border">
          <h3 class="box-title">Danh sách ( <span class="value">{{ $items->total() }} phim )</span></h3>
        </div>
        
        <!-- /.box-header -->
        <div class="box-body">
          <div style="text-align:center">
           {{ $items->appends( ['status' => $status, 'title' => $title] )->links() }}
          </div>  
          <table class="table table-bordered" id="table-list-data">
            <tr>
              <th style="width: 1%">#</th>              
              <th>Thumbnail</th>
              <th width="50%">Tiêu đề</th>
              <th>Episode</th>
              <th style="white-space:nowrap">Người tạo</th>
              <th style="white-space:nowrap">Ngày tạo</th>
              <th width="1%;white-space:nowrap">Thao tác</th>
            </tr>
            <tbody>
            @if( $items->count() > 0 )
              <?php $i = 0; ?>
              @foreach( $items as $item )             
                <?php $i ++; ?>
              <tr id="row-{{ $item->film_id }}">
                <td><span class="order">{{ $i }}</span></td>       
                <td>
                  <img class="img-thumbnail lazy" data-original="{{ Helper::showImage($item->image_url)}}" width="130">
                </td>        
                <td class="top">                  
                  <a class="title" href="{{ route( 'film.edit', [ 'id' => $item->film_id ]) }}">{{ $item->title }}</a>
                

                  <p class="desc">{{ $item->original_title }}</p>
                </td>
                <td>
                  <a href="{{ route('film-episode.index', ['film_id' => $item->film_id])}}" class="btn btn-info btn-sm">
                    Episode
                  </a>     
                </td>
                <td>{{ $item->full_name }}</td>
                <td style="white-space:nowrap">{{ date('d-m-Y H:i', strtotime($item->time_created)) }}</td>       
                <td style="white-space:nowrap">                
                @if($item->status == 1 && $item->sitemap == 0)
                <button class="btn btn-success btn-sm tao-sitemap" data-value="{{ $item->film_id}}">Tạo sitemap</button>
                @endif
                  <a href="{{ route( 'film.edit', [ 'id' => $item->film_id ]) }}" class="btn-sm  btn btn-warning">Chỉnh sửa</a>                 
                  
                  <a onclick="return callDelete('{{ $item->title }}','{{ route( 'film.destroy', [ 'id' => $item->film_id ]) }}');" class="btn-sm btn btn-danger">Xóa</a>
                  
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
          <div style="text-align:center">
            {{ $items->appends( ['status' => $status, 'title' => $title] )->links() }}
          </div>  
        </div>        
      </div>
      <!-- /.box -->     
    </div>
    <!-- /.col -->  
  </div> 
</section>
<!-- /.content -->
</div>
@stop
@section('javascript_page')
<script src="{{ URL::asset('assets/js/lazy.js') }}"></script>
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
  $('img.lazy').lazyload();
  $('#parent_id').change(function(){
    $.ajax({
        url: $('#route_get_cate_by_parent').val(),
        type: "POST",
        async: false,
        data: {          
            parent_id : $(this).val(),
            type : 'list'
        },
        success: function(data){
            $('#cate_id').html(data).select2('refresh');                      
        }
    });
  });
  $('.select2').select2();
  $('input[name="status"]').click(function(){
    $('#searchForm').submit();
  });
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
            updateOrder("loai_sp", strOrder);
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