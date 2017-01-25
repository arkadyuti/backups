import React from 'react';

class LegendComponent extends React.Component{
	constructor(props){
		super(props);
		this.makeLegend = ::this.makeLegend;
	}

	makeLegend(d,i){
		var xcoor = 0;
		return(
				<div key={i} x={xcoor} y={30} >
					<span className="box" style={{backgroundColor: this.props.colorData[i]}} ></span>
					<span>{d}</span>
				</div>
			)
	}

	render(){
		return(
				<span className="legend">
					{this.props.colorNames.map(this.makeLegend)}
				</span>
			)
	}
}


export default LegendComponent;

