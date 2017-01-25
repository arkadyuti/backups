import { connect } from 'react-redux'
import { bindActionCreators } from 'redux'
//components 
import {CustomizePopup} from '../../components/CustomizeColumn/customize-pop-up'
//actions
import {displayCustomizePopup,retrunLastChecked,giveCheckedData,showLastChecked,givecolumn,
	    givecolumnDesktop,giveChechboxOptions,giveLastCheckedOptions} from '../../actions/ProjectListAction/show-customize-pop-up';
       //import the following action from the given folder path
const mapStateToProps = function(state) {
	return {
		aptPopupVisible:state.customizeColumn.aptPopupVisible,
		selectedCheckOptions:state.customizeColumn.selectedCheckOptions,
		selectedCheckOptionsDesktop:state.customizeColumn.selectedCheckOptionsDesktop,
		showErrorMessage:state.customizeColumn.showErrorMessage,
		customizeThreeOptions:state.customizeColumn.customizeThreeOptions,
		errorMessage:state.customizeColumn.errorMessage,
		customizeOptionCheck:state.customizeColumn.customizeOptionCheck,
		customizeOptions:state.customizeColumn.customizeOptions,
		columnCheckBox:state.customizeColumn.columnCheckBox
	};
  	//get the following state to have as props
};
 
function mapDispatchToProps(dispatch){
	return bindActionCreators({
		displayCustomizePopup:displayCustomizePopup,
	 	givecolumnDesktop:givecolumnDesktop,
	 	givecolumn:givecolumn,
	 	giveChechboxOptions:giveChechboxOptions,
	 	giveLastCheckedOptions:giveLastCheckedOptions,
		showLastChecked:showLastChecked,
		retrunLastChecked:retrunLastChecked,
    //this function to bind the following actions

	}, dispatch);
}

export default  connect(mapStateToProps,mapDispatchToProps)(CustomizePopup)