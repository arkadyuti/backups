import React from 'react'
import Pie from './pie'

export default (props) => {

		var radius = 150,
    		x = props.x,
    		y = props.y,
            total = 0,
            data = props.data,
    		value = [],
    		color=[],
    		label=[];

    	if(props.type=="status"){
              color=["#dd2e2f","#89E91B","#53C8E5"];
        }

    	for(var key in data) {
            value.push(data[key].value);
    		label.push(data[key].label);
            total +=  parseInt(data[key].value);
    	}

		return (
			<Pie x = {x} 
                y = {y} 
                radius = {radius} 
                data = {value} 
                color = {color} 
                label = {label} 
                total = {total}/>

		)
}