import React,{Component} from 'react';
import {connect} from 'react-redux';
import {bindActionCreators} from 'redux';
import BREWSER from 'brewser';

//components
import ProjectListContainer from '../../containers/ProjectTableContainer/project-list-number';
import CustomizePopupContainer from '../../containers/ProjectTableContainer/customizepop-up-container';

//Styles
import './customize-column.scss';

export class ProjectDisplayed extends React.Component{
	
	constructor(props){
	    super(props)
	}
	showPopup(){
		this.props.displayCustomizePopup();
		//this is an action to show and hide the popup on the customize Button clicked
		if(BREWSER.br.windowWidth<=768){
            if(this.props.customizeOptions.length!=3){
                this.props.hideErrorMessage();
				//this is an action to hide the error message based on the length of checked options

            }
            else {
                this.props.showErrorMessage();    
				//this is an action to show the error message based on the length of checked options
            }
        }
        else {
            if(this.props.customizeOptions.length<3){
                this.props.showErrorMessage();
				//this is an action to hide the error message based on the length of checked options   
            }
            else {
                this.props.hideErrorMessage();
				//this is an action to show the error message based on the length of checked options    
            } 
        }
	}
		
	render(){ 
		return (
			<div>
				<div className = "row displayed-project">
					<ProjectListContainer/>
					<button className="col-md-3 customize-column-button" 
					onClick={this.showPopup.bind(this)} >
					<span className="ion-plus"></span>
					<span className="customize-column-plusicon">Customize Column</span>
					</button>
				</div>
				<CustomizePopupContainer/>
			</div>
		);
	}
}
ProjectDisplayed.propTypes={
	displayCustomizePopup:React.PropTypes.func,
	hideErrorMessage:React.PropTypes.func,
	showErrorMessage:React.PropTypes.func,
	customizeOptions:React.PropTypes.array,
	selectedCheckOptions:React.PropTypes.array
}
