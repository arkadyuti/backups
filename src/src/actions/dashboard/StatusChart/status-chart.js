import axios from 'axios';
import {STATUS_CHART_DATA_FAILED, STATUS_CHART } from '../../../constants/Dashboard/statusChart/action-types';
import {URL_STATUS_CHART} from '../../../constants/Dashboard/url/index.js';

export function fetchStatusData() {
  
  return function(dispatch){
    axios.get(URL_STATUS_CHART)
      .then(
        (response)=>{
       		dispatch({type:STATUS_CHART,
         	payload : response.data.status,
                status:"success"
        	})

        }).catch(function(error){

        dispatch({
            type: STATUS_CHART_DATA_FAILED,
            error: error,
            status:"failed"
        })
    });


  }
}