import {checkboxOptions,SEARCH_RED_STATUS,Request_FULFILLED_RED_STATUS,Request_REJECTED_RED_STATUS,Request_PENDING_RED_STATUS,RESET_RED_STATUS} from '../../constants/RedStatusConstants/columns-displayed';
export default function redStatusReducer(
    state ={
        projects: null,
        inProgress: true,
        error: null,
        columns:[{value:'pid', label:'PID'},
            {value:'p_name',label:'Project'},
            {value:'scg',label:'SCG'},
            {value:'location',label:'Location'}],
        searchKey:null,
        searchValue:{"pid":"","p_name":"","scg":"","location":""},
        searchedData:[],
    }, action)
{  
    switch(action.type) {
        
        //Reducer when AJAX call has not been completed
        case Request_PENDING_RED_STATUS:{
            return Object.assign({},state,{
                inProgress: true,
                error: false}
            );
        }

        //Reducer for successful AJAX call
        case Request_FULFILLED_RED_STATUS:{
            return Object.assign({},state,{
                projects: action.payload,
                searchedData:action.payload,
                inProgress: false}
            );
        }

        //Reducer for unsuccessful AJAX call
        case Request_REJECTED_RED_STATUS:{
            return Object.assign({},state,{
                inProgress: false,
                error: action.error}
            );
        }

        //Reducer for search function
        case SEARCH_RED_STATUS:{
            return  Object.assign({}, state,{
                searchKey:action.key,
                searchValue:action.searchValue,
                searchedData:action.data
            });
        }

        //Reducer for resetting data
        case RESET_RED_STATUS:{
            return Object.assign({},state,{
                inProgress: true
            })
        }
        
        default:
            return state
    }
}