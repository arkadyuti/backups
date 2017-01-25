import React from 'react';
import QuadrantComponent from '../../../containers/QuadrantContainer.js';


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
				{this.props.Qs.map(this.eachRectPerQ)}
			</g>
			)
	}
}

export default BarsComponent;

