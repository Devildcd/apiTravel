<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Travel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TravelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $viajes = Travel::all();
        
        return response()->json($viajes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request-> all(), Travel::rules());

        if($validator-> fails()) {
            
            return response()-> json([
                'message' => 'Error de validacion',
                'errors'  =>  $validator-> errors(),
            ], 422);
        }

        $viaje = New Travel;

        $viaje-> flyType = $request-> flyType;
        $viaje-> class = $request-> class;
        $viaje-> passengers = $request-> passengers;

        if($viaje-> origin = $request-> origin ===  $viaje-> destiny = $request-> destiny) {
            
            return response()-> json([
                'message' => 'El origen debe ser distinto del destino',
                ], 422);
        }

        $viaje-> origin = $request-> origin;
        $viaje-> dateOrigin = $request-> dateOrigin;
        $viaje-> destiny = $request-> destiny;
        $viaje-> dateDestiny = $request-> dateDestiny;

        $viaje-> save();

        return response()-> json([

            'message' => 'Viaje creado exitosamente',
            'viaje' => $viaje
        ], 201);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Travel  $travel
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $viaje = Travel::find($id);

        if (!$viaje) {
            return response()->json([
                'message' => 'Viaje no encontrado'
            ], 404);
        }

        return response()-> json($viaje);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Travel  $travel
     * @return \Illuminate\Http\Response
     */
    public function edit(Travel $travel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Travel  $travel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make( $request-> all(), Travel::rules());

        if($validator-> fails()) {

            return response()-> json([
                'message' => 'Error de validacion',
                'errors'  => $validator-> errors(),
            ], 422);
        }

        $viaje = Travel::find($id);

        if (!$viaje) {
            return response()->json([
                'message' => 'Viaje no encontrado'
            ], 404);
        }
    
        $viaje-> flyType = $request->flyType;
        $viaje-> class = $request->class;
        $viaje-> passengers = $request->passengers;

        if($viaje-> origin = $request-> origin ===  $viaje-> destiny = $request-> destiny) {
            
            return response()-> json([
                'message' => 'El origen debe ser distinto del destino',
                ], 422);
        }

        $viaje-> origin = $request-> origin;
        $viaje-> dateOrigin = $request-> dateOrigin;
        $viaje-> destiny = $request-> destiny;

        $flyType = $viaje-> flyType;

        if(!Travel::validateDateDestiny($flyType, $request-> dateDestiny)) {

            return response()->json(['error' => 'La fechaDestiny debe ser null cuando flyType es Solo Ida'], 422);
        }

        $viaje-> dateDestiny = $request-> dateDestiny;
    
        $viaje->save();
    
        return response()->json([
            'message' => 'Viaje actualizado exitosamente',
            'viaje' => $viaje
        ], 200);
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Travel  $travel
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $viaje = Travel::find($id);

        if (!$viaje) {
            return response()->json([
                'message' => 'Viaje no encontrado'
            ], 404);
        }

        $viaje-> delete();

        return response()-> json([
            'message' => 'Viaje eliminado exitosamente'
        ], 200);
    }




    //Function for filter data
    public function filter(Request $request) {

        $flyType = $request->input('flyType');
        $class = $request->input('class');
        $passengers = $request->input('passengers');
        $origin = $request->input('origin');
        $dateOrigin = $request->input('dateOrigin');
        $destiny = $request->input('destiny');
        $dateDestiny = $request->input('dateDestiny');

        $travel = Travel:: filtrar( $flyType,$class, $passengers, $origin, $dateOrigin, $destiny,  $dateDestiny);

        return response()-> json($travel);
    
    }
}
