import React, { Component}  from 'react';
import ReactDOM from 'react-dom';
import './User-profile-container.scss';
import ClickableIcon from '../ClickableIcon';
import ImgWithTextComponent from '../../containers/ImgText';
import MobileHeader from '../../containers/MobileHeader';
 


//contains the notification badge, image with text component and the mobile header component
class UserProfileContainer extends Component{
	render(){
		return(
            <div className='user-profile-container'> 
                <div className='mobile-header'>
                    <MobileHeader />
                </div>
                <div className='user-details'>
                    <ImgWithTextComponent />
                    <ClickableIcon />
                </div>
            </div>
			)
                               
	}
}

export default UserProfileContainer;