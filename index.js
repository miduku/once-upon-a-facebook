var express = require('express');
var config = require('config'); // load default.json
var io = require('socket.io');
var http = require('http');
var path = require('path');
// var fs = require('fs');

var port = 3000;
var app = express(); // create the app
var server = http.createServer(app);
var socket = io.listen(server);


// app.use(express.static(path.join(__dirname, '/app')));


server.listen(port, function() {
  console.log('Express server listening on port ' + port);
});

