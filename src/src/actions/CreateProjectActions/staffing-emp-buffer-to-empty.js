import {STAFFING_EMP_UPDATED_EMPTYJSON} from '../../constants/CreateProjectConstants/action-types';

export function updateEmpBufferToEmptyJson(EmployeeDetailsBuffer){
	
	return {
		type: STAFFING_EMP_UPDATED_EMPTYJSON,
		payload : EmployeeDetailsBuffer,
		resetTabError : 'true'
	}
}