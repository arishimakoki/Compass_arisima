$(function () {
  $('.delete-modal-open').on('click', function () {
    $('.js-modal').fadeIn();
    var getDate = $(this).attr('getDate');
    var getPart = $(this).attr('getPart');
    $('.modal-Date p').text("予約日："+getDate);
    $('.modal-Part p').text("時間："+getPart);
    return false;
  });
  $('.js-modal-close').on('click', function () {
    $('.js-modal').fadeOut();
    return false;
  });

});
