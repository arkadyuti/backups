import React from 'react';

class XAxisComponent extends React.Component{
	constructor(props){
		super(props);
		this.makeXaxis = ::this.makeXaxis;
	}

	makeXaxis(d,i){
		let tickWidth = 400*i/4+35;
		let points = ""+2+" "+2+","+19+" "+2+","+9.5+" "+-3+"";
		return(
				<g className="tick" key={i} transform={`translate(${tickWidth},0)`}>
					<line y2="6" x2="0"></line>
					<text dy=".71em" y="9" x="0" styles={"textAnchor: end"}>{d}</text>
					<polygon points={points} fill="white" />
				</g>
			)
	}

	render(){
		return (
				<g transform = "translate(40,285)" >
					{this.props.Qs.map(this.makeXaxis)}
				</g>
			)
	}
}

export default XAxisComponent;

