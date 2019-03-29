require('../css/app.scss');
require('../css/bootstrap.css');
require('../css/custom.css');
var $ = require('jquery');
var greet = require('./greet');
$(document).ready(function() {
    $('body').prepend('<h1>'+greet('john')+'</h1>');
});