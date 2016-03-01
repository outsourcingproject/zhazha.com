/**
 * Created by zl on 15-12-9.
 */
jQuery(function ($) {
    var button = $('#tutorials-download');
    var share=$('#share-list a');
    button.click(function () {
        if(button.data('downloaded')){
            return;
        }
        if (button.data('shared')) {
            $('#tutorials-download-link').show();
            button.data('downloaded',true);
            //TODO push ajax

        }else{
            alert('此教程需要分享后才能下载，请点击左边的分享按钮后再试');
        }
    });
    share.click(function(){
        button.data('shared',true);
        //TODO push ajax
    });

})