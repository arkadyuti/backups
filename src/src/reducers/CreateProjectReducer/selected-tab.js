import { TAB_SELECTED,SERVER_JSON } from '../../constants/CreateProjectConstants/action-types';

export default function(state = "basic_information",action){

	switch(action.type){
		case TAB_SELECTED:
			return action.payload;

	   	case SERVER_JSON:
			return action.selectedTab;
	}
	return state;
}