$(document).ready(function() {

// filter list
  var $searchForm = $('.map-filter form'),
    $resultList = $('.filter-list-items'),
    $itemSelector = '.filter-list-item',
    $mapElement = $('[data-is-map=true]');

  function checkSearchForm() {
    filterArray = [];
    $searchForm.find('select option:selected').each(function() {
      if($(this).attr('value') != 0) {
        filterArray.push(parseInt($(this).attr('value')));
      }
    });
    $resultList.find($itemSelector).each(function () {
      item = $(this);
      if(filterArray.length > 0) {
        for(i=0; i<filterArray.length;i++) {
          if (filterArray[i] != 0 && $.inArray(filterArray[i], item.data('filter')) < 0) {
            item.hide().addClass('hide');
            break;
          } else {
            item.show().removeClass('hide');
          }
        }
      } else {
       item.show().removeClass('hide');
      }
    });

    if ($resultList.find($itemSelector + ':visible').length == 0) {
      $('.map-filter .no-results').show();
    } else {
      $('.map-filter .no-results').hide();
    }
  }

  if ($searchForm.length > 0) {
    $searchForm.find('select.js-controlled').each(function () {
      $(this).on('change', function (e) {
        checkSearchForm();
        $mapElement[0].dispatchEvent(new Event('update-list'));
        $mapElement[0].dispatchEvent(new Event('fitbounds'));
      });
    });
    $(window).on('load', function () {
      checkSearchForm();
    });
  }
});