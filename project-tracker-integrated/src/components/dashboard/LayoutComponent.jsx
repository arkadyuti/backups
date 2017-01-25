import React , {Component} from 'react';
import DonutChart from './donutChartD3/jsx/donut1.jsx';

export default class LayoutComponent extends Component{
	constructor(props){
		super(props)
	}

	render(){
		return(
			<div><DonutChart /></div>
		);
	}
}