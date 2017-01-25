import React from 'react' 
import { connect } from 'react-redux'
import { bindActionCreators } from 'redux'

//containers
import  ListHeaderContainer  from '../../../containers/OpenNeedsContainer/table-header-container.js'

//components
import { TableRow } from './table-row.js'

//constants
import {calculateTopics} from '../../../constants/ProjectListConstants/pagination-function.js'

//styles
import './open-needs-table.scss'
import './open-needs-header.scss'


export class ProjectsTable extends React.Component{
	
	constructor(props){
		super(props)	
	}

	componentDidMount(){
		this.props.fetchData(this.props.pageSize);
	}

	componentWillUnmount(){
		this.props.resetData();
	}
	
	//Renders the header of the table
	renderData (columns){
		
		if(columns.length>0){
			var columnLength="total-column-"+columns.length;
		
			return (columns.map((column,index) => (
						
					<ListHeaderContainer column = { column.value } columnKey = {column.label} key={ index } columnLength={columnLength}/>
		  		))
		  	)}
		else {
			return "" 
		}
	}

	//Renders each row of the table
	renderTable (data,columns){
		if(data.length>0){
			return (
				data.map((value,index)=>(
					<TableRow tableContent = { value } columns = { columns } key={index} />))
			)
		}
		else {
			return ""
		}
	}
	
	//Creates the first set of data and pagination links to be displayed on refresh
	initialisePagination(){
		if (this.props.token == 0) {
			let newTopics =  calculateTopics(this.props.pageSize,this.props.currentPage,this.props.searchedData)
	        return this.renderTable(newTopics,this.props.columns)
		}
		else{
			return this.renderTable(this.props.topics,this.props.columns)
		}
	}
	
	//Complete rendering of the table
	render(){
		if(!this.props.inProgress){
			
				if(!this.props.error){
				var errorDisplay
				if(this.props.searchedData.length>0){
					errorDisplay ="error-display-none"
				}
				else{
					errorDisplay ="op-error-display-block"
				}
				let headerData = this.renderData(this.props.columns)
				let tableData =this.initialisePagination()
				return(
				<div>
					<div className = "full-table-scroll project-list" id="full-table-scroll">
						<div>
							<div className = "table-header"  >
								{ headerData }
							</div>
						</div>
						<div className="table-scroll" id="table-scroll">
							{tableData}
						</div>
					</div>
					<div className={errorDisplay}> No results found!</div>
						
				</div>
				);
			}
			else{
				return (<div className="op-error-display-block"> Sorry, unable to fetch data!</div>)
			}
		}
		else{
			return(<div className="op-error-display-block ">Loading... <div className="fetch-loader-icon"></div></div>)
		}
		
	}
}


ProjectsTable.propTypes={
	columns:React.PropTypes.array,
	projects:React.PropTypes.array,
	pageSize:React.PropTypes.number,
	topics:React.PropTypes.array,
	currentPage:React.PropTypes.number,
	token:React.PropTypes.number,
	searchedData:React.PropTypes.array,
	fetchData:React.PropTypes.func,
	inProgress:React.PropTypes.bool,
	error:React.PropTypes.bool,
	resetData:React.PropTypes.func
}
