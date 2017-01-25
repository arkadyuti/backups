import {connect} from "react-redux";
import {bindActionCreators} from 'redux';
import skillBasedChart from '../../../components/Dashboard/SkillBasedChart/index';
import * as fetchSkillAction from '../../../actions/Dashboard/SkillBasedChart/skill-based-chart.js';
import '../../../components/Dashboard/SkillBasedChart/skill-based-chart.scss';

let mapStateToProps = (state) => {
	return {
		skills : state.skills,
		fetching : state.skills.fetching,
	};
}

let mapDispatchToProps = (dispatch) => {
	return{
		actions : bindActionCreators(fetchSkillAction,dispatch)
	};
}

export default connect(mapStateToProps,mapDispatchToProps)(skillBasedChart);	