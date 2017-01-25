import {FIRSTLIST_TRACKER} from '../../constants/CreateProjectConstants/action-types';

export function firstListTracker(key,selectedArrayLocal){
	
	return {
		type: FIRSTLIST_TRACKER,
		key: key,
		payload : selectedArrayLocal
	}
}