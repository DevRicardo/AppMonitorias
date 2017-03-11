@extends("la.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/estudiantes') }}">Estudiante</a> :
@endsection
@section("contentheader_description", $estudiante->$view_col)
@section("section", "Estudiantes")
@section("section_url", url(config('laraadmin.adminRoute') . '/estudiantes'))
@section("sub_section", "Edit")

@section("htmlheader_title", "Estudiantes Edit : ".$estudiante->$view_col)

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
				{!! Form::model($estudiante, ['route' => [config('laraadmin.adminRoute') . '.estudiantes.update', $estudiante->id ], 'method'=>'PUT', 'id' => 'estudiante-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'tipo_doc')
					@la_input($module, 'numero_doc')
					@la_input($module, 'nombres_estudiante')
					@la_input($module, 'apellidos_estudiante')
					@la_input($module, 'facultad_id')
					@la_input($module, 'programa_id')
					@la_input($module, 'estado')
					@la_input($module, 'email_estudiante')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/estudiantes') }}">Cancel</a></button>
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
	$("#estudiante-edit-form").validate({
		
	});
});
</script>
@endpush
