import { handleOpen } from '../../actions/toggle-side-panel-action';
import { bindActionCreators } from 'redux';
import {connect} from 'react-redux';
import {MobileHeader} from '../../components/MobileHeader';
function mapDispatchToProps(dispatch) {
	return bindActionCreators({
		handleOpen:handleOpen
	},dispatch)
}
export default connect(null,mapDispatchToProps)(MobileHeader);
