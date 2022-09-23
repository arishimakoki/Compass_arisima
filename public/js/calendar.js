$(function () {
  $('.delete-modal-open').on('click', function () {
    $('.js-modal').fadeIn();
    var getDate_modal = $(this).attr('getDate_modal');
    var getPart_modal = $(this).attr('getPart_modal');
    var getPart = $(this).attr('getPart');
    var getDate = $(this).attr('getDate');
    $('.modal-Date p').text("予約日："+getDate_modal);
    $('.modal-Part p').text("時間：" + getPart_modal);
    $('.part-modal-hidden').val(getPart);
    $('.reserve-modal-hidden').val(getDate);
    return false;
  });
  $('.js-modal-close').on('click', function () {
    $('.js-modal').fadeOut();
    return false;
  });

});
