var router = require('express').Router();
var React = require('react');
var ReactDOMServer = require('react-dom/server');
var ReactRouter = require('react-router');

router.get('/', function (req, res) {
	var props = {title : 'Server'}
	ReactRouter.match({
		routes: require('./routes.jsx'),
		location: req.url
	}, function (error, redirectLocation, renderProps) {
		if(renderProps){
			var html = ReactDOMServer.renderToString(
				<ReactRouter.RouterContext {...renderProps} 
					createElement = {function (Compomemt, renderProps) {
						return <Compomemt {...renderProps} custom={props} />
					}}/>
				
			);
			res.send(html);
		} else {
			response.status(404).send("not found")
		}
	})
	
});
module.exports = router;