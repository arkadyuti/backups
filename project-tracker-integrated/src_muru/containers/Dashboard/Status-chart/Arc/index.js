import React, { Component, PropTypes } from 'react'
import { connect } from 'react-redux';
import { bindActionCreators } from 'redux';
import * as d3 from 'd3'

class Arc extends Component {

    render() {

    	var arc = d3.arc()
    	.innerRadius(this.props.innerRadius)
    	.outerRadius(this.props.outerRadius);

    	return (
    	<path d = {arc(this.props.value)} 
    	fill = {this.props.fill} 
    	onMouseOver = {() => {this.props.handleHover(this.props.index)}}
    	onMouseOut ={this.props.handleHoverOut} />
    	)
    }
}

function mapStateToProps(state) {
	// whatever returned will show up as props inside of 
	// Arc. This acts as a psuedo state.
	return {
		innerRadius : state.statusChartInnerRadius,
		outerRadius : state.statusChartOuterRadius
	}
}

export default connect(mapStateToProps)(Arc);