@extends("la.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/monitores') }}">Monitore</a> :
@endsection
@section("contentheader_description", $monitore->$view_col)
@section("section", "Monitores")
@section("section_url", url(config('laraadmin.adminRoute') . '/monitores'))
@section("sub_section", "Edit")

@section("htmlheader_title", "Monitores Edit : ".$monitore->$view_col)

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
				{!! Form::model($monitore, ['route' => [config('laraadmin.adminRoute') . '.monitores.update', $monitore->id ], 'method'=>'PUT', 'id' => 'monitore-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'tipo_doc')
					@la_input($module, 'numero_doc')
					@la_input($module, 'nombre_monitor')
					@la_input($module, 'apellido_monitor')
					@la_input($module, 'email_monitor')
					@la_input($module, 'facultad_id')
					@la_input($module, 'programa_id')
					@la_input($module, 'promedio_credito')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/monitores') }}">Cancel</a></button>
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
	$("#monitore-edit-form").validate({
		
	});
});
</script>
@endpush
