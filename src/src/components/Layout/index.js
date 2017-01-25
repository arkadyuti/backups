import React, { Component}  from 'react';
import './layout.scss';
import SidePanel from '../../containers/SidePanel';
import Header from '../Header';
export class Layout extends Component {
	componentWillMount(){
		this.props.fetchHeaderData();
		this.props.fetchSideNavData();
	}

	handleClose(e){
			
			this.props.handleClose();
	}
	

	render() {	
			//left-container and side panel components are enclosed 	
			// right container consisting of Header and the content
		return (
			<div className ="show-grid" >
			
				<div className = {"left-container " +(this.props.status?'show1':'')} > 	
			    		<SidePanel />	
				</div>
				
					
				<div className = "right-container" >
					<header className = "header-gc"> <Header /></header>
				<main className = "content" onClick={this.handleClose.bind(this)}> {this.props.children} </main>
				</div>
			</div>
			)
	}
};

