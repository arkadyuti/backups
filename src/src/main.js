import React from 'react';
import { Root } from './containers/Root';
import ReactDOM, {render} from 'react-dom';
import { Router, Route, Link, browserHistory,IndexRoute} from 'react-router';
import Dashboard from './components/Dashboard/layout.js';
import Reports from './components/reports';
import Layout from './containers/Layout/index'
import './components/Layout/layout.scss';
import {createStore, applyMiddleware} from 'redux';
import {Provider} from 'react-redux';
import rootReducer from './reducers';
import logger from 'redux-logger';
import thunk from 'redux-thunk';
import axios from 'axios';
import {configureStore} from './store/configureStore';
import TabViewContainer from './containers/TabViewContainer/index';
import TabCreateContainer from './containers/TabCreateContainer/index';
import TabEditContainer from './containers/TabEditContainer/index';
import App from './components/ProjectListApp/app.js';
import RedStatusApp from './components/RedStatusApp/index.js'
import EditView from './components/editView.js';
import OpenNeedsApp from './components/OpenNeedsApp/index.js';
import LoginContainer from './containers/login-container';
import { authTransition } from './utility';
const store=configureStore();

render(

	<Provider store={store}>

	<Router history = {browserHistory}>
		<Route path="/" component={LoginContainer} onEnter={authTransition}/> 
		<Route path='Dashboard' component={Layout}> 
			<IndexRoute component={Dashboard} />
			<Route path= '/project-list' component= {App}  />
			<Route path='/open-needs' component={OpenNeedsApp} />
			<Route path='/red-status' component={RedStatusApp} />
			<Route path= '/create-project' component= {TabCreateContainer}/>
			<Route path= '/Reports' component={Reports} />
			<Route path= "/projects/view/:pid" component= {TabViewContainer}/>
			<Route path= "/projects/edit/:pid" component= {TabEditContainer}/>
		</Route>
	</Router>
	</Provider>,
	document.getElementById('container')
	);