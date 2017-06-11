<div id="bread">
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('/') }}" title="Trang chủ">Trang chủ</a></li>
        
        <li>
            <a href="{{ route('cate', $cateDetail->slug) }}" title="{{ $cateDetail->name }}">{{ $cateDetail->name }}</a>
        </li>
        <li class="active">{{ $detail->title }}</li>
    </ol>
</div>