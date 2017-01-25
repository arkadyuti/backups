import { connect } from 'react-redux';
import { bindActionCreators } from 'redux';

//Actions
import { staffingFormDisplay } from '../../actions/CreateProjectActions/staffing-form-display';
import { updateUserInput     } from '../../actions/CreateProjectActions/update-empty-json.js';
import {updateUserInputStaffing} from '../../actions/CreateProjectActions/update-empty-staffing.js';
import {staffingEmployeeDetailUpdate} from '../../actions/CreateProjectActions/staffing-employee-details-update.js';
import {nextButtonActive} from '../../actions/CreateProjectActions/next-button-enable';
import {nextClick} from '../../actions/CreateProjectActions/next-click';

//Components
import Element from '../../components/Element/index';

function mapStateToProps(state){

	return {
        staffingFormVisible : state.staffingFormVisible,
        selectedTab         : state.selectedTab,
        configJSON          : state.configJSON,
        isTabValid          : state.isTabValid,
        validateTabNext     : state.validateTabNext,
        requestType         : state.requestType,
	    emptyJSON           : state.emptyJSON,
        allFieldsCheck      : state.allFieldsCheck


	}

}

function mapDispatchToProps(dispatch){

	    return bindActionCreators({staffingFormDisplay,updateUserInput,updateUserInputStaffing,nextClick,staffingEmployeeDetailUpdate,nextButtonActive},dispatch);
} 

export default connect(mapStateToProps,mapDispatchToProps)(Element);


