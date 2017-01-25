import React from 'react';
import TableData from './table-data.js'
import {Link} from 'react-router'
var SwipeToRevealOptions = require('react-swipe-to-reveal-options');

//To display each row of the table
export class TableRow extends React.Component {
	
	constructor(props){
		super(props)
	}

	renderData (columns){
		var columnLength='total-column-'+columns.length;
		if(columns.length){
			return (columns.map((column,index) => (
			  		<TableData  key={index} column={column.label} rowContent= {this.props.tableContent[column.value]} columnLength={columnLength}/>
			   	))
			)
		}
		else {
			return ''
		}		
	}
	
	render(){

		var rowData = this.renderData(this.props.columns)

		return (		
				<div className='table-row force-overflow'> 
					{ rowData }
				</div>				
		)
	}
}