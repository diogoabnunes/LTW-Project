'use strict'

function beforeToday(date) {
    let pickedDate = Date.parse(date);
    let todaysDate = Date.now();

    if(pickedDate > todaysDate)
      document.querySelector("input[type='date']").parentNode.innerHTML = '<input class = "text_field" type="date" value="" name="bday" required onchange="beforeToday(this.value)">';

  }