import logger from 'redux-logger';
import {createStore, applyMiddleware} from 'redux';
import rootReducer from '../reducers/index.js';
import thunk from 'redux-thunk';

/*export default function configureStore(){
	return createStore(
		rootReducer,
		applyMiddleware(thunk,createLogger)
	);
}*/

/*const middleware = applyMiddleware( thunk, logger());

export default createStore(rootReducer, middleware);*/

export default function configureStore(initialState){
	return createStore(
		rootReducer,
		initialState,
		applyMiddleware(thunk,logger())
		);
}