// background process
'use strict';

chrome.webNavigation.onErrorOccurred.addListener(function (e) {
  if (e.frameId !== 0) { return; }
  chrome.pageAction.show(e.tabId);
  chrome.storage.local.set({ url: e.url }, function() {
    chrome.extension.getBackgroundPage().console.log('URL: ' + e.url);
  });
});
