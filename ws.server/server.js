var io = require('socket.io')(6001);

io.on('connection', function (socket) {
    console.log('New conenction');
});
