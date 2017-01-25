import React,{Component} from 'react';
import './styles.scss';

//Containers
import ElementContainer from '../../containers/ElementContainer';
import TechstackContainer from '../../containers/TechstackContainer';
import StaffingContainer from '../../containers/StaffingContainer';

//Components
import ButtonComponent from '../Button/index.js';
import Breadcrumb from '../Breadcrumb/index';
import Loader from '../Loader/index';

export default class TabCreate extends Component{

	constructor(props) {
        super(props);
        this.state = {
        };
        this.isTabActive = this.isTabActive.bind(this);
        this.handleTabClick = this.handleTabClick.bind(this);
    }

    componentWillMount() {

        this.props.fetchJSON("create",55555);
        this.props.nextButtonActive('false');


    }

    componentWillUnmount() {
        this.props.nullifyRequestType("false");
    }


    componentDidUpdate() {
        if(this.props.selectedTab!=='techstackTab'){       
            {this.tabFieldCheck()}
        }
               
    }


    /**
     * handleTabClick - adds 'active' className to the currently selected tab
     * tabname - the selected tabname from configJSON
    **/

     handleTabClick(tabname){
         if(tabname === this.props.selectedTab) {
            if(tabname === 'basic_information'){
               
                return 'cp-tab-item cp-basic-information';
            }
            else if(tabname === 'techstackTab'){
                return 'cp-tab-item cp-tech-stack';
            }
            else {
                 return 'cp-tab-item cp-active';
            }

        }
        else {
            return 'cp-tab-item cp-default'
        }
    }


     /**
     * isTabActive - shows/hides the content of the tabs based on the selection
     * tabname - the selected tabname from configJSON
    **/

    isTabActive(tabname){

        return  (tabname)===this.props.selectedTab? "cp-show":"cp-hide";
    }

    /**
     * onFormSubmit - submits the form contents 
     * event - type object
    **/

    onFormSubmit(event){
        event.preventDefault();
    }


        tabFieldCheck(){
            let count = this.props.configJSON[this.props.selectedTab].list.length;
            ((this.props.emptyJSON) && (this.props.selectedTab !== 'techStackTab'))?this.props.configJSON[this.props.selectedTab].list.map((field)=> {
                if(this.props.emptyJSON[field]) {
                    count=count-1;
                }
            }):'Loading'
                
            if(count===0 && this.props.requestType.type === "create") {

                this.props.nextButtonActive('true')
         
            }
         }


    render(){
        
        let TABHTML = '';
        let HTML = '';

        /**
        * errorMsgCheck - to display error message for invalid input
         **/

        let errorMsgCheck = (this.props.validateTabNext ==='false')?'cp-tab-error':'';


        /**
         * ErrorHTML - to display error message for tab validation
        **/

         let ErrorHTML = (this.props.validateTabNext === 'false')?
         <span>
         Invalid details in {this.props.configJSON[this.props.selectedTab].name} tab
         </span>
         : '';


        /**
         * TABHTML - to render the respective tab content based on the selection
        **/


        if(this.props.requestType.type === "create"){



            TABHTML = this.props.configJSON.tabs.map((tabitem) => {
                switch(this.props.configJSON[tabitem].type) {
                    case "genericTab": return (
                            <div key = {this.props.configJSON[tabitem].id}
                                 className={this.isTabActive(tabitem)}>
                                <ElementContainer list = {this.props.configJSON[tabitem].list}
                                                  fields = {this.props.configJSON[this.props.selectedTab].list}/>                           
                            
                            </div>
                        );
                    break;

                    case "staffingTab":  return(
                                <div key = {this.props.configJSON[tabitem].id}
                                        className={this.isTabActive(tabitem)}>
                                        <StaffingContainer list = {this.props.configJSON[tabitem].list}/>
                                        
                                 </div>    
                            );
                    break;

                    case "techStackTab": return(
                                <div key = {this.props.configJSON[tabitem].id}
                                        className={this.isTabActive(tabitem)}>
                                        <TechstackContainer/>
                                        
                                 </div> 
                            );
                    break;

                }
            });
        

        /**
         * HTML component
         * to render all tabs from the configJSON
        **/

         HTML = this.props.configJSON.tabs.map((tabitem) => {
                        return (
                                <li key = {this.props.configJSON[tabitem].id}
                                    className={this.handleTabClick(tabitem)} 
                                    onClick = {(event) =>  this.props.tabClick(tabitem)}  
                                    data-map={this.props.configJSON[tabitem].name}>
                                    {this.props.configJSON[tabitem].name}</li>
                        )
                    });
        }
        else {
           return <Loader>Loading...<div className="fetch-loader-icon"></div></Loader>
        }

        let BUTTONHTML = (this.props.emptyJSON)?
                            ((this.props.selectedTab !== 'staffing')?
                                <ButtonComponent fields={this.props.configJSON[this.props.selectedTab].list} 
                                                 name="Next"
                                                 requestType = {this.props.requestType} 
                                                 emptyJSON = {this.props.emptyJSON}
                                                 configJSON = {this.props.configJSON}
                                                 selectedTab = {this.props.selectedTab}
                                                 validateTabNext = {this.props.validateTabNext}
                                                 tabClick = {this.props.tabClick}
                                                 nextClick = {this.props.nextClick}
                                                allFieldsCheck = {this.props.allFieldsCheck}
                                                nextButtonActive = {this.props.nextButtonActive}/>
 
                                : <ButtonComponent fields={this.props.configJSON[this.props.selectedTab].list} 
                                                 name="Submit"
                                                 requestType = {this.props.requestType} 
                                                 emptyJSON = {this.props.emptyJSON}
                                                 configJSON = {this.props.configJSON}
                                                 selectedTab = {this.props.selectedTab}
                                                 validateTabNext = {this.props.validateTabNext}
                                                 tabClick = {this.props.tabClick}
                                                 nextClick = {this.props.nextClick} 
                                                 allFieldsCheck = {this.props.allFieldsCheck}
                                                 nextButtonActive = {this.props.nextButtonActive}/>)
                        : ''

    	return (
    			
				<div className="cp-tab-container">
                    <Breadcrumb breadcrumbProp = {[{id:"firstItem",link:"Projects"},{id:"secondItem",link:">"},{id:"lastItem",link:"Create Project"}]}/>
                    <span className="cp-page-heading">
                         CREATE PROJECT
                    </span>

					<nav className="cp-tab-nav">
						<ul className='cp-tab-list'>
                          {HTML}  
						</ul>
					</nav>

				    <form className="cp-tab-content container" name="create-project-form" noValidate onSubmit={this.onFormSubmit.bind(this)}>
					   {TABHTML}

                        <div className = "cp-form-footer">
                       
                            <div className={errorMsgCheck}>
                                {ErrorHTML}
                            </div>
                            {BUTTONHTML}
                        </div>

				    </form>
              
				</div> 	
    	)
    }
}