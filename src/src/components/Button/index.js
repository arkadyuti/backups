import React, {Component} from 'react';

import axios from 'axios';
import {browserHistory} from 'react-router';

import './styles.scss';

import getCookie from '../../utility'

export default class ButtonComponent extends Component {
	constructor(props) {
		super(props);
		this.state={
			buttonDisabled:'true'
		}	
	}
      

    getFormData(){
        let formDataObject = {};
        let selectedTab = this.props.selectedTab; 
        if(selectedTab === "staffing"){
            formDataObject =  this.props.emptyJSON.staffing_details;
        }
        else if(selectedTab === "techstackTab"){
            formDataObject =  this.props.emptyJSON.techstack;
        }
        else{
                  let tabContent = this.props.configJSON[selectedTab].list;
                  tabContent.map((key) => {
                        formDataObject[key] = this.props.emptyJSON[key]
                  })
            }
            return formDataObject
    }
   
    getEndPoint(projectId){
      switch(this.props.selectedTab){
                  case "basic_information":
                        return (this.props.requestType.type === "create")
                              ?'/project'
                              :'/project/'+projectId+'/basicinfo';
                  case "details":
                        return '/project/'+projectId+'/details'
                  case "status_log":
                        return '/project/'+projectId+'/status'
                  case "techstackTab":
                        return '/project/'+projectId+'/techstack'
                  case "staffing":
                        return '/project/'+projectId+'/staffing'        

      }
    }

    postData(method,url,data,token){
      console.log("URL = >",url+' '+method)
      axios({
                  method: method,
                  url: url,
                  data: data,
                  headers: {'x-access-token': token} 
            })
      .then(function (response) {
                  console.log('RESPONSE =>' ,response)
                  if(!response.data.success){
             console.log('ERROR',response.error)
             return "ERROR"
                  }
                  else{
                    var success = response.data.success;
                    console.log('SUCCESS',success)
                    return "success"
                  }
            })
    }

    postFormData(formDataObject){
      let token = getCookie('x-access-token');
      let projectId = this.props.emptyJSON.pid;
      let host = 'http://10.207.7.131:2220';
      let endPoint = this.getEndPoint(projectId);
      let method = "";
      
      (this.props.requestType.type === "create" && this.props.selectedTab === "basic_information")
      ?method = "post"
      :method = "put"

      this.postData(method,host+endPoint,formDataObject,token)
    }
      /**
      * validateTabLocal - to validate if all the fields of the respective tabs are filled 
      **/

      validateTabLocal(){

      	let allFilled = "true";
      	
      	if(this.props.requestType.type === 'view' && this.props.selectedTab === 'staffing'){
      		console.log("redirect to project list");
      	}

      	else if(this.props.selectedTab === 'staffing'){
      		console.log("FINAL POST REQUEST");
      	}
      	
      	else if(this.props.selectedTab!== 'techstackTab'){
      		this.props.fields.map((field) => {
      			
      			let Regex = this.props.configJSON[field].regex;
      			
      			/*document.getElementById('generic-Button').disabled = false;*/
      			if(!Regex.test(this.props.emptyJSON[field])){
      				
      				allFilled = "false";
      				{this.props.nextClick('false')}
      				this.setState({buttonDisabled:'false'})
      				
      				if(!this.props.emptyJSON[field]) {
      					
      					/*this.refs.buttonInput.disabled = true;*/
      					this.setState({buttonDisabled:'true'})
      					{this.props.nextClick('true')}
      				}
      				else {
      					/*this.refs.buttonInput.disabled = false;*/
      					this.setState({buttonDisabled:'false'})
      				}

      			}
      			
      		})
      	}

      	if(allFilled === "true"){
      		//SERVER CODE
                  let formDataObject = this.getFormData();
                  let postResponse = this.postFormData(formDataObject)
                  console.log("postResponse =>",postResponse)
                   if(this.props.selectedTab === "staffing"){
                    browserHistory.push('/project-list');
                }
                else{

                  let tabs = this.props.configJSON.tabs;
      		let currentTabIndex = tabs.indexOf(this.props.selectedTab);
      		let nextTab =tabs[currentTabIndex +1];
      		this.props.tabClick(nextTab); 
      		this.props.nextClick('true');
      		if(nextTab === "techstackTab" || (nextTab === "staffing")){
      			this.props.nextButtonActive('true');

      		}else{
      			this.props.nextButtonActive('false');

      		}
      		
      		this.setState({buttonDisabled:'true'});




      	}
      }
      	
      }

	/**
      * handleStaffingSubmitButton - to change the Button style value in case of staffing tab
      **/

      handleStaffingSubmitButton() {
			if(this.props.allFieldsCheck === 'false') {
				return 'cp-button cp-disabled-button'
			}
			else {
				return 'cp-button'
			}
			
		}

		render() {
			
			let BUTTONTEXT = (this.props.selectedTab === "staffing")?"Submit":"Next";
			let tabIndex = {tabIndex:0}
			return(
				    <div className="cp-button-wrapper">
				        <button type='button' className={this.handleStaffingSubmitButton()} onClick={this.validateTabLocal.bind(this)} ref="buttonInput" {...tabIndex} >
				            {this.props.name}
				        </button>
				    </div>
				)
		}
	}

