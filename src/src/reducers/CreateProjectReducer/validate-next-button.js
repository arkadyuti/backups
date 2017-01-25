import { NEXT_CLICKED,TAB_SELECTED,STAFFING_EMP_UPDATED_EMPTYJSON,STAFFING_FORM_DISPLAY,SERVER_JSON } from '../../constants/CreateProjectConstants/action-types';

export default function(state = null,action){

	switch(action.type){
		case NEXT_CLICKED:
			return action.payload;
		case TAB_SELECTED:
			return action.resetTabError;
		case STAFFING_EMP_UPDATED_EMPTYJSON:
			return action.resetTabError;
		case STAFFING_FORM_DISPLAY:
            return action.resetTabError;    
        case SERVER_JSON:
        	return action.resetTabError;        
				
	}
	return state;
}