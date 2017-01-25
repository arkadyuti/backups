import axios from 'axios';

export function fetchStatusData() {


  return function(dispatch){
    axios.get("http://localhost:3000/status")
      .then(
        (response)=>{
       		dispatch({type:"STATUS_CHART",
         	payload : response.data,
        	})

        });


	// const request = axios.get("http://10.150.238.56:3000/status")

	// return {
	// 	type:"STATUS_CHART",
	// 	payload:request
	// }
}
}