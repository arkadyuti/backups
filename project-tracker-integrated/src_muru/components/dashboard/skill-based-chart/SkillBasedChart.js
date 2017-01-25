import React,{PropTypes} from 'react';
import {connect} from "react-redux";
import {bindActionCreators} from 'redux';
import * as fetchDataAction from '../../../actions/FetchDataAction.js';
import SkillBasedChartCallBack from "./SkillBasedChartD3.js";
import './scss/hBarChart.scss';



class SkillBasedChart extends React.Component {
	
	constructor(props,context){
		super(props);
	}

	componentDidMount(){
		console.log('i am calling');
		this.props.actions.fetchData();
		
	}

	componentDidUpdate(){
		console.log('my props ',this.props);
		SkillBasedChartCallBack(this.props.skills);
	}

	render() {
		return (
			<div id="wrapper"></div>
		);
	}
}	

SkillBasedChart.propTypes = {
	skills:PropTypes.array.isRequired,
	actions : PropTypes.object.isRequired

};

export default SkillBasedChart;

					

/*class HBarChart extends React.Component {
	constructor(props) {
		super(props);
	}
	componentDidMount(){
		axios.get('http://localhost:3000/skills')
			.then(function (response) {
				window.addEventListener('resize', hBarChartCallBack);
				hBarChartCallBack(response.data);
			})
			.catch(function (error) {
				console.log(error);
			});
	}
    
    componentWillReceiveProps(newProps) {    
		console.log('Component WILL RECIEVE PROPS!')
	}

	shouldComponentUpdate(newProps, newState) {
		return true;
	}

	componentWillUpdate(nextProps, nextState) {
		console.log('Component WILL UPDATE!');
	}

	componentDidUpdate(prevProps, prevState) {
		console.log('Component DID UPDATE!')
	}

	componentWillUnmount() {
		console.log('Component WILL UNMOUNT!')
	}
	
	render() {
		return (
			
				<div id="wrapper"></div>

		
		)
	}
}*/


/*class HBarChart extends React.Component {
	constructor(props){
		super(props);
		this.props.fetchData()
		.then(response => {});
	}
}
export default HBarChart;

*/