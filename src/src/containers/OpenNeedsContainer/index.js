import { connect } from 'react-redux'
import { bindActionCreators } from 'redux'

//components
import {ProjectsTable} from '../../components/OpenNeedsComponents/OpenNeedsTable/index.js'

//actions
import fetchData from '../../actions/OpenNeedsActions/fetch-open-needs-list.js'
import resetData from '../../actions/OpenNeedsActions/reset-open-needs.js'
//Props for the ProjectTable component
const mapStateToProps = function(state) {
	return {
		columns:state.openNeedsReducer.columns,
		projects: state.openNeedsReducer.projects,
		pageSize:state.openNeedsReducer.pageSize,
		topics:state.openNeedsReducer.topics,
		currentPage:state.openNeedsReducer.currentPage,
		token:state.openNeedsReducer.token,
		searchedData:state.openNeedsReducer.searchedData,
		inProgress:state.openNeedsReducer.inProgress,
		error:state.openNeedsReducer.error
	}
};
function mapDispatchToProps(dispatch){
	return bindActionCreators({
		fetchData:fetchData,
		resetData:resetData
	},dispatch)
}
export default connect(mapStateToProps, mapDispatchToProps)(ProjectsTable)
 