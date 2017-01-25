import { STAFFING_FORM_DISPLAY,SERVER_JSON,TAB_SELECTED } from '../../constants/CreateProjectConstants/action-types';

export default function(state = "false",action){

	switch(action.type){
		case STAFFING_FORM_DISPLAY:
			return action.payload;
	
		case SERVER_JSON:
			return action.staffingFormDisplay;

		case TAB_SELECTED:
			return action.staffingFormDisplay;				
					
	}
	return state;
}