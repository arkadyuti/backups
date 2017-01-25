import React, {Component} from 'react';
import ReactDOM from 'react-dom';
import getCookie from '../../utility'
import axios from 'axios';

/*import {updateUserInput} from '../../actions/update-empty-json.js';
import {updateUserInputStaffing} from '../../actions/action_update_empty_staffing.js';
import {staffingEmployeeDetailUpdate} from '../../actions/staffing-employee-details-update.js'*/

import LabelDescription from '../LabelDescription/index.js';
/*import {nextClick} from '../../actions/action_next_click';*/

/*import {bindActionCreators} from 'redux';
import {connect} from 'react-redux';
*/
import './styles.scss';

export default class TextInput extends Component{

	constructor(props) {
    	super(props);
    	this.state = {
    			showError: 'false',
    			inputValue: '',
    			isFocus:'false'    			
    	}    	
	}


	componentWillMount() {

		this.setState({inputValue: this.props.emptyJSON[this.props.field.name]})
		// this is for first click of create,edit or view
	}

	componentWillReceiveProps(nextProps,nextState){

		let field = this.props.field.name;
			let checkStaffingField	= nextProps.configJSON.staffing.list.indexOf(field)
			let check = ""
			if(checkStaffingField === -1){
				check = false;
			}
			else{
				check = true;
			}
			//Handle create Transitions
		if(check === true){
			this.setState({inputValue:""})
			this.setState({showError:"false"})

		}
/*		//Handle create Transitions
		

		if(this.props.requestType.type === "edit" && nextProps.requestType.type === "create"){
			
			//this is for transition of edit to create
			this.setState({inputValue: nextProps.emptyJSON[this.props.field.name]})
			this.setState({showError: "false"})
			
		}


		if(this.props.requestType.type === "view" && nextProps.requestType.type === "create"){
			
			//this is for transition of view to create
			this.setState({inputValue: nextProps.emptyJSON[this.props.field.name]})
			this.setState({showError: "false"})
			
		}

		//Handle Edit Transitions
		if(nextProps.emptyJSON[this.props.field.name] === this.state.inputValue && (this.props.requestType.type === "edit" && nextProps.requestType.type === "edit")){

			this.setState({inputValue: nextProps.emptyJSON[this.props.field.name]})
		}

		if(this.props.requestType.type === "create" && nextProps.requestType.type === "edit"){
			
			//this is for transition of create to edit
			this.setState({inputValue: nextProps.emptyJSON[this.props.field.name]})
			this.setState({showError: "false"})
		}
		if(this.props.requestType.type === "view" && nextProps.requestType.type === "edit"){
			
			//this is for transition of view to edit
			this.setState({inputValue: nextProps.emptyJSON[this.props.field.name]})
			this.setState({showError: "false"})
		}*/
	}


    /**
      * isActive - to add className to display error-message
      * value - true in all case and is used to compare with the local error-message state
    **/


	isActive(value){
		return (value===this.state.showError) ?'cp-red-error':'cp-hide';
	}


	showFocusField(value) {
			return (value === this.state.isFocus) ?'cp-input cp-colored-field':'cp-input';
		}

		changeLabelOnFocus(value) {
		return (value === this.state.isFocus) ? 'cp-blue-label cp-floating-label':'cp-floating-label';
	}

		
	/**
      * validAction - to save changes to the empty JSON
      * event - type object
    **/

    validAction(value,key){
    	let valueArray
    	if(key === "skills"){
    	 
	    	valueArray  = value.split(",");		
	    	let arrayOfSkillObjects = [];
	    	valueArray.map((skillName) => {
	    		let skillObject = {};
	    		if(skillName === "css"){
	    			skillObject["id"] = 1
	    			arrayOfSkillObjects.push(skillObject)
	    		}
	    		else{
	    			skillObject["id"] = 2
	    			arrayOfSkillObjects.push(skillObject)
	    		}

	    	})
	    		value = arrayOfSkillObjects
	    		console.log('arrayOfSkillObjects =>',arrayOfSkillObjects)
	    }

    	(this.props.selectedTab === "staffing")
		?this.props.staffingEmployeeDetailUpdate(key,value)
		:this.props.updateUserInput(value,key)
	}


	/**
      * invalidAction - to make the corresponding field in emptyJSON null in case of invalid input
      * value - null in this case
      * key - the reference of the field in emptyJSON
    **/


    invalidAction(value,key){
    	(this.props.selectedTab === "staffing")
		?this.props.staffingEmployeeDetailUpdate(key,value)
		:this.props.updateUserInput(value,key)
	}

	checkDuplicatePid(aaa,userInputpid){
		let token = getCookie('x-access-token');
    	axios.get('http://10.207.7.131:2220/projects/checkpid?pid='+userInputpid,{ headers: {'x-access-token': token} })
			  			.then(function (response) {
			 				if(response.data.success === false)
			 				aaa.setState({showError:'true'})
			 				else
			 				aaa.setState({showError:'false'})
    					})
			  			.catch(function (error) {

			 				 });
    }



	/**
      * doValidation - to validate text field based on the input provided and save changes to the empty JSON
      * event - type object
    **/


	doValidation(event){
		
		var value = event.target.value;
		var regular_exp=this.props.field.regex
		this.setState({isFocus: !this.state.isFocus})

			if(value=""|| !regular_exp.test(value)){
			 	this.setState({showError:'true'});
			 	
			    this.validAction(event.target.value,this.props.field.name);

			}
			else{
			 	this.setState({showError:'false'});
			 	this.validAction(event.target.value,this.props.field.name);
			 	let userInputpid = event.target.value
			 	if(this.props.field.name === 'pid'){
			 		let aa="";
			        var duplicatePidResponse = this.checkDuplicatePid(this,userInputpid)
			 			console.log('duplicatePidResponse = >' ,duplicatePidResponse)
			 			if(duplicatePidResponse === "false"){
			  			  this.setState({showError:'true'})
			  			}else{
			  				this.setState({showError:'false'})
			  			}
			}	
		
		}

	}
		

		/**
      	  * handleInputChange - to reset the state equal to the target value in the input field
    	  * event - type object
    	**/


		handleInputChange(event) {
	 	
	 	this.setState({inputValue: event.target.value})
    	}

    	changeFocusState() {
    		this.setState({isFocus: 'true'})
    	}

		render(){

			let EDITHTML = (this.props.requestType.type === 'view')?
				<LabelDescription field={this.props.field} />
				
			: <div>
					<input id="inputText"  className = {this.showFocusField('true')}
											type="text"
											required
											onBlur = {this.doValidation.bind(this)}
											onFocus = {this.changeFocusState.bind(this)}
											onChange={this.handleInputChange.bind(this)}
											value = {this.state.inputValue}
											autoComplete="off"/>
					<label htmlFor="inputText" className ={this.changeLabelOnFocus('true')}>{this.props.field.staticValue}</label>
					<span className ={this.isActive('true')}>{this.props.field.error}</span></div>
		
			
		return (
				 <div key={this.props.field.id} className="cp-text">
        {EDITHTML}
        </div>
        );
	}
}

