var app = require('express')();
var http = require('http').Server(app);
var io = require('socket.io')(http);
var Redis = require('ioredis');
var redis = new Redis();


// redis.subscribe('test-channel', function(err, count) {
// });

redis.psubscribe('*', function(err, count) {
});

redis.on('pmessage', function(pattern, channel, message) {
    console.log('Message Recieved: ' + message);
    message = JSON.parse(message);
    io.emit(channel + ':' + message.event, message.data.message);

});
http.listen(6001, function(){
    console.log('Listening on Port 6001');
});