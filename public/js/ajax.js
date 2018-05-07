function ajax(data,root,callback) {
   $.ajax({
        headers: {
            'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
        },
        url: root + '/ajax/data',
        data: data,
        success: function(data) {
            callback(data);
        },
        error: function(xhr, status, error){
            console.log(status, error);
        },
        method : 'POST',
    }); 
}

function bindclick(){
    $('#btnVote').on('click',function(e){
        e.preventDefault();
        $.ajax({
        headers: {
            'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
        },
        url: $('#baseurl').html() + '/ajax/vote',
        data: {
            answer:$('input[name="poll-answers"]:checked').val(),
            user:$(this).attr('data-user-id')
        },
        success: function(data) {

            data=JSON.parse(data);
            var rezultat=$('.funkyradio-primary');
            $.each(data,function(index,item){
               rezultat.eq(index).html(item.numberOfVotes);
            });
            
            $(e.currentTarget).hide();
        },
        error: function(xhr, status, error){
            console.log(status, error);
        },
        method : 'POST',
    });
    });
}
bindclick();

  

  
