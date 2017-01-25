import React from 'react';
import QuadrantMobileComponent from '../../../containers/QuadrantMobileContainer.js';


class BarsMobileComponent extends React.Component{

	 

	constructor(props){
		super(props);
        this.eachRectPerQ = ::this.eachRectPerQ;

	}

	componentWillUpdate() {
		


	}

	componentDidUpdate() {

	}
	

	eachRectPerQ(d,i){
		return(
			<QuadrantMobileComponent key={i} group = {i} q ={d} /> 
		)

	}


	render(){
		return(
			<g transform = "translate(160,35)">
				{this.props.Qs.map(this.eachRectPerQ)}
			</g>
			)
	}
}

export default BarsMobileComponent;

