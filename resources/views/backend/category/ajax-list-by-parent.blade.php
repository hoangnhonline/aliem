<option value="">-- {{ $type == "form" ? "chọn" : "Tất cả" }} --</option>
@if( $items->count() > 0 )
	@foreach( $items as $value )
	<option value="{{ $value->id }}">{{ $value->name }}</option>
	@endforeach
@endif