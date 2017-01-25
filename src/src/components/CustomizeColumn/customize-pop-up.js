import React,{Component} from 'react';
import CheckOptionContainer from '../../containers/ProjectTableContainer/customize-column-container.js';
import {checkboxOptions} from '../../constants/ProjectListConstants/customize-checkbox-options';
import BREWSER from 'brewser';
export class CustomizePopup extends Component {
	constructor (props){
	    super (props);
	} 
	componentWillMount(){
		  var breakPoint = 768;
		if(BREWSER.br.windowWidth<=breakPoint){
			this.props.giveChechboxOptions();
            //call this action only when the browser is rendred to anywhere less than 768px device to have only 3 checkboxs are as checked in the initial state.

	    }
	    if(BREWSER.br.windowWidth>breakPoint) {
	    	this.props.giveLastCheckedOptions();
            //call this action only when the browser is rendred to anywhere more than 768px device to have 6 checkboxs are as checked in the initial state.
	    }
	}
	hidePopup () {
		//This function will be called to hide the popup only when the user clicked the cross Button and anywhere in the outer opacity
		let newCustomizeOptions=this.props.customizeOptions;
		let columnCheckBox=this.props.columnCheckBox;
		newCustomizeOptions.forEach((option) =>{
	        option.checked=false;
	        //when the hidePopup fucntion calls it takes all the initial options's checked objects and set all of them as false
	        columnCheckBox.forEach((checkedOption) =>{
	                if (checkedOption.value == option.value) {
	                        option.checked=true;
	                        //if the shown options's value in the table is same as initial option's, set the checked object false for those objects only
	                }          
	        });  
	        this.props.retrunLastChecked(newCustomizeOptions);
	        //this is an action to send the newCustomizeOptions and set the state in the reducers to have previously checked option if the browser don't entred the customize save Button in the popup
	    });
		this.props.displayCustomizePopup();
		//this is an action to hide the popup box
		
	}
	hidPopupOnsave(){
		this.props.displayCustomizePopup();
		//this is an action to hide the popup box when the user clicked on the Customize save Button
	}

	checkedCheckBox(label){
		var breakPoint = 768;
		if(BREWSER.br.windowWidth<breakPoint){
            //when the device is rendered to mobileview
			if(this.props.selectedCheckOptions.length==3){
	            //do this only when the user checked exact 3 options
	            this.hidPopupOnsave();
	            //call this action to hide the popup on click of Customize save Button
				let columnCheckBox=[];
	     		this.props.selectedCheckOptions.map((option)=>{
					columnCheckBox.push(option);
				});
	     		this.props.givecolumn(columnCheckBox);
	     		//this is an action to send the columnCheckBox to set the state and render the option in the table
		    }
	    }
	    if(BREWSER.br.windowWidth>breakPoint) {
            //when the device is rendered to desktopview
	    	if(this.props.selectedCheckOptionsDesktop.length>2){
	            //do this only when the user checked more than 2 options
	            this.hidPopupOnsave();
	            //call this action to hide the popup on click of Customize save Button
				let columnCheckBoxDesktop=[];
	     		this.props.selectedCheckOptionsDesktop.map((option)=>{
					columnCheckBoxDesktop.push(option);
				});
	     		this.props.givecolumnDesktop(columnCheckBoxDesktop);
	     		//this is an action to send the columnCheckBoxDesktop to set the state and render the option in the table
	     	}
	    }
	}
	render() {
		let displayPopup = {
			display:this.props.aptPopupVisible ? 'block' : 'none'
		}
		//this is an styling to show or hide the popup
		let showError = {
			display:this.props.showErrorMessage ? 'block' : 'none'
		}
		//this is an styling to show or hide the popup
		let disabledButton = {
			cursor:this.props.showErrorMessage ? 'not-allowed' : 'pointer',
			backgroundColor:this.props.showErrorMessage ? 'rgb(200,200,200)': 'rgb(45,174,219)'
		}
		//this is an styling to add style to the customize save Button
		let errorMessage = this.props.errorMessage;
		return (<div>
					<div className="outer-opacity" style={displayPopup} onClick={this.hidePopup.bind(this)}></div>
					<div className="customize-column-popup" style={displayPopup}>
						<header className="customize-category">
							<span className="customize-category-logo">CATEGORY</span>
							<span className="ion-close" onClick={this.hidePopup.bind(this)}></span>
							
						</header>
						<div className="customize-category-container col-md-12">
				                <CheckOptionContainer />
				                <div className='showCheckBoxError' style={showError}>
				                	{errorMessage}
				                </div>
						</div>
						<button className="customize-column-save-button"
						 onClick={this.checkedCheckBox.bind(this)}
						 tabIndex="3" 
						 style={disabledButton}>
							<span className="customize-column-add-btn">+Customize</span>
						</button>
											
					</div>
				</div>);
	}
}
CustomizePopup.propTypes={
	aptPopupVisible:React.PropTypes.bool,
	selectedCheckOptions:React.PropTypes.array,
	selectedCheckOptionsDesktop:React.PropTypes.array,
	showErrorMessage: React.PropTypes.bool,
	customizeThreeOptions:React.PropTypes.array,
	errorMessage:React.PropTypes.string,
	customizeOptionCheck:React.PropTypes.array,
	customizeOptions:React.PropTypes.array,
	columnCheckBox:React.PropTypes.array,
	displayCustomizePopup:React.PropTypes.func,
	givecolumnDesktop:React.PropTypes.func,
	givecolumn:React.PropTypes.func,
	giveChechboxOptions:React.PropTypes.func,
	giveLastCheckedOptions:React.PropTypes.func,
	showLastChecked:React.PropTypes.func,
	retrunLastChecked:React.PropTypes.func
}
