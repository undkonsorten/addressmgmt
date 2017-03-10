$(document).ready(function() {

// filter list
  var $searchForm = $('.map-filter form'),
    $resultList = $('.filter-list-items'),
    $itemSelector = '.filter-list-item',
    $mapElement = $('[data-is-map=true]');

  function checkSearchForm(form) {
    filterArray = [];
    form.find('select option:selected').each(function() {
      if($(this).attr('value') != 0) {
        filterArray.push(parseInt($(this).attr('value')));
      }
    });
    $resultList.find($itemSelector).each(function () {
      item = $(this);
      if(filterArray.length > 0) {
        for(i=0; i<filterArray.length;i++) {
          if (filterArray[i] != 0 && $.inArray(filterArray[i], item.data('filter')) < 0) {
            item.hide().addClass('hide').removeClass('visible');
            break;
          } else {
            item.show().removeClass('hide').addClass('visible');
          }
        }
      } else {
        item.show().removeClass('hide').addClass('visible');
      }
    });
    if ($resultList.find($itemSelector + '.visible').length == 0) {
      $('.no-results').show();
    } else {
      $('.no-results').hide();
    }
  }

  if ($searchForm.length > 0) {
    $searchForm.each(function () {
      form = $(this);
      form.on('submit', function (e) {
        console.log(e.type);
        e.preventDefault();
        checkSearchForm($(this));
        if($mapElement.length) {
          $mapElement[0].dispatchEvent(new Event('update-list'));
          $mapElement[0].dispatchEvent(new Event('fitbounds'));
        }
      });
      form.find('.reset').on('click', function (e) {
        console.log(form);
        form[0].reset();
        form.submit();
      });
    });
  }
});