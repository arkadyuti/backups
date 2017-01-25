import React from 'react'
import { connect } from 'react-redux'
import {Link} from 'react-router'

//Constants
import {searchProjects} from '../../../constants/ProjectListConstants/search-function.js'

//Displays the table header
export class ListHeaderComponent extends React.Component {
	
	constructor(props){
		super(props)
	}

	//Event Handler for search function
	searchValue(e){
		let id = e.target.id;
		let val = e.target.value.toLowerCase();
		let result = searchProjects(val,id,this.props.projects,this.props.pageSize,this.props.currentPage,this.props.searchValue,this.props.columns);
		this.props.searchData(result);
	}

	render(){
		

		return (
			<div className={`filter-header ${this.props.columnLength}`}> 
				<div className = "filter-head-name">
					<label>{this.props.columnKey}</label>
				</div>
				<input type="text" id = {this.props.column} onChange={this.searchValue.bind(this)} className="search-input" tabIndex="3"/>
			</div>
		)
	}
}
ListHeaderComponent.propTypes = {
	projects:React.PropTypes.array,
	searchValue:React.PropTypes.object,
	pageSize:React.PropTypes.number,
	topics:React.PropTypes.array,
	currentPage:React.PropTypes.number,
	searchedData:React.PropTypes.array,
	columns:React.PropTypes.array,
	searchData:React.PropTypes.func,
}
