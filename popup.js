// popup functions
(function () {
  'use strict';
  document.getElementById('loading').innerHTML = 'Please wait...';
  
  chrome.storage.local.get(['url'], function (result) {
    const xhr = new XMLHttpRequest();
    xhr.onload = () => {
      let message;
      switch (xhr.responseText) {
        case "1":
          message = `${result.url} is up. It's just you ;)`;
          break;
        case "2":
          message = `URL ${result.url} is invalid`;
          break;
        default:
          message = `${result.url} is down. Sorry about that.`;
      }
      document.getElementById('loading').innerHTML = message;
    };
    xhr.open("GET", 'http://demo.neilacero.com/isitreallydown/server.php?url=' + result.url);
    xhr.send();
  })
})();
