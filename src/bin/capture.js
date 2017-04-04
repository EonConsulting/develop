/**
 * Created by Peace Ngara on 4/3/2017.
 */

var fs = require('fs'),
    args = require('system').args,
    page = require('webpage').create();

page.content = fs.read(args[1]);

page.viewportSize = {
    width: 1024,
    height: 1024
};

page.paperSize = {
    format: 'A4',
    orientation: 'potrait',
    margin: '1cm'
};

window.setTimeout(function () {
    page.render(args[1]);
    phantom.exit();
}, 1500)
