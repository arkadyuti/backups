import {EMPTYING_FIRSTLIST_BUFFER} from '../../constants/CreateProjectConstants/action-types';

export function resetFirstListBuffer(emptyObject){
	return {
		type: EMPTYING_FIRSTLIST_BUFFER,
		payload : emptyObject
	}
}