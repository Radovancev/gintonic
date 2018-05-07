<?php

namespace App\Http\Controllers;
use App\Models\PollModel;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function handleRequest(Request $request){
        $method = $request->get('method_name');
        $model  = $request->get('model_name');
        $params = $request->get('params');
        return (new $model)->$method($params);
    }
    public function vote(Request $request){

    	$odgovor=$request['answer'];
    	$userid=$request['user'];
    	$poll= new PollModel();
    	if($poll->getPoll($userid,$odgovor)){

    		return json_encode($poll->getPollResults());
    	};
    	return "neeee";

    }
}
