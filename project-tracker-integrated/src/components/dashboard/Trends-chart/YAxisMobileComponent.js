import React from 'react';
import * as d3 from 'd3';

class YAxisMobileComponent extends React.Component{
	constructor(props){
		super(props);
		this.maxData = d3.max(this.props.newData);
		this.makeYaxis = ::this.makeYaxis;
	}

	componentWillMount() {
		
	}	


	makeYaxis(d,i){

		let tickHeight = this.props.barHeight - this.props.barHeight*i/5;
		return (
				<g className = "tick" key={i} transform={`translate(0,${tickHeight})`}>
					<text dy=".32em" x="-9" y="0" textAnchor="middle">{d}</text>
				</g>
			)
	}

	render(){
		let arr = [],i=0,ticks=0;
		let maxData = d3.max(this.props.newData);
		let divlength = maxData/5;
		while(i<=maxData){
			ticks++;			
			arr.push(i);
			i+=divlength;
		}
		
		
		let yScale = d3.scaleLinear()
					  .domain([maxData,0])
					  .range([0,(this.props.barHeight)]);
		let vAxis = d3.axisRight()
					  .scale(yScale)
					  .ticks(4);
			

		return (
				<g transform = "translate(30,80)" >
					{arr.map(this.makeYaxis)}
				</g>
			)
	}
}

export default YAxisMobileComponent;
