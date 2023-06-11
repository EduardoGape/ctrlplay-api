<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClasseController extends Controller
{
    /**
     * Mostra todos os recursos do tipo Classe.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {
        $classes = Classe::with('students')->get();
        return response()->json($classes);
    }
    
    /**
     * Cria um novo recurso do tipo Classe.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'dayWeek' => 'required|string',
            'hourClasses' => 'required',
            'teacher_id' => 'required|exists:teachers,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $classe = Classe::create($request->all());

        return response()->json($classe, 201);
    }

    /**
     * Exibe um recurso do tipo Classe específico.
     *
     * @param  \App\Models\Classe  $classe
     * @return \Illuminate\Http\Response
     */
    public function show(Classe $classe)
    {
        return response()->json($classe);
    }

    /**
     * Atualiza um recurso do tipo Classe específico.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Classe  $classe
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Classe $classe)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'dayWeek' => 'required|string',
            'hourClasses' => 'required',
            'teacher_id' => 'required|exists:teachers,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $classe->update($request->all());

        return response()->json($classe);
    }

    /**
     * Remove um recurso do tipo Classe específico.
     *
     * @param  \App\Models\Classe  $classe
     * @return \Illuminate\Http\Response
     */
    public function destroy(Classe $classe)
    {
        $classe->delete();

        return response()->json(null, 204);
    }
}
