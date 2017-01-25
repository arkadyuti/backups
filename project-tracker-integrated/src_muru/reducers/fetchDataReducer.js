import * as types from '../actions/ActionTypes.js';


export default function fetchDataReducer (state=[], action) {
	switch (action.type) {
		case types.FETCH_SKILL: 
			return [...state,Object.assign({},{ fetching: true})];
			
		
		case types.FETCH_SKILL_FAILURE:
			return [...state,Object.assign({},{fetching: false, error: action.skills })];
		
		
		
		case types.FETCH_SKILL_SUCCESS:
			return [...state,Object.assign({},action.skills)];
		

		default:
			return state;
	}				
}