import React from 'react';
import QuadrantComponent from '../../../containers/Dashboard/TrendsChart/quadrant.js';


class BarsComponent extends React.Component{

	 

	constructor(props){
		super(props);
		this.eachRectPerQ = ::this.eachRectPerQ;
	}

	eachRectPerQ(d,i){
		return(
			<QuadrantComponent key={i} group = {i} /> 
		)

	}


	render(){
		
		return(
			<g transform = "translate(0,10)" >
				{this.props.Quarters.map(this.eachRectPerQ)}
			</g>
			)
	}
}

export default BarsComponent;

