'use strict';

var _react = require('react');

var _react2 = _interopRequireDefault(_react);

var _Root = require('./containers/Root');

var _reactDom = require('react-dom');

var _reactDom2 = _interopRequireDefault(_reactDom);

var _reactRouter = require('react-router');

var _SidePanel = require('./containers/SidePanel.js');

var _dashboard = require('./components/Dashboard');

var _dashboard2 = _interopRequireDefault(_dashboard);

var _reports = require('./components/reports');

var _reports2 = _interopRequireDefault(_reports);

var _tab = require('./components/tab');

var _tab2 = _interopRequireDefault(_tab);

var _Layout = require('./containers/Layout');

var _Layout2 = _interopRequireDefault(_Layout);

require('./components/Layout/layout.scss');

var _redux = require('redux');

var _reactRedux = require('react-redux');

var _reduxLogger = require('redux-logger');

var _reduxLogger2 = _interopRequireDefault(_reduxLogger);

var _reduxThunk = require('redux-thunk');

var _reduxThunk2 = _interopRequireDefault(_reduxThunk);

var _axios = require('axios');

var _axios2 = _interopRequireDefault(_axios);

var _configureStore = require('./store/configureStore');

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var store = (0, _configureStore.configureStore)();
/*const middleware=applyMiddleware(thunk,logger());
const store=createStore(reducer,middleware);*/
store.dispatch(function (dispatch) {

	_axios2.default.get('./JSON/headerData.json').then(function (headerResponse) {
		dispatch({ type: "FETCH_USERS_HEADER", headerData: headerResponse.data });
	}).catch(function (err) {
		console.log(err);
	});
	_axios2.default.get('./JSON/sidePanel.json').then(function (sideNavresponse) {
		console.log(sideNavresponse.data);
		dispatch({ type: "FETCH_USERS_SIDENAV", sideNavdata: sideNavresponse.data });
	}).catch(function (err) {
		console.log(err);
	});
});

(0, _reactDom.render)(_react2.default.createElement(
	_reactRedux.Provider,
	{ store: store },
	_react2.default.createElement(
		_reactRouter.Router,
		{ history: _reactRouter.browserHistory },
		_react2.default.createElement(
			_reactRouter.Route,
			{ path: '/', component: _Layout2.default },
			_react2.default.createElement(_reactRouter.Route, { path: '/Dashboard', component: _dashboard2.default }),
			_react2.default.createElement(_reactRouter.Route, { path: '/Create Project', component: _tab2.default }),
			_react2.default.createElement(_reactRouter.Route, { path: '/Reports', component: _reports2.default })
		)
	)
), document.getElementById('container'));
