<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Word extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'word',
        'translate',
        'description',
        'user_id',
        'status',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_word', 'word_id')
            ->withPivot(['is_knew', 'correct_answer', 'wrong_answer', 'repeat']);
    }

    public function exams()
    {
        return $this->belongsToMany(Exam::class, 'word_exams', 'exam_id')
            ->withPivot(['answer']);
    }
}
