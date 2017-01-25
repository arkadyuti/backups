import { connect } from 'react-redux'
import { bindActionCreators } from 'redux'

//components 
import {Dropdown} from '../../components/Dropdown/index.js'

//actions
import changePerPage from '../../actions/ProjectListAction/change-per-page.js'

//Props for the Dropdown component
function mapStateToProps(state) {
    return {
        currentPage:state.projectsDataReducer.currentPage,
        searchedData:state.projectsDataReducer.searchedData,
        perPageValues:state.projectsDataReducer.perPageValues              
    };
};

function mapDispatchToProps(dispatch){
    return bindActionCreators({
		changePerPage:changePerPage
	}, dispatch);
}

export default connect(mapStateToProps,mapDispatchToProps)(Dropdown)