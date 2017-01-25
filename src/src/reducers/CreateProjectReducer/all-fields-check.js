import { ALL_FILLED } from '../../constants/CreateProjectConstants/action-types';

export default function(state = 'false',action){

	switch(action.type){
		case ALL_FILLED :
			return action.payload
        case 'TAB_SELECTED':
            return  action.disableButton    

	}
	return state
}