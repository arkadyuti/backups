import React, { Component } from 'react'
import * as d3 from 'd3'

export default (props) => {  // STATE-LESS component
	
	function _handleEllipsisClass(i) {
		return (props.label[i].length > 3)?  "legend-group-ellipsis": "legend-group"
	} // ellipsis classnames given to enable tooltip on them

	function _handleHoverClass(i) {
		return (i === props.hover)? "hover-active" : "hover-not-active"
	}// handling hover classNames to give more control

	function _legendGroup(value,i) {

		var circleStyle = {
            background:props.color[i]
        };

        var textStyle = (i === props.hover)?
        				{ color:props.color[i] } : {};
        // textStyle so that on hover of arc, corresponding li item GLOWS

		var percentage = ((props.data[i] / props.total)*100).toFixed(2);
		var text = props.label[i].toUpperCase();
		if(text.length > 3) {
			text = text.substring(0,3)+"...";
		} // adding ellipsis
		
		return(
			
			<li data-balloon={props.label[i].toUpperCase()} data-balloon-pos="up"
			className={`${_handleEllipsisClass(i)} ${_handleHoverClass(i)}`}>
			<span className="status-chart-legend-color"
			style={circleStyle}></span>
			<span style={textStyle}>{`${text} ${percentage}%`}</span>
			</li>
			
		)
	}

	return(
		<ul>
		{props.data.map(_legendGroup)}
		</ul>
	)
}
