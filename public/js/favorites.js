$(document).ready(function() {
    $('.like-button').click(function(e) {
        e.preventDefault();
        var ideaId = $(this).data('idea-id');
        var likeCountElement = $('#likeCount_' + ideaId);

        $.ajax({
            url: '/idea/like/' + ideaId,
            method: 'GET',
            success: function(response) {
                var data = response.data;
                likeCountElement.text(data.favorites);
            },
            error: function(response) {
                console.log(response);
            }
        });
    });
});
