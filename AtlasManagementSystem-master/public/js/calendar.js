$(function () {
  $('.reserve-modal-open').on('click', function () {
    $('.reserve-modal').fadeIn();

    // ボタンからデータを取得する
    var date = $(this).val();
    var info = $(this).data('part');

    // モーダルにデータを表示する
    $('.reserve-date').text(date);
    $('.reserve-part').text(info);

    // attrメソッドを使って取得
    var reserve_date = $(this).attr('reserve_date');
    var reserve_part = $(this).attr('reserve_part');

    // val()を使ってvalue値を設定
    $('.reserve_date').val(reserve_date);
    $('.reserve_part').val(reserve_part);

    return false;
  });
  $('.reserve-modal-close').on('click', function () {
    $('.reserve-modal').fadeOut();
    return false;
  });
});
