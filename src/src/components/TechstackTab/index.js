import React, { Component } from 'react';
import { connect } from 'react-redux';
import { bindActionCreators } from 'redux';
import './styles.scss';

//Components
import FirstList from '../FirstList/index';
import SecondList from '../SecondList/index';


/*
**TechStack tab component for the create project page containing the FirstList 
and the SecondList Components
*/
export default class TechStack extends Component {
  constructor(props) {
      super(props); 
      this.state={
    }
  }

  componentWillMount(){
    if(this.props.requestType.type === "edit"){

      this.props.resetSecondListBuffer(this.props.emptyJSON.techstack);
      this.props.resetFirstListBuffer(this.props.emptyJSON.techstack);

    }
  }

  componentWillUnmount() {
    if(this.props.requestType.type === "create" || this.props.requestType.type === "edit" || 
      this.props.requestType.type === "view"){
      this.props.resetFirstListBuffer({
                                "frameworks":[],
                                "buildtool":[],
                                "testframework":[]
                            })
      }
      this.props.resetSecondListBuffer({
                                "frameworks":[],
                                "buildtool":[],
                                "testframework":[]
                            });
  }
  
   /*
   **Onclick function on move Button
   ** We are assigning firstListBuffer Global State to EmptyJSON Global state
   through moveclick action
   */
  handleMoveClicked(){

    this.props.updateSecondListBuffer(this.props.firstListBuffer);
    this.props.moveClick(this.props.firstListBuffer);

  }

  /*
  **Onclick function on send Button
  ** We are assigning secondListBuffer Global State to EmptyJSON Global state
   through sendclick action
  */
  handleSendClicked(){
    this.props.sendClick(this.props.secondListBuffer);
  }

  /*
  **It renders the html containing the firstlist,secondlist and the Button wrapper containing
   the move and the send Button
  */
  render() {

    let HTML =
      <div className="cp-tech-stack-wrapper ">
          <FirstList  type              = "library" 
                      firstListClass    = "cp-library-content col-md-5 col-sm-5 col-xs-12"
                      configJSON        = {this.props.configJSON}
                      firstListBuffer   = {this.props.firstListBuffer}
                      requestType       = {this.props.requestType}
                      firstListTracker  = {this.props.firstListTracker}
                      emptyJSON         = {this.props.emptyJSON}/>

          <div className="cp-button-wrapper col-md-2 col-sm-2 col-xs-12">
            <button className="cp-move-button cp-button col-md-12 col-sm-6 col-xs-6"
                    value="MOVE" onClick={this.handleMoveClicked.bind(this)}>MOVE
                    <div className="cp-move-button-icon"></div>  
                    </button>
           
            <button className="cp-send-button cp-button col-md-12 col-sm-6 col-xs-6" 
                    value="SEND" onClick={this.handleSendClicked.bind(this)}>SENDBACK
                    <div className="cp-send-button-icon"></div>  
                    </button>
          </div>
          <SecondList type                  = "selected" 
                      secondListClass       = "cp-selected-content col-md-5 col-sm-5 col-xs-12"
                      configJSON            = {this.props.configJSON}
                      emptyJSON             = {this.props.emptyJSON}
                      secondListBuffer      = {this.props.secondListBuffer}
                      requestType           = {this.props.requestType}
                      secondListTracker     = {this.props.secondListTracker}/>
          
      </div>

  let VIEWHTML =  
      <div className="cp-tech-stack-wrapper-view-mode">
          <FirstList  type              = "library" 
                      firstListClass    = "cp-library-content col-md-6 col-sm-6 col-xs-12"
                      configJSON        = {this.props.configJSON}
                      requestType       = {this.props.requestType}/>
          <SecondList type              = "selected" 
                      secondListClass   = "cp-selected-content col-md-6 col-sm-6 col-xs-12"
                      emptyJSON         = {this.props.emptyJSON}
                      requestType       = {this.props.requestType}
                      configJSON        = {this.props.configJSON}/>
      </div>

  /*
  **If condition here is applied to check the requestType and rendering of HTML 
  and VIEWHTML is done based on it
  */
  if(this.props.requestType.type === 'view'){
    return(
      <div className = "row">
       {VIEWHTML}
      </div>
      )
  }

  else{
     return(
      <div className = "row">
       {HTML}
      </div>
      )
  }

  }
}
