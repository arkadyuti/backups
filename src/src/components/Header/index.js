import React, { Component } from 'react';
import UserProfileContainer from '../UserProfileContainer';
import './header.scss';

class Header extends Component {
    //Header Component
     //Contains image with text component and logout block
    render() {
        return (

            < div className = 'header-container' >

            < UserProfileContainer / >
            < div className = 'clear-fix' > < /div>

            < /div>

        )
    }
}
export default Header;
