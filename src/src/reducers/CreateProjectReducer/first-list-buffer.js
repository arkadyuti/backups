import { FIRSTLIST_TRACKER,EMPTYING_FIRSTLIST_BUFFER } from '../../constants/CreateProjectConstants/action-types';

const firstListTracker = 
                          	{
                          			"frameworks":[],
                           			"buildtool":[],
                            		"testframework":[]
                            }
                     

export default function(state = firstListTracker,action){


	switch(action.type){
		case FIRSTLIST_TRACKER:

			return  Object.assign({}, state,{[action.key] : action.payload})
			
		case EMPTYING_FIRSTLIST_BUFFER:

			return  Object.assign({},state,action.payload)
	}
	return state
}

