var app = require('express')();
var http = require('http').Server(app);
var io = require('socket.io')(http);
var Redis = require('ioredis');
var redis = new Redis();

redis.subscribe('new-friend', function(err, count) {
});
redis.subscribe('new-message', function(err, count) {
});
redis.subscribe('new-here', function(err, count) {
});
redis.subscribe('new-article', function(err, count) {
});
redis.subscribe('user.private', function(err, count) {
});

// redis.subscribe('user.private.${id}', function(err, count) {
// });



redis.on('message', function(channel, message) {
    console.log('alert: ' + message);
    message = JSON.parse(message);
    io.emit(channel + ':' + message.event, message.data);
});
http.listen(3000, function(){
    console.log('Listening on Port 3000');
});
