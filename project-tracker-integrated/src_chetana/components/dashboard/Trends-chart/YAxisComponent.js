import React from 'react';
import * as d3 from 'd3';

class YAxisComponent extends React.Component{
	constructor(props){
		super(props);
		this.maxData = d3.max(this.props.newData);
		this.makeYaxis = this.makeYaxis.bind(this);
	}

	componentWillMount() {
		
	}	


	makeYaxis(d,i){

		var tickHeight = this.props.barHeight - this.props.barHeight*i/5;
		return (
				<g className = "tick" key={i} transform={`translate(0,${tickHeight})`}>
					<text dy=".32em" x="-9" y="0" textAnchor="middle">{d}</text>
				</g>
			)
	}

	render(){
		var arr = [],i=0,ticks=0;
		var maxData = d3.max(this.props.newData);
		var divlength = maxData/5;
		while(i<=maxData){
			ticks++;			
			arr.push(i);
			i+=divlength;
		}
		
		
		var yScale = d3.scaleLinear()
					  .domain([maxData,0])
					  .range([0,(this.props.barHeight)]);
		var vAxis = d3.axisRight()
					  .scale(yScale)
					  .ticks(4);
			

		return (
				<g transform = "translate(30,60)" >
					{arr.map(this.makeYaxis)}
				</g>
			)
	}
}

export default YAxisComponent;
