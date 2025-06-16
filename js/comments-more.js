document.addEventListener('DOMContentLoaded', function() {
  var btn  = document.getElementById('showMoreComments');
  var list = document.querySelector('.additional-comments-level-0');

  // Если списка комментариев не существует или саму кнопку не нашли — скрываем кнопку (если есть) и выходим
  if (!btn) return;
  if (!list) {
      btn.style.display = 'none';
      return;
  }

  // Собираем все корневые комментарии
  var items = list.querySelectorAll('li.additional-comment');

  // Если нет ни одного комментария — скрываем кнопку и выходим
  if (items.length === 0) {
      btn.style.display = 'none';
      return;
  }

  // Если комментариев 20 или меньше, кнопку тоже скрываем
  if (items.length <= 20) {
      btn.style.display = 'none';
      return;
  }

  // Иначе оставляем кнопку видимой и вешаем обработчик
  btn.addEventListener('click', function() {
      // Показываем все скрытые после 20-го
      for (var i = 20; i < items.length; i++) {
          items[i].style.display = 'block';
      }
      // Скрываем саму кнопку, чтобы она больше не показывалась
      btn.style.display = 'none';
  });
});
