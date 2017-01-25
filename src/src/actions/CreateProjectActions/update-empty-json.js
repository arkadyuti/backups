import {UPDATE_JSON} from '../../constants/CreateProjectConstants/action-types';

export function updateUserInput(value,key){
	return {
		type: UPDATE_JSON,
		payload : {[key]:value},

	}
}