var React = require('react');
module.exports = React.createClass({
	_handleClick: function () {
		console.log('console');
	},
	render: function () {
		return (
			<html>
			<head>
				<title>{this.props.title}</title>
				<link rel="stylesheet" href="/style.css"/>
			</head>
			<body>
				<div>
					<h1>{this.props.title}</h1>
					<button onClick={this._handleClick}>Click</button>
				</div>
				<script dangerouslySetInnerHTML={{
					__html: 'window.PROPS=' + JSON.stringify(this.props)
				}}/>
				<script src="/bundle.js"/>
			</body>
			</html>
		);
	}
});
