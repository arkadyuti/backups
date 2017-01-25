//Mobile header
import React, { Component}  from 'react';
import ClickableImage from '../ClickableImage';
import SidePanel from '../../containers/SidePanel';
import ReactDOM from 'react-dom';

import './mobile-header.scss';
var hamburger = require('./Hamburger.png')
var logo = require('./sapient_DNA.png') 

export class MobileHeader extends Component{
	//function to open the side panel in mobile view
	handleOpen(){
		this.props.handleOpen()
	}
	//contains the Header in mobile view
	render(){
		var hamburger = require('./Hamburger.png')
		var logo = require('./sapient_DNA.png') 
		return(
			<div>
			<div className='mobile-display'>
			<ClickableImage src={hamburger} class='hamburger' onClick={this.handleOpen.bind(this)}/>
			</div>
			<div className='mobile-display'>
			<ClickableImage  src={logo} class="logo" routevalue="/Dashboard"/>
			</div>
			<div className='header-title'>PROJECT TRACKER</div>
			</div>
			)
	}
}

