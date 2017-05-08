function newEntrie() {
  var place = '';
  var desc = '';
  var date = '';

  $("form.form-add-date :input").each(function () {
    var input = $(this); // This is the jquery object of the input, do what you will
    var idInput = input.attr('id');
    if (idInput === 'input-place') {
      return place = input.val();
    }
    if (idInput === 'input-desc') {
      return desc = input.val();
    }
    if (idInput === 'input-date') {
      return date = input.val();
    }

  });
  var lastId = $('#table-date tr:last').attr('id');
  lastId = parseInt(lastId) + 1;
  addLastRow(lastId,place, desc, date, true);
}

function addLastRow(index,place, desc, date, fromNewEntrie) {
  // ajout de la rangée dans le tableau
    $('#0').hide();
    var lastId = index;
    console.log(index);
    var appendItem = '<tr id="' + lastId + '">';
    if (fromNewEntrie) {
      appendItem += '<td><label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect mdl-data-table__select mdl-js-ripple-effect--ignore-events is-upgraded" data-upgraded=",MaterialCheckbox,MaterialRipple"><input type="checkbox" class="mdl-checkbox__input"><span class="mdl-checkbox__focus-helper"></span><span class="mdl-checkbox__box-outline"><span class="mdl-checkbox__tick-outline"></span></span><span class="mdl-checkbox__ripple-container mdl-js-ripple-effect mdl-ripple--center" data-upgraded=",MaterialRipple"><span class="mdl-ripple"></span></span></label></td>';
    }
    appendItem += '<td class="mdl-data-table__cell--non-numeric td-place">' + place + '</td>';
    appendItem += '<td class="mdl-data-table__cell--non-numeric td-desc">' + desc + '</td>';
    appendItem += '<td class="mdl-data-table__cell--non-numeric td-date">' + date + '</td></tr>';
    $('#table-date tr:last').after(appendItem);

    // Update dates.json
    if (fromNewEntrie) {
      var newObject = {};
      if (place) {
        newObject.place = place;
      }
      if (place) {
        newObject.desc = desc;
      }
      if (place) {
        newObject.date = date;
      }
      if (fromNewEntrie) {
        var dataComplete = {
          "place": place,
          "desc": desc,
          "date": date

        };
        dataComplete = $(this).serialize() + "&" + $.param(dataComplete);
        $.ajax({
          url: '../../app/dates.php',
          type: 'post',
          dataType: 'json',
          data: dataComplete
        });
      }
    }
}

function deleteRow(){
  $('.is-checked').each(function () {
    var tdIdBase = $(this).parent().parent().attr('id');
    var tdId = '#'+tdIdBase;
    $(tdId).children().hide();
    $(tdId).hide();
    var dataComplete = {
      "id": tdIdBase
    };
    dataComplete = $(this).serialize() + "&" + $.param(dataComplete);
    $.ajax({
      url: '../../app/removeDates.php',
      type: 'post',
      dataType: 'json',
      data: dataComplete
    });
  });
}

//init tab
$.getJSON("dates.json", function (json) {
  $.each(json, function (key, data) {
    $.each(data, function (index, data) {
      addLastRow(index,data.place, data.desc, data.date, false);
    })
  })
});
