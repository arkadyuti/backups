import { connect } from 'react-redux'
import { bindActionCreators } from 'redux'

//components
import {ProjectsTable} from '../../components/RedStatusComponents/RedStatusTable/index.js'

//actions
import fetchData from '../../actions/RedStatusAction/fetch-red-status.js'
import resetData from '../../actions/RedStatusAction/reset-red-status.js'
//Props for the ProjectsTable component
const mapStateToProps = function(state) {
	return {
		columns:state.redStatusReducer.columns,
		projects: state.redStatusReducer.projects,
		searchedData:state.redStatusReducer.searchedData,
		inProgress:state.redStatusReducer.inProgress,
		error:state.redStatusReducer.error
	}
};
function mapDispatchToProps(dispatch){
	return bindActionCreators({
		fetchData:fetchData,
		resetData:resetData
	},dispatch)
}
export default connect(mapStateToProps, mapDispatchToProps)(ProjectsTable)
 