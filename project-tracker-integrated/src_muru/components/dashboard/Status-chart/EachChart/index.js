import React from 'react'
import Pie from '../../../../containers/Dashboard/Status-chart/Pie/index'

export default (props) => {

		var total = 0,
            data = props.data,
    		value = [],
    		color=[],
    		label=[];

    	if(props.type === "status") {
              color=["#dd2e2f","#89E91B","#53C8E5"];
        }

    	for(var key in data) {
            value.push(data[key].value);
    		label.push(data[key].label);
            total +=  parseInt(data[key].value);
    	} // total is to find percentage in legend.

		return (
			<Pie uniqueId={props.uniqueId} 
                data = {value} 
                color = {color} 
                label = {label} 
                total = {total} />
		) // uniqueId passed on for tooltip component
}