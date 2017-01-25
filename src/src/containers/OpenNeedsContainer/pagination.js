import { connect } from 'react-redux'
import { bindActionCreators } from 'redux'

//components 
import {Pagination} from '../../components/OpenNeedsComponents/Pagination/index'

//actions
import handleClick from '../../actions/OpenNeedsActions/handle-click.js'

//Props for the Pagination component
const mapStateToProps = function(state) {
	return {
		pagers: state.openNeedsReducer.pagers,
		currentPage: state.openNeedsReducer.currentPage,
		searchedData:state.openNeedsReducer.searchedData,
		pageSize: state.openNeedsReducer.pageSize,
		token: state.openNeedsReducer.token,
        count: state.openNeedsReducer.count
	};
};
 
function mapDispatchToProps(dispatch){
	return bindActionCreators({
		handleClick:handleClick
	}, dispatch);
}

export default  connect(mapStateToProps,mapDispatchToProps)(Pagination)