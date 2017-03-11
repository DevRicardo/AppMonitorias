<?php
/**
 * Controller genrated using LaraAdmin
 * Help: http://laraadmin.com
 */

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Dwij\Laraadmin\Models\Module;
use Dwij\Laraadmin\Models\ModuleFields;
use Collective\Html\FormFacade as Form;

use App\Models\Monitore;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index()
    {
        $module_monitor = Module::get('Monitores');
        $module_estudiante = Module::get('Estudiantes');

        $roleCount = \App\Role::count();
		if($roleCount != 0) {
			if($roleCount != 0) {

				return view('home',[
                    'module_monitor' => $module_monitor,
                    'module_estudiante' => $module_estudiante
                ]);
			}
		} else {
			return view('errors.error', [
				'title' => 'Migration not completed',
				'message' => 'Please run command <code>php artisan db:seed</code> to generate required table data.',
			]);
		}
    }
}