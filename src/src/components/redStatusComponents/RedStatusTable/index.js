import React from 'react' 
import { connect } from 'react-redux'
import { bindActionCreators } from 'redux'

//containers
import  ListHeaderContainer  from '../../../containers/RedStatusContainer/table-header-container.js'

//components
import { TableRow } from './table-row.js'

//styles
import './red-status-table.scss'
import './red-status-header.scss'

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
		
			if(data){
				return (
					data.map((value,index)=>(
						<TableRow tableContent = { value } columns = { columns } key={index} />))
				)
			}
			else {
				return ""
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
					errorDisplay ="red-status-error-display-block"
				}
				let headerData = this.renderData(this.props.columns)
				let tableData =this.renderTable(this.props.searchedData,this.props.columns)
				return(
				<div>
					<div className = "project-list" >
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
				return (<div className="red-status-error-display-block"> Sorry, unable to fetch data! </div>)
			}
		}
		else{
			return(<div className="red-status-error-display-block">Loading... <div className="fetch-loader-icon"></div></div>)
		}
	}
}


ProjectsTable.propTypes = {
	columns:React.PropTypes.array,
	projects:React.PropTypes.array,
	searchedData:React.PropTypes.array,
	fetchData:React.PropTypes.func,
	inProgress:React.PropTypes.bool,
	error:React.PropTypes.bool,
	resetData:React.PropTypes.func
}
