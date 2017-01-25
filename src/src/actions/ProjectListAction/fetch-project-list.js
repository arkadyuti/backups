import axios from 'axios'
import { Request_PENDING, Request_FULFILLED, Request_REJECTED} from '../../constants/ProjectListConstants/action-types';
import { URL_PROJECT_LIST } from '../../constants/project-list-urls';
import getCookie from '../../utility'

export default function fetchData(pageSize){
	var token = getCookie('x-access-token');

	var config = {
		"headers":{"x-access-token": token }
	} 
		//AJAX call to fetch project list data
	
		//AJAX call to fetch project list data
	return function(dispatch){
		axios.get('https://api.myjson.com/bins/3lm3p')
		.then(function (response) {	
		    // Dispatch the success action with the payload
    		dispatch({
		        type: Request_FULFILLED,
		        payload: response.data.data
        	})
    	}.bind(this))
	  	.catch(function (error) {
	    // Dispatch the error action with error information
		    dispatch({
		        type: Request_REJECTED,
		        error: error
		    })
    	});
	}

	return {type: Request_PENDING};

}