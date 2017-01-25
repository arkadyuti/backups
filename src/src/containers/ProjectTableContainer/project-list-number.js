import React from 'react';
import { connect } from 'react-redux'
import { bindActionCreators } from 'redux'

//components 
import {ProjectList} from '../../components/CustomizeColumn/displayed-project-per-page'

//Props for the ProjectList component
function mapStateToProps(state) {
	return {
		pageSize:state.projectsDataReducer.pageSize,
		currentPage:state.projectsDataReducer.currentPage,
		actionPerformed:state.projectsDataReducer.actionPerformed,
		topics:state.projectsDataReducer.topics,
		searchedData:state.projectsDataReducer.searchedData,
		projects:state.projectsDataReducer.projects
    };
};

export default connect(mapStateToProps)(ProjectList)