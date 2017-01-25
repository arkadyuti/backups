import axios from 'axios';
import { browserHistory} from 'react-router';
/*
    To get cookie for a given key.
*/
export default function getCookie(key) {
    let cookieKey = key + "=";
    let cookieData = document.cookie.split(';');
    for(let i = 0; i < cookieData.length; i++) {
        let c = cookieData[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(cookieKey) == 0) {
            return c.substring(cookieKey.length, c.length);
        }
    }
    return "";
}
/*
    Redirecting to Dashboard if logged in.    
*/
export const authTransition = function authTransition() {
    const token = getCookie('x-access-token');
    axios.post('http://10.207.7.131:2220/verifytoken',null,{headers:{'x-access-token': token}}).then(function (response){
    	if(response.data.isValid){
    		browserHistory.push('Dashboard');
    	}
    	else{
        	browserHistory.push('/');
    	}
    });
}
/*
    Trigger click events on enter key.
*/
export const clickOnEnter = function clickOnEnter(element){
    element.addEventListener("keyup", function(event) {
        event.preventDefault();
        if (event.keyCode == 13) {
            element.click();
        }
    });
}
