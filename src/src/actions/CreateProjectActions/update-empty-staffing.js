import {UPDATE_JSON_STAFFING} from '../../constants/CreateProjectConstants/action-types';

export function updateUserInputStaffing(value,key){

	return {
		type: UPDATE_JSON_STAFFING,
		key:key,
		payload : value

	}
}