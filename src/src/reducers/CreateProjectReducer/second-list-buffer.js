import { SECONDLIST_TRACKER,USER_SELECTED_DATA,UPDATED_USER_SELECTED_DATA,USER_EDIT_PRESELECTED_DATA } from '../../constants/CreateProjectConstants/action-types';

const secondListTracker = 
                          	{
                          			"frameworks":[],
                           			"buildtool":[],
                            		"testframework":[]
                            }
                     

export default function(state = secondListTracker,action){

	switch(action.type){

		case SECONDLIST_TRACKER:

			return  Object.assign({}, state, {[action.key] : action.payload})


    case USER_SELECTED_DATA:

          	return Object.assign({},state,action.payload)

    case UPDATED_USER_SELECTED_DATA:

            return Object.assign({},state,action.payload)

    case USER_EDIT_PRESELECTED_DATA:

            return Object.assign({},state,action.payload)
       
	}
	return state
}
