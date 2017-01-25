import {Accordian} from '../components/Accordian';
import {connect} from 'react-redux';
import { bindActionCreators } from 'redux';
import { handleClose,fetchHeaderData,fetchSideNavData,handleClick } from '../actions/toggle-side-panel-action';




function mapStateToProps(state) {
		return{
			sideNavData:state.toggleSidePanel.sideNavData,
			clicked:state.toggleSidePanel.clicked,
			headerData:state.toggleSidePanel.headerData
		}
	}
	function mapDispatchToProps(dispatch) {
		return bindActionCreators({
			handleClose:handleClose,
			handleClick:handleClick
			
		},dispatch)
	}
	export default connect(mapStateToProps,mapDispatchToProps)(Accordian);