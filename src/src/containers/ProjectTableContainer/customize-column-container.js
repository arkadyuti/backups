import { connect } from 'react-redux'
import { bindActionCreators } from 'redux'
//components 
import {CheckOption} from '../../components/CustomizeColumn/customize-column.js';
//actions
import {giveUncheckedData,giveCheckedData,giveUncheckedDataDesktop,
        giveCheckedDataDesktop,showErrorMessage,hideErrorMessage,
       } from '../../actions/ProjectListAction/show-customize-pop-up';
       //import the following action from the given folder path

function mapStatetoProps(state) {
  return{
    options:state.customizeColumn.allCustomizeOptions,
    errorMessage:state.customizeColumn.errorMessage
  };
  //get the following state to have as props
}
function mapDispatchToProps (dispatch) {
    return bindActionCreators({ 
      giveUncheckedData, 
      giveCheckedData,
      giveUncheckedDataDesktop,
      giveCheckedDataDesktop,
      showErrorMessage,
      hideErrorMessage,
      //this function to bind the following actions
    }, 
    dispatch);
}
export default connect(mapStatetoProps, mapDispatchToProps)(CheckOption);