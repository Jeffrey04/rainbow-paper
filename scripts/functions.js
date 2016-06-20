;(function($) {

function header_init_toggle(_event, header) {
    $(this).prependTo(header)
        .click(function(_event) {
            $('#sidebar').trigger('sidebar:toggle')
        })
}


function header_resize(_event) {
    if($('.toggle', this).length === 0 && is_big_screen() === false) {
        $($.parseHTML($('#template-header-toggle').html()))
            .on('header:toggle:init', header_init_toggle)
            .trigger('header:toggle:init', this)
    } else if($('.toggle', this).length > 0 && is_big_screen()) {
        $('.toggle', this).remove()
    }
}


function is_big_screen() {
    return $('#header p').css('display') === 'block'
}


function sidebar_toggle(_event) {
    $(this).slideToggle()
}


$(function() {
    $('#header')
        .on('header:resize', header_resize)

    $('#sidebar')
        .on('sidebar:toggle', sidebar_toggle)

    $(window)
        .resize(
            _.debounce(
                function() {
                    $('#header').trigger('header:resize')
                },
                500))
        .trigger('resize')
})

})(jQuery)
