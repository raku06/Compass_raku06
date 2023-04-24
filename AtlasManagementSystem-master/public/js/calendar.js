$(function () {

  $('#reserve-modal-open').on('click', function () {
    $('#reserve-modal').fadeIn();
    return false;
  });
  $('#reserve-modal-close').on('click', function () {
    $('#reserve-modal').fadeOut();
    return false;
  });

});
