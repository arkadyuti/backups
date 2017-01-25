import React from 'react'
import Pie from '../../../../containers/Dashboard/StatusChart/pie/index'

export default (props) => {

		var total = 0,
            data = props.data,
    		value = [],
    		color=[],
    		label=[];

    	if(props.type === "status") {
              color=["#dd2e2f","#89E91B","#53C8E5"];
        } // here for the first chart with type "status", the colors are red, green and  blue
        // explicitly specifying

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
		) // uniqueId passed on to pie component to give appropriate className for svg
	// eg-svg0,svg1,etc for more control
}