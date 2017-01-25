import React from 'react';

class LegendMobileComponent extends React.Component{
	constructor(props){
		super(props);
		this.makeLegend = ::this.makeLegend;
	}

	makeLegend(d,i){
		var xcoor = 0;
		return(
				<li key={i}>
					<span className="box" style={{backgroundColor: this.props.colorData[i]}} ></span>
					<span>{d}</span>
				</li>
			)
	}

	render(){
		return(
				<ul className="legend">
					{this.props.colorNames.map(this.makeLegend)}
				</ul>
			)
	}
}


export default LegendMobileComponent;

