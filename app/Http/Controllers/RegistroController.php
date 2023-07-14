<?php

namespace App\Http\Controllers;

use App\Models\Registro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegistroController extends Controller
{
    public function create()
    {
        return view('cadastrar');
    }

    public function store(Request $request)
    {
        // Validação dos campos
        $validator = Validator::make($request->all(), [
            'cpf' => 'required|unique:registros,cpf',
            'nome' => 'required',
            'sobrenome' => 'required',
            'data_nascimento' => 'required|date',
            'email' => 'required|email',
            'genero' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        // Criação do registro
        $registro = Registro::create([
            'cpf' => $request->cpf,
            'nome' => $request->nome,
            'sobrenome' => $request->sobrenome,
            'data_nascimento' => $request->data_nascimento,
            'email' => $request->email,
            'genero' => $request->genero,
        ]);

        return response()->json(['message' => 'Registro criado com sucesso', 'data' => $registro], 201);
    }

    public function edit($id)
    {
        $registro = Registro::findOrFail($id);
        return view('editar', compact('registro'));
    }

    public function update(Request $request, $id)
    {
        // Validação dos campos
        $validator = Validator::make($request->all(), [
            'cpf' => 'required|unique:registros,cpf,' . $id,
            'nome' => 'required',
            'sobrenome' => 'required',
            'data_nascimento' => 'required|date',
            'email' => 'required|email',
            'genero' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        // Busca do registro pelo ID
        $registro = Registro::findOrFail($id);

        // Atualização dos dados
        $registro->update([
            'cpf' => $request->cpf,
            'nome' => $request->nome,
            'sobrenome' => $request->sobrenome,
            'data_nascimento' => $request->data_nascimento,
            'email' => $request->email,
            'genero' => $request->genero,
        ]);

        return response()->json(['message' => 'Registro atualizado com sucesso', 'data' => $registro]);
    }

    public function destroy($id)
    {
        // Busca do registro pelo ID
        $registro = Registro::findOrFail($id);

        // Exclusão do registro
        $registro->delete();

        return redirect()->back()->with('success', 'Registro excluído com sucesso!');
    }

    public function index()
    {
        $registros = Registro::all();

        return view('index', ['registros' => $registros]);
    }
}
