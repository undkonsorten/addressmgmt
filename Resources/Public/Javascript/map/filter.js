jQuery(function($) {

  // fix error in IE 11: Object doesn't support this action
  // on line 92/93: $mapElement[0].dispatchEvent(new Event('update-list'))
  // https://stackoverflow.com/questions/26596123/internet-explorer-9-10-11-event-constructor-doesnt-work
  try {
    var ce = new window.CustomEvent('test');
    ce.preventDefault();
    if (ce.defaultPrevented !== true) {
      // IE has problems with .preventDefault() on custom events
      // http://stackoverflow.com/questions/23349191
      throw new Error('Could not prevent default');
    }
  } catch(e) {
    var CustomEvent = function(event, params) {
      var evt, origPrevent;
      params = params || {
          bubbles: false,
          cancelable: false,
          detail: undefined
        };

      evt = document.createEvent("CustomEvent");
      evt.initCustomEvent(event, params.bubbles, params.cancelable, params.detail);
      origPrevent = evt.preventDefault;
      evt.preventDefault = function () {
        origPrevent.call(this);
        try {
          Object.defineProperty(this, 'defaultPrevented', {
            get: function () {
              return true;
            }
          });
        } catch(e) {
          this.defaultPrevented = true;
        }
      };
      return evt;
    };

    CustomEvent.prototype = window.Event.prototype;
    window.CustomEvent = CustomEvent; // expose definition to window
  }

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
      if(filterArray.length > 0) {
        for(i=0; i<filterArray.length;i++) {
          if (filterArray[i] != 0 && $.inArray(filterArray[i], $(this).data('filter')) < 0) {
            $(this).hide().addClass('hide').removeClass('visible');
            break;
          } else {
            $(this).show().removeClass('hide').addClass('visible');
          }
        }
      } else {
        $(this).show().removeClass('hide').addClass('visible');
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
          $mapElement[0].dispatchEvent(new CustomEvent('update-list'));
          $mapElement[0].dispatchEvent(new CustomEvent('fitbounds'));
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
