import axios from 'axios'
import { Request_FULFILLED_RED_STATUS,Request_REJECTED_RED_STATUS,Request_PENDING_RED_STATUS } from '../../constants/RedStatusConstants/columns-displayed';
import { URL_RED_STATUS } from '../../constants/project-list-urls';
import getCookie from '../../utility';

export default function fetchData(pageSize){
	var token = getCookie('x-access-token');
	
	return function(dispatch){
		//AJAX call to fetch red status data
		axios.get('https://api.myjson.com/bins/3lm3p')
		.then(function (response) {	
		    // Dispatch the success action with the payload
		    let displayData = []
			response.data.data.map((data,index) => {
				if (data.p_status == "RED") {
					displayData.push(data)
				}
			})
    		dispatch({
		        type: Request_FULFILLED_RED_STATUS,
		        payload: displayData
        	})
    	}.bind(this))
	  	.catch(function (error) {
	    // Dispatch the error action with error information
		    dispatch({
		        type: Request_REJECTED_RED_STATUS,
		        error: error
		    })
    	});
	}

	return {type: Request_PENDING_RED_STATUS};

}


