import React, { Component}  from 'react';
import { Router, Route,browserHistory} from 'react-router'
import LogoutBlock from '../LogoutBlock';
import './Clickable-icon.scss';

function logOut(){
    document.cookie = 'x-access-token=' + '=; expires=Thu, 01 Jan 1970 00:00:01 GMT;path=/';
    browserHistory.push('/');
    history.pushState(null, null, document.URL);    
    window.addEventListener('popstate', function () {
        history.pushState(null, null, document.URL);
    });
    localStorage.removeItem('SelectedOption')
    localStorage.removeItem('ListOption')
}
export default class ClickableIcon extends Component{
	//Logout Component
    logOutClick(){
        logOut();
    }
    enterClick(evnt){
        if (evnt.keyCode == 13) {
          logOut();  
        }
    }
    componentWillMount(){
        if(document.cookie===''){
          browserHistory.push('/');
        }
    }

    render(){
        return(
            <div className='logout-container ' onClick={this.logOutClick.bind(this)} onKeyUp={this.enterClick.bind(this)} tabIndex='0' id="logout">
                <LogoutBlock logOut="Log Out"/>
            </div>
        );
    }
}