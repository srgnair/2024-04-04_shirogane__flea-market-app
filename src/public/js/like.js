$(document).ready(function() {
    console.log('Document is ready');

    $('.like-button').click(function(event) {
        console.log('Like button clicked');
        event.preventDefault(); // ボタンのデフォルトの挙動をキャンセル

        var button = $(this); // クリックされたボタンを取得
        var form = button.closest('form'); // クリックされたボタンの親フォームを取得
        var action = form.attr('action'); // フォームのアクションURLを取得
        var method = form.find('input[name="_method"]').val() || 'POST'; // フォームのHTTPメソッドを取得（存在しない場合はPOST）
        var item_id = form.find('input[name="item_id"]').val(); // 商品IDを取得
        var csrfToken = $('#csrf-token').val();

        console.log('Sending AJAX request to:', action);
        console.log('Method:', method);
        console.log('Item ID:', item_id);

        // ボタンを無効にする
        button.prop('disabled', true);

        $.ajax({
            url: action,
            type: method,
            data: {
                "_token": csrfToken, // CSRFトークンを使用する
                "item_id": item_id
            },
            success: function(response) {
                // 成功時の処理
                console.log('Response:', response);
                if (response.success) {
                    // いいね！の数を更新などのUIの更新処理を行う
                    var icon = button.find('i');
                    var count = form.find('.detail__item-info--number');
                    if (response.liked) {
                        icon.css('color', '#ff5555');
                        icon.removeClass('fa-star-o').addClass('fa-star');
                    } else {
                        icon.css('color', 'black'); // アイコンを黒色に設定
                        icon.removeClass('fa-star').addClass('fa-star-o');
                    }
                    count.text(response.likes_count); // サーバーから新しいいいね数を返してもらう必要があります

                    // フォームのアクションとメソッドを切り替える
                    if (response.liked) {
                        form.attr('action', routes.deleteLike.replace('ITEM_ID_PLACEHOLDER', item_id));
                        form.find('input[name="_method"]').val('DELETE');
                    } else {
                        form.attr('action', routes.like.replace('ITEM_ID_PLACEHOLDER', item_id));
                        form.find('input[name="_method"]').val('POST');
                    }

                } else {
                    console.error('いいね！の処理に失敗しました。');
                }
            },
            error: function(xhr, status, error) {
                // エラー時の処理
                console.error('サーバーエラー:', xhr.responseText);
            },
            complete: function() {
                // ボタンを再度有効にする
                button.prop('disabled', false);
            }
        });
    });
});
