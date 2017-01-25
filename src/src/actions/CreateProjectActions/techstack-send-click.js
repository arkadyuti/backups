import {USER_RESELECTED_DATA} from '../../constants/CreateProjectConstants/action-types';

export function sendClick(reselectedData){
	return {
		type: USER_RESELECTED_DATA,
		payload : reselectedData
	}
}