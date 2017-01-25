import React from 'react';
import * as d3 from 'd3';

class YAxisComponent extends React.Component{
	constructor(props){
		super(props);
		this.makeYaxis = ::this.makeYaxis;
	}

	componentWillMount() {
		
	}	


	makeYaxis(d,i){

		let tickHeight = this.props.barHeight - this.props.barHeight*i/5;
		return (
				<g className = "tick" key={i} transform={`translate(20,${tickHeight})`}>
					<text dy=".32em" x="-9" y="0" textAnchor="end">{d}</text>
				</g>
			)
	}

	render(){
		let arr = [],i=0,ticks=0;
		let maxData = d3.max(this.props.responseData);
		let divlength = maxData/5;
		while(i<=maxData){
			ticks++;			
			arr.push(parseInt(i));
			i+=divlength;
		}

		return (
				<g transform = "translate(30,60)" >
					{arr.map(this.makeYaxis)}
				</g>
			)
	}
}

export default YAxisComponent;
