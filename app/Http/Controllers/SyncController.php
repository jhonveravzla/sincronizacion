<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use App\Models\Logs;

class SyncController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = Http::get('http://192.168.12.30/comunicacion/public/api/products-count');
        $validar=Logs::where('tipo','=','products')->get();

        return json_Decode($response["products"]);
    }

    public function ultimoProducto()
    {
        $response = Http::get('http://192.168.12.30/comunicacion/public/api/products-count');
     
        $validacion=Logs::where("tipo","=","products")->where("sede","=","5")->get();
        if($validacion->first()->id>0){
            
            if($validacion->first()->ultimoid < $response["products"]){
                $response = Http::post('http://192.168.12.30/comunicacion/public/api/products-actualizar?id='.$validacion->first()->ultimoid);
                
                 //return $response;
                /*$data=json_decode($response->getBody());
                /*$data2=json_decode($data->products);*/
                
                foreach(json_decode($response->getBody()) as $da){
                    return $da->name;
                }
                            
            }
            else{
                return "todo actualizado";
            }
        }
        else{
            Logs::create([
                "ultimoid" => $response["products"],
                "tipo"=> 'products',
                "sede" => '5'
            ]);
            return "Inicializado logs con exito";
        }

        
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
