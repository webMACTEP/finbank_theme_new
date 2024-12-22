jQuery(document).ready(function($){
    // Функция для проверки наличия куки
    function hasCookie(name) {
        return document.cookie.split(';').some((item) => item.trim().startsWith(name + '='));
    }

    // Блокируем кнопки, если пользователь уже лайкнул/дизлайкнул
    $('.like-button, .dislike-button').each(function(){
        var commentId = $(this).data('comment-id');
        if(hasCookie('liked_comment_' + commentId)){
            $(this).prop('disabled', true).addClass('disabled');
        }
        if(hasCookie('disliked_comment_' + commentId)){
            $(this).prop('disabled', true).addClass('disabled');
        }
    });

    // Обработка клика по кнопке "Лайк"
    $('.like-button').on('click', function(){
        var commentId = $(this).data('comment-id');
        var likeButton = $(this);
        var dislikeButton = likeButton.siblings('.dislike-button');

        // Отправляем AJAX-запрос
        $.ajax({
            url: ajax_object_like_dislike.ajax_url,
            type: 'POST',
            data: {
                action: 'handle_like_dislike_ajax',
                comment_id: commentId,
                type: 'like',
                nonce: ajax_object_like_dislike.like_dislike_nonce
            },
            beforeSend: function(){
                // Можно добавить спиннер или индикатор загрузки
                likeButton.prop('disabled', true).html(`
                    <svg width="11" height="6" viewBox="0 0 11 6" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M0.75 4.5L2.32258 2.84722C3.57668 1.52915 4.20373 0.870122 4.968 0.768647C5.15526 0.743785 5.34474 0.743785 5.532 0.768647C6.29627 0.870122 6.92332 1.52915 8.17742 2.84722L9.75 4.5" stroke="#626B84" stroke-width="1.2" stroke-linecap="round"/>
</svg> Отправка...`);
            },
            success: function(response){
                if(response.success){
                    // Обновляем счетчик лайков
                    likeButton.find('.like-count').text(response.data.likes);
                    // Блокируем кнопку
                    likeButton.prop('disabled', true).addClass('disabled').html(`
                        <svg width="11" height="6" viewBox="0 0 11 6" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M0.75 4.5L2.32258 2.84722C3.57668 1.52915 4.20373 0.870122 4.968 0.768647C5.15526 0.743785 5.34474 0.743785 5.532 0.768647C6.29627 0.870122 6.92332 1.52915 8.17742 2.84722L9.75 4.5" stroke="#626B84" stroke-width="1.2" stroke-linecap="round"/>
</svg>
                        ${response.data.dislikes}
                    `);
                    // Устанавливаем куки
                    document.cookie = 'liked_comment_' + commentId + '=1; path=/; max-age=31536000'; // 1 год
                }
                else{
                    alert(response.data);
                    likeButton.prop('disabled', false).html(`
                        <svg width="11" height="6" viewBox="0 0 11 6" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M0.75 4.5L2.32258 2.84722C3.57668 1.52915 4.20373 0.870122 4.968 0.768647C5.15526 0.743785 5.34474 0.743785 5.532 0.768647C6.29627 0.870122 6.92332 1.52915 8.17742 2.84722L9.75 4.5" stroke="#626B84" stroke-width="1.2" stroke-linecap="round"/>
    </svg>`);
                }
            },
            error: function(){
                alert('Произошла ошибка. Пожалуйста, попробуйте снова.');
                likeButton.prop('disabled', false).html(`
                    <svg width="11" height="6" viewBox="0 0 11 6" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M0.75 4.5L2.32258 2.84722C3.57668 1.52915 4.20373 0.870122 4.968 0.768647C5.15526 0.743785 5.34474 0.743785 5.532 0.768647C6.29627 0.870122 6.92332 1.52915 8.17742 2.84722L9.75 4.5" stroke="#626B84" stroke-width="1.2" stroke-linecap="round"/>
</svg>`);
            }
        });
    });

    // Обработка клика по кнопке "Дизлайк"
    $('.dislike-button').on('click', function(){
        var commentId = $(this).data('comment-id');
        var dislikeButton = $(this);
        var likeButton = dislikeButton.siblings('.like-button');

        // Отправляем AJAX-запрос
        $.ajax({
            url: ajax_object_like_dislike.ajax_url,
            type: 'POST',
            data: {
                action: 'handle_like_dislike_ajax',
                comment_id: commentId,
                type: 'dislike',
                nonce: ajax_object_like_dislike.like_dislike_nonce
            },
            beforeSend: function(){
                // Можно добавить спиннер или индикатор загрузки
                dislikeButton.prop('disabled', true).html(`
                    <svg width="11" height="6" viewBox="0 0 11 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10.25 1.5L8.67742 3.15278C7.42332 4.47085 6.79627 5.12988 6.032 5.23135C5.84474 5.25621 5.65526 5.25621 5.468 5.23135C4.70373 5.12988 4.07668 4.47085 2.82258 3.15278L1.25 1.5" stroke="#626B84" stroke-width="1.2" stroke-linecap="round"/>
                    </svg>
                    Отправка...
                `);
                
            },
            success: function(response){
                if(response.success){
                    // Обновляем счетчик дизлайков
                    dislikeButton.find('.dislike-count').text(response.data.dislikes);
                    // Блокируем кнопку
                    dislikeButton.prop('disabled', true).addClass('disabled').html(`
                        <svg width="11" height="6" viewBox="0 0 11 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10.25 1.5L8.67742 3.15278C7.42332 4.47085 6.79627 5.12988 6.032 5.23135C5.84474 5.25621 5.65526 5.25621 5.468 5.23135C4.70373 5.12988 4.07668 4.47085 2.82258 3.15278L1.25 1.5" stroke="#626B84" stroke-width="1.2" stroke-linecap="round"/>
                        </svg>
                        ${response.data.dislikes}
                    `);
                                        // Устанавливаем куки
                    document.cookie = 'disliked_comment_' + commentId + '=1; path=/; max-age=31536000'; // 1 год
                }
                else{
                    alert(response.data);
                    dislikeButton.prop('disabled', false).html(`
                        <svg width="11" height="6" viewBox="0 0 11 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10.25 1.5L8.67742 3.15278C7.42332 4.47085 6.79627 5.12988 6.032 5.23135C5.84474 5.25621 5.65526 5.25621 5.468 5.23135C4.70373 5.12988 4.07668 4.47085 2.82258 3.15278L1.25 1.5" stroke="#626B84" stroke-width="1.2" stroke-linecap="round"/>
                        </svg>
                    `);
                }
            },
            error: function(){
                alert('Произошла ошибка. Пожалуйста, попробуйте снова.');
                dislikeButton.prop('disabled', false).html(`
                    <svg width="11" height="6" viewBox="0 0 11 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10.25 1.5L8.67742 3.15278C7.42332 4.47085 6.79627 5.12988 6.032 5.23135C5.84474 5.25621 5.65526 5.25621 5.468 5.23135C4.70373 5.12988 4.07668 4.47085 2.82258 3.15278L1.25 1.5" stroke="#626B84" stroke-width="1.2" stroke-linecap="round"/>
                    </svg>
                `);
            }
        });
    });
});
