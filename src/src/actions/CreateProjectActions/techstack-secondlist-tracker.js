import {SECONDLIST_TRACKER} from '../../constants/CreateProjectConstants/action-types';

export function secondListTracker(key,secondListSelectedArrayLocal){
	

	return {
		type: SECONDLIST_TRACKER,
		key: key,
		payload : secondListSelectedArrayLocal
	}
}