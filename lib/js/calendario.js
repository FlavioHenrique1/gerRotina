function getRoot()
{
    var root="http://"+document.location.hostname+":8080/Qualidade/";
    return root;
}    

//Exibir o calendario
function getCalendar(perfil, div) {

  let calendarEl = document.querySelector(div)
  let calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: 'dayGridMonth',
    headerToolbar: {
      start: 'prev,next,today',
      center: 'title',
      end: 'dayGridMonth, timeGridWeek, timeGridDay'
    },
    buttonText: {
      today: 'hoje',
      month: 'mês',
      week: 'semana',
      day: 'dia'
    },
    locale: 'pt-br',
    dateClick: function (info) {
      if(perfil == 'manager'){
        calendar.changeView('timeGrid',info.dateStr)
      }else{
        if(info.view.type == 'dayGridMonth'){
          calendar.changeView('timeGrid',info.dateStr)
        }else{
          window.location.href='views/add?date='+info.dateStr
        }
      }
      // alert('Clicked on: ' + info.dateStr);
      // alert('Coordinates: ' + info.jsEvent.pageX + ',' + info.jsEvent.pageY);
      // alert('Current view: ' + info.view.type);
      // change the day's background color just for fun
      info.dayEl.style.backgroundColor = 'red';
    },
    events: getRoot() + 'controllers/controllerEvents',
    eventClick: function (info) {
      if(perfil == 'manager'){
        window.location.href = `views/editar?id=${info.event.id}`
      }

    }
  });
  calendar.render()
}

if(document.querySelector('.calendarUser')){
  getCalendar('user','.calendarUser')
}else if(document.querySelector('.calendarManager')){
  getCalendar('manager','.calendarManager')
}