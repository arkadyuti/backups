import { SERVER_JSON,NULLIFY_REQUEST_TYPE } from '../../constants/CreateProjectConstants/action-types';

const requestType = {

						type : "",
						pid  : ""
					}


export default function(state = requestType,action){

	switch(action.type){

	case SERVER_JSON:
			return Object.assign({},state,{
											type 		: action.requestType,
											pid  		: action.pid})

	case NULLIFY_REQUEST_TYPE:
			return Object.assign({},state,{
											type 		: "",
											pid  		: ""})
	}
	return state
}
