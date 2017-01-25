import axios from 'axios';
import { Request_FULFILLED_OPEN_NEEDS,Request_REJECTED_OPEN_NEEDS,Request_PENDING_OPEN_NEEDS} from '../../constants/OpenNeedsConstants/action-types';
import { URL_OPEN_NEEDS } from '../../constants/project-list-urls';
import getCookie from '../../utility';

export default function fetchData(pageSize){
	var token = getCookie('x-access-token');

	return function(dispatch){
		//AJAX call to fetch open needs data
		axios.get('https://api.myjson.com/bins/3lm3p')
		.then(function (response) {	
		    // Dispatch the success action with the payload
    			dispatch({
		        type: Request_FULFILLED_OPEN_NEEDS,
		        payload: response.data.openNeeds
        	})
    	}.bind(this))
	  	.catch(function (error) {
	    // Dispatch the error action with error information
		    dispatch({
		        type: Request_REJECTED_OPEN_NEEDS,
		        error: error
		    })
    	});
	}
	
	return {type: Request_PENDING_OPEN_NEEDS};

}