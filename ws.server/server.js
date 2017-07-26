var app = require('http').createServer();
var io = require('socket.io')(6001);


io.on('connection', function(socket){

 console.log('A user connected!');

    socket.on('disconnect', function () {
        console.log('A user disconnected');
    });

});