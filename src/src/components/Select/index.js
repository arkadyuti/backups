import React,{Component} from 'react';

import LabelDescription from '../LabelDescription/index.js';

import './styles.scss'

	/**
      * ClickOutHandler  	  
      * An onClickOutside wrapper for React components
    **/
let ClickOutHandler = require('react-onclickout');



export default class SelectInput extends Component{

	constructor(props) {
    	super(props);
    	this.state = {
      		selected: 'false',
      		defaultVal:''
    	};

	}

	/**
      * onClickOut function :- 	  
      * onClickOutside  method invoked when clicked outside the component
    **/
	onClickOut() {
  		(this.state.selected ==='true')?this.setState({selected:'false'}):""
  	}

	componentWillMount() {

		/*this.setState({defaultVal: this.props.emptyJSON[this.props.field.name]})*/
		if(this.props.requestType.type === "create")
			this.setState({defaultVal: this.props.field.default})
		else
			this.setState({defaultVal: this.props.emptyJSON[this.props.field.name]})

		// this is for first click of create,edit or view
	}

	componentWillReceiveProps(nextProps,nextState){

		//Handle create Transitions
		
		if(this.props.requestType.type === "edit" && nextProps.requestType.type === "create"){
			
			//this is for transition of edit to create
			this.setState({defaultVal: nextProps.emptyJSON[this.props.field.name]})
		}
		if(this.props.requestType.type === "view" && nextProps.requestType.type === "create"){
			
			//this is for transition of view to create
			this.setState({defaultVal: nextProps.emptyJSON[this.props.field.name]})
		}

		if(nextProps.emptyJSON[this.props.field.name] === this.state.inputValue && (this.props.requestType.type === "create" && nextProps.requestType.type === "create")){
			
			this.setState({defaultVal: nextProps.emptyJSON[this.props.field.name]})
		}

		//Handle Edit Transitions
		if(nextProps.emptyJSON[this.props.field.name] === this.state.inputValue && (this.props.requestType.type === "edit" && nextProps.requestType.type === "edit")){

			this.setState({defaultVal: nextProps.emptyJSON[this.props.field.name]})
		}

		if(this.props.requestType.type === "create" && nextProps.requestType.type === "edit"){
			
			//this is for transition of create to edit
			this.setState({defaultVal: nextProps.emptyJSON[this.props.field.name]})
		}
		if(this.props.requestType.type === "view" && nextProps.requestType.type === "edit"){
			
			//this is for transition of view to edit
			this.setState({defaultVal: nextProps.emptyJSON[this.props.field.name]})
		}
	}

	/**
      * handleClick function :-
      * handles click event for select input 	  
      * toggles the local state "selected" based on which select options are displayed 
    **/
    handleClick(){
    	(this.state.selected ==='false' || '')?this.setState({selected:'true'}):this.setState({selected:'false'})
    }
    
    /**
      * handleLiClick function :-
      * handles click event for select options  	  
      * sets local state "defaultVal" based on which select options is clicked 
      * toggles the local state "selected"
    **/
    handleLiClick(event){
    	let targetText = event.target.innerText;
    	/*targetText = this.props.configJSON[location].code(Bangalore);
    	console.log("targetText",targetText);*/
    	this.setState({defaultVal : targetText});
    	(this.state.selected ==='false')?this.setState({selected:'true'}):this.setState({selected:'false'})
    	{this.props.updateUserInput(targetText,this.props.field.name)};
    }

    /**
      * makeActiveGrey function :-
      * based on the current local state "selected"
      * shevron-grey class is added to the div to make background color grey  	  
    **/
    makeActiveGrey(value){
		return 'cp-custom-shevron'+((value===this.state.selected) ?'':' cp-shevron-grey');
	}

	 /**
      * chevronDirection function :-
      * based on the current local state "selected"
      * ion-icon class is added to display appropriate chevron ("UP" or "DOWN")  	  
    **/
	chevronDirection(value){
		return 'cp-custom-shevron-icon'+((value===this.state.selected) ?' ion-chevron-down':' ion-chevron-up');
	}

	/**
      * displayDropdown function :-
      * based on the current local state "selected"
      * visible class is added to display options  	  
    **/
    displayDropdown(value){
    	if(value===this.state.selected)
    	return 'cp-visible';
    }

    /**
      * handleClickEnterOnSelect function :-
      * wrapper function to handle key press "ENTER" on select component 	  
    **/
    handleClickEnterOnSelect(event){
    	(event.key==="Enter")?this.handleClick():"";
    }

    /**
      * handleClickEnterOnLi function :-
      * wrapper function to handle key press "ENTER" on select options 	  
    **/
    handleClickEnterOnLi(event){
		(event.key==="Enter")?this.handleLiClick(event):"";
    }

    /**
      * lableOnFocus function :-
      * based on the current local state "selected"
      * lable-blue class is added to make lable blue  	  
    **/
    lableOnFocus(){

    	return "cp-floating-label"+((this.state.selected==="true") ?' cp-label-blue':'');

    }

  
	render() {
        
  
   let defaultTabIndex = {tabIndex: 0};

   let HTML = (this.props.requestType.type === 'view')
   				?	<LabelDescription field={this.props.field} />
				
					:<div> 
						<ClickOutHandler onClickOut={this.onClickOut.bind(this)}>  
							<div className="cp-selected" 
								 onKeyDown={this.handleClickEnterOnSelect.bind(this)} 
								 onClick={this.handleClick.bind(this)}>
							    	<div  	{...defaultTabIndex} 
							    			className={this.makeActiveGrey('false')}>
							    				<span className={this.chevronDirection('false')}>
							    				</span>
							    	</div>
							    	<label className={this.lableOnFocus()}>{this.props.field.staticValue}</label>
							    	<span className="cp-selected-li-text">
							    		{this.state.defaultVal}
							    	</span>
							</div>
						</ClickOutHandler>		
					  	<div className="cp-options">
					    	<ul className={this.displayDropdown('true')}>
					    		{
					    			this.props.field.options.map( (option) => {
										return ( 	<li onKeyDown={this.handleClickEnterOnLi.bind(this)}
													 	onClick={this.handleLiClick.bind(this)}
													 	key={option} 
													 	{...defaultTabIndex}>
													 		{option}
													</li>
												)
									})
								}
					    	</ul>
					  	</div>
					</div>   

		return(
			<div key={this.props.field.id} className="cp-selectbox">
				{HTML}
			</div>
		)
	}
}

