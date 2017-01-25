import {UPDATED_USER_SELECTED_DATA} from '../../constants/CreateProjectConstants/action-types';

export function updateSecondListBuffer(firstListBuffer){
	
	return {
		type: UPDATED_USER_SELECTED_DATA,
		payload : firstListBuffer
	}
}