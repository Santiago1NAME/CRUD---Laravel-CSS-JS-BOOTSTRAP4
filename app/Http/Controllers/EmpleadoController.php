<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empleado;
use App\Models\Area;
use App\Models\Rol;
use App\Models\RolEmp;
use DB;

class EmpleadoController extends Controller
{
    //Función que permite visualizar la tabla de los empleados
    public function index(){
        //Realizamos un inner join para traer los nombres de las areas segun el id en la tabla empleados
        $empleados = DB::table('empleado')
        ->join('areas', 'empleado.area_id', '=', 'areas.id')
        ->select('empleado.id','empleado.nombres','empleado.email','empleado.sexo','areas.nombre','empleado.boletin')
        ->get();
        return view('empleado', compact('empleados'));
    }

    //Función que permite visualizar el formulario de registro
    public function viewCreate(){
        //Consultamos las areas registradas en la db
        $areas = Area::all();
        //Consultamos los roles registradas en la db
        $roles = Rol::all();

        //Consultamos la vista crear empleado y le enviamos las areas y roles de la db
        return view('createempleado', compact('areas','roles'));
    }

    //Función que permite crear un nuevo usario
    public function create(Request $request){

        $rules = [
            'nombreC' => 'required',
            'email' => 'required|email|unique:empleado',
            'sexo' => 'required',
            'areaId' => 'required',
            'descrip' => 'required'
        ];

        $message = [
            'nombreC.required' => 'Ingrese su nombre',
            'email.required' => 'Ingrese su correo electronico',
            'email.email' => 'El correo diligenciado no es valido',
            'email.unique' => 'El correo diligenciado ya existe',
            'sexo.required' => 'Seleccione su sexo',
            'areaId.required' => 'Seleccione el área al que corresponde',
            'descrip.required' => 'Ingrese una descripción'
        ];

        $request->validate($rules, $message);

        //Creamos el nuevo empleado
        $empleado = new Empleado();
        $empleado->nombres = $request->get('nombreC');
        $empleado->email = $request->get('email');
        $empleado->sexo = $request->get('sexo');
        $empleado->area_id = $request->get('areaId');

        if($request->get('deseoR') == "on"){
            $boletin = 1;
        }else{
            $boletin = 0;
        }

        $empleado->boletin = $boletin;
        $empleado->descripcion = $request->get('descrip');
        $empleado->save();
        $roles = $request['rolF'];
        //El foreach es para recorrer todos los roles seleccionados y sean guardados en db
        foreach($roles as $rol){
            $rolesEm = new RolEmp();
            $rolesEm->empleado_id = $empleado->id;
            $rolesEm->rol_id = $rol;
            $rolesEm->save();
        }
        \Session::flash('message', 'Dato registrado correctamente!!');
        return redirect('/');
    }

    //Función que permite visualizar el formulario de editar empleado
    public function viewEdit($id){
        $empleado = Empleado::where('id', $id)->get();
        $rolesEmple = RolEmp::where('empleado_id', $id)->get();
        //Consultamos las areas registradas en la db
        $areas = Area::all();
        //Consultamos los roles registradas en la db
        $roles = Rol::all();

        return view('editempleado', compact('empleado','rolesEmple','areas','roles'));
    }

    //Función editar empleado
    public function editEmp(Request $request, $id){

        $rules = [
            'nombreC' => 'required',
            'email' => 'required|email',
            'sexo' => 'required',
            'areaId' => 'required',
            'descrip' => 'required'
        ];

        $message = [
            'nombreC.required' => 'Ingrese su nombre',
            'email.required' => 'Ingrese su correo electronico',
            'email.email' => 'El correo diligenciado no es valido',
            'email.unique' => 'El correo diligenciado ya existe',
            'sexo.required' => 'Seleccione su sexo',
            'areaId.required' => 'Seleccione el área al que corresponde',
            'descrip.required' => 'Ingrese una descripción'
        ];

        $request->validate($rules, $message);

        $empleado = Empleado::find($id);
        $empleado->nombres = $request->get('nombreC');
        $empleado->email = $request->get('email');
        $empleado->sexo = $request->get('sexo');
        $empleado->area_id = $request->get('areaId');

        if($request->get('deseoR') == "on"){
            $boletin = 1;
        }else{
            $boletin = 0;
        }

        $empleado->boletin = $boletin;
        $empleado->descripcion = $request->get('descrip');
        $empleado->save();
        \Session::flash('update', 'El empleado ' . $empleado->nombres . ' fue actualizado');
        return redirect('/');
    }

    //Función eliminar empleado
    public function deletEmp($id){
        $empleado = Empleado::find($id);
        \Session::flash('delete', 'El empleado ' . $empleado["nombres"] . ' fue eliminado');
        $empleado->delete();
        return redirect('/');
    }
}
