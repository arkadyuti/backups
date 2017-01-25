var Radius;
Radius = {
    innerRadius: 45,
    outerRadius: 66
};

import { STATUS_RADIUS } from '../../../constants/Dashboard/statusChart/action-types';

export default function (state = Radius, action) {
	
	switch(action.type) {
		case STATUS_RADIUS:
		return action.payload
	} // this is a dummy case for future use.
	
	return state;
}