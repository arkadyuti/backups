var innerRadius = 50;

import { STATUS_INNERRADIUS } from '../../../constants/ActionTypes';

export default function (state=innerRadius, action) {
	
	switch(action.type) {
		case STATUS_INNERRADIUS: 
		return action.payload
	} // this is a dummy case for future use.
	
	return state;
}