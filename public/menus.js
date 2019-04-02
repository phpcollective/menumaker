let except = $('#js-response').data('except'),
    ancestors = JSON.parse("[" + $('#js-response').data('ancestors') + "]");

function menus(element) {
    let parent_id = element.val() || 0,
        parentCount = $('select.parent').length,
        target = element.data('target'),
        url = baseUrl() + 'filter-menus?p_id=' + parent_id + '&e_id=' + except + '&pCount=' + parentCount;
    $.get(url, function(data, status){
        $(document).find('#child-of-parent-' + target).html(data);
        if(ancestors.length > 0)
        {
            $(document).find('select.parent:last').val(ancestors.shift()).change();
        }
    });
}

$(function () {
    $(document).on('change', '.parent', function (e) {
        menus($(this));
    });

    if(ancestors.length > 0)
    {
        $(document).find('select.parent:last').val(ancestors.shift()).change();
    }
});