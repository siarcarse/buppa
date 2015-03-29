/*var pg = require ('pg');

var pgConString = 'postgres://postgres:justgoon@localhost:5432/bioris';

pg.connect(pgConString, function(err, client) {
  if(err) {
    console.log(err);
  }
  client.on('notification', function(msg) {
    console.log(msg);
  });
  var query = client.query("LISTEN notify_me");
});*/
var PGPubsub = require('pg-pubsub');

var pubsubInstance = new PGPubsub('postgres://postgres:justgoon@192.168.0.10:5432/pacsdb');

pubsubInstance.addChannel('notify_me_study', function (channelPayload) {
  console.log(channelPayload);
});
