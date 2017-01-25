import React,{Component} from 'react';
import {connect} from 'react-redux';
import {bindActionCreators} from 'redux';
//components 
import {ProjectDisplayed} from '../../components/CustomizeColumn/index'
//actions
import { displayCustomizePopup,hideErrorMessage,showErrorMessage } from '../../actions/ProjectListAction/show-customize-pop-up.js'


//Props for the ProjectDisplayed component

//import the following action from the given folder path

function mapDispatchToProps (dispatch) {
	return bindActionCreators({displayCustomizePopup:displayCustomizePopup,
							   hideErrorMessage:hideErrorMessage,
							   showErrorMessage:showErrorMessage
    //this function to bind the following actions
								}, dispatch)
}
const mapStateToProps = function(state) {
	return {
		customizeOptions:state.customizeColumn.customizeOptions,
		selectedCheckOptions:state.customizeColumn.selectedCheckOptionsDesktop
	}
  	//get the following state to have as props
}
export default connect(mapStateToProps,mapDispatchToProps)(ProjectDisplayed);