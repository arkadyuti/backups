import React, { Component } from 'react'
import Arc from './Arc'
import * as d3 from 'd3'
import Legend from './Legend'
import { connect } from 'react-redux';

export default class Pie extends Component {

		constructor(props) {
			super(props);

			this.state = {
				x:80,
				y:-65,
				width:300,
				height:260
			}

			this._pieSlice = this._pieSlice.bind(this);
			this._updateDimensions = this._updateDimensions.bind(this);
		}

		componentDidMount() {
			window.addEventListener("resize", this._updateDimensions);
			this._updateDimensions();
		}

		_updateDimensions() {
			var width = (!window.innerWidth)? screen.width : window.innerWidth;
			if(width < 768) {
				this.setState({
					x:-70,
					y:80,
					width:210,
					height:320
				})
			}
			else {
				this.setState({
					x:80,
					y:-65,
					width:320,
					height:260
				})
			}
		}

		_pieSlice(value,i,color) {
			return (
				<Arc key = {i} 
				outerRadius = {this.props.radius}
            	value = {value}
            	fill = {color} /> 
            );
		}

		render () {

			var color = this.props.color;
			if(color.length === 0) {
				color = ["#3f25a3","#dd2e2f","#32c8b7","lightPurple","blue"];
			}

			var pie = d3.pie();
			var x = this.state.x,
				y = this.state.y,
				width =33.33;

			return(	
				<svg className="status-chart-svg" width = {this.state.width} height = {this.state.height} >
				<g transform = {`translate(${this.props.x}, ${this.props.y})`}>
				{pie(this.props.data).map((value,i) => this._pieSlice(value,i,color[i]))}

				<Legend x = {x} 
					y = {y} 
					color = {color} 
					label = {this.props.label} 
					data = {this.props.data} 
					total = {this.props.total} />
			
				</g>
				</svg> )
		}		
}