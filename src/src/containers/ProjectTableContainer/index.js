import { connect } from 'react-redux'
import { bindActionCreators } from 'redux'
//components
import {ProjectsTable} from '../../components/ProjectsTable/index.js'
//actions
import fetchData from '../../actions/ProjectListAction/fetch-project-list.js'
import resetData from '../../actions/ProjectListAction/reset-project-list.js'
import updatePid from '../../actions/ProjectListAction/update-pid.js'

//Props for the ProjectsTable component
const mapStateToProps = function(state) {
	return {
		columnCheckBox:state.customizeColumn.columnCheckBox,
		projects: state.projectsDataReducer.projects,
		pageSize:state.projectsDataReducer.pageSize,
		topics:state.projectsDataReducer.topics,
		currentPage:state.projectsDataReducer.currentPage,
		actionPerformed:state.projectsDataReducer.actionPerformed,
		searchedData:state.projectsDataReducer.searchedData,
		inProgress:state.projectsDataReducer.inProgress,
		error:state.projectsDataReducer.error
	}
};
function mapDispatchToProps(dispatch){
	return bindActionCreators({
		fetchData:fetchData,
		resetData:resetData,
		updatePid:updatePid
	},dispatch)
}
export default connect(mapStateToProps, mapDispatchToProps)(ProjectsTable)
 