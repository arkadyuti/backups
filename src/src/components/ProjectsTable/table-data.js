import React from 'react'
import BREWSER from 'brewser';

//To display Tool-Tip on overflow of data
export default class TableData extends React.Component {
	render(){
		var tooltip = "";
		var touch = "";
		if(this.props.rowContent.length >=18){
			tooltip = "display-tooltip"
		}
		else {
			tooltip = "hide-tooltip"
		}
		if(BREWSER.br.device.touch){
			touch = 'touch-col-'+this.props.length
		}
		
		return (
			<div className={`table-data ${this.props.columnLength} ${this.props.column} ${touch}`} >
			<div className={`table-data-content ${this.props.rowContent}`}>
				{this.props.rowContent}
				</div>
			<span className={tooltip}>{this.props.rowContent}</span>
			</div>
		)
	}
}