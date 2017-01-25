export function dataValidated(errorfree) {
	return {
		type: 'DATA_VALIDATED',
		errorfree:errorfree	
	};
}

export function validUserId(validUserData,userIdData){
	return{
		type: 'VALID_USER_ID',
		validUserData:validUserData,
		userIdData:userIdData
	};
}

export function validPassword(validPassData,passwordData){
	return{
		type: 'VALID_PASSWORD',
		validPassData:validPassData,
		passwordData:passwordData
	};
}

export function resetState(){
	return {
		type: 'RESET'
	}
}