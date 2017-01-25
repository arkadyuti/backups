import {NULLIFY_REQUEST_TYPE} from '../../constants/CreateProjectConstants/action-types';

export function nullifyRequestType(data){
	return {
		type: NULLIFY_REQUEST_TYPE,
		payload : data
	}
}