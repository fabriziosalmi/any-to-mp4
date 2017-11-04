var system = require('system');
var url = system.args[1];
var filename = system.args[2];
var page = new WebPage();
page.viewportSize = { width: 1280, height: 720 };
page.clipRect = { top: 0, left: 0, width: 1280, height: 720 };

page.open(url, function (status) {
  page.render(filename);
  console.log(filename)
  phantom.exit();
});
