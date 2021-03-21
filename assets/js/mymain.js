/*** VARS GLOBAL **** */
var urlHost = document.getElementById('urlHost').value;

/*** FULLSCREEN ***/
let closeFullScreenButton = document.getElementById('closeFullScreenButton');
var fullScreen = document.getElementById('fullScreen');
var fullScreenContent = document.getElementById('fullScreenContent');
closeFullScreenButton.addEventListener('click', function() {
    fullScreen.style.display = "none";
})


/**** AJAX JS */ 
const fetchAjaxText = (targetUrl, bodyData, callBack) => {
    const options = {
        method: 'POST',
        body: bodyData
      };
      
      fetch(targetUrl, options)
      .then(function(response) {
        return response.text();
      })
      .then(function(result) {
         callBack(result);
      });
  
}

const fetchAjaxJson = (targetUrl, bodyData, callBack) => {
    const options = {
        method: 'POST',
        body: bodyData
      };
      fetch(targetUrl, options)
      .then(function(response) {
        return response.json();
      })
      .then(function(result) {
         callBack(result);
      });
  
}