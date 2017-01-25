import { connect } from 'react-redux';
import { bindActionCreators } from 'redux';
//functions

//Actions
import { tabClick  } from '../../actions/CreateProjectActions/tab-click';
import { nextClick } from '../../actions/CreateProjectActions/next-click';
import { fetchJSON } from '../../actions/CreateProjectActions/fetch-JSON';
import {nextButtonActive} from '../../actions/CreateProjectActions/next-button-enable';
import {nullifyRequestType} from '../../actions/CreateProjectActions/nullify-request-type';

//Components
import TabEdit from "../../components/TabEdit"


function mapStateToProps(state){

    return {
        requestType             : state.requestType,
        selectedTab             : state.selectedTab,
        emptyJSON               : state.emptyJSON,
        configJSON              : state.configJSON,
        validateTabNext         : state.validateTabNext,
        staffingEmployeeBuffer  : state.staffingEmployeeBuffer,
        allFieldsCheck          : state.allFieldsCheck
    }
}

function mapDispatchToProps(dispatch){

    return bindActionCreators({tabClick,nextClick,fetchJSON,nextButtonActive,nullifyRequestType},dispatch); 
} 

export default connect(mapStateToProps,mapDispatchToProps)(TabEdit);
