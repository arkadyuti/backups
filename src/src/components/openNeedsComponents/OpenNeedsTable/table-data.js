import React from 'react'

//To display Tool-Tip on overflow of data
export default class TableData extends React.Component {
	render(){
		var tooltip = "";
			if(this.props.rowContent.length >=12){
				tooltip = "display-tooltip"
			}
			else {
				tooltip = "hide-tooltip"
			}
	
		return (
			<div className={`table-data ${this.props.columnLength} ${this.props.column} `} >
			<div className={`table-data-content ${this.props.rowContent}`}>
				{this.props.rowContent}
				</div>
			<span className={tooltip}>{this.props.rowContent}</span>
			</div>
		)
	}
}