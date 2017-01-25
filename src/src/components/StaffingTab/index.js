import React,{Component} from 'react';
import "./styles.scss";

//Containers
import ElementContainer from '../../containers/elementContainer';


export default class StaffingTab extends Component {
			
	constructor(props) {
		super(props);
		this.state ={
			BtnText:'add',
			noUser:'true'
		}
	}

	/**
      * handleBtnInnerText function :- 	  
      * Handles Add Btn inner text by changing the global state staffingFormVisible to ADD MORE or SAVE
    **/

	handleBtnInnerText(){
		return (this.props.staffingFormVisible==='Add More') ?'Save':'Add More'
	}

	/**
      * displayStaffingForm function :- 	  
      * toggles visibility of staffing form by adding a class named visible based on global state staffingFormVisible 
    **/
	displayStaffingForm(){
		
		return   'cp-staffing-form'+((this.props.staffingFormVisible==='Add More') ?' cp-visible':' ');
	}

	/**
      * handleBtnCss function :- 	  
      * adds ion-icon to the ADD btn if innertext is ADD MORE which is ensured by global state staffingFormVisible
    **/
	handleBtnCss(value){
		return  'cp-add-more-btn cp-Button'+((this.props.staffingFormVisible==="Add More")?'':' ion-plus');
	}

	/**
      * handleAddBtnClick function :- 	  
      * based on the current state of add btn ("ADD MORE" or "SAVE")different method is invoked
      * innerText argument:-
      * innerText argument refers to btn text ("ADD MORE" or "SAVE") 
    **/	
	handleAddBtnClick(innerText){
		

		if(this.props.staffingFormVisible === "Add More"){
		this.validateStaffingTab();
		}
		else{
		this.props.staffingFormDisplay(innerText)
	 	}
	 	this.checkNoUser()
    }

    /**
      * validateStaffingTab function :- 	  
      * validates each field of staffing form
      *								if(valid):- adds employee to the staffing table
      *								else     :-displays error message				  
    **/
	validateStaffingTab(){
		let allFilled = "true";

		/**
      	* validate each form field is as per regex :- 	  
    	**/
		this.props.list.map((field) => {
                let Regex = this.props.configJSON[field].regex;
                if(!Regex.test(this.props.staffingEmployeeBuffer[field])){

					console.log("DDDD",field)
					allFilled = "false";
					
                }
		})

		/**
      	* ensures oid is not repeated :- 	  
    	**/
		this.props.emptyJSON.staffing_details.map((employee) => {
			if(this.props.staffingEmployeeBuffer.oid === employee.oid){
					allFilled = "false";
				}
		})
		/**
      	* if all valid employee is added to the buffer list 	  
    	**/
		if(allFilled === "true"){
		let EmpDetailBuffer = this.props.staffingEmployeeBuffer;	
		this.props.updateEmpBufferToEmptyJson(EmpDetailBuffer);
		this.props.staffingFormDisplay("Save")
		}
		else{
			this.props.nextClick('false')
		}
	
	}

	/**
      * checkNoUser function :- 	  
      * checks if no employess have been added yet 
      *								if(true):- displays no user text by setting local state noUser to true
      *								else	sets local state to false		  
    **/
	checkNoUser(){
		(this.props.emptyJSON.staffing_details.length === 0)
    		?this.setState({noUser:'true'})
    		:this.setState({noUser:'false'});
	}
	componentWillReceiveProps(nextProps) {
    		this.checkNoUser()
	}
    
	 /**
      * handleTableCss function :- 	  
      * toggles visibility of staffing table by adding a class named not-visible based on local state noUser 
    **/
    handleTableCss(){
    	return   "cp-staffing-table"+((this.state.noUser==='true') ?' cp-not-visible':' ');
    }

     /**
      * handleNoUserTextCss function :- 	  
      * toggles visibility of NO USER TEXT by adding a class named not-visible or visible 
      * based on local state noUser  and global state staffingFormVisible
    **/
    handleNoUserTextCss(){
    	return   "cp-no-user-text"+((this.state.noUser==='false') || (this.props.staffingFormVisible === 'Add More')  ?' cp-not-visible':' cp-visible');
 	}
    
	render(){
		
	

		let tableData = this.props.emptyJSON.staffing_details.map( (staff,index) => {
					
			return( 
					<tr key={staff+index}>
						<td>{staff.oid}</td>
						<td>{staff.name}</td>
						<td>{staff.title}</td>
						<td>{staff.role}</td>
						<td>{staff.alloc_percent}</td>
						<td>{staff.start_date.slice(0, 10)}</td>
						<td>{staff.end_date.slice(0, 10)}</td>
						<td>{staff.skills[0].id}</td>
						<td>{staff.morale}</td>
					</tr>
				)
		});

		let addMoreBtn =(this.props.requestType.type !== 'view') 
						?<div className="cp-add-more-wrapper">
						<button className={this.handleBtnCss()}
							 onClick={(event) => this.handleAddBtnClick(event.target.innerText)}>
							 {this.handleBtnInnerText()}
						 </button>
						 </div>
						:"";
						

						

		return (
				
				<div className = "cp-staffing-tab">  
					<table className={this.handleTableCss()}>
						<thead>
							<tr>
								<th>OID</th>
								<th>Name</th>
								<th>Title</th>
								<th>Role</th>
								<th>Alloc Percent</th>
								<th>Start Date</th>
								<th>End Date</th>
								<th>Skills</th>
								<th>Morale</th>
							</tr>
						</thead>
						<tbody>
							{tableData}
						</tbody>
					</table>
					<div className={this.handleNoUserTextCss()}><span>Click on Add More to add employees to the project</span></div>	
					<div className={this.displayStaffingForm()} key="24">
						<ElementContainer list = {this.props.list} staffingFlag={"staffing"}/>
					</div>
					{addMoreBtn}
				</div>
				)
			}
		}

