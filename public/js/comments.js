$(document).ready(function(){
    document.querySelector("#btnSend").addEventListener("click", callAjax);
});

function pushNewComment(data) {
    $('#comment').val("");
    let date = new Date(data.comment.posted_at * 1000)
    let formatted = moment(date).format("MMMM DD[,] YYYY hh:mm");

    let html =`
        <div class='card my-4'>
            <div class='card-header'>
                <strong>` + data.author.username +`</strong>
                <span class='text-muted'> on ` + formatted +` </span>
            </div>
            <div class='card-body'>
                ` + data.comment.comment_text + `
            </div>
        </div>
    `;
    $('#comments-container').prepend(html)
    focusNewComment();
}

function callAjax() {
  let root = document.querySelector("input[name='root_path']");
  let post_id   = document.querySelector("input[name='post_id']");

  if(root !== undefined && post_id !== undefined ) {

        let text = $('#comment').val();
        let data = {
            params: {
               post_id: post_id.value,
               text   : text
            },
            model_name : 'App\\Models\\CommentModel',
            method_name : 'addComment'
        };
        
        ajax(data,root.value,pushNewComment);
        
    }
}

function focusNewComment() {
    let new_comment = document.querySelector(".card");
    new_comment.scrollIntoView({behavior:'smooth'});

    new_comment.classList.add('just_added');
    setTimeout(function() {
        new_comment.classList.remove('just_added')
    }, 2000);
}
