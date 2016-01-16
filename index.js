'use strict';

var express = require('express');
var config = require('config'); // load default.json
var io = require('socket.io');
var FB = require('fb');
var FB_TOKEN = config.get('TOKEN');
var http = require('http');
var path = require('path');
// var fs = require('fs');

var port = 3000;
var app = express(); // create the app
var server = http.createServer(app);
var socket = io.listen(server);

console.log(FB_TOKEN);

app.use(express.static(path.join(__dirname, '/app')));
app.get('/', function(req, res) {
  res.sendFile(__dirname + '/app/index.html');
});


server.listen(port, function() {
  console.log('Express server listening on port ' + port);
});

