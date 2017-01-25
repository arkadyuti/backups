var outerRadius = 66;

import { STATUS_OUTERRADIUS } from '../../../constants/ActionTypes';

export default function (state=outerRadius, action) {
	
	switch(action.type) {
		case STATUS_OUTERRADIUS: 
		return action.payload
	} // this is a dummy case for future use.
	
	return state;
}