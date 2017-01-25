require('babel-register')({
	presets: ['react']
});

var express = require('express');
var app = express();

app.use(express.static('public'));
app.use(require('./routes/index.jsx'));

var PORT = 4000;
app.listen(PORT, function () {
	console.log(PORT);
})