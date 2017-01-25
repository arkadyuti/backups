//Accordian Component

import React, { Component }  from 'react';
import  './accordian.scss';

import {Link} from 'react-router';


//styles to display dropdown list
const styles = {
	active: {
		display: 'inherit'
	},
	inactive: {
		display: 'none'
	},
	defaultAction: {
		display: 'none'
	}
};


export class Accordian extends Component {
	constructor() {
		super();
		this.state = {
			active: false,
			selected: false,
			notselected: true,

			count: localStorage.getItem( 'SelectedOption' ) || 5,
		};

		this.toggle = this.toggle.bind(this);
		/*this.handleClick = this.handleClick.bind(this);*/
	}
	                //to control the state of the arrow
	                toggle() {

	                	this.setState({
	                		active: !this.state.active,
	                		selected: !this.state.selected,
	                		notselected: false,
	                		
	                	});

	                }


	                
	                enterClick(evnt){
	                	if (evnt.keyCode == 13) {
	                		this.toggle();
	                	}
	                }




	//function to control clickable event of dropdown
	handleClick(e) {
		/*setSelectedOption( e.target.parentNode.dataset.index )*/
		this.setState({
			count: e.target.parentNode.dataset.index
		});
		this.props.handleClick(true);	  
		this.setSelectedOption( e.target.parentNode.dataset.index )
		localStorage.setItem( 'ListOption', '' );
	}

	setSelectedOption( option ) {
		localStorage.setItem( 'SelectedOption', option );

	}

	userMessage() {
		if (this.state.active) {

			return (

				<span className="ion-chevron-up arrow"></span>
				);
		}
		else {

			return (
				<span className="ion-chevron-down arrow"></span>);
		}
	}

	//to check if props of dropdown is existing
	userMeassageMain() {
		if (this.props.details.length > 0) {
			return (
				this.userMessage()
				);
		}
		else {
			return (
				<span className='defaultAction'></span>);
		}

	}

	displayDropdown(value) {
		if(this.props.clicked || localStorage.getItem('SelectedOption')!==''){
			if (value == this.state.count) {
				return 'visibleBackground';
			}
		}
		return '';
	}
	openNeedsAndRedstatus(value,index){
		if(value =='Open Needs' && this.props.sideNavData.openneeds!==0  && this.props.sideNavData.openneeds!==''){
			return (<span data-index={index}> ({this.props.sideNavData.openneeds}) </span>)
		}
		else if(value =='Red Status' && this.props.sideNavData.redcount!==0 && this.props.sideNavData.redcount!==''){
			return (<span data-index={index}> ({this.props.sideNavData.redcount}) </span>)
		}
		return '';
	}

	handleClose(){
		this.props.handleClose();
	}
	componentWillMount() {
		if( localStorage.getItem('ListOption')=== null && localStorage.getItem('SelectedOption')!==null){
		
      this.props.handleClick() ;//only if clicked is false
  }
}

lableOnFocus(){
	if(this.state.selected){
		return 'hide-outline'
	}
	if(this.state.notselected===false){
		return 'hide-outline-close'
	}
	
	return '';
}

render() {
	let tabIndexVar =  {tabIndex: 0}
		 //stateStyle is used to check if dropdown is active or not
		 const stateStyle = this.state.active ? styles.active : styles.inactive;
		 return (
		 	<section>
		 	<div onClick={this.toggle}  >
		 	<div className={"sidepanel-list " +this.lableOnFocus()} tabIndex='0' onKeyUp={this.enterClick.bind(this)}>
		 	<span className='hover-for-accordian list-title'>
		 	<span >{this.props.summary}</span>
		 	{this.userMeassageMain()}
		 	</span>
		 	</div>
		 	</div>


		 	<ul style={stateStyle} className='toggle-items-ul'>
		 	{
		 		this.props.details.map((data,index) => {
		 			return (
		 				<div data-index={index} key={data.text} onClick={this.handleClose.bind(this)}  className={this.displayDropdown(index)}    >
		 				<Link data-index={index}  to={"/"+data.route} onClick={this.handleClick.bind(this)}>
		 				<li data-index={index} key={data.text} className={`${this.displayDropdown(index)} toggle-items `}>
		 				<span data-index={index} key={data.icon} className='icon'>{data.icon}</span>
		 				<span data-index={index} className='toggle-list-item'>{data.text} {this.openNeedsAndRedstatus(data.text,index)}</span>
		 				</li>
		 				</Link>
		 				</div>


		 				);
		 		})
		 	}
		 	</ul>
		 	</section>
		 	);
		}
	}

	Accordian.propTypes = {
		summary: React.PropTypes.string.isRequired,
	};

	

