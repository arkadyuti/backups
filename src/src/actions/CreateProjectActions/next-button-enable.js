import {ALL_FILLED} from '../../constants/CreateProjectConstants/action-types';

export function nextButtonActive(allFieldsFilled){
	return {
		type: ALL_FILLED,
		payload : allFieldsFilled
	}
}