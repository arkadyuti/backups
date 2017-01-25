import {Layout} from '../../components/Layout';
import {connect} from 'react-redux';
import { bindActionCreators } from 'redux';
import { handleClose,fetchHeaderData,fetchSideNavData } from '../../actions/toggle-side-panel-action';

function mapStateToProps(state){
	return {
		status:state.toggleSidePanel.status
	}
}
function mapDispatchToProps(dispatch) {
    return bindActionCreators({
            
            fetchHeaderData : fetchHeaderData,
            fetchSideNavData : fetchSideNavData,
            handleClose:handleClose
        },dispatch)
}

export default connect(mapStateToProps,mapDispatchToProps)(Layout);