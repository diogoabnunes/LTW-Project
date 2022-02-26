'use strict'

function getBreeds(specieName) {
    if (specieName == "") {
      document.getElementById("breedList").innerHTML = "";
      return;
    } else {
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("breedList").innerHTML = this.responseText;
        }
      };
      xmlhttp.open("GET","../actions/action_get_breeds.php?s="+specieName,true);
      xmlhttp.send();
    }
}
