<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PollModel extends Model
{

    public $timestamps = false;
    protected $table = "polls";

    public function getActivePoll() {
        return DB::table('polls')
                   ->join('poll_answers', 'polls.id', 'poll_answers.poll_id')
                   ->where('polls.active', '1')
                   ->select('polls.question_text', 'poll_answers.answer_text', 
                            'poll_answers.id as answer_id', 'polls.id as poll_id')
                   ->get();
    }

    public function getPollResults() {
        return DB::table('user_poll_answers')
                 ->selectRaw('count(user_poll_answers.user_id) as numberOfVotes, user_poll_answers.answer_id as answer_id')
                 ->join('poll_answers', 'poll_answers.id', 'user_poll_answers.answer_id')
                 ->join('polls', 'polls.id','poll_answers.poll_id' )
                 ->where('polls.active', 1)
                 ->groupBy('user_poll_answers.answer_id')
                 ->get();
    }
    public function getPoll($user_id,$answer_id){
        return DB::insert('insert into user_poll_answers (user_id, answer_id) values (?, ?)', [$user_id, $answer_id]);
    }
}
