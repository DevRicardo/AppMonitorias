@extends("la.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/facultads') }}">Facultad</a> :
@endsection
@section("contentheader_description", $facultad->$view_col)
@section("section", "Facultads")
@section("section_url", url(config('laraadmin.adminRoute') . '/facultads'))
@section("sub_section", "Edit")

@section("htmlheader_title", "Facultads Edit : ".$facultad->$view_col)

@section("main-content")

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="box">
	<div class="box-header">
		
	</div>
	<div class="box-body">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				{!! Form::model($facultad, ['route' => [config('laraadmin.adminRoute') . '.facultads.update', $facultad->id ], 'method'=>'PUT', 'id' => 'facultad-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'nombre_facultad')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/facultads') }}">Cancel</a></button>
					</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>

@endsection

@push('scripts')
<script>
$(function () {
	$("#facultad-edit-form").validate({
		
	});
});
</script>
@endpush
