var app = require('http').createServer();
var io = require('socket.io')(6001);

// io.on('connection', connect);
//
//
// function connect(socket, user) {
//     console.log('Connetion is established! User ' + user + ' is joined to room');
// }

io.on('connection', function(socket){
    console.log('User is connected to chat');

    // var onevent = socket.onevent;
    // socket.onevent = function (packet) {
    //     var args = packet.data || [];
    //     onevent.call (this, packet);    // original call
    //     packet.data = ["*"].concat(args);
    //     onevent.call(this, packet);      // additional call to catch-all
    // };

    // socket.on('*', function(data) { console.log(data); });

    socket.on('user.message', function(event, data){
        console.log(event);
        console.log(data);
      //  io.emit('user.private.' + data.user_to_id, data);
        io.emit('user.private' + data);
    });
});