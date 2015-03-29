var fs = require('fs'),
    http = require('http'),
    sio = require('socket.io'),
    PGPubsub = require('pg-pubsub'),
    pubsubInstance = new PGPubsub('postgres://postgres:justgoon@192.168.0.10:5432/pacsdb');

var server = http.createServer(function(req, res) {});
server.listen(6969, function() {
    console.log('Server Listen on port 6969!');
});
io = sio.listen(server);


var messages = [];

io.sockets.on('connection', function(socket) {
    pubsubInstance.addChannel('notify_me_study', function(channelPayload) {
    	console.log(channelPayload);
        socket.send(channelPayload); // envia solo una vez a los usuarios conectados!
    });

});
