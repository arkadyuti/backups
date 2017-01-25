/**
	Skill Based Chart's Component
**/
import React,{PropTypes} from 'react';
import Loader from "./../Loader/index";
import skillBasedChartCallBack from "./skill-based-chart-d3.js";

class skillBasedChart extends React.Component {
	
	constructor(props,context){
		super(props);
	}

	//Calls the action
	componentDidMount(){
		this.props.actions.fetchSkillsAction();
	}

	//Call Back function for populating data to the chart by D3 Library
	componentDidUpdate(){
		skillBasedChartCallBack(this.props.skills);
	}
 
	render() {
		//Loader for Failed API call
		if(this.props.fetching==false){
			return(<Loader addClass="error">Sorry! Unable to fetch data :(</Loader>);
		}
		//Loader while data is loading
		if(this.props.fetching==true){
			return(<Loader addClass="loading">Loading....</Loader>);
		}
		//Renders when data is fetched
		return (<Loader className="skillBasedChartWrapper"></Loader>);
	}
}	

export default skillBasedChart;

					

