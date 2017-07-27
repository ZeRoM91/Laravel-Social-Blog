var app = require('express')();
var http = require('http').Server(app);
var io = require('socket.io')(http);
var Redis = require('ioredis');
var redis = new Redis();


// redis.subscribe('message', function(err, count) {
// });

redis.psubscribe('*', function(err, count) {
});

redis.on("pmessage", function(pattern, channel, data) {
    console.log('Message Recieved: ' + data);
    data = JSON.parse(data);
    io.emit(channel + ':' + data.message);

});


http.listen(6001, function(){
    console.log('Listening on Port 6001');
});