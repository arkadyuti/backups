import {NEXT_CLICKED} from '../../constants/CreateProjectConstants/action-types';

export function nextClick(validState){
	return {
		type: NEXT_CLICKED,
		payload : validState,
	    disableButton : 'false'
	}
}