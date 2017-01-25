import { connect } from 'react-redux'
import { bindActionCreators } from 'redux'

//components 
import { ListHeaderComponent } from '../../components/RedStatusComponents/RedStatusTable/table-header.js'

//actions
import searchData from '../../actions/RedStatusAction/search-action.js'

//Props for the ListHeaderComponent component
function mapStatetoProps(state) {
	return{
		projects: state.redStatusReducer.projects,
		searchValue:state.redStatusReducer.searchValue,
		searchedData:state.redStatusReducer.searchedData,
        columns:state.redStatusReducer.columns
	};
}
function mapDispatchToProps (dispatch) {
  	return bindActionCreators({ 
  		searchData:searchData}, 
  	dispatch);
}
export default connect(mapStatetoProps,mapDispatchToProps)(ListHeaderComponent);