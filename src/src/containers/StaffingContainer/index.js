import { connect } from 'react-redux';
import { bindActionCreators } from 'redux';
//functions

//Actions
import { staffingFormDisplay  } from '../../actions/CreateProjectActions/staffing-form-display';
import { updateEmpBufferToEmptyJson } from '../../actions/CreateProjectActions/staffing-emp-buffer-to-empty';
import { nextClick } from '../../actions/CreateProjectActions/next-click';

//Components
import StaffingTab from '../../components/StaffingTab/index';


function mapStateToProps(state){

	return {
		staffingFormVisible     : state.staffingFormVisible,
		configJSON              : state.configJSON,
		emptyJSON           	: state.emptyJSON,
		staffingEmployeeBuffer  : state.staffingEmployeeBuffer,
		requestType				: state.requestType,
		selectedTab				: state.selectedTab
	}
}

function mapDispatchToProps(dispatch){

	return bindActionCreators({staffingFormDisplay,updateEmpBufferToEmptyJson,nextClick},dispatch); 
} 

export default connect(mapStateToProps,mapDispatchToProps)(StaffingTab);