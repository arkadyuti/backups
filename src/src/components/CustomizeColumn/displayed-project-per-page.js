import React from 'react';
import { connect } from 'react-redux'
import { bindActionCreators } from 'redux'

//Displays the project number displayed in that page
export class ProjectList extends React.Component{
	render(){
		if(this.props.projects != null){
			let start = parseInt(parseInt(this.props.pageSize) * parseInt(this.props.currentPage - 1))
			let end 
			end = (this.props.projects.length) ? 
						((this.props.actionPerformed == 0) ? 
							((this.props.searchedData.length < this.props.pageSize) ? 
								(parseInt(start) + parseInt(this.props.searchedData.length)) : (parseInt(start) + parseInt(this.props.pageSize))) 
								: ((this.props.topics.length < this.props.pageSize) ? 
									(parseInt(start) + parseInt(this.props.topics.length)) : (parseInt(start) + parseInt(this.props.pageSize)))) : (parseInt(this.props.pageSize))	
			return (
				<span className="col-md-9 displayed-number">
					<span>PROJECTS: {start + 1} TO {end}</span>
				</span>
			);
		}
		else{
			return null
		}
	}
		
}
ProjectList.propTypes={
	pageSize:React.PropTypes.number,
	currentPage:React.PropTypes.number,
	actionPerformed:React.PropTypes.number,
	topics:React.PropTypes.array,
	searchedData:React.PropTypes.array,
	projects:React.PropTypes.array
}
