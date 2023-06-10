<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    /**
     * Mostra todos os recursos do tipo Teacher.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $search = $request->query('search');
    
        if ($search) {
            $Teachers = Teacher::where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->paginate(10);
        } else {
            $Teachers = Teacher::paginate(10); // Vai retornar 10 Teachers por página
        }
        
        return response()->json($Teachers);
    }
    
    

    /**
     * Cria um novo recurso do tipo Teacher.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
        ]);

        $Teacher = Teacher::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json($Teacher, 201);
    }

    /**
     * Exibe um recurso do tipo Teacher específico.
     *
     * @param  \App\Models\Teacher  $Teacher
     * @return \Illuminate\Http\Response
     */
    public function show(Teacher $Teacher)
    {
        return response()->json($Teacher);
    }

    /**
     * Atualiza um recurso do tipo Teacher específico.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Teacher  $Teacher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Teacher $Teacher)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:teachers,email,'.$Teacher->id,
            'password' => 'required|string|min:6',
        ]);

        $Teacher->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json($Teacher);
    }

    /**
     * Remove um recurso do tipo Teacher específico.
     *
     * @param  \App\Models\Teacher  $Teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teacher $Teacher)
    {
        $Teacher->delete();

        return response()->json(null, 204);
    }
}
