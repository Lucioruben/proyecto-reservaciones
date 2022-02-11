<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Models\v1\Reservacion;
use Illuminate\Http\Request;

class ReservacionesController extends Controller
{

	function getAll()
	{
		$response = new \stdClass();
		$response->success = true;

		$reservaciones = Reservacion::all();
		$response->data=$reservaciones;

		return response()->json($response,200);
	}

	function getItem($id)
	{
		$response = new \stdClass();
		$response->success = true;

		$reservacion = Reservacion::find($id);
		$response->data = $reservacion;

		return response()->json($response,200);
	}

	function store(Request $request)
	{
		$response = new \stdClass();
		$response->success = true;

		$reservacion=Reservacion::where("dni","=",$request->dni)->first();
		if($reservacion)
		{
			$response->success=false;
			$response->errors=[];
			$response->errors[]="Ya existe estudiante con dni ".$request->dni;
			return response()->json($response,400);
		}

		$reservacion = new Reservacion();
		$reservacion->dni = $request->dni;
		$reservacion->apellido = $request->apellido;
		$reservacion->nombre = $request->nombre;
		$reservacion->nivel = $request->nivel;
		$reservacion->grado = $request->grado;
		$reservacion->condicion = $request->condicion;
		$reservacion->celular = $request->celular;
		$reservacion->save();

		$response->data = $reservacion;

		return response()->json($response,201);
	}

	function update(Request $request)
	{
		$response = new \stdClass();
		$response->success=true;

		$reservacion = Reservacion::find($request->id);
		$reservacion->dni = $request->dni;
		$reservacion->apellido = $request->apellido;
		$reservacion->nombre = $request->nombre;
		$reservacion->nivel = $request->nivel;
		$reservacion->grado = $request->grado;
		$reservacion->condicion = $request->condicion;
		$reservacion->celular = $request->celular;
		$reservacion->save();

		$response->data = $reservacion;

		return response()->json($reservacion,200);		
	}

	function patch(Request $request)
	{
		$response = new \stdClass();
		$response->success=true;

		$reservacion = Reservacion::find($request->id);

		if(isset($request->dni))
		$reservacion->dni = $request->dni;

		if(isset($request->apellido))
		$reservacion->apellido = $request->apellido;

		if(isset($request->nombre))
		$reservacion->nombre = $request->nombre;
		
		if(isset($request->nivel))
		$reservacion->nivel = $request->nivel;

		if(isset($request->grado))
		$reservacion->grado = $request->grado;

		if(isset($request->condicion))
		$reservacion->condicion = $request->condicion;

		if(isset($request->celular))
		$reservacion->celular = $request->celular;

		$reservacion->save();

		$response->data = $reservacion;

		return response()->json($reservacion,200);		
	}

	function delete($id)
	{
		$response = new \stdClass();
		$response->success=true;

		$response_code;

		$reservacion = Reservacion::find($id);

		if($reservacion)
		{
			$reservacion->delete();
			$response_code=200;
		}
		else
		{
			$response->success=false;
			$response->errors = [];
			$response->errors[]="El estudiante ya ha sido eliminado previamente";
			$response_code=400;
		}

		return response()->json($response,$response_code);
	}

}

?>