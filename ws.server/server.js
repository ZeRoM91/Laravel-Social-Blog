var app = require('http').createServer();
var io = require('socket.io')(6001);

// io.on('connection', connect);
//
//
// function connect(socket, user) {
//     console.log('Connetion is established! User ' + user + ' is joined to room');
// }
var i = 1;
io.on('connection', function(socket){

 console.log('A user connected!');

    // socket.emit('.user.message', function (data) {
    //     console.log('Push message: ' + data );
    // });
    // socket.on('.user.message', function (data) {
    //     console.log('Receive message: ' + data);
    // });

    socket.on('disconnect', function () {
        console.log('A user disconnected');
    });

});