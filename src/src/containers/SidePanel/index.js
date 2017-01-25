import { handleClose,handleClick,fetchSideNavData } from '../../actions/toggle-side-panel-action';
import {connect} from 'react-redux';
import { bindActionCreators } from 'redux';
import {SidePanel} from '../../components/SidePanel';

function mapStateToProps(state) {
    return{
        status:!state.toggleSidePanel.status,
        sideNavData:state.toggleSidePanel.sideNavData,
        clicked:state.toggleSidePanel.clicked
    }
}
function mapDispatchToProps(dispatch) {
    return bindActionCreators({
            handleClose:handleClose,
            handleClick:handleClick
        },dispatch)
}
export default connect(mapStateToProps,mapDispatchToProps)(SidePanel);