/* 
 * kERANA utils js.
 * 
 */

/**
 * -----------------------------------------------------------------------------
 * Load a url into a divid
 * -----------------------------------------------------------------------------
 * @param string url
 * @param string divid
 * @returns {undefined}
 */
function loadResource(url, divid) {
    //$('#' + loader).show();
    $.ajax({
        type: 'get',
        url: url,
        dataType: 'html',
        success: function (data) {
            $('#' + divid).css('display', 'inline').html(data);
      //      $('#' + loader).hide();
        }
    });

}

