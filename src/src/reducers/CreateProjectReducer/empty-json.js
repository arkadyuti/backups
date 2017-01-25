import { UPDATE_JSON,UPDATE_JSON_STAFFING,USER_SELECTED_DATA,USER_RESELECTED_DATA,
         STAFFING_EMP_UPDATED_EMPTYJSON,SERVER_JSON } from '../../constants/CreateProjectConstants/action-types';

export default function(state = null,action){

   switch(action.type){
      case UPDATE_JSON:
         return Object.assign({}, state, action.payload);
       
      case UPDATE_JSON_STAFFING:
         return Object.assign({},state,{
            ...state,
            staffing_details: handleStaffingUpdates(state,action.key,action.payload)
            })

      case USER_SELECTED_DATA:
         return Object.assign({},state,{

            ...state,
            techstack:action.payload
         })

        case USER_RESELECTED_DATA:
         return Object.assign({},state,{

            ...state,
            techstack:action.payload
         })         
       
      case STAFFING_EMP_UPDATED_EMPTYJSON:
         return Object.assign({},state,{

            ...state,

            staffing_details: pushStaffingUpdates(state,action.payload)
         })
       

       case SERVER_JSON:

         return Object.assign({},state,action.payload); 
   }

   return state;
}


function handleStaffingUpdates(state,key,payload){
   state.staffing_details[key] = payload;
   return  state.staffing_details;
}

function pushStaffingUpdates(state,payload){
   state.staffing_details.push(payload)
   return state.staffing_details
}