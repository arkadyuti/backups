// Here, state argument is not application state,
// only the state this reducer is responsible for.
import {STATUS_CHART_DATA_FAILED ,  STATUS_CHART } from '../../../constants/Dashboard/statusChart/action-types';

export default function (state={data:null , status :"waiting"}, action) {
	
	switch(action.type) {
		case STATUS_CHART: 
		return Object.assign({},state,{data:action.payload, status:action.status})

		case STATUS_CHART_DATA_FAILED:
			return Object.assign({},state,{error:action.error, status:action.status})
	}

	return state;
}