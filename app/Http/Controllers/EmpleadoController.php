<?php

namespace App\Http\Controllers;
    
    use App\Models\Empleado;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;
    
    class EmpleadoController extends Controller
    {
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
    

         public function byAll(){

            $empleados = DB::select("select * from empleados");

            return response()->json($empleados);
    
        }

         public function byEmpleado($id){

            $empleados = DB::select("select * from empleados where id = $id");
            return response()->json($empleados);
    
        }
    
        public function index()
        {
            $empleados = Empleado::all();
            return view('empleado.index', compact('empleados'));
        }
    
        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function create()
        {
            return view('empleado.create');
        }
    
        /**
         * Store a newly created resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @return \Illuminate\Http\Response
         */
        public function store(Request $request)
        {
            // Valida los datos del formulario
            $request->validate([
                'nombre' => 'required',
                'app' => 'required',
                'apm' => 'required',
                'ubicacion' => 'required',
                // Agrega aquí las validaciones para otros campos según tu modelo de datos
            ]);
    
            // Crea un nuevo empleado con los datos del formulario
            $empleado = new Empleado;
            $empleado->nombre = $request->input('nombre');
            $empleado->app = $request->input('app');
            $empleado->apm = $request->input('apm');
            $empleado->ubicacion = $request->input('ubicacion');
            // Asigna otros campos según tu modelo de datos
    
            // Guarda el empleado en la base de datos
            $empleado->save();
    
            // Redirige a una página de éxito o responde con JSON
            return response()->json(['message' => 'Empleado creado con éxito'], 201);
        }
    
        /**
         * Display the specified resource.
         *
         * @param  \App\Models\Empleado  $empleado
         * @return \Illuminate\Http\Response
         */
        public function show(Empleado $empleado)
        {
            return view('empleado.show', compact('empleado'));
        }
    
        /**
         * Show the form for editing the specified resource.
         *
         * @param  \App\Models\Empleado  $empleado
         * @return \Illuminate\Http\Response
         */
        public function edit(Empleado $empleado)
        {
            return view('empleado.edit', compact('empleado'));
        }
    
        /**
         * Update the specified resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  \App\Models\Empleado  $empleado
         * @return \Illuminate\Http\Response
         */
        public function update(Request $request, $id)
        {
            $request->validate([
                'nombre' => 'required',
                'app' => 'required',
                'apm' => 'required',
                'ubicacion' => 'required',
                // Agrega aquí las validaciones para otros campos según tu modelo de datos
            ]);
        
            $empleado = Empleado::find($id);
        
            if (!$empleado) {
                return response()->json(['message' => 'Empleado no encontrado'], 404);
            }
        
            $empleado->nombre = $request->input('nombre');
            $empleado->app = $request->input('app');
            $empleado->apm = $request->input('apm');
            $empleado->ubicacion = $request->input('ubicacion');
            // Actualiza otros campos según tu modelo de datos
        
            $empleado->save();
        
            return response()->json(['message' => 'Empleado actualizado con éxito'], 200);
        }
        
        /**
         * Remove the specified resource from storage.
         *
         * @param  \App\Models\Empleado  $empleado
         * @return \Illuminate\Http\Response
         */
        public function destroy($id)
        {
            $empleado = Empleado::find($id);
            $empleado->delete();
    
            // Redirige a una página de éxito o responde con JSON
            return response()->json(['message' => 'Empleado eliminado con éxito'], 200);
        }
    }
    