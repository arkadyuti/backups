//Actions
//Action to open the side panel in mobile view
import axios from 'axios';
import getCookie from '../utility.js';
import {OPENED,CLOSED,CLICKED,FETCH_USERS_HEADER,FETCH_USERS_SIDENAV} from '../constants/GlobalComponents/action-types';
import {HEADER_DATA,SIDEPANEL_DATA } from '../constants/GlobalComponents/global-components-urls';

export function handleOpen(){
	return{
		type:OPENED
	}
}
//Action to close the side panel in mobile view
export function handleClose(){
	return {
		type:CLOSED
	}
}
export function handleClick(filter){
	return {
		type:CLICKED,
		filter
	}
}
export function fetchHeaderData() {

    var token = getCookie('x-access-token');

    var config = {
        "headers": {"x-access-token": token}
    }
    return function (dispatch) {


        axios.post(HEADER_DATA, null, config).then((headerResponse) => {
            console.log(headerResponse);
            dispatch({type: FETCH_USERS_HEADER, headerData: headerResponse.data})


        })
    }
}

export function fetchSideNavData(){
	var token1 = getCookie('x-access-token');
	
	var config1 = {

		"headers":{"x-access-token": token1 }
	} 
	return function(dispatch){
		axios.all([
			axios.post(HEADER_DATA,null, config1),
			axios.get(SIDEPANEL_DATA,config1)
			])
		.then(axios.spread(function (userResponse, sideNavresponse) {
    //... but this callback will be executed only when both requests are complete.
    console.log('User', userResponse.data);
    console.log(sideNavresponse);
    dispatch({type:FETCH_USERS_SIDENAV,sideNavdata:sideNavresponse.data})
    
})).catch((err)=>{
			console.error(err);
		});
}
}
