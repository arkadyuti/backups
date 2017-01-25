import React from 'react';
import './styles.scss';
import { clickOnEnter } from '../../utility'
export default class Logo extends React.Component{
	constructor(props){
		super(props);
	}
	componentDidMount(){
		let logoElement = document.getElementById('login-logo');
		clickOnEnter(logoElement); 
	}
	refreshPage(e){
		window.location.reload();
	}
	render(){
		var logo = require('./logo.png');
		return(
			
			<div className="login-logo" id="login-logo" tabIndex={1} onClick={this.refreshPage}> 
				<img  src={logo}/>
			</div>		
		);
	}
}

