var arraySection = [
                    'accueil',
                    'biographie',
                    'music',
                    'presse',
                    'contact',
                    'admin-accueil',
                    'admin-music',
                    'admin-dates'
];
function disableOther(activeMenu) {
  $.each(arraySection, function( index, value ) {
    if (value !== activeMenu){
      $('.section-'+value).hide()
    }
    if (value === activeMenu){
      $('.section-'+value).show()
    }
  });
}

function changeMenu(attributeId) {
  disableOther(attributeId)
}

// init with main page
$.each(arraySection, function( index, value ) {
  if (value !== 'accueil' ){
    $('.section-'+value).hide()
  }
  if (value === 'accueil' ||value === 'admin-dates'){
    $('.section-'+value).show()
  }
});
