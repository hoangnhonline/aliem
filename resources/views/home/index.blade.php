@extends('layout.frontend')

@section('slider')
	@include('home.index.slider')
@endsection

@section('top-news')
	@include('home.index.top-news')
@endsection

@section('content')
	@include('home.index.content')
@endsection

@section('javascript_page')
	<script type="text/javascript">
	$("img.lazy").lazyload({
        effect: "fadeIn"
    });
	</script>
@endsection