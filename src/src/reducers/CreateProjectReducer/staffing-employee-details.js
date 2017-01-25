import { STAFFING_EMPLOYEE_DETAILS } from '../../constants/CreateProjectConstants/action-types';

const EmployeeDetailsTracker = 
                          	{  
						        "oid":"",
						        "name":"",
						        "title":"",
						        "role":"",
						        "alloc_percent":"",
						        "start_date":"to be given",
						        "end_date":" to be given",
						        "skills":"",
						        "morale_code":"1",
						        "morale":"good"
						    }
                     

export default function(state = EmployeeDetailsTracker,action){


	switch(action.type){
		case STAFFING_EMPLOYEE_DETAILS:

			return  Object.assign({}, state,{[action.key] : action.payload})
	}
	return state
}
