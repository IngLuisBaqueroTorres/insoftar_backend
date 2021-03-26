<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Requests\UsuariosPostRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Usuarios;
use Exception;

class UsuariosController extends Controller
{
    public function __construct()
    {
    }



    public function index()
    {
        return Usuarios::all();
    }

    public function find($id){
        return Usuarios::where('id',$id)->get();
    }

    public function show(Request $request, Usuarios $usuarios)
    {
        return $usuarios;
    }

    public function store(UsuariosPostRequest $request)
    {
        $data = $request->validated();
        $usuarios = Usuarios::create($data);
        return $usuarios;
    }

    public function update(UsuariosPostRequest $request, Usuarios $usuarios, $id)
    {
        $data = $request->validated();
        $usuarios->fill($data);
        try{
            $Usuario = Usuarios::find($id);
            $Usuario -> nombres = $request['nombres'];
            $Usuario -> apellidos = $request['apellidos'];
            $Usuario -> cedula = $request['cedula'];
            $Usuario -> correo = $request['correo'];
            $Usuario -> telefono = $request['telefono'];
            $Usuario->save();
        }catch(Exception $ex){
            $this->response->error = true;
            $this->response->message = "Error editando el usuario "+$ex->getMessage();
        }

        return $usuarios;
    }

    public function destroy(Request $request, Usuarios $usuarios, $id)
    {
        try{
            $Usuario = Usuarios::find($id);
            $Usuario->delete();
        }catch(Exception $ex){
            $this->response->error = true;
            $this->response->message = "Error borrando el usuario "+$ex->getMessage();
        }
        return $usuarios;
    }

}
