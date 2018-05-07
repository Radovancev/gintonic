@extends('layouts.homelayout')


@section('content')
    <div class="col-lg-8 col-md-10 mx-auto">
        <div class="card my-4">
            <div class='card-header'>
                {{ $poll->first()->question_text}}
            </div>
            <div class='card-body'>
                    <input type="hidden" value="{{ $poll->first()->poll_id }}" name='poll_id' />
                <div class="funkyradio">
                    
                    @foreach($poll as $answer)
                        
                        

                            
                            <div class="funkyradio-primary">
                                <input type="radio" name="poll-answers" id='radio{{$loop->index }}' value="{{ $answer->answer_id}}"/>
                                <label for='radio{{$loop->index }}' >{{ $answer->answer_text}}</label>
                            </div>
                            
                        
                    @endforeach     
                </div>
            </div>
            <div class='card-footer'>
                
                <button  class="btn btn-primary" id='btnVote' data-user-id='{{session('user')[0]->id}}'>Vote</button>
                
            </div>
        </div>
    </div>

@endsection

@section('customScripts')
    <script src="{{ asset('js/ajax.js')}}"></script> 
    
@endsection