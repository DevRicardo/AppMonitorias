@extends("la.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/programas') }}">Programa</a> :
@endsection
@section("contentheader_description", $programa->$view_col)
@section("section", "Programas")
@section("section_url", url(config('laraadmin.adminRoute') . '/programas'))
@section("sub_section", "Edit")

@section("htmlheader_title", "Programas Edit : ".$programa->$view_col)

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
				{!! Form::model($programa, ['route' => [config('laraadmin.adminRoute') . '.programas.update', $programa->id ], 'method'=>'PUT', 'id' => 'programa-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'nombre_progama')
					@la_input($module, 'facultad_id')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/programas') }}">Cancel</a></button>
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
	$("#programa-edit-form").validate({
		
	});
});
</script>
@endpush
