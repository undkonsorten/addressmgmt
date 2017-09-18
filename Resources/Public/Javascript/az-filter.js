jQuery(function($) {

  // build menu with letters to filter groups
  var groupSelector = '.list-items.group',
    groupChildren = '.list-item',
    letterMenuSelector = '.letter-list',
    letterData = 'group-letter',
    $usedGroups = new Array(),
    replaceNumber = '#',
    numberSign = '#',
    $letters = new Array(numberSign,'a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z');
  function getAllUsedGroups () {
    $(groupSelector).find(groupChildren).each(function(){
      $Letter = $(this).data(letterData);
      if ($Letter == numberSign) {
        itemToArray = replaceNumber;
        $(this).attr({'id': 'group-' + replaceNumber});
      } else {
        itemToArray = $Letter;
      }
      $usedGroups.push(itemToArray);
    });
    return $usedGroups;
  }
  function isLetterActive($value,$array) {
    ($value == numberSign) ? $value = replaceNumber : $value;
    return ($.inArray($value,$array) != -1) ? true : false;
  }
  function buildTags() {
    $usedGroups = getAllUsedGroups();
    var tags = '';
    for(i = 0; i < $letters.length; i++) {
      if(isLetterActive($letters[i],$usedGroups)) {
        ($letters[i] == numberSign) ? $replacedLetter = replaceNumber : $replacedLetter = $letters[i];
        tags += '<a id="link-for-group-' + $replacedLetter + '" data-' + letterData + '="' + $replacedLetter + '" href="#group-' + $replacedLetter + '" class="show-group">' + $letters[i] + '</a>';
      } else {
        if ($letters[i] != numberSign) {
          tags += '<span>' + $letters[i] + '</span>';
        }
      }
    }
    return tags;
  }

  function buildJumpMenu() {
    $taglist = buildTags();
    $showAll = '<a href="" class="show-all">' + $(letterMenuSelector).data('label-all') + '</a>';
    $(letterMenuSelector).prepend($taglist  + $showAll);
  }
  if($(groupSelector).length > 0) {
    buildJumpMenu();
  }
  $(letterMenuSelector + ' .show-group').on('click',function(e) {
     e.preventDefault();
    $letter = $(this).data(letterData);
     $(groupSelector).find(groupChildren).each(function() {
       if($(this).data(letterData) != $letter ) {
         $(this).hide();
       } else {
         $(this).show();
       }
     });
  });
  $('.letter-list .show-all').on('click', function (e) {
    e.preventDefault();
    $(groupSelector).find(groupChildren).show();
  });

  // show list-item on loading the page with # in th url
  if ( window.location.hash ) {
    hash = window.location.hash.split('#');
    $('#link-for-' + hash[1]).trigger('click');//and trigger the event when needed
  }

});