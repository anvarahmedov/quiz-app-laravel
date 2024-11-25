<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
 //   public $quizHasS = false;
    protected $fillable = ['id', 'user_id', 'quiz_id', 'result', 'owner'];

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function quiz()
    {
        return $this->belongsTo(Quiz::class, 'quiz_id');
    }

    public function setQuizHasStarted($hasStarted) {
        $this->quizHasStarted = $hasStarted;
    }

    public function getQuizHasStarted() {
        return $this->quizHasStarted;
    }
}
