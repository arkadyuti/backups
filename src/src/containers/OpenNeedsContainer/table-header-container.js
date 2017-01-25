import { connect } from 'react-redux'
import { bindActionCreators } from 'redux'

//components 
import { ListHeaderComponent } from '../../components/OpenNeedsComponents/OpenNeedsTable/table-header.js'

//actions
import searchData from '../../actions/OpenNeedsActions/search-action.js'

//Props for the table header component
function mapStatetoProps(state) {
	return{
		projects: state.openNeedsReducer.projects,
		searchValue:state.openNeedsReducer.searchValue,
		pageSize:state.openNeedsReducer.pageSize,
		topics:state.openNeedsReducer.topics,
		currentPage:state.openNeedsReducer.currentPage,
		searchedData:state.openNeedsReducer.searchedData,
		columns:state.openNeedsReducer.columns
	};
}
function mapDispatchToProps (dispatch) {
  	return bindActionCreators({ 
  		searchData:searchData
		}, 
  	dispatch);
}
export default connect(mapStatetoProps,mapDispatchToProps)(ListHeaderComponent);