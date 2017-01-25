//Logout Block
import React, { Component } from 'react';
import './Logout-block.scss';

export default class LogoutBlock extends Component {
    constructor(props) {
        super(props);
    }
    
    render() {
        return ( < div >
            	< span className = 'logout-span' > { this.props.logOut } < /span> 
            	< span className = "ion-log-out signout-icon" > < /span> 
            < /div>
        );
    }
}
