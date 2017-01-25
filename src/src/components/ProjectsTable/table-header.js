import React from 'react'
import { connect } from 'react-redux'
import {Link} from 'react-router'
import BREWSER from 'brewser';

//Constants
import {searchProjects} from '../../constants/ProjectListConstants/search-function.js'
import {sortingData} from '../../constants/ProjectListConstants/sort-function.js'

//Displays the table header
export class ListHeaderComponent extends React.Component {
	constructor(props){
		super(props)
	}

	//Event Handler for sort function
	organizeData(e){
		let id = e.target.id;
		let result = sortingData(id,this.props.searchedData,this.props.toggleFilter,this.props.pageSize,this.props.currentPage)
		this.props.sortData(result)
	}

	//Event Handler for search function
	searchValue(e){	
		let id = e.target.id;
		let val = e.target.value.toLowerCase();
		let result = searchProjects(val,id,this.props.projects,this.props.pageSize,this.props.currentPage,this.props.searchValue,this.props.columns);
		this.props.searchData(result);
	}

	render(){
		var sortArrow ="";
		var sortOrder ="";
		var touch = "";
		if(BREWSER.br.device.touch){
			touch = 'touch-'+this.props.columnLength
		}
		if(this.props.toggleFilter[this.props.column]){
			sortOrder = "descending"
			if (this.props.column == "pid") {

				sortArrow= "icon-sort-numeric-asc"
			}
			else{
				sortArrow = "icon-sort-alpha-desc"
			}
		}
		else{
			sortOrder = "ascending"
			if (this.props.column == "pid") {
				sortArrow= "icon-sort-numberic-desc"
			}
			else{
				sortArrow = "icon-sort-alpha-asc"
			}
		}

		return (
			<div className={`filter-header ${this.props.columnLength} ${touch}`}> 
				<div className = "filter-head-name">
					<label>{this.props.columnKey}</label>
					<span  className={sortArrow} onClick={ this.organizeData.bind(this) } id={this.props.column} tabIndex="3"></span>
				</div>
				<input type="text" id = {this.props.column} onChange={this.searchValue.bind(this)} className="search-input" tabIndex="3"/>
			</div>
		)
	}
}
ListHeaderComponent.propTypes={
	toggleFilter:React.PropTypes.object,
	projects:React.PropTypes.array,
	searchValue:React.PropTypes.object,
	pageSize:React.PropTypes.number,
	topics:React.PropTypes.array,
	currentPage:React.PropTypes.number,
	searchedData:React.PropTypes.array,
	columns:React.PropTypes.array,
	searchData:React.PropTypes.func,
	sortData:React.PropTypes.func
}
