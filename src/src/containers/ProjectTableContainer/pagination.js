import { connect } from 'react-redux'
import { bindActionCreators } from 'redux'

//components 
import {Pagination} from '../../components/Pagination/index'

//actions
import handleClick from '../../actions/ProjectListAction/handle-click.js'

//Props for the Pagination component
const mapStateToProps = function(state) {
	return {
		pagers: state.projectsDataReducer.pagers,
		currentPage: state.projectsDataReducer.currentPage,
		searchedData:state.projectsDataReducer.searchedData,
		pageSize: state.projectsDataReducer.pageSize,
		actionPerformed: state.projectsDataReducer.actionPerformed,
        pageValue: state.projectsDataReducer.pageValue
	};
};
 
function mapDispatchToProps(dispatch){
	return bindActionCreators({
		handleClick:handleClick
	}, dispatch);
}

export default  connect(mapStateToProps,mapDispatchToProps)(Pagination)