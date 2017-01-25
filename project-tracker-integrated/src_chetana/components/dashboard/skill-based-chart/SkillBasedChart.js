import React,{PropTypes} from 'react';
import {connect} from "react-redux";
import {bindActionCreators} from 'redux';
import * as fetchSkillsAction from '../../../actions/Dashboard/Skill-based-chart/SkillBasedChartAction.js';
import SkillBasedChartCallBack from "./SkillBasedChartD3.js";
import '../../../styles/Dashboard/Skill-based-chart/SkillBasedChart.scss';

class SkillBasedChart extends React.Component {
	
	constructor(props,context){
		super(props);
	}

	componentDidMount(){
		this.props.actions.fetchSkillsAction();
	}

	componentDidUpdate(){
		console.log('my props ',this.props);
		SkillBasedChartCallBack(this.props.skills);
	}

	render() {
		return (
			<div id="skillBasedChartWrapper"></div>
		);
	}
}	

SkillBasedChart.propTypes = {
	skills:PropTypes.array.isRequired,
	actions : PropTypes.object.isRequired
};

export default SkillBasedChart;

					

