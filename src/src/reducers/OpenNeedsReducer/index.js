import { SEARCH_OPEN_NEEDS,Request_FULFILLED_OPEN_NEEDS,HANDLE_CLICK_OPEN_NEEDS,Request_REJECTED_OPEN_NEEDS,Request_PENDING_OPEN_NEEDS,RESET_OPEN_NEEDS } from '../../constants/OpenNeedsConstants/action-types';
export default function openNeedsReducer(
    state ={
        projects: null,
        inProgress: true,
        error: null,
        columns:[{value:'pid', label:'PID'},
            {value:'p_manager',label:'Project Manager'},
            {value:'p_name',label:'Project'},
            {value:'p_platform',label:'Primary Capacity'},
            {value:'start_date',label:'Start-Date'},
            {value:'p_techstack',label:'Tech Stack'},
            {value:'fe_lead_name',label:'Lead Name'},
            {value:'openneeds',label:'Open Needs'}],
        key:"",
        searchKey:null,
        searchValue:{"pid":"","p_manager":"","p_name":"","p_platform":"","start_date":"","p_techstack":"","fe_lead_name":"","openneeds":""},
        currentPage:1,
        pageSize:10,
        pagers:[{id:"currentPage", link:1},{id:"nextPage", link:2},{id:"lastPage", link:'>'}],
        topics:[ ], 
        token:0,
        count: 1,
        searchedData:[]
    }, action)
{  
    switch(action.type) {
        
        //Reducer when AJAX call has not been completed
        case Request_PENDING_OPEN_NEEDS:{
            return Object.assign({},state,{
                inProgress: true,
                error: false}
            );
        }

        //Reducer for successful AJAX call
        case Request_FULFILLED_OPEN_NEEDS:{
            return Object.assign({},state,{
                projects: action.payload,
                searchedData:action.payload,
                pagers:action.pagers,
                inProgress: false}
            );
        }

        //Reducer for unsuccessful AJAX call
        case Request_REJECTED_OPEN_NEEDS:{
            return Object.assign({},state,{
                inProgress: false,
                error: action.error}
            );
        }

        //Reducer for search function
        case SEARCH_OPEN_NEEDS:{
            return  Object.assign({}, state,{
                searchKey:action.key,
                searchValue:action.searchValue,
                searchedData:action.data,
                currentPage:1,
                topics:action.newTopics,
                token:0,
                pagers:action.newPagerLinks});
        }

        //Reducer for changing the page
        case HANDLE_CLICK_OPEN_NEEDS:{
            return Object.assign({}, state,{
                currentPage:action.page,
                pagers:action.links,
                topics:action.topics,
                token:action.token,
                count:action.count}
            );
        }
        
        //Reducer for resetting data
        case RESET_OPEN_NEEDS:{
            return Object.assign({},state,{
                inProgress: true
            })
        }
        
        default:
            return state
    }
}