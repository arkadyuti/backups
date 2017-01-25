import {connect} from "react-redux";
import {bindActionCreators} from 'redux';
import SkillBasedChart from '../../../components/Dashboard/Skill-based-chart/SkillBasedChart.js';
import * as fetchSkillAction from '../../../actions/SkillBasedChartAction.js';

function mapStateToProps(state){
	return {
		skills: state.skills
	};
}



function mapDispatchToProps(dispatch){
	return{
		actions : bindActionCreators(fetchSkillAction,dispatch)
	};
}


export default connect(mapStateToProps,mapDispatchToProps)(SkillBasedChart);	