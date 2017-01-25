import {STAFFING_FORM_DISPLAY} from '../../constants/CreateProjectConstants/action-types';

export function staffingFormDisplay(value){
	
	return {
		type: STAFFING_FORM_DISPLAY,
		payload : value,
		resetTabError : 'true'

	}
}