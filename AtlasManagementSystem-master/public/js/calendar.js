$(function () {

  $('.reserve-modal-open').on('click', function () {
    $('.reserve-modal').fadeIn();
    // ボタンからデータを取得する
    var date = $(this).val();
    var info = $(this).data('part');

    // モーダルにデータを表示する
    $('.reserve-date').text(date);
    $('.reserve-part').text(info);
    return false;
  });
  $('.reserve-modal-close').on('click', function () {
    $('.reserve-modal').fadeOut();
    return false;
  });

});
