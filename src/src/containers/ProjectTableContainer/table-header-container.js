import { connect } from 'react-redux'
import { bindActionCreators } from 'redux'

//components 
import { ListHeaderComponent } from '../../components/ProjectsTable/table-header.js'

//actions
import searchData from '../../actions/ProjectListAction/search-action.js'
import sortData from '../../actions/ProjectListAction/sort-action.js'


//Props for the ListHeaderComponent component
function mapStatetoProps(state) {
	return{
		toggleFilter:state.projectsDataReducer.toggleFilter,
		projects: state.projectsDataReducer.projects,
		searchValue:state.projectsDataReducer.searchValue,
		pageSize:state.projectsDataReducer.pageSize,
		topics:state.projectsDataReducer.topics,
		currentPage:state.projectsDataReducer.currentPage,
		searchedData:state.projectsDataReducer.searchedData,
		columns:state.customizeColumn.columnCheckBox
	};
}
function mapDispatchToProps (dispatch) {
  	return bindActionCreators({ 
  		searchData:searchData,
		sortData:sortData
		}, 
  	dispatch);
}
export default connect(mapStatetoProps,mapDispatchToProps)(ListHeaderComponent);