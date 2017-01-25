import axios from 'axios';
import {SERVER_JSON,REQUEST_REJECTED,REQUEST_PENDING} from '../../constants/CreateProjectConstants/action-types';

export function fetchJSON(type,pid){

	const ROOT_URL = `https://api.myjson.com/bins/`;

		let url=''; 
		if(pid === 55555)
			url= `${ROOT_URL}22bft`;
		else{
			if(pid !== ""){
			    url= `${ROOT_URL}16eyj`;

			}			
		}

		return function(dispatch){	
					axios.get(url)
						 .then(function(response){
								dispatch({
						 				type 				: SERVER_JSON,
		        						payload				: response.data,
		        						isTabValid  		: null,
		        						requestType			: type,
		        						pid 				: pid,
		        						staffingFormDisplay : 'close',
		        						selectedTab  		: 'basic_information',
		        						resetTabError       : 'true'
						 		})
						})
						.catch(function(error){
	   
	   							 dispatch({
	        							type: REQUEST_REJECTED,
	        							error: error
	    						})
    		
    					});

			}
	

	return {type: REQUEST_PENDING};


}
