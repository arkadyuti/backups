import React, { Component } from 'react'
import { connect } from 'react-redux'
import { bindActionCreators } from 'redux'
import Arc from '../Arc/index'
import * as d3 from 'd3'
import Legend from '../../../../components/Dashboard/Status-chart/Legend/index'

class Pie extends Component {

		constructor(props) {
			super(props);

			this.state = {
				hover:""
			}

			this._pieSlice = this._pieSlice.bind(this);
			this._handleHover = this._handleHover.bind(this);
			this._handleHoverOut = this._handleHoverOut.bind(this);
		}

		_handleHover(index) {
			this.setState ({
				hover:index
			})
		} // setting hover property on the correct legend group => in <legend>
		// hover-active class set
		
		_handleHoverOut() {
			this.setState ({
				hover:""
			})
		}

		_pieSlice(value,i,color) {
			return (
				<Arc key = {i}
				index={i}
				handleHover = {this._handleHover}
				handleHoverOut ={this._handleHoverOut} 
            	value = {value}
            	fill = {color} /> 
            );
		}

		render () {
			var color = this.props.color;
			if(color.length === 0) {
				color = ["#3f25a3","#dd2e2f","#32c8b7"]; // defining first 
				// three colours as seen in PSD.
				var colours = d3.scaleOrdinal(d3.schemeCategory10);
				this.props.data.map((item,i) => {
					color.push(colours(i));
				}) // pushing extra colours into the array according to the 
				// length of data
			}

			var pie = d3.pie();

			return (
				<div className = {`status-svg-container col-xs-12 col-sm-6 col-md-4 col-lg-4`}>
					<svg width = {this.props.outerRadius * 2} 
					height = {this.props.outerRadius * 2} 
					className={`svg${this.props.uniqueId}`}>
					{/* classname of svg0, svg1, svg2 to have more control */}
						<g transform = {`translate(${this.props.outerRadius}, ${this.props.outerRadius})`}>
						{pie(this.props.data).map((value,i) => this._pieSlice(value,i,color[i]))}
						</g>
					</svg>
					<Legend hover = {this.state.hover}
					color = {color} 
					label = {this.props.label} 
					data = {this.props.data} 
					total = {this.props.total} />
				</div>
				)
		}		
}

function mapStateToProps(state) {
	// whatever returned will show up as props inside of 
	// Pie. This acts as a psuedo state.
	return {
		outerRadius : state.statusChartOuterRadius
	}
}

export default connect(mapStateToProps)(Pie);