import { Request_PENDING, Request_FULFILLED, Request_REJECTED,HANDLE_CLICK ,INITIALISE_PAGINATION,SEARCH,CHANGE_PER_PAGE,SORTING,RESET_PROJECT_LIST,UPDATE_PID} from '../../constants/ProjectListConstants/action-types';
export default function projectsDataReducer(
    state ={
        projects:null,
        inProgress: true,
        error: false,
        key:"p_name",
        toggleFilter: {"pid":true,"p_name":true,"scg":true,"location":true,"p_status":true,"p_techstack":true},
        searchKey:null,
        searchValue:{"pid":"","p_name":"","scg":"","location":"","p_status":"","p_techstack":""},
        currentPage:1,
        pageSize:10,
        topics:[], 
        numPages:0,
        actionPerformed:0,
        pageValue: 1,
        perPageValues:[10,20,30,40,50,60,70,80],
        searchedData:[],
        pid: null
    }, action)
{  
    switch(action.type) {
        
        //Reducer when AJAX call has not been completed
        case Request_PENDING:{
            return Object.assign({},state,{
                inProgress: true
                }
            );
        }

        //Reducer for successful AJAX call
        case Request_FULFILLED:{
            return Object.assign({},state,{
                projects: action.payload,
                searchedData:action.payload,
                inProgress: false}
            );
        }

        //Reducer for unsuccessful AJAX call
        case Request_REJECTED:{
            return Object.assign({},state,{
                inProgress: false,
                error: true}
            );
        }

        //Reducer for sort function
        case SORTING:{
            return Object.assign({},state,{
                key:action.key,
                toggleFilter: action.toggleFilter,
                searchedData:action.data,
                actionPerformed:1,
                topics:action.topics}
            );
        }

        //Reducer for search function
        case SEARCH:{
            return  Object.assign({}, state,{
                searchKey:action.key,
                searchValue:action.searchValue,
                searchedData:action.data,
                currentPage:1,
                topics:action.newTopics,
                actionPerformed:0
            });
        }

        //Reducer for changing the page
        case HANDLE_CLICK:{
            return Object.assign({}, state,{
                currentPage:action.page,
                topics:action.topics,
                actionPerformed:action.actionPerformed,
                pageValue:action.pageValue}
            );
        }
        
        //Reducer for changing the content per-page
        case CHANGE_PER_PAGE:{
            return Object.assign({}, state,{
                pageSize:action.perPage,
                actionPerformed:action.actionPerformed,
                currentPage:1,
                pageValue:1
            }
            );
        }

        //Reducer for resetting data
        case RESET_PROJECT_LIST:{
            return Object.assign({},state,{
                inProgress: true
            })
        }
        case UPDATE_PID:{
            return Object.assign({},state,{
                pid:action.pid
            })
        }
        default:
            return state
    }
}