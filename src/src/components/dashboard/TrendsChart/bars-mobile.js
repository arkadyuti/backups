import React from 'react';
import * as d3 from 'd3';
import QuadrantMobileComponent from '../../../containers/Dashboard/TrendsChart/quadrant-mobile.js';


class BarsMobileComponent extends React.Component{

	 

	constructor(props){
		super(props);
        this.eachRectPerQ = ::this.eachRectPerQ;

	}


	componentDidUpdate() {
        console.log(d3.select("#svg-wrapper").node().clientWidth);
	}
	

	eachRectPerQ(d,i){
		return(
			<QuadrantMobileComponent key={i} group = {i} q ={d} /> 
		)

	}


	render(){
		return(
			<g transform = "translate(160,35)">
				{this.props.Quarters.map(this.eachRectPerQ)}
			</g>
			)
	}
}

export default BarsMobileComponent;

