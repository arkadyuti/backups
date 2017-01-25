import React from 'react'
import * as d3 from 'd3'

export default (props) => {

	var arc = d3.arc()
    	.innerRadius(50)
    	.outerRadius(66);

    	return (
    	<path d={arc(props.value)} fill={props.fill} />
    	)
}