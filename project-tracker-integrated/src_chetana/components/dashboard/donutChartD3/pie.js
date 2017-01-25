import React, { Component } from 'react'
import Arc from './Arc'
import * as d3 from 'd3'
import Legend from './Legend'
import { connect } from 'react-redux';

class Pie extends Component {

		constructor(props) {
			super(props);

			this._pieSlice = this._pieSlice.bind(this);
		}

		_pieSlice(value,i,color){
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
			var x = this.props.Ordinate.x,
				y = this.props.Ordinate.y,
				width =33.33;

			return(	
				<svg width = {350} height = {300} >
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

function mapStateToProps(state) {
	// whatever returned will show up as props inside of 
	// DonutChart. This acts as a psuedo state.
	return{
		Ordinate : state.legendOrdinate
	}
}

export default connect(mapStateToProps)(Pie);