import {connect} from "react-redux";
import {bindActionCreators} from 'redux';
import SkillBasedChart from '../components/Dashboard/skill-based-chart/SkillBasedChart.js';
import * as fetchDataAction from '../actions/FetchDataAction.js';

function mapStateToProps(state){
	return {
		skills: state.skills
	};
}



function mapDispatchToProps(dispatch){
	return{
		actions : bindActionCreators(fetchDataAction,dispatch)
	};
}


export default connect(mapStateToProps,mapDispatchToProps)(SkillBasedChart);	