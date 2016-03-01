/**
 * Created by zl on 15-12-10.
 */
videojs.options.flash.swf = "/sites/all/themes/bootstrap_subtheme/videojs/video-js.swf";
jQuery(function ($) {
    try {
        var mainVideo = videojs('main-video');
        mainVideo.width($('.content').width());


    } catch (e) {

    }
    try {
        var flashVideo = $('.edui-faked-video');

        flashVideo.attr('width', $('.content').width());
        flashVideo.attr('height', $('.content').width()/16*10);
        console.log(flashVideo);
    } catch (e) {

    }


});