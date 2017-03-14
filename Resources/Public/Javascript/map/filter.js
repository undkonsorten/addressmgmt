$(document).ready(function() {

// filter list
  var $searchForm = $('.map-filter form'),
    $resultList = $('.filter-list-items'),
    $itemSelector = '.filter-list-item',
    $noResultsSelector = '.no-results',
    $statusSelector = '.update-map',
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
      $($noResultsSelector).show();
    } else {
      $($noResultsSelector).hide();
    }
  }

  if ($searchForm.length > 0) {
    $searchForm.each(function () {
      form = $(this);
      form.on('submit', function (e) {
        e.preventDefault();
        checkSearchForm($(this));
        if($mapElement.length) {
          $($statusSelector).show();
          setTimeout(function(){
            $($statusSelector).hide();
          }, 600);
          $mapElement[0].dispatchEvent(new Event('update-list'));
          $mapElement[0].dispatchEvent(new Event('fitbounds'));
          // animate scrolling on submit to target on form element
          target = form[0].target;
          if ($(target).length) {
            $('html, body').animate({
              scrollTop: $(target).offset().top
            }, 500);
            return false;
          }
        }
      });
      form.find('.reset').on('click', function (e) {
        form[0].reset();
        form.submit();
      });
    });
  }
  if($($noResultsSelector).length && $mapElement.length) {
    $($noResultsSelector).appendTo($mapElement);
  }
});