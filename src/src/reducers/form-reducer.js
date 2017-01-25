//reducer
export default function formReducer(state={ errorfree : false, data: {}}, action){
	switch(action.type){
		case 'DATA_VALIDATED':
			return Object.assign({},state,{errorfree:action.errorfree});
		case 'VALID_USER_ID':	
			return Object.assign({},state,{validUserData:action.validUserData, userIdData:action.userIdData});        
		case 'VALID_PASSWORD':	
			return Object.assign({},state,{validPassData:action.validPassData, passwordData:action.passwordData});
		case 'RESET': 
			return state={ errorfree : false, data: {}};               
		default: return state;

	}
	return state;
}