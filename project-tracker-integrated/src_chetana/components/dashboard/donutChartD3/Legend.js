import React, { Component } from 'react'
import * as d3 from 'd3'

class Legend extends Component {

	constructor(props) {
		super(props);

		this._legendGroup = this._legendGroup.bind(this);
	}
	
	componentWillUpdate() {
		this.y = 0;
	}

	_legendGroup(value,i) {

		var rectStyle = {
            fill:this.props.color[i],
            stroke:this.props.color[i]
        };

        this.y = this.y || 0;
        this.y = this.y + 30;
        var x = 10;

		var transform="translate("+x+","+this.y+")";
		var percentage = ((this.props.data[i]/this.props.total)*100).toFixed(2);
		var text = this.props.label[i]+" "+percentage+" %";

		return(
			<g transform={transform} key={i}>
			<circle cx="10" cy="5" r="5" style={rectStyle}></circle>
			<text x="20" y="10">{text}</text>
			</g>
		)
	}

	render() {
		return(<g transform={`translate(${this.props.x}, ${this.props.y})`} >
			{this.props.data.map(this._legendGroup)}
			</g>)
	}
}

export default Legend