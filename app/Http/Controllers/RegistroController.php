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
        if(!$this->validateCPF($request->cpf)){
           return response()->json('CPF invalido', 422);
        }
        // Validação dos campos
        $validator = Validator::make($request->all(), [
            'cpf' => 'required|unique:registros,cpf',
            'nome' => 'required',
            'sobrenome' => 'required',
            'data_nascimento' => 'required|date|before:2005-01-01',
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
        if(!$this->validateCPF($request->cpf)){
            return response()->json('CPF invalido', 422);
         }

        // Validação dos campos
        $validator = Validator::make($request->all(), [
            'cpf' => 'required',
            'nome' => 'required',
            'sobrenome' => 'required',
            'data_nascimento' => 'required|date|before:2005-01-01',
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

    public function validateCPF($cpf) {
        // Remove caracteres não numéricos
        $cpf = preg_replace('/[^0-9]/', '', $cpf);

        // Verifica se possui 11 dígitos
        if (strlen($cpf) != 11) {
            return false;
        }

        // Verifica se todos os dígitos são iguais (CPF inválido)
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }

        // Calcula o primeiro dígito verificador
        $sum = 0;
        for ($i = 0; $i < 9; $i++) {
            $sum += (int) $cpf[$i] * (10 - $i);
        }
        $remainder = $sum % 11;
        $digit1 = $remainder < 2 ? 0 : 11 - $remainder;

        // Calcula o segundo dígito verificador
        $sum = 0;
        for ($i = 0; $i < 10; $i++) {
            $sum += (int) $cpf[$i] * (11 - $i);
        }
        $remainder = $sum % 11;
        $digit2 = $remainder < 2 ? 0 : 11 - $remainder;

        // Verifica se os dígitos verificadores estão corretos
        if ($cpf[9] != $digit1 || $cpf[10] != $digit2) {
            return false;
        }

        return true;
    }

}
