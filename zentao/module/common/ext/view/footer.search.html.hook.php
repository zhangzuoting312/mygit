<script>
$.extend({
    gotoObject:function()
    {
        objectType  = $('#searchType').attr('value');
        objectValue = $('input#searchInput').attr('value');
        if(objectType && objectValue)
        {
            var reg = /[^0-9]/;
            if(reg.test(objectValue) || objectType == 'all')
            {
                location.href=createLink('search', 'index') + (config.requestType == 'PATH_INFO' ? '?' : '&') + 'words=' + objectValue;
            }
            else
            {
                var types = objectType.split('-');
                var searchModule = types[0];
                var searchMethod = typeof(types[1]) == 'undefined' ? 'view' : types[1];

                location.href=createLink(searchModule, searchMethod, "id=" + objectValue);
            }
        }
    }
});

$(function()
{
    var reg = /[^0-9]/;
    var $searchbox    = $('#searchbox');
    var $typeSelector = $searchbox.find('.input-group-btn');
    var $dropmenu     = $typeSelector.children('.dropdown-menu');
    var $searchQuery  = $('#searchInput');
    var searchType    = $('#searchType').val();

    var toggleMenu = function(show)
    {
        $searchbox.toggleClass('open', show);
        $dropmenu.toggleClass('show', show).toggleClass('in', show);
        if(show) $dropmenu.show();
        else $dropmenu.hide();
    };

    var hideMenu = function(){toggleMenu(false);};

    var refreshMenu = function()
    {
        var val = $searchQuery.val();
        if(val !== null && val !== "")
        {
            var isQuickGo = !reg.test(val);
            $dropmenu.toggleClass('show-quick-go', isQuickGo);
            var $typeAll = $dropmenu.find('li.search-type-all > a');
            $typeAll.html('<?php echo $lang->searchAB?> <span>"' + val + '"</span>');
            if(isQuickGo)
            {
                $typeAll.closest('li').removeClass('active');
                $dropmenu.removeClass('with-active').find('li:not(.search-type-all) > a').each(function()
                {
                    var $this = $(this);
                    var isActiveType = $this.data('value') === searchType && searchType !== 'all';
                    $this.closest('li').toggleClass('active', isActiveType);
                    $this.html($this.data('name') + ' <span>#' + (val.length > 4 ? (val.substr(0, 4) + '...') : val) + "</span>");
                    if(isActiveType) $dropmenu.addClass('with-active');
                });
            }
            else
            {
                $dropmenu.find('li.active').removeClass('active');
                $typeAll.closest('li').addClass('active');
            }
            toggleMenu(true);
        }
        else
        {
            hideMenu();
        }
    };

    $dropmenu = $dropmenu.appendTo($searchbox);
    $dropmenu.on('click', 'a', function(e)
    {
        $('#searchType').val($(this).data('value'));
        $.gotoObject();
        e.stopPropagation();
    }).find('li > a').each(function()
    {
        var $this = $(this);
        $this.attr('data-name', $this.text());
    });
    var $allItem = $dropmenu.find('li > a[data-value="all"]');
    if($allItem.length)
    {
        $allItem.closest('li').addClass('search-type-all').prependTo($dropmenu);
    }
    $searchQuery.on('change keyup paste input propertychange', refreshMenu).on('focus', function()
    {
        setTimeout(refreshMenu, 300);
    });

    $(document).on('click', hideMenu);
});
</script>
