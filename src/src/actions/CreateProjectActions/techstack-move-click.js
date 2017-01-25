import {USER_SELECTED_DATA} from '../../constants/CreateProjectConstants/action-types';

export function moveClick(firstListBuffer){
	
	return {
		type: USER_SELECTED_DATA,
		payload : firstListBuffer
	}
}