/*var express = require('express');
var http = require('http');
var path = require('path');
var bodyParser = require('body-parser');
var mongoose = require('mongoose');

var app = express();

app.set('port', process.env.PORT || 3000);
app.set('views', __dirname + '/views');
app.set('view engine', 'jade');

// app.use(bodyParser.bodyParser());
// app.use(express.methodOverride());
// app.use(app.router);
app.get('/', function (req, res) {
  console.log(admin.mountpath); // /admin
  res.send(express.static(path.join(__dirname,'public')));
});
// app.use();

mongoose.connect('mongodb://localhost/Company');

var Schema = new mongoose.Schema({
	_id: String,
	name: String,
	age: String
});

var user = mongoose.model('emp', Schema);

var server = http.createServer(app).listen(app.get('port'), function () {
	console.log('express listening on port' + app.get('port'));
})*/
var express = require('express');
var app = express();


var mongoose = require('mongoose');
mongoose.connect('mongodb://127.0.0.1:27017/test');

var mongoose = require('mongoose');

var db = mongoose.connection;

db.on('error', console.error);
db.once('open', function() {
  console.log("Database");
});

var schema = mongoose.Schema({ name: String });
var Cat = db.model('table', schema);

var kitty = new Cat({ name: 'cat11' });
kitty.save(function (err) {
  if (err) // ...
  console.log('meow');
});


app.get('/', function (req, res) {
  res.send('Hello World!');
});

app.listen(3000, function () {
  console.log('Example app listening on port 3000!');
});