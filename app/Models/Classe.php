<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Classe;
use App\Models\Teacher;

class Classe extends Model
{
    use HasFactory;
    protected $table = 'classes';

    protected $fillable = [
        'title',
        'dayWeek',
        'hourClasses',
        'teacher_id'
    ];

    public function teacher() 
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }
    public function Students()
    {
        return $this->belongsToMany(Student::class, 'student_classe');
    }
}
