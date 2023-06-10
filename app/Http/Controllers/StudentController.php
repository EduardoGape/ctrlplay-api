<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    /**
     * Mostra todos os recursos do tipo Student.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $orderBy = $request->query('orderBy', 'ctrlCash');
        $direction = $request->query('direction', 'desc');
        $search = $request->query('search');
        
        $query = Student::orderBy($orderBy, $direction);
        
        if ($search) {
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%");
        }
        
        $students = $query->paginate(10);
            
        return response()->json($students);
    }
    

    /**
     * Cria um novo recurso do tipo Student.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:students',
            'password' => 'required|string|min:6',
            'age' => 'required|date',
            'ctrlCash' => 'required|numeric',
        ]);
    
        $student = Student::create([
            'name' => $request->name,
            'email' => $request->email,
            'age' => $request->age,
            'ctrlCash' => $request->ctrlCash,
            'password' => Hash::make($request->password),
        ]);
    
        return response()->json($student, 201);
    }


    /**
     * Exibe um recurso do tipo Student específico.
     *
     * @param  \App\Models\Student  $Student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        return response()->json($student);
    }

    /**
     * Atualiza um recurso do tipo Student específico.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $Student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:students,email,' . $student->id,
            'password' => 'required|string|min:6',
            'age' => 'required|date',
            'ctrlCash' => 'required|numeric',
        ]);

        $student->update([
            'name' => $request->name,
            'email' => $request->email,
            'age' => $request->age,
            'ctrlCash' => $request->ctrlCash,
            'password' => Hash::make($request->password),
        ]);

        return response()->json($student);
    }

    /**
     * Remove um recurso do tipo Student específico.
     *
     * @param  \App\Models\Student  $Student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        $student->delete();

        return response()->json(null, 204);
    }
}
