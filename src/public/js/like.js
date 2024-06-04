$(document).ready(function() {
    console.log('Document is ready');

    $('.like-button').click(function(event) {
        console.log('Like button clicked');
        event.preventDefault();

        var button = $(this);
        var form = button.closest('form');
        var action = form.attr('action');
        var method = form.find('input[name="_method"]').val() || 'POST';
        var item_id = form.find('input[name="item_id"]').val();
        var csrfToken = $('#csrf-token').val();

        console.log('Sending AJAX request to:', action);
        console.log('Method:', method);
        console.log('Item ID:', item_id);

        button.prop('disabled', true);

        $.ajax({
            url: action,
            type: method,
            data: {
                "_token": csrfToken,
                "item_id": item_id
            },
            success: function(response) {
                console.log('Response:', response);
                if (response.success) {
                    var icon = button.find('i');
                    var count = form.closest('.comment__item-info--star').find('.comment__item-info--number');
                    
                    if (response.liked) {
                        icon.css('color', '#ff5555');
                        icon.removeClass('fa-star-o').addClass('fa-star');
                        form.attr('action', routes.deleteLike.replace('ITEM_ID_PLACEHOLDER', item_id));
                        form.find('input[name="_method"]').val('DELETE');
                    } else {
                        icon.css('color', '');
                        icon.removeClass('fa-star').addClass('fa-star-o');
                        form.attr('action', routes.like.replace('ITEM_ID_PLACEHOLDER', item_id));
                        form.find('input[name="_method"]').val('POST');
                    }

                    count.text(response.likes_count);

                } else {
                    console.error('いいね！の処理に失敗しました。');
                }
            },
            error: function(xhr, status, error) {
                console.error('サーバーエラー:', xhr.responseText);
            },
            complete: function() {
                button.prop('disabled', false);
            }
        });
    });
});
