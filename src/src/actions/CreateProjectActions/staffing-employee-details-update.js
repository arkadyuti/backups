import {STAFFING_EMPLOYEE_DETAILS} from '../../constants/CreateProjectConstants/action-types';

export function staffingEmployeeDetailUpdate(key,value){
	
	return {
		type: STAFFING_EMPLOYEE_DETAILS,
		key: key,
		payload : value
	}
}