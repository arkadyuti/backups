import {USER_EDIT_PRESELECTED_DATA} from '../../constants/CreateProjectConstants/action-types';

export function resetSecondListBuffer(preselectedData){
	return {
		type: USER_EDIT_PRESELECTED_DATA,
		payload : preselectedData
	}
}