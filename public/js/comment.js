
    // 使用 jQuery 发起 AJAX 请求，提交评论并获取最新评论列表
    function submitComment() {
    var formData = $('#commentForm').serializeArray();
    $.post($('#commentForm').attr('action'), formData, function (response) {
    // 清空评论框
    $('#content').val('');
    updateComments();
}, 'json');
}

    // 获取最新评论列表并更新页面
    function updateComments() {
        $.get('/comment/index?idea_id={{ $idea->id }}', function (response){
            var commentList = $('#commentList');
            commentList.empty();

            response.forEach(function (comment) {
                var newComment = '<li>' +
                    '<strong>' + comment.user_name + '</strong>' +
                    '<p>' + comment.content + '</p>' +
                    '<time>' + comment.created_at + '</time>' +
                    '<form method="get" action="/comment/delete/' + comment.id + '">' +
                    // '<input type="hidden" name="comment_id" value="'+ comment.id +'"> ' +
                    '<button type="submit">Delete</button>' +
                    '</form>' +
                    '</li>';
                commentList.append(newComment);
            });
        });
    }

    // 每隔一定时间间隔调用 updateComments 函数
    setInterval(updateComments, 5000); // 5 秒，根据需要调整时间间隔
