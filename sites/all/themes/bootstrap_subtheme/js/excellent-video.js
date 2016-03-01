/**
 * Created by zl on 15-12-17.
 */
jQuery(function ($) {
    $('.carousel').carousel({
        interval: false
    });
    var info = $('.excellent-video-metadata');
    //info.show();
    $('#excellent-video-title').hover(function () {
        info.show();
    }, function () {
        info.hide();
    })
});
