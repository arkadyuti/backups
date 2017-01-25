import * as types from '../../../constants/Dashboard/skillBasedChart/action-types.js';

//Reducers
export default function skillBasedChartReducer (state={fetching:true}, action) {
	
	switch (action.type) {
		case types.FETCH_SKILL: 
			return Object.assign({},state,{fetching:true});
			
		case types.FETCH_SKILL_FAILURE:
			return Object.assign({},state,{fetching:false});
		
		case types.FETCH_SKILL_SUCCESS:
			return [...state,Object.assign({},action.skills)];
		
		default:
			return state;
	}				
}