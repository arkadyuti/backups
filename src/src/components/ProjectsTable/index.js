import React from 'react' 
import { connect } from 'react-redux'
import { bindActionCreators } from 'redux'
import BREWSER from 'brewser';
//containers
import  ListHeaderContainer  from '../../containers/ProjectTableContainer/table-header-container.js'

//components
import { TableRow } from './table-row.js'

//Functions
import {calculateTopics} from '../../constants/ProjectListConstants/pagination-function.js'

//Styles
import './projects-table.scss'
import './project-list-header.scss'


export class ProjectsTable extends React.Component{
	constructor(props){
		super(props)	
	}

	componentWillMount(){
		this.props.fetchData(this.props.pageSize);
	}

	componentWillUnmount(){
		this.props.resetData();
	}
	
	//Renders the header of the table	
	renderData (columns){
		var columnLength="total-column-"+columns.length;
		
		if(columns){
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
						<TableRow tableContent = { value } columns = { columns } key={index}  updatePid={this.props.updatePid}/>))
				)
			}
			else {
				return ""
			}
		}
	
	//Creates the first set of data and pagination links to be displayed on refresh
	initialisePagination(){
		if (this.props.actionPerformed == 0) {
			let newTopics =  calculateTopics(this.props.pageSize,this.props.currentPage,this.props.searchedData)
	        return this.renderTable(newTopics,this.props.columnCheckBox)
		}
		else{
			return this.renderTable(this.props.topics,this.props.columnCheckBox)
		}
	}

	//Swipe action on Touch devices
	viewEdit(touch){
		if(touch){
			return(			
				<div className = "view-edit">
					<span className="view">View</span>
					<span className="slash">/</span>
					<span className="edit">Edit</span>
				</div>
			)
		}
	}

	//Complete rendering of the table
	render(){
		if(!this.props.inProgress){
			var errorDisplay;

			if(!this.props.error){
				
			let headerData = this.renderData(this.props.columnCheckBox)
			let tableData =this.initialisePagination()
			let view = this.viewEdit(!BREWSER.br.device.touch)
				if(this.props.searchedData.length>0){
						errorDisplay ="error-display-none"
				}
				else{
						errorDisplay ="error-display-block"
				}
				return(
					<div className="project-list-comp" id="project-list-comp">
						<div className = "project-list" >
							<div>
								<div className = "table-header"  >
									{ headerData }
									{ view }
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
				return (<div className="failed-response error-display-block"> Sorry, unable to fetch data! </div>)
			}

		}
		else{
			return (<div className="failed-response error-display-block">Loading... <div className="fetch-loader-icon"></div></div>)
		}	
		
	}
}



ProjectsTable.propTypes ={
		columnCheckBox:React.PropTypes.array,
		projects:React.PropTypes.array,
		pageSize:React.PropTypes.number,
		topics:React.PropTypes.array,
		currentPage:React.PropTypes.number,
		actionPerformed:React.PropTypes.number,
		searchedData:React.PropTypes.array,
		fetchData:React.PropTypes.func,
		fetchJSON:React.PropTypes.func,
		inProgress:React.PropTypes.bool,
		error:React.PropTypes.bool,
		resetData:React.PropTypes.func
}