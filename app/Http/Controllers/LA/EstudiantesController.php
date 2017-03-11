<?php
/**
 * Controller genrated using LaraAdmin
 * Help: http://laraadmin.com
 */

namespace App\Http\Controllers\LA;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use DB;
use Validator;
use Datatables;
use Collective\Html\FormFacade as Form;
use Dwij\Laraadmin\Models\Module;
use Dwij\Laraadmin\Models\ModuleFields;
use App\User;
use App\Role;
use App\Models\Estudiante;

class EstudiantesController extends Controller
{
	public $show_action = true;
	public $view_col = 'numero_doc';
	public $listing_cols = ['id', 'tipo_doc', 'numero_doc', 'nombres_estudiante', 'apellidos_estudiante', 'facultad_id', 'programa_id', 'estado', 'email_estudiante'];
	
	public function __construct() {
		// Field Access of Listing Columns
		/*if(\Dwij\Laraadmin\Helpers\LAHelper::laravel_ver() == 5.3) {
			$this->middleware(function ($request, $next) {
				$this->listing_cols = ModuleFields::listingColumnAccessScan('Estudiantes', $this->listing_cols);
				return $next($request);
			});
		} else {
			$this->listing_cols = ModuleFields::listingColumnAccessScan('Estudiantes', $this->listing_cols);
		}*/
	}
	
	/**
	 * Display a listing of the Estudiantes.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$module = Module::get('Estudiantes');
		
		if(Module::hasAccess($module->id)) {
			return View('la.estudiantes.index', [
				'show_actions' => $this->show_action,
				'listing_cols' => $this->listing_cols,
				'module' => $module
			]);
		} else {
            return redirect(config('laraadmin.adminRoute')."/");
        }
	}

	/**
	 * Show the form for creating a new estudiante.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created estudiante in database.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
			
		$rules = Module::validateRules("Estudiantes", $request);
		
		$validator = Validator::make($request->all(), $rules);
		
		if ($validator->fails()) {
			return redirect()->back()->withErrors($validator)->withInput();
		}
		flash('Registro exitoso, Porfavor verifique su email para validar las credenciales de acceso', 'success');
		$insert_id = Module::insert("Estudiantes", $request);
		$user = User::create([
				'name' => $request->nombres_estudiante." ".$request->apellidos_estudiante,
				'email' => $request->email_estudiante,
				'password' => bcrypt($request->numero_doc),
				'context_id' => $insert_id,
				'type' => "Estudiante",
			]);

		// update user role
		$user->detachRoles();
		$role = Role::find(3);
		$user->attachRole($role);

		if($insert_id){
			return redirect()->back();
		}
		
		return redirect()->route(config('laraadmin.adminRoute') . '.estudiantes.index');

	}

	/**
	 * Display the specified estudiante.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		if(Module::hasAccess("Estudiantes", "view")) {
			
			$estudiante = Estudiante::find($id);
			if(isset($estudiante->id)) {
				$module = Module::get('Estudiantes');
				$module->row = $estudiante;
				
				return view('la.estudiantes.show', [
					'module' => $module,
					'view_col' => $this->view_col,
					'no_header' => true,
					'no_padding' => "no-padding"
				])->with('estudiante', $estudiante);
			} else {
				return view('errors.404', [
					'record_id' => $id,
					'record_name' => ucfirst("estudiante"),
				]);
			}
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Show the form for editing the specified estudiante.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		if(Module::hasAccess("Estudiantes", "edit")) {			
			$estudiante = Estudiante::find($id);
			if(isset($estudiante->id)) {	
				$module = Module::get('Estudiantes');
				
				$module->row = $estudiante;
				
				return view('la.estudiantes.edit', [
					'module' => $module,
					'view_col' => $this->view_col,
				])->with('estudiante', $estudiante);
			} else {
				return view('errors.404', [
					'record_id' => $id,
					'record_name' => ucfirst("estudiante"),
				]);
			}
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Update the specified estudiante in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		if(Module::hasAccess("Estudiantes", "edit")) {
			
			$rules = Module::validateRules("Estudiantes", $request, true);
			
			$validator = Validator::make($request->all(), $rules);
			
			if ($validator->fails()) {
				return redirect()->back()->withErrors($validator)->withInput();;
			}
			
			$insert_id = Module::updateRow("Estudiantes", $request, $id);
			
			return redirect()->route(config('laraadmin.adminRoute') . '.estudiantes.index');
			
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Remove the specified estudiante from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		if(Module::hasAccess("Estudiantes", "delete")) {
			Estudiante::find($id)->delete();
			
			// Redirecting to index() method
			return redirect()->route(config('laraadmin.adminRoute') . '.estudiantes.index');
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}
	
	/**
	 * Datatable Ajax fetch
	 *
	 * @return
	 */
	public function dtajax()
	{
		$values = DB::table('estudiantes')->select($this->listing_cols)->whereNull('deleted_at');
		$out = Datatables::of($values)->make();
		$data = $out->getData();

		$fields_popup = ModuleFields::getModuleFields('Estudiantes');
		
		for($i=0; $i < count($data->data); $i++) {
			for ($j=0; $j < count($this->listing_cols); $j++) { 
				$col = $this->listing_cols[$j];
				if($fields_popup[$col] != null && starts_with($fields_popup[$col]->popup_vals, "@")) {
					$data->data[$i][$j] = ModuleFields::getFieldValue($fields_popup[$col], $data->data[$i][$j]);
				}
				if($col == $this->view_col) {
					$data->data[$i][$j] = '<a href="'.url(config('laraadmin.adminRoute') . '/estudiantes/'.$data->data[$i][0]).'">'.$data->data[$i][$j].'</a>';
				}
				// else if($col == "author") {
				//    $data->data[$i][$j];
				// }
			}
			
			if($this->show_action) {
				$output = '';
				if(Module::hasAccess("Estudiantes", "edit")) {
					$output .= '<a href="'.url(config('laraadmin.adminRoute') . '/estudiantes/'.$data->data[$i][0].'/edit').'" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>';
				}
				
				if(Module::hasAccess("Estudiantes", "delete")) {
					$output .= Form::open(['route' => [config('laraadmin.adminRoute') . '.estudiantes.destroy', $data->data[$i][0]], 'method' => 'delete', 'style'=>'display:inline']);
					$output .= ' <button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-times"></i></button>';
					$output .= Form::close();
				}
				$data->data[$i][] = (string)$output;
			}
		}
		$out->setData($data);
		return $out;
	}
}
