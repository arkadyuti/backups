import React from 'react';
import './styles.scss';

export default class Input extends React.Component {  
	constructor(props){
		super(props);		
		this.change = this.change.bind(this);
		this.state ={value: null};
		this.classNameInput = this.classNameInput.bind(this); 
	}
	componentDidUpdate() {
		if(this.props.validUserData && this.props.validPassData){
			this.props.actions.dataValidated(true);
		}
		else {
			this.props.actions.dataValidated(false);
		}
	}

/*
	Event Handler for validation of userId and password.
*/
	change(e) {
		this.setState({value:e.target.value}, validateData);
		function validateData(){	
			if(this.props.data=='text'){
				let regex = /^[0-9 a-z]{5,6}$/;
				if(regex.test(this.state.value)){
					this.props.actions.validUserId(true,this.state.value);	
				}else{
					this.props.actions.validUserId(false,null);	
				}
			}
			else if(this.props.data=='password'){
				let regex= /^[a-zA-Z0-9!@#$%^&*]{6,16}$/;
				if(regex.test(this.state.value)){	
					this.props.actions.validPassword(true,this.state.value);
					
				}else{
					this.props.actions.validPassword(false,null);
				}
			}	
		}

	}

/*
	Adding class for displaying invalid input format.
*/
	classNameInput() {
		if(this.props.class=='user-id'){
			if(this.props.validUserData || this.props.validUserData==undefined ){
				return 'login-input valid-input';
			}
			else
				return 'login-input invalid-input';
		}
		else{
			if(this.props.validPassData|| this.props.validPassData==undefined ){
				return 'login-input valid-input';
			}
			else
				return 'login-input invalid-input';
		}
	}

	render(){
		const value = this.state.value;
		let inputClass = this.classNameInput();
		return(
			<div>
				<span>
					<label htmlFor={this.props.id} className={this.props.icon +' login-icon' }></label>
					<input className={inputClass} 
					value={value} 
					id={this.props.id} 
					type={this.props.data}
					placeholder={this.props.ph}
					onChange={this.change} tabIndex={this.props.tabIndex} />	
				</span>
			</div>
		);
	}
}

