@extends('layout.backend')
@section('content')
<style type="text/css">
  p.pri-parent{
    text-transform: uppercase;
    color: #3c8dbc;    
  }
  p.pri-child{
    padding-left: 25px;  
    color: #222d32  
  }
  p label{
    cursor: pointer;
  }
  p.pri-child label{
    font-weight: normal;
  }
</style>
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Phân quyền tài khoản : <span style="color:red">{{ $detail->full_name }}</span>
  </h1>  
    
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      @if(Session::has('message'))
      <p class="alert alert-info" >{{ Session::get('message') }}</p>
      @endif
      <div class="box">

        <div class="box-header with-border">
          <h3 class="box-title">Danh sách</h3>
        </div>
        
        <!-- /.box-header -->
        <div class="box-body">
          <table class="table table-bordered" id="table-list-data">            
            <tbody>
            @if( $parentPrivilege->count() > 0 )
              <?php $i = 0; ?>
              @foreach( $parentPrivilege as $parent )
                <?php $i ++; ?>
                <tr id="row-{{ $parent->id }}">                  
                  <td>                  
                    <p class="pri-parent"><label><input type="checkbox" class="parent" value="{{ $parent->id }}"> {{ $parent->name }} </label></p>
                    @if(!empty($childArr[$parent->id]))                      
                      @foreach($childArr[$parent->id] as $child)
                      <p class="pri-child"><label><input type="checkbox" class="child" data-parent="{{ $parent->id }}" value="{{ $parent->id }}">  {{ $child->name }}</label></p>
                      @endforeach
                    @endif
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