// Here, state argument is not application state,
// only the state this reducer is responsible for.
import { STATUS_CHART } from '../../../constants/Dashboard/Status-chart/ActionTypes';

export default function (state=null, action) {
	
	switch(action.type) {
		case STATUS_CHART: 
		return action.payload
	}
	return state;
}