import React from 'react';
import ReactDOM from 'react-dom';
import {Provider} from 'react-redux';

import {configureStore} from './store/configureStore';

import App from './components/App'

const store=configureStore();

ReactDOM.render(
	<Provider store={store}>
		<App initialData = {window.initialData}/>
	</Provider>,
	document.getElementById("root")
)
