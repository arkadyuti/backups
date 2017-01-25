import React from 'react';
import TableData from './table-data.js'
import {Link} from 'react-router'
var SwipeToRevealOptions = require('react-swipe-to-reveal-options');
import BREWSER from 'brewser';

//To display each row of the table
export class TableRow extends React.Component {
	
	constructor(props){
		super(props)
	}
	handleClick(action,e){

		this.props.updatePid(e.target.id);
		

	}
	renderData (columns){
		
		var columnLength='total-column-'+columns.length;

		if(columns.length){
			return (columns.map((column,index) => (
			  		<TableData  key={index} column={column.label} rowContent= {this.props.tableContent[column.value]} columnLength={columnLength} length={columns.length}/>
			   	))
			)
		}
		else {
			return ''
		}		
	}
	
	render(){
		var touch=BREWSER.br.device.touch;
		var pid=this.props.tableContent['pid'];
		//Swipe action
		var items = [
	        {
		      	rightOptions: [{
					label: <Link to={'/projects/view/'+pid} onClick = {this.handleClick.bind(this,'view')} id={this.props.tableContent['pid']}>View</Link>,
					class: 'view'
		        },{
					label: <Link to={'/projects/edit/'+pid} onClick = {this.handleClick.bind(this,'edit')}>Edit</Link>,
					class: 'edit'
		        }],
	        	callActionWhenSwipingFarLeft: false,
	        	callActionWhenSwipingFarRight: true
      		}
      	]
      	
		var rowData = this.renderData(this.props.columns)
		if(touch){
			return (
				<SwipeToRevealOptions 
	              rightOptions={items[0].rightOptions}
	              callActionWhenSwipingFarRight={items[0].callActionWhenSwipingFarRight}
	              callActionWhenSwipingFarLeft={items[0].callActionWhenSwipingFarLeft}>
					<div className='table-row force-overflow'> 
						{ rowData }
					</div>
				</SwipeToRevealOptions>
			)
		}
		else{
			return( 
				<div className='table-row force-overflow'> 
						{ rowData }

						<div className = 'nav-button'><span className = 'nav-view-btn' id=  {this.props.tableContent['pid']} onClick = {this.handleClick.bind(this,'view')} ><Link to={'/projects/view/'+pid} className='link-view' tabIndex='4'>View</Link></span><span className='nav-edit-btn' onClick = {this.handleClick.bind(this,'edit')}><Link id=  {this.props.tableContent['pid']} to={'/projects/edit/'+pid} className='link-edit' tabIndex='4'>Edit</Link></span>
						</div>
						
				</div>
			)
		}
						
	}
}


