// generate events
var eventDates = {}


// set maxDates
var maxDate = {
  1: new Date(new Date().setMonth(new Date().getMonth() + 11)),
  2: new Date(new Date().setMonth(new Date().getMonth() + 10)),
  3: new Date(new Date().setMonth(new Date().getMonth() + 9))
}

var flatpickr = $('#calendar .placeholder').flatpickr({
  inline: true,
  minDate: 'today',
  maxDate: maxDate[3],
  showMonths: 1,
  enable: Object.keys(eventDates),
  disableMobile: "true",
  onChange: function(date, str, inst) {
    var contents = '';
    if(date.length) {
      for(i=0; i < eventDates[str].length; i++) {
        contents += '<div class="event"><div class="date">' + flatpickr.formatDate(date[0], 'l J F') + '</div><div class="location">' + eventDates[str][i] + '</div></div>';
      }
    }
    $('#calendar .calendar-events').html(contents);
  },
  locale: {
    weekdays: {
      shorthand: ["S", "M", "T", "W", "T", "F", "S"],
      longhand: [
        "Sunday",
        "Monday",
        "Tuesday",
        "Wednesday",
        "Thursday",
        "Friday",
        "Saturday",
      ]
    }
  },
  onReady: function(selectedDates, dateStr, instance) {
    // Récupérer la cellule de la date d'aujourd'hui
    var todayCell = instance.days.querySelector('.today');

    // Ajouter la classe 'today' à la cellule de la date d'aujourd'hui
    if (todayCell) {
      todayCell.classList.add('today');
    }
  }
})

eventCaledarResize($(window));
$(window).on('resize', function() {
  eventCaledarResize($(this))
})

function eventCaledarResize($el) {
  var width = $el.width()
  if(flatpickr.selectedDates.length) {
    flatpickr.clear()
  }
  if(width >= 992 && flatpickr.config.showMonths !== 3) {
    flatpickr.set('showMonths', 3)
    flatpickr.set('maxDate', maxDate[3])
  }
  if(width < 992 && width >= 768 && flatpickr.config.showMonths !== 2) {
    flatpickr.set('showMonths', 2)
    flatpickr.set('maxDate', maxDate[2])
  }
  if(width < 768 && flatpickr.config.showMonths !== 1) {
    flatpickr.set('showMonths', 1)
    flatpickr.set('maxDate', maxDate[1])
    $('.flatpickr-calendar').css('width', '')
  }
}

function formatDate(date) {
    let d = date.getDate();
    let m = date.getMonth() + 1; //Month from 0 to 11
    let y = date.getFullYear();
    return '' + y + '-' + (m<=9 ? '0' + m : m) + '-' + (d <= 9 ? '0' + d : d);
}



// Faire une requête AJAX pour récupérer les données des entretiens depuis calrecup.php
$.ajax({
  url: 'calrecup.php',
  type: 'GET',
  dataType: 'json',
  success: function(data) {
      // Mettre à jour eventDates avec les données récupérées
      eventDates = data;

      // Afficher les données récupérées dans la console
      console.log('Données récupérées depuis calrecup.php :', data);

      // Mettre à jour le calendrier avec les nouveaux événements
      updateCalendarEvents();
  },
  error: function(xhr, status, error) {
      console.error('Erreur lors de la récupération des entretiens depuis calrecup.php :', error);
  }
});


// Mettre à jour les événements sur le calendrier
function updateCalendarEvents() {
  // Mettre à jour les événements sur le calendrier avec les données récupérées
  flatpickr.set('enable', Object.keys(eventDates));
  console.log('Event dates updated:', eventDates);
}


function onChange(date, str, inst) {
  var contents = '';

  // Vérifier si des rendez-vous existent pour la date sélectionnée
  if (eventDates[str] && eventDates[str].length > 0) {
    // Boucler à travers les rendez-vous et les afficher
    for (var i = 0; i < eventDates[str].length; i++) {
      // Diviser chaque partie de l'événement par une virgule
      var eventParts = eventDates[str][i].split(', ');

      // Créer un bloc pour chaque entretien
      contents += '<div class="event">';
      for (var j = 0; j < eventParts.length; j++) {
        // Si c'est la première partie (type_entretien), la rendre en gras
        if (j === 0) {
          contents += '<div><strong>' + eventParts[j] + '</strong></div>';
        } else {
          contents += '<div>' + eventParts[j] + '</div>';
        }
      }
      contents += '</div>';
    }
  }

  // Afficher les événements dans la zone d'événements du calendrier
  $('#calendar .calendar-events').html(contents);
}



